# Database Schema for KaneDB

Table `kanedb.users`
====================

- ID
- firstName
- lastName
- email
- password
- phone
- address
- isphoneverified
- isemailverified
- timestamp

Table `kanedb.listings`
=======================

- ID
- userID
- slug
- title
- address
- description
- num_beds
- num_baths
- timestamp 


Table `kanedb.admins`
=====================

- username
- password