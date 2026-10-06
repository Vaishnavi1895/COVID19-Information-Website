# VitaSafe — COVID-19 Information Portal (PHP + MySQL)

A responsive software-testing mini project using HTML, CSS, JavaScript, PHP, and MySQL. Features include public information pages, account registration/login, password hashing, session-based authentication, a community comment board, regex/validation test cases, and responsive styling.

## Requirements
- XAMPP for Windows (Apache + MySQL/MariaDB)
- A modern browser
- Internet connection for Google Fonts and the Unsplash background photos (the website still works without these; use local images if you need fully offline operation)

## Install on XAMPP
1. Start **Apache** and **MySQL** from the XAMPP Control Panel.
2. Copy the whole `covid19_info_portal` folder into `C:\\xampp\\htdocs\\`.
3. Open `http://localhost/phpmyadmin/`.
4. Choose **Import**, select this project's `database.sql`, and click **Import/Go**. It creates the `covid19_portal` database and tables.
5. Open `config.php`. Default XAMPP settings are host `127.0.0.1`, username `root`, blank password. If your MySQL root account has a password, update `$pass`.
6. Open `http://localhost/covid19_info_portal/` in your browser.

## Suggested demo
1. Open Home and COVID-19 Info.
2. Register using a valid name/email and a password such as `Health@2026` (do not reuse a real password).
3. Log out, then log in again.
4. Open Community and add a comment.
5. Open phpMyAdmin → `covid19_portal` → `users` and `comments` to show records are stored.
6. Run the cases in `tests/regex_test_cases.md`; record actual results and screenshots.

## Test features
- Name regex: Unicode letters plus spaces, apostrophes, periods, and hyphens.
- Password regex: at least 8 characters, uppercase, lowercase, digit, special character; max 72.
- Email: PHP's built-in email validation.
- Comment length and link validation.
- Prepared statements, password hashing, HTML output escaping, CSRF tokens, and session ID regeneration.

## Deployment
This project requires a PHP + MySQL host; a static host such as GitHub Pages or a static-only Netlify site cannot run its PHP/MySQL backend. Choose a host that explicitly supports PHP and MySQL, create a database and database user in the hosting panel, import `database.sql`, update `config.php` with production credentials, upload files to the web root, enable HTTPS, and test registration/login/comments. Do not upload your local database credentials to a public repository. Use environment variables or a protected configuration file where supported.

Before public deployment:
- Remove any debug output and use a non-root database user with only required database permissions.
- Keep PHP and the hosting platform updated.
- Configure HTTPS and secure session cookies.
- Add rate limiting / login throttling and moderation/reporting if the site will be used by real visitors.
- Review medical content and links for accuracy. This is an educational project, not medical advice.
- Back up the database and test restore procedures.
