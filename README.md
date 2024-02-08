# Kane Project - Web

The KANE Project's website. Real estate listings for newcomers to Canada.

# Contribution Guide

1. Create a feature branch to make your changes.
2. Test your changes thoroughly.
3. Make a PR
4. We will review the changes together and merge them to `main`.

# TODO for Kane-Web

## L'chronologie

- Listings Page {Loading Order, Filters, Pagination}
- Listing View Page
- Generic Email Templates
- Landlord Registration + Login Initial Security Audit
- Landlord Password Reset
- Homepage Rework
- Client Login + Initial Auth Security Audit
- Client Registration + Forgot Password {Don't Forget Email List Signup}
- Client Account Purchases
- Landlord Account Settings
- Client Account Settings
- Reporting Mechanism
- ADMIN PAGE INIT
- Email Marketing
- Info Pages {About, Contact, Safety, Terms, Privacy, Refunds, Footer Links}

## Pre-Deployment Tasks

- Evaluate and implement using Content Delivery Networks (CDN) for improved performance and load times.
- Check for any `die()` statements & related errors/exceptions before production
- Increase view counts
- Implement a mechanism to accurately track and increase view counts for listings.
- Security Audit
- SEO & Analytics API
- Add reCaptcha
- Review page access settings
- Transactional emails at every step
- CRON job to clean archived data every 7 years
- Check for AWS options

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