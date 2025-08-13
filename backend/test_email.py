import requests
import json
import time

# Test data for contact form
test_data = {
    "name": "Test User",
    "email": "test@example.com",
    "subject": "Test Email",
    "message": "This is a test message to verify email functionality."
}

# Send request to the contact endpoint
url = "http://localhost:8000/api/contact"
headers = {"Content-Type": "application/json"}

print("Sending test request to:", url)
print("With data:", json.dumps(test_data, indent=2))

try:
    # Add a timeout of 10 seconds to prevent hanging
    start_time = time.time()
    print("Starting request at:", time.strftime("%H:%M:%S", time.localtime()))
    
    response = requests.post(url, json=test_data, headers=headers, timeout=10)
    
    end_time = time.time()
    print(f"Request completed in {end_time - start_time:.2f} seconds")
    print("\nResponse status code:", response.status_code)
    
    if response.status_code == 200:
        print("Success! Response data:")
        print(json.dumps(response.json(), indent=2))
    else:
        print("Error! Response:")
        print(response.text)
except requests.exceptions.Timeout:
    print("Request timed out after 10 seconds. The server might be processing the request but not responding.")
    print("Check the server logs for more information.")
except Exception as e:
    print("Exception occurred:", str(e))