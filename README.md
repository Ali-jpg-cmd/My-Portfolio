# Portfolio Project Deployment Guide

## Project Structure

This portfolio project consists of two main components:

1. **Static HTML Portfolio** - A single HTML file with CSS and JavaScript
2. **FastAPI Backend** - A Python API server for handling data operations

## Deployment on Render.com

This project is configured for easy deployment on Render.com, which offers free hosting for both static sites and web services. The `render.yaml` file has been configured to use Render's free tier for both services.

### Prerequisites

1. Create a [Render.com](https://render.com) account
2. Set up a MongoDB database (you can use [MongoDB Atlas](https://www.mongodb.com/cloud/atlas) free tier)
3. Connect your GitHub/GitLab/Bitbucket account to Render

### Deployment Steps

1. Push this repository to your GitHub/GitLab/Bitbucket account
2. Log in to your Render.com dashboard
3. Click on the "New +" button and select "Blueprint"
4. Connect to your repository
5. Render will automatically detect the `render.yaml` configuration file
6. Set the required environment variables:
   - `MONGO_URL`: Your MongoDB connection string
   - `DB_NAME`: Your database name (default: portfolio)
7. Click "Apply" to deploy both the API and static site

### Free Tier Limitations

Render's free tier includes:

- **Web Services**: 750 hours of runtime per month
- **Static Sites**: Unlimited static site hosting
- **Suspended after inactivity**: Free web services are suspended after 15 minutes of inactivity
- **Startup time**: Services may take up to 30 seconds to spin up after being suspended

To stay within the free tier:

1. Use MongoDB Atlas free tier for your database
2. Keep your API usage moderate
3. Be aware that the API will sleep after 15 minutes of inactivity and take time to wake up on the next request

### Accessing Your Deployed Portfolio

Once deployment is complete, you can access your portfolio at:

- **Static Portfolio**: `https://portfolio-static.onrender.com`
- **API**: `https://portfolio-api.onrender.com`

### Custom Domain Setup

To use your own domain:

1. Go to your static site in the Render dashboard
2. Navigate to the "Settings" tab
3. Scroll down to "Custom Domain"
4. Add your domain and follow the DNS configuration instructions

## Local Development

### Backend

```bash
cd backend
pip install -r requirements.txt
uvicorn server:app --reload
```

The API will be available at http://localhost:8000

### Frontend

Simply open the `portfolio.html` file in your browser.