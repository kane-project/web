#!/bin/bash

# Check if the script has already been run
if [ -f ".installed" ]; then
    echo "\nError - The installation script has already been run. Exiting...\n"
    exit 1
fi

# Create directory structure
echo "Creating directory structure..."
mkdir -p uploads/listings uploads/profiles

# Prompt for environment variables
read -p "Enter DB_HOST: " DB_HOST
read -p "Enter DB_USER: " DB_USER
read -s -p "Enter DB_PASS: " DB_PASS
echo
read -p "Enter DB_NAME: " DB_NAME
read -p "Enter GOOGLE_MAPS_API_KEY: " GOOGLE_MAPS_API_KEY
read -p "Enter STRIPE_TEST_PKEY: " STRIPE_TEST_PKEY
read -p "Enter STRIPE_TEST_SKEY: " STRIPE_TEST_SKEY
read -p "Enter STRIPE_LIVE_PKEY: " STRIPE_LIVE_PKEY
read -p "Enter STRIPE_LIVE_SKEY: " STRIPE_LIVE_SKEY
read -p "Enter TRASHDB_HOST: " TRASHDB_HOST
read -p "Enter TRASHDB_USER: " TRASHDB_USER
read -s -p "Enter TRASHDB_PASS: " TRASHDB_PASS
echo
read -p "Enter TRASHDB_NAME: " TRASHDB_NAME
read -p "Enter SMTP_HOST: " SMTP_HOST
read -p "Enter SMTP_PORT: " SMTP_PORT
read -p "Enter SMTP_USER: " SMTP_USER
read -s -p "Enter SMTP_PASS: " SMTP_PASS
echo
read -p "Enter SUID_SECRET_KEY: " SUID_SECRET_KEY

# Write environment variables to .env file
echo "Writing environment variables to .env file..."
cat <<EOF > .env
DB_HOST=$DB_HOST
DB_USER=$DB_USER
DB_PASS=$DB_PASS
DB_NAME=$DB_NAME
GOOGLE_MAPS_API_KEY=$GOOGLE_MAPS_API_KEY
STRIPE_TEST_PKEY=$STRIPE_TEST_PKEY
STRIPE_TEST_SKEY=$STRIPE_TEST_SKEY
STRIPE_LIVE_PKEY=$STRIPE_LIVE_PKEY
STRIPE_LIVE_SKEY=$STRIPE_LIVE_SKEY
TRASHDB_HOST=$TRASHDB_HOST
TRASHDB_USER=$TRASHDB_USER
TRASHDB_PASS=$TRASHDB_PASS
TRASHDB_NAME=$TRASHDB_NAME
SMTP_HOST=$SMTP_HOST
SMTP_PORT=$SMTP_PORT
SMTP_USER=$SMTP_USER
SMTP_PASS=$SMTP_PASS
SUID_SECRET_KEY=$SUID_SECRET_KEY
EOF

# Mark script as already run
touch .installed

echo "Installation completed successfully."
