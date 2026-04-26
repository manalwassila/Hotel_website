# Hotel Management System

A full‑stack web application to manage hotel operations — room reservations, client management, and administrative control.

## Overview

This project provides a complete solution for hotel workflows: searching availability, making bookings, and managing clients and reservations from an admin dashboard. It separates client-facing pages and administrative functionality for a secure and streamlined experience.

## Features

Client
- Browse available rooms
- Make reservations with real-time availability checks
- Contact the hotel via a built-in form

Admin
- Manage reservations (create, update, delete)
- Manage clients and accounts
- Monitor booking activity and history
- Secure authentication and role separation

## Tech Stack

- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP
- Database: MySQL / MariaDB

## Highlights

- Real-time availability validation before confirming bookings
- Normalized database with relationships (Client ↔ Booking)
- Separate authentication flows for admins and regular users
- Clean, responsive UI with a functional design

## Screenshots

Add screenshots to the `screenshots/` folder and reference them here. Example:

![Homepage](screenshots/homepage.png)
![Booking page](screenshots/booking.png)
![Admin dashboard](screenshots/admin.png)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/manalwassila/Hotel_website.git
```

2. Import the database:
- Open phpMyAdmin (or MySQL client)
- Import the provided `database.sql` (or the SQL file in `/db`)

3. Configure the application:
- Update database credentials in `config.php` (or the appropriate config file)

4. Run locally:
- Place the project in your web server folder (e.g., `htdocs` for XAMPP)
- Start Apache and MySQL
- Visit `http://localhost/<project-folder>` in your browser

## Improvements & Roadmap

- Payment gateway integration
- Email notifications for bookings and confirmations
- Migrate frontend to a modern framework (React / Vue / Angular)
- Add analytics dashboard for bookings and revenue
- Use ML for client segmentation and booking predictions

## Contributing

Contributions are welcome. Please open issues or pull requests for bug fixes and enhancements.

## License

Specify a license (e.g., MIT) in `LICENSE` if you want this project to be open source.

## Author

Manal Wassila — Computer Science Student | AI & Web Development Enthusiast

---

If you'd like, I can also add a `screenshots/` folder and sample images, or create a `LICENSE` file for you.


