# Qasim Ali Portfolio - Single File Deployment

## Overview

This is a standalone, single-file portfolio website for Qasim Ali. The entire portfolio is contained in a single HTML file (`portfolio.html`) that includes all necessary CSS and JavaScript. This makes it extremely easy to deploy anywhere on the internet.

## Features

- **Fully Responsive Design** - Looks great on all devices from mobile to desktop
- **Modern UI** - Clean, professional design with smooth animations
- **No External Dependencies** - All CSS and JavaScript are included in the file
- **Contact Form** - Functional contact form (can be connected to a backend service)
- **Dark Theme** - Modern dark theme with lime green accents
- **Optimized Performance** - Fast loading with minimal code

## How to Use

### Local Viewing

Simply open the `portfolio.html` file in any web browser to view the portfolio locally.

### Deployment Options

1. **GitHub Pages**
   - Create a new GitHub repository
   - Upload the `portfolio.html` file (you can rename it to `index.html`)
   - Enable GitHub Pages in the repository settings
   - Your portfolio will be available at `https://yourusername.github.io/repository-name`

2. **Netlify**
   - Sign up for a free Netlify account
   - Drag and drop the `portfolio.html` file to the Netlify dashboard
   - Your portfolio will be deployed instantly with a Netlify subdomain
   - You can add a custom domain in the Netlify settings

3. **Vercel**
   - Sign up for a free Vercel account
   - Create a new project and upload the `portfolio.html` file
   - Your portfolio will be deployed with a Vercel subdomain
   - You can add a custom domain in the Vercel settings

4. **Any Web Hosting Service**
   - Upload the `portfolio.html` file to any web hosting service
   - Rename it to `index.html` if needed
   - Your portfolio will be available at your domain

## Customization

You can easily customize the portfolio by editing the `portfolio.html` file:

- **Personal Information**: Update the name, title, contact details, etc.
- **Skills**: Modify the skills lists in each category
- **Experience**: Update work experience details
- **Education**: Change education information
- **Colors**: Modify the CSS variables at the top of the style section to change the color scheme
- **Social Links**: Update the social media links in the footer

## Contact Form Integration

The contact form currently shows a success message without sending data. To make it functional:

1. **Email Service Integration**:
   - Sign up for a service like Formspree, FormSubmit, or Netlify Forms
   - Update the form action attribute with your endpoint

2. **Custom Backend**:
   - Create a simple backend service (Node.js, PHP, etc.)
   - Update the form submission JavaScript to send data to your API

## License

Feel free to use and modify this portfolio template for your personal use.

## Credits

Design and implementation based on the portfolio project for Qasim Ali.