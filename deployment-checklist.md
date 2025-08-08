# Deployment Checklist

Use this checklist to ensure you've completed all necessary steps for deploying your portfolio project on Render.com.

## Prerequisites

- [ ] Create a MongoDB Atlas account and set up a database (see `mongodb-setup.md`)
- [ ] Create a GitHub account and repository (see `github-setup.md`)
- [ ] Create a Render.com account

## Local Setup

- [ ] Initialize Git repository
- [ ] Add all files to Git
- [ ] Create initial commit
- [ ] Push to GitHub

## MongoDB Configuration

- [ ] Create database user with secure password
- [ ] Configure network access (IP whitelist)
- [ ] Get MongoDB connection string
- [ ] Test database connection locally

## Render.com Setup

- [ ] Connect GitHub account to Render.com
- [ ] Create new Blueprint deployment
- [ ] Select your portfolio repository
- [ ] Configure environment variables:
  - [ ] `MONGO_URL`: Your MongoDB connection string
  - [ ] `DB_NAME`: Your database name (default: portfolio)
- [ ] Deploy the services

## Post-Deployment

- [ ] Verify static site is accessible
- [ ] Verify API is accessible and connected to MongoDB
- [ ] Set up custom domain (optional)
- [ ] Configure SSL/TLS (automatic with Render.com)

## Maintenance

- [ ] Set up automatic deployments from GitHub
- [ ] Monitor application performance
- [ ] Set up database backups

## Security

- [ ] Ensure sensitive data is not committed to Git
- [ ] Use environment variables for all secrets
- [ ] Regularly update dependencies