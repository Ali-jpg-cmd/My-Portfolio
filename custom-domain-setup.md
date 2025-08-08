# Custom Domain Setup Guide

This guide will help you set up a custom domain for your portfolio project deployed on Render.com.

## Step 1: Purchase a Domain Name

If you don't already own a domain name, you'll need to purchase one from a domain registrar such as:

- [Namecheap](https://www.namecheap.com/)
- [Google Domains](https://domains.google/)
- [GoDaddy](https://www.godaddy.com/)
- [Cloudflare Registrar](https://www.cloudflare.com/products/registrar/)

Choose a domain name that represents you professionally (e.g., `yourname.com`, `yourname.dev`).

## Step 2: Add Custom Domain in Render.com

1. Log in to your [Render.com dashboard](https://dashboard.render.com/)
2. Select your static site (portfolio-static)
3. Go to the "Settings" tab
4. Scroll down to "Custom Domain"
5. Click "Add Custom Domain"
6. Enter your domain name (e.g., `yourname.com` or `www.yourname.com`)
7. Click "Save"

## Step 3: Configure DNS Settings

Render will provide you with specific DNS records to add to your domain registrar. Typically, you'll need to add:

### For an Apex Domain (e.g., `yourname.com`)

Add these records at your domain registrar:

```
Type: A
Name: @
Value: 76.76.21.21
TTL: 3600 (or default)
```

### For a WWW Subdomain (e.g., `www.yourname.com`)

Add these records at your domain registrar:

```
Type: CNAME
Name: www
Value: yoursite.onrender.com. (with the trailing dot)
TTL: 3600 (or default)
```

## Step 4: Verify Domain Ownership

1. After adding the DNS records, go back to your Render.com dashboard
2. Render will automatically check for the correct DNS configuration
3. DNS changes can take up to 48 hours to propagate, but typically happen within a few hours

## Step 5: Set Up SSL/TLS Certificate

Render.com automatically provisions and renews SSL/TLS certificates for your custom domains using Let's Encrypt. No additional configuration is required.

## Step 6: Test Your Custom Domain

1. Wait for DNS propagation to complete
2. Visit your custom domain in a web browser
3. Verify that your portfolio loads correctly
4. Check that the SSL certificate is valid (look for the padlock icon in your browser)

## Troubleshooting

If your custom domain isn't working:

1. Verify that your DNS records are set up correctly
2. Check the Render.com dashboard for any error messages
3. Use a DNS lookup tool like [DNSChecker](https://dnschecker.org/) to verify your DNS records have propagated
4. Wait longer for DNS propagation (up to 48 hours)
5. Contact Render.com support if issues persist