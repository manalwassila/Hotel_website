
# Hotel Website

Project: a small hotel booking website written in PHP with a MySQL backend.

## Features
- Room listing and gallery
- Booking form and backend handling
- Admin panel for bookings and messages (`admin/`)
- Simple PHP + MySQL architecture (no frameworks)

## Requirements
- PHP 7.4 or newer
- MySQL / MariaDB
- Web server (Apache, Nginx, or PHP built-in server)

## Installation
1. Clone or copy this repository to your webserver root (e.g., `htdocs`, `www`).
2. Import the database: `hotel_db.sql` into your MySQL server.
	- Example: `mysql -u root -p hotel_db < hotel_db.sql`
3. Edit database credentials in `components/connect.php` to match your DB.
4. Ensure the `media/` and `css/` folders are readable by the server.

## Run locally (quick test)
From the project root you can start PHP's built-in server for a quick smoke test:
```bash
php -S localhost:8000 -t .
```
Then open `http://localhost:8000` in your browser.

## Configuration
- Database connection: `components/connect.php`
- Admin credentials: handled in `admin/` files (change as needed)

## Troubleshooting
- If pages are blank, enable PHP error display in `php.ini` or add `ini_set('display_errors',1);` for debugging.
- Ensure file permissions allow the webserver to read static assets.



## Contact
- Questions or help: open an issue in this repository.

## License
Choose and add a license file if you want this repo publicly licensed.

