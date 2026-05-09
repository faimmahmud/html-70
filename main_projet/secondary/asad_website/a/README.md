# Aurelia Estates Starter

A premium real-estate marketplace starter built with:
- PHP
- Bootstrap 5
- JavaScript
- Clean Arc-style UI

## Files
- `index.php` — homepage
- `listings.php` — property listings with filters
- `property.php` — property details page
- `login.php` — login/register UI
- `dashboard-agent.php` — agent workspace
- `admin.php` — admin panel
- `assets/css/style.css` — global styling
- `assets/js/app.js` — filtering and UI interactions
- `db/schema.sql` — database schema
- `api/search.php` — sample JSON endpoint

## Run locally
1. Put the folder in your PHP server root.
2. Start PHP:
   ```bash
   php -S localhost:8000
   ```
3. Open:
   - `http://localhost:8000/index.php`

## Notes
- Demo listings use remote images from Unsplash.
- Replace the database credentials in `includes/config.php`.
- Connect the forms to your authentication, booking, and payment logic as needed.
