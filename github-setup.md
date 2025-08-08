# GitHub Repository Setup Guide

This guide will help you set up a GitHub repository for your portfolio project, which is required for deployment on Render.com.

## Step 1: Create a GitHub Account

If you don't already have a GitHub account:

1. Go to [GitHub](https://github.com/)
2. Click "Sign up"
3. Follow the registration process

## Step 2: Create a New Repository

1. After logging in, click the "+" icon in the top-right corner
2. Select "New repository"
3. Name your repository (e.g., "my-portfolio")
4. Add an optional description
5. Choose "Public" visibility (or "Private" if you prefer)
6. Click "Create repository"

## Step 3: Initialize Git in Your Local Project

Open a terminal or command prompt in your portfolio project directory and run:

```bash
# Initialize Git repository
git init

# Add all files to staging
git add .

# Commit the changes
git commit -m "Initial commit"
```

## Step 4: Connect to GitHub Repository

Run the following commands, replacing `YOUR_USERNAME` with your GitHub username and `my-portfolio` with your repository name:

```bash
# Add the remote repository
git remote add origin https://github.com/YOUR_USERNAME/my-portfolio.git

# Push to GitHub
git push -u origin main
```

Note: If your default branch is named "master" instead of "main", use:

```bash
git push -u origin master
```

## Step 5: Verify Repository

1. Go to your GitHub profile
2. Navigate to your repositories
3. Click on your portfolio repository
4. Ensure all files have been uploaded correctly

## Next Steps

Now that your code is on GitHub, you can proceed with deploying to Render.com by following the instructions in the main README.md file.