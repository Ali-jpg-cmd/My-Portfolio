# Qasim Ali Portfolio WordPress Theme

## Overview
This WordPress theme provides the backend API and admin interface for Qasim Ali's portfolio website. The frontend is handled by a separate React application.

## Features
- Custom post types for Experience, Education, Skills, and Contact Messages
- WordPress admin interface for content management
- REST API endpoints for frontend integration
- Contact form handling with email notifications
- CORS support for cross-origin requests

## Installation

### 1. WordPress Setup
1. Install WordPress locally (using XAMPP, WAMP, or similar)
2. Copy this theme folder to `/wp-content/themes/`
3. Activate the theme from WordPress admin
4. The theme will automatically create necessary post types and default data

### 2. Theme Structure
```
wordpress-theme/
├── functions.php    # Main theme functionality
├── style.css       # Theme header and basic styles
├── index.php       # Main template (shows API info)
└── README.md       # This file
```

### 3. Admin Interface
After activation, you'll see a new "Portfolio" menu in WordPress admin with:
- **Personal Info**: Update name, title, contact details, summary
- **Skills**: Manage technical skills by category (future enhancement)
- **Experience**: Add/edit work experience (future enhancement)
- **Education**: Manage educational background (future enhancement)
- **Contact Messages**: View form submissions

### 4. API Endpoints
The theme creates these REST API endpoints:

#### GET `/wp-json/portfolio/v1/personal`
Returns personal information (name, title, location, phone, email, summary)

#### GET `/wp-json/portfolio/v1/skills`
Returns skills organized by category (frontend, backend, tools, other)

#### GET `/wp-json/portfolio/v1/experience`
Returns work experience with achievements

#### GET `/wp-json/portfolio/v1/education`
Returns educational background with coursework

#### POST `/wp-json/portfolio/v1/contact`
Handles contact form submissions
- Saves messages to database
- Sends email notifications
- Returns success/error response

## Frontend Integration
The React frontend should make API calls to these endpoints instead of using mock data. Update the frontend's API service to point to your WordPress installation URL.

Example:
```javascript
const API_BASE = 'http://your-wordpress-site.local/wp-json/portfolio/v1';
```

## WordPress Secret Key
The SECRET_KEY provided earlier should be added to your WordPress `wp-config.php` file:

```php
define('SECRET_KEY', '0mo[<Apr\"8Ibpi?hFf-ttuD@s-.Jpe?C<R6H90n6\\CLvp\"fg,}\"C*a6C(]:zHJy8');
```

## Content Management
1. **Personal Information**: Use Portfolio > Personal Info to update your details
2. **Contact Messages**: Check Portfolio > Contact Messages for form submissions
3. **Skills/Experience/Education**: Currently using static data, can be enhanced with custom fields

## Development Notes
- The theme initializes with Qasim's data from the resume
- CORS is enabled for cross-origin requests
- Contact form saves messages and sends email notifications
- Admin interface is user-friendly for non-technical content updates

## Future Enhancements
- Custom fields interface for Skills management
- Experience and Education post editing
- File upload capabilities
- Advanced contact form features
- Email template customization

## Support
This theme is specifically designed for Qasim Ali's portfolio. For modifications or support, refer to the contracts.md file for technical specifications.