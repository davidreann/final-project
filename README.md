Names:
Abatteng, Rhona
Davic, Rafaela
Manalansan, Jynyl

# WhiskList 🍳

WhiskList is a Laravel-based recipe management web application that allows users to create, manage, and explore recipes. It includes user authentication, email verification, and a clean UI powered by Tailwind CSS.

Please migrate and seed the database for better testing.

testing account:
Email:whisker@gmail.com
Password: Whisker1.

deployed site (no seed data): https://whisklist.onrender.com/

---

## 🚀 Features

* User Registration & Login
* Email Verification
* Create, Edit, Delete Recipes
* Responsive UI with Tailwind CSS
* Authentication & Authorization

---

## 🛠️ Tech Stack

* Laravel
* PHP
* SQLite (default)
* Tailwind CSS
* Blade Templating Engine

---

## ⚙️ Installation

1. Clone the repository:

```bash
git clone https://github.com/davidreann/final-project.git
cd final-project
```

2. Install dependencies:

```bash
composer install
npm install
npm run build
```

3. Copy environment file:

```bash
cp .env.example .env
```

4. Generate app key:

```bash
php artisan key:generate
```

5. Configure `.env`:

* Set your database (SQLite by default)
* Set your mail configuration (see below)

6. Run migrations and seed the database:

```bash
php artisan migrate --seed
```

7. Start the server:

```bash
php artisan serve
```

---

## 📧 Email Configuration

To enable email verification, configure SMTP in `.env`.

### Option 1: Gmail SMTP

* Enable 2FA on your Google account
* Generate an App Password

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password (no spaces)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="WhiskList"
QUEUE_CONNECTION=sync
```

### Option 2: Log (for testing)

```env
MAIL_MAILER=log
```

Emails will be stored in:

```
storage/logs/laravel.log
```

## ⚠️ Notes

* `.env` file is not included for security reasons
* Each user must configure their own environment variables


---
