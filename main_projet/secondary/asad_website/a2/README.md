# Premium Real Estate Platform (Flat PHP)

A full-stack, non-MVC real-estate website built with:
- PHP 8+
- PDO + MySQL
- Bootstrap 5
- JavaScript
- Responsive premium dark theme

## Included
- Authentication: register, login, logout
- Buyer / Agent / Admin dashboards
- Property CRUD with approval workflow
- Search, filters, AJAX suggestions
- Wishlist, recently viewed, inquiries, bookings
- Reviews and ratings
- EMI calculator and construction cost estimator
- Property comparison page
- API endpoints
- SEO pages + PWA files
- MySQL schema

## Setup
1. Import `db/schema.sql` into MySQL.
2. Update DB credentials in `includes/config.php`.
3. Put the project in your PHP server root.
4. Run:
   ```bash
   php -S localhost:8000
   ```
5. Open `http://localhost:8000/index.php`

## Notes
- This project intentionally does **not** use MVC.
- Uploads are saved under `uploads/`.
- Google Maps, payment gateways, SMS, and email are wired as ready-to-connect modules.
