# API Contracts - Qasim Ali Portfolio

## Overview
This document defines the integration between the React frontend portfolio and WordPress backend for Qasim Ali's portfolio website.

## Current Frontend Implementation
- **Mock Data Location**: `/app/frontend/src/data/mock.js`
- **Components**: Header, Hero, Skills, Experience, Education, Contact, Footer
- **Design**: Pixel Pushers inspired (dark theme with lime green accents)
- **Sections**: Skip projects section (as requested)

## WordPress Integration Plan

### 1. WordPress Custom Post Types & Fields

#### A. Portfolio Settings (Options Page)
```php
// Personal Information
- name (text)
- title (text) 
- location (text)
- phone (text)
- email (email)
- summary (textarea)
```

#### B. Skills (Custom Post Type: 'skills')
```php
// Meta Fields
- skill_category (select: frontend, backend, tools, other)
- skill_items (repeater field with skill names)
```

#### C. Experience (Custom Post Type: 'experience')
```php
// Meta Fields  
- job_title (text)
- company_location (text)
- period (text)
- achievements (repeater field)
```

#### D. Education (Custom Post Type: 'education')
```php
// Meta Fields
- degree (text)
- institution (text) 
- period (text)
- coursework (repeater field)
```

### 2. WordPress REST API Endpoints

#### Base URL: `/wp-json/portfolio/v1/`

#### A. Personal Information
```
GET /personal
Response: {
  name, title, location, phone, email, summary
}
```

#### B. Skills
```
GET /skills
Response: {
  frontend: [array],
  backend: [array], 
  tools: [array],
  other: [array]
}
```

#### C. Experience
```
GET /experience  
Response: [
  {
    title, location, period, achievements: [array]
  }
]
```

#### D. Education
```
GET /education
Response: [
  {
    degree, institution, period, coursework: [array]
  }
]
```

#### E. Contact Form
```
POST /contact
Body: {
  name, email, subject, message
}
Response: {
  success: boolean,
  message: string
}
```

### 3. Frontend Integration Changes

#### A. Replace Mock Data
1. Remove mock.js imports
2. Create API service layer (`/services/api.js`)
3. Add loading states to components
4. Add error handling

#### B. API Service Implementation
```javascript
// /app/frontend/src/services/api.js
const API_BASE = process.env.REACT_APP_BACKEND_URL + '/wp-json/portfolio/v1';

export const portfolioAPI = {
  getPersonal: () => fetch(`${API_BASE}/personal`),
  getSkills: () => fetch(`${API_BASE}/skills`),
  getExperience: () => fetch(`${API_BASE}/experience`),
  getEducation: () => fetch(`${API_BASE}/education`),
  submitContact: (data) => fetch(`${API_BASE}/contact`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
};
```

### 4. WordPress Theme Files

#### Required Files:
- `functions.php` - Register custom post types, fields, REST endpoints
- `index.php` - Main template (can be minimal)
- `style.css` - Theme info header
- `admin/` - Custom admin interface for portfolio management

### 5. Implementation Steps

1. **WordPress Setup**
   - Install WordPress locally
   - Create custom theme with post types & fields
   - Set up REST API endpoints
   - Add sample data matching mock.js structure

2. **Frontend Integration**
   - Create API service layer
   - Update components to use real data
   - Add loading & error states
   - Test all functionality

3. **Contact Form**
   - WordPress handles form submissions
   - Store in database (custom table or WP posts)
   - Send email notifications
   - Return success/error responses

### 6. WordPress Custom Fields Structure

#### ACF (Advanced Custom Fields) Configuration:
```php
// Personal Info (Options Page)
'personal_info' => [
  'name', 'title', 'location', 'phone', 'email', 'summary'
]

// Skills (Repeater by category)
'skills_frontend' => ['skill_name']
'skills_backend' => ['skill_name'] 
'skills_tools' => ['skill_name']
'skills_other' => ['skill_name']
```

### 7. Data Migration

Current mock data will be migrated to WordPress:
- Personal info → Options page
- Skills → Custom post type with meta fields
- Experience → Custom post type with achievements repeater
- Education → Custom post type with coursework repeater

This approach maintains the exact same frontend design while providing a WordPress admin interface for content management.