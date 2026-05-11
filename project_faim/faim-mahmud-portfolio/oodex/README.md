# faim mahmud Luxury Portfolio

Premium one-page portfolio website for `faim mahmud`, built with HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, PHP, and MySQL.

## What Is Included

- Cinematic luxury portfolio homepage
- Capability Lab page for skill/demo proof
- All page for the complete personal-brand system
- Responsive desktop, tablet, and mobile layout
- Premium scroll reveal, magnetic buttons, card tilt, cursor detail, and smooth navigation
- PHP contact endpoint with validation
- MySQL lead storage using PDO prepared statements
- Local Bootstrap 5 and jQuery assets
- SQL database file
- SEO and Open Graph tags

## Folder Structure

```text
oodex/
  api/contact.php
  all.php
  assets/css/style.css
  assets/images/
  assets/js/main.js
  assets/vendor/
  capability-lab.php
  database/database.sql
  includes/
  contact.php
  database.sql
  index.php
  README.md
```

## XAMPP Setup

1. Put the `oodex` folder inside:

```text
C:\xampp\htdocs\project_faim\
```

2. Start Apache and MySQL from the XAMPP Control Panel.

3. Open phpMyAdmin:

```text
http://localhost/phpmyadmin/
```

4. Import either SQL file:

```text
oodex/database.sql
```

or:

```text
oodex/database/database.sql
```

5. Open the website:

```text
http://localhost/project_faim/oodex/
```

## Pages

- `index.php`: luxury homepage, selected work, process, and contact form.
- `capability-lab.php`: premium skill/demo page for HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, PHP, and MySQL.
- `all.php`: complete personal-brand hub with services, project directions, future standard, and conversion CTAs.

## Database Settings

Default local settings are in `includes/config.php`:

```php
const DB_HOST = 'localhost';
const DB_NAME = 'faim_portfolio';
const DB_USER = 'root';
const DB_PASS = '';
```

These defaults match a normal XAMPP install. Change them only if your MySQL user or password is different.

## Contact Form

The contact form posts to:

```text
api/contact.php
```

Valid submissions are stored in:

```text
faim_portfolio.contact_messages
```

If the database has not been imported yet, the form will show a clear setup message instead of silently failing.

## Customization Notes

- Replace placeholder case studies with real project screenshots, metrics, and links when available.
- Replace `SITE_EMAIL` in `includes/config.php` with your real email address.
- The visual texture assets are in `assets/images/`.
- The main design system lives in `assets/css/style.css`.
