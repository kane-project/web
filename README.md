# Kane Project - Web

The KANE Project's website. Real estate listings for newcomers to Canada.

# Contribution Guide

1. Create a feature branch to make your changes.
2. Test your changes thoroughly.
3. Make a PR
4. We will review the changes together and merge them to `main`.

# TODO for Kane-Web

## L'chronologie

- [x] Landlord Registration + Login Initial Security Audit
- [x] Landlord Password Reset
- [ ] Listings Page {Check Loading Order, Filters, Pagination}
- [ ] Listing View Page
- [ ] Homepage Rework
- [ ] Client Login + Initial Auth Security Audit
- [ ] Client Registration + Marketing Email Opt-in + Forgot Password
- [ ] Client Account Purchases
- [ ] Landlord Account Settings
- [ ] Client Account Settings
- [ ] Reporting Mechanism
- [ ] Admin Pages
- [ ] Email Marketing Templates + Generator
- [ ] Info Pages {About, Contact, Safety, Terms, Privacy, Refunds, Footer Links}

## Pre-Deployment Tasks

- Evaluate and implement using Content Delivery Networks (CDN) for improved performance and load times.
- Check for error messages and set up secure logging
- Security Audit & extensive A/B Testing
- SEO & Analytics library for listing stats
- Add reCaptcha
- Transactional emails
- CRON job to clean archived data every 7 years
- Database Security! Rotating DB secrets and switch to RDS!
- THE ABILITY TO EDIT LISTING PHOTOS!

## Pre-Audit

- Image Uploads (Size Limit, File Type and Extension!)
- UserID security
- Email Limit Attack (Cloudflare?)
- DB Leak Prevention

## Pages

**Landlord Portal Prototype**

- Registration: Implement user registration functionality.
- Listings List: Create a page displaying a list of landlord's listings.
- Edit Listing: Allow landlords to edit their existing listings.
- Messages: Implement messaging functionality.
- Message Thread: Develop a thread view for message conversations.
- Account Settings: Provide options for landlords to manage their account settings.
- Dashboard: Create a personalized dashboard for landlords.

**Client Portal Prototype**

- Listings: Display a list of available listings for clients.
- Listing View + Initial Inquiry: Allow clients to view details of a listing and make initial inquiries.
- Messages + Message Thread: Enable clients to communicate with landlords.
- Account Settings: Offer options for clients to manage their account settings.
- About, Contact, Legalese: Create informative pages for users.

**Admin Pages**

- Dashboard: Develop an admin dashboard for overview and management.
- Login: Implement a secure login system for administrators.
- Reports: Create reporting features for admin purposes.
- Users: Manage user accounts and permissions.
- Listings: Administer and oversee property listings.
- Settings: Implement admin settings.

**Polish and DevOps it**

- Polish UI/UX and continously refactor.
- AWS EC2, S3, Route53
- Brevo Email
- Stripe

## BUGS

None so far, *yay*!