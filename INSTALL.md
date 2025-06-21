
# CareerNext - Laravel Project Installation Guide

## Requirements

- PHP >= 8.1
- Composer
- MySQL

---

## Installation Steps

1. **Clone or extract the project folder:**

```bash
git clone https://github.com/yourusername/CareerNext.git
cd CareerNext
```

2. **Install PHP dependencies:**

```bash
composer install
```

3. **Create a copy of the `.env` file and generate the application key:**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Set up your database:**

- Create a MySQL database named `careernext_db`.
- Update the `.env` file with your DB credentials:

```env
DB_DATABASE=careernext_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Run the migrations and seed the database:**

```bash
php artisan migrate --seed
```

6. **(Optional) Install frontend dependencies and compile assets:**

```bash
npm install
npm run dev
```

7. **Serve the application:**

```bash
php artisan serve
```

---

## Admin Login Credentials

```
Email: admin@gmail.com
Password: 12345678
```

---

## Creating a Zip for Deployment (Optional)

If you want to zip the project **excluding unnecessary files** like `vendor`, `node_modules`, and `.git`, run this from one directory above your project folder:

```bash
cd ..
zip -r CareerNext.zip CareerNext -x "CareerNext/node_modules/*" "CareerNext/vendor/*" "CareerNext/.git/*"
```

---

## Initialize Git and Push to GitHub (Optional)

Inside your project directory:

```bash
git init
git remote add origin https://github.com/yourusername/CareerNext.git
git add .
git commit -m "Initial commit"
git push -u origin master
```

---

### ✅ Final Tips:

- Double-check `.env` values before pushing to a public repo.
- Never commit `.env`, `vendor/`, or `node_modules/`.
- Add a `.gitignore` file if not already present.
