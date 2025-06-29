# Certificate Printing Website

This is a simple web application for printing personalized certificates.

## Features

1. **Admin Panel**
   - Upload A4 certificate templates (JPG, PNG, GIF)
   - Access via `admin.html`

2. **Frontend**
   - Users enter their name in a text field
   - Click "Print" to generate a personalized certificate
   - Printing defaults to landscape A4 format

## Setup

1. Place all files in your web server directory
2. Ensure PHP is installed on your server
3. The `uploads` directory must be writable by the web server

## Usage

1. First, upload your certificate template using the admin panel
2. Then, users can visit the main page (`index.html`) to:
   - See the certificate template
   - Enter their name
   - Print their personalized certificate

## Notes

- The system will automatically use the last uploaded certificate template
- Printing will open in a new window with landscape orientation by default
- The name will be centered on the certificate