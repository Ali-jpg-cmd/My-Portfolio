# MongoDB Atlas Setup Guide

This guide will help you set up a free MongoDB Atlas database for your portfolio project.

## Step 1: Create a MongoDB Atlas Account

1. Go to [MongoDB Atlas](https://www.mongodb.com/cloud/atlas/register)
2. Sign up for a free account
3. Complete the registration process

## Step 2: Create a New Cluster

1. After logging in, click "Build a Database"
2. Select the "FREE" tier option (M0 Sandbox)
3. Choose your preferred cloud provider and region (closest to your target audience)
4. Name your cluster (e.g., "PortfolioCluster")
5. Click "Create Cluster" (this may take a few minutes to provision)

## Free Tier Limitations

MongoDB Atlas free tier (M0) includes:

- Shared RAM and vCPU
- 512 MB storage
- Shared clusters with other free tier users
- No backup
- No SLA

This is sufficient for a portfolio project with moderate usage. To stay within the free tier:

1. Keep your database size under 512 MB
2. Implement proper data cleanup for logs and temporary data
3. Be mindful of connection limits (500 connections per cluster)

## Step 3: Set Up Database Access

1. In the left sidebar, click on "Database Access" under SECURITY
2. Click "Add New Database User"
3. Create a username and a secure password
4. Set privileges to "Read and write to any database"
5. Click "Add User"

## Step 4: Configure Network Access

1. In the left sidebar, click on "Network Access" under SECURITY
2. Click "Add IP Address"
3. For development, you can click "Allow Access from Anywhere" (not recommended for production)
4. For production, add the specific IP addresses of your Render.com services
5. Click "Confirm"

## Step 5: Get Your Connection String

1. Go back to the "Database" section
2. Click "Connect" on your cluster
3. Select "Connect your application"
4. Copy the connection string
5. Replace `<password>` with your database user's password
6. Replace `<dbname>` with `portfolio` (or your preferred database name)

## Step 6: Add to Render.com

1. In your Render.com dashboard, go to your portfolio-api service
2. Navigate to the "Environment" tab
3. Add an environment variable named `MONGO_URL` with your connection string
4. Add another environment variable named `DB_NAME` with value `portfolio`
5. Click "Save Changes"

## Testing the Connection

After deployment, you can test if your API is properly connected to MongoDB by accessing:

```
https://portfolio-api.onrender.com/api
```

You should see a JSON response with a "Hello World" message.