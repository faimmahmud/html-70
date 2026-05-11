# Aurelia Travel

A premium tourism website built with HTML, Bootstrap 5, CSS3, JavaScript, and PHP.

## Included
- Full-screen luxury hero sections
- Dynamic destination and package pages
- World explorer page
- Booking form with AJAX submission
- Login / register
- Admin package CRUD
- Booking dashboard with detailed customer, travel, and payment views
- Image upload support
- Optional SQL schema for importing booking tables into MySQL

## Booking system
The booking form now captures:
- package / ticket name
- booking type
- customer name, email, phone
- departure and destination
- travel date and travel time
- leaving date and leaving time
- guests / tickets
- payment method and payment reference
- amount and currency
- booking status and payment status
- booked by, IP address, and user agent

## Admin panel
Open the admin dashboard after login to:
- view all bookings
- search and filter bookings
- inspect full booking details
- update booking and payment status
- delete bookings
- manage tour packages

## Storage
- Packages and users are stored in `data/*.json`
- Bookings are stored in `data/bookings.json`
- `database/schema.sql` is included if you want to import the same booking table structure into MySQL later

## Setup
1. Copy the project to your local server folder.
2. Open it through XAMPP / localhost.
3. Make sure `data/` and `uploads/` are writable.

## Demo admin
- Email: admin@demo.com
- Password: admin123
