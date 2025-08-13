from fastapi import FastAPI, APIRouter, BackgroundTasks
from dotenv import load_dotenv
from starlette.middleware.cors import CORSMiddleware
from motor.motor_asyncio import AsyncIOMotorClient
import os
import logging
from pathlib import Path
from pydantic import BaseModel, Field, EmailStr
from typing import List
import uuid
from datetime import datetime
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart


ROOT_DIR = Path(__file__).parent
load_dotenv(ROOT_DIR / '.env')

# Create a mock database class for development
class MockCollection:
    async def insert_one(self, document):
        print(f"Mock insert: {document}")
        return None
        
    async def find(self):
        return MockCursor()

class MockCursor:
    async def to_list(self, length):
        return []

class MockDB:
    def __init__(self):
        self.contact_messages = MockCollection()
        self.status_checks = MockCollection()

# Initialize db as MockDB
db = MockDB()
print("Using mock database - email functionality will still work")

# Create the main app without a prefix
app = FastAPI()

# Create a router with the /api prefix
api_router = APIRouter(prefix="/api")


# Define Models
class StatusCheck(BaseModel):
    id: str = Field(default_factory=lambda: str(uuid.uuid4()))
    client_name: str
    timestamp: datetime = Field(default_factory=datetime.utcnow)

class StatusCheckCreate(BaseModel):
    client_name: str
    
class ContactMessage(BaseModel):
    id: str = Field(default_factory=lambda: str(uuid.uuid4()))
    name: str
    email: EmailStr
    subject: str
    message: str
    timestamp: datetime = Field(default_factory=datetime.utcnow)
    
class ContactMessageCreate(BaseModel):
    name: str
    email: EmailStr
    subject: str
    message: str

# Email sending function
async def send_email(message: ContactMessage):
    # Get email configuration from environment variables
    smtp_server = os.environ.get('SMTP_SERVER', 'smtp.gmail.com')
    smtp_port = int(os.environ.get('SMTP_PORT', 587))
    smtp_username = os.environ.get('SMTP_USERNAME', 'qasimali20041004@gmail.com')
    smtp_password = os.environ.get('SMTP_PASSWORD')
    recipient_email = os.environ.get('RECIPIENT_EMAIL', 'qasimali20041004@gmail.com')
    
    # Log email configuration for debugging (without password)
    logger.info(f"Email config: server={smtp_server}, port={smtp_port}, username={smtp_username}, recipient={recipient_email}")
    if not smtp_password:
        logger.error("SMTP password is not set in environment variables")
        return False
    
    # Create email message
    msg = MIMEMultipart()
    msg['From'] = smtp_username
    msg['To'] = recipient_email
    msg['Subject'] = f"Portfolio Contact: {message.subject}"
    
    # Email body
    body = f"""Name: {message.name}
Email: {message.email}
Subject: {message.subject}

Message:
{message.message}
"""
    msg.attach(MIMEText(body, 'plain'))
    
    try:
        # Connect to SMTP server and send email
        logger.info(f"Connecting to SMTP server: {smtp_server}:{smtp_port}")
        server = smtplib.SMTP(smtp_server, smtp_port)
        
        logger.info("Starting TLS connection")
        server.starttls()
        
        logger.info(f"Logging in with username: {smtp_username}")
        server.login(smtp_username, smtp_password)
        
        logger.info("Sending email message")
        server.send_message(msg)
        
        logger.info("Closing SMTP connection")
        server.quit()
        
        logger.info(f"Email sent successfully from {message.email}")
        return True
    except smtplib.SMTPAuthenticationError as e:
        logger.error(f"SMTP Authentication Error: {str(e)}. Please check your email credentials.")
        return False
    except smtplib.SMTPException as e:
        logger.error(f"SMTP Error: {str(e)}")
        return False
    except Exception as e:
        logger.error(f"Failed to send email: {str(e)}")
        return False

# Add your routes to the router instead of directly to app
@api_router.get("/")
async def root():
    return {"message": "Hello World"}

@api_router.post("/status", response_model=StatusCheck)
async def create_status_check(input: StatusCheckCreate):
    status_dict = input.dict()
    status_obj = StatusCheck(**status_dict)
    if db is not None:
        try:
            _ = await db.status_checks.insert_one(status_obj.dict())
        except Exception as e:
            logger.error(f"Failed to save status check to database: {str(e)}")
    return status_obj

@api_router.get("/status", response_model=List[StatusCheck])
async def get_status_checks():
    if db is not None:
        try:
            status_checks = await db.status_checks.find().to_list(1000)
            return [StatusCheck(**status_check) for status_check in status_checks]
        except Exception as e:
            logger.error(f"Failed to retrieve status checks from database: {str(e)}")
    return []

@api_router.post("/contact", response_model=ContactMessage)
async def send_contact_message(input: ContactMessageCreate, background_tasks: BackgroundTasks):
    try:
        # Log incoming request
        logger.info(f"Received contact form submission from: {input.email}")
        
        # Create contact message object
        contact_dict = input.dict()
        contact_obj = ContactMessage(**contact_dict)
        
        # Save to database if available
        if db is not None:
            try:
                await db.contact_messages.insert_one(contact_obj.dict())
                logger.info("Contact message saved to database")
            except Exception as e:
                logger.error(f"Failed to save contact message to database: {str(e)}")
        
        # Send email in background
        background_tasks.add_task(send_email, contact_obj)
        logger.info("Email task added to background tasks")
        
        return contact_obj
    except Exception as e:
        logger.error(f"Error processing contact form submission: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

# Include the router in the main app
app.include_router(api_router)

app.add_middleware(
    CORSMiddleware,
    allow_credentials=True,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

@app.on_event("shutdown")
async def shutdown_db_client():
    if 'client' in globals() and client is not None:
        client.close()
