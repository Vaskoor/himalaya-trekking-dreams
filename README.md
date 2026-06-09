# 🌄 Himalaya Trekking Dreams

![Laravel](https://img.shields.io/badge/Laravel-13.8-red.svg)
![Next.js](https://img.shields.io/badge/Next.js-16.2-black.svg)
![PHP](https://img.shields.io/badge/PHP-8.3-blue.svg)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38B2AC.svg)

A modern full-stack travel platform built for a Nepali trekking and adventure company. The platform showcases trekking packages, peak climbing expeditions, helicopter tours, cultural experiences, one-day activities, and adventure holidays across Nepal.

The system consists of a multilingual Laravel API with a powerful admin dashboard and a modern Next.js frontend optimized for performance, SEO, and international visitors.

---

## 🌐 Live Demo

**Website:** Coming Soon

**Admin Panel:** `/admin`

---

## ✨ Features

### 🖥️ Backend (Laravel)

* RESTful API architecture
* Laravel Sanctum authentication
* Role-based admin access
* Multilingual content management
* Dynamic homepage management
* Booking management system
* Newsletter subscriber management
* Media uploads (images & videos)
* SEO-friendly content structure
* CORS support for frontend integration
* Database seeders with realistic demo data

### 📚 Content Management

Manage:

* Trek Packages
* Trek Regions
* Itineraries
* Galleries
* Testimonials
* Team Members
* Blogs
* FAQs
* Homepage Carousel
* Why Choose Us Sections
* Trek Comparisons
* Seasonal Guides
* Customer Bookings

### 🎨 Frontend (Next.js)

* Dynamic trek pages
* Dynamic blog pages
* Activity packages
* Helicopter tours
* Peak climbing packages
* Cultural and wildlife tours
* Multilingual routing
* Advanced search & filtering
* Interactive maps
* Booking system
* Responsive design
* Scroll animations
* SEO optimized pages
* Fast page loading

### 🌎 Internationalization

Supported Languages:

* 🇬🇧 English
* 🇩🇪 German
* 🇫🇷 French
* 🇪🇸 Spanish
* 🇯🇵 Japanese

Example URLs:

```text
/en/
/de/
/fr/
/es/
/jp/
```

### 🗺️ Trek Route Maps

* OpenStreetMap Integration
* Interactive Route Visualization
* Trek Location Markers
* Elevation & Route Information

### 💰 Booking System

* Real-time pricing calculations
* Inquiry submission
* Trip customization requests
* Package availability checks

---

## 🧰 Technology Stack

### Backend

| Technology          | Purpose               |
| ------------------- | --------------------- |
| Laravel 13.8        | API & Admin Dashboard |
| PHP 8.3             | Backend Language      |
| MySQL / SQLite      | Database              |
| Laravel Sanctum     | Authentication        |
| Spatie Translatable | Multilingual Content  |
| Intervention Image  | Image Processing      |
| Laravel Cashier     | Stripe Integration    |
| Redis / Predis      | Caching & Performance |

### Frontend

| Technology     | Purpose            |
| -------------- | ------------------ |
| Next.js 16.2   | Frontend Framework |
| React 19       | UI Library         |
| Tailwind CSS 4 | Styling            |
| Axios          | API Requests       |
| React Leaflet  | Interactive Maps   |
| Lucide Icons   | Icons              |
| Framer Motion  | Animations         |
| SWR            | Data Fetching      |

---

# 📦 Installation

## Prerequisites

Before getting started, install:

* PHP 8.3+
* Composer
* Node.js 20+
* npm / yarn / pnpm
* MySQL (recommended)
* SQLite (optional)

---

## 1️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/himalaya-trekking-dreams.git

cd himalaya-trekking-dreams
```

---

## 2️⃣ Backend Setup (Laravel)

Navigate to backend directory:

```bash
cd backend
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database inside `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=himalaya
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

Start development server:

```bash
php artisan serve
```

Backend URL:

```text
http://localhost:8000
```

---

## 3️⃣ Frontend Setup (Next.js)

Navigate to frontend directory:

```bash
cd ../frontend
```

Install dependencies:

```bash
npm install
```

Create environment file:

```bash
cp .env.example .env.local
```

Edit `.env.local`:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000
```

Start development server:

```bash
npm run dev
```

Frontend URL:

```text
http://localhost:3000
```

> The application automatically redirects users to `/en/` as the default locale.

---

# 🔧 Environment Variables

## Backend (`.env`)

```env
APP_NAME="Himalaya Trekking Dreams"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=himalaya
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
```

## Frontend (`.env.local`)

```env
NEXT_PUBLIC_API_URL=http://localhost:8000

# Optional if using Google Maps
NEXT_PUBLIC_GOOGLE_MAPS_API_KEY=
```

---

# 🚀 Production Deployment

## Backend

Install optimized dependencies:

```bash
composer install --optimize-autoloader --no-dev
```

Cache configurations:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Recommended Stack:

* Nginx
* PHP-FPM
* MySQL
* Redis
* SSL Certificate

---

## Frontend

Build production assets:

```bash
npm run build
```

Start production server:

```bash
npm start
```

Recommended Hosting:

* Vercel
* VPS (Ubuntu)
* DigitalOcean
* AWS
* Railway

---

# 🔐 Admin Access

After database seeding:

| Field    | Value                                         |
| -------- | --------------------------------------------- |
| URL      | `/admin`                                      |
| Email    | [admin@example.com](mailto:admin@example.com) |
| Password | password123                                   |

> Change these credentials immediately in production.

Admin access is controlled through:

```php
users.is_admin = 1
```

Additional administrators can be created via seeders or directly from the database.

---

# 📡 API Endpoints

| Method | Endpoint                | Description               |
| ------ | ----------------------- | ------------------------- |
| GET    | `/api/treks`            | List all treks            |
| GET    | `/api/treks/{slug}`     | Trek details              |
| GET    | `/api/activities`       | One-day activities        |
| GET    | `/api/helicopter-tours` | Helicopter tours          |
| GET    | `/api/peaks`            | Peak climbing packages    |
| GET    | `/api/tour-packages`    | Cultural & wildlife tours |
| GET    | `/api/blogs`            | Blog posts                |
| GET    | `/api/regions`          | Trekking regions          |
| GET    | `/api/seasonal-guides`  | Seasonal travel guides    |
| POST   | `/api/bookings`         | Create booking            |
| POST   | `/api/login`            | Admin authentication      |

All responses are returned as JSON.

---

# 📁 Project Structure

```text
.
├── backend/
│
│   ├── app/
│   │   ├── Http/
│   │   │   └── Controllers/
│   │   ├── Models/
│   │   └── Console/
│   │       └── Commands/
│   │
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   │
│   ├── routes/
│   │   ├── api.php
│   │   ├── admin.php
│   │   └── web.php
│   │
│   └── config/
│
└── frontend/
    ├── app/
    │   └── [locale]/
    ├── components/
    ├── lib/
    └── public/
```

---

# 🎯 SEO Features

* Dynamic Meta Tags
* Open Graph Support
* Structured Data (JSON-LD)
* Sitemap Generation
* Multilingual SEO URLs
* Canonical URLs
* Fast Core Web Vitals

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create a new branch

```bash
git checkout -b feature/new-feature
```

3. Commit your changes

```bash
git commit -m "Add new feature"
```

4. Push your branch

```bash
git push origin feature/new-feature
```

5. Create a Pull Request

---

# 📄 License

This project is proprietary software.

For licensing inquiries, please contact the authors directly.

---

# 📬 Contact

### Himalaya Trekking Dreams

Website: https://nepaltrekkingplanner.com

Email: [info@nepaltrekkingplanner.com](mailto:info@nepaltrekkingplanner.com)

Phone: +977-1-4701234

📍 Kathmandu, Nepal

---

### Made with ❤️ in the Himalayas of Nepal
