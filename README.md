# Hotel Website

Simple hotel booking website project (PHP + MySQL).

## Requirements
- PHP 7.4+ (or 8.x)
- MySQL / MariaDB
- Apache or any webserver (XAMPP, WAMP, LAMP) or PHP built-in server

## Quick setup
1. Import `hotel_db.sql` into your MySQL server.
2. Update database credentials in `components/connect.php`.
3. Place the project folder in your webserver root (e.g., `htdocs`).
4. Start the server and open `http://localhost/<folder>`.

Quick test (built-in PHP server):
```bash
php -S localhost:8000 -t .
```

## Notes
- See `hotel_db.sql` for the database schema.
- Admin pages are under the `admin/` directory.

## License
Add a license as needed.
