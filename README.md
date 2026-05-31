# 🏟️ Sunshine City Venue Reservation System

A web-based venue reservation system for **Sunshine City**, a community recreation facility. The system allows residents and staff to browse, book, and manage venue spaces efficiently.

---

## ✨ Features

- Browse available venues and facilities
- Reserve venues for specific dates and time slots
- View and manage existing reservations
- Admin panel for managing venues, bookings, and users
- Conflict detection to prevent double bookings
- Responsive design for desktop and mobile

---

## 🛠️ Tech Stack

| Layer      | Technology                        |
|------------|-----------------------------------|
| Backend    | PHP / Laravel                     |
| Frontend   | Blade Templates, Tailwind CSS, JavaScript |
| Database   | MySQL                             |

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL
- Laravel CLI (optional)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-org/sunshine-city-reservations.git
   cd sunshine-city-reservations
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install && npm run dev
   ```

4. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   DB_DATABASE=sunshine_city
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

6. **Run migrations and seed the database**
   ```bash
   php artisan migrate --seed
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser.

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/    # Request handling logic
│   ├── Models/              # Eloquent models (Venue, Reservation, User)
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
├── resources/
│   ├── views/               # Blade templates
│   └── css/ & js/           # Tailwind and plain JS assets
├── routes/
│   └── web.php              # Application routes
└── public/                  # Publicly accessible assets
```

<!-- ---

## 👤 Default Accounts (Seeded)

| Role  | Email                  | Password  |
|-------|------------------------|-----------|
| Admin | admin@sunshinecity.com | password  |
| User  | user@sunshinecity.com  | password  |

> ⚠️ Change these credentials before deploying to production.

---

## 👥 Team

| Name | Role |
|------|------|
|      | Backend Developer |
|      | Frontend Developer |
|      | UI/UX Designer |
|      | Database / QA | -->
