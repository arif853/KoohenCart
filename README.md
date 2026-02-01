<div align="center">

# 🛒 KoohenCart

### A Modern Full-Stack E-Commerce Platform

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)

**A production-ready, feature-rich e-commerce solution built with Laravel & Livewire, featuring SSLCommerz payment gateway, Steadfast Courier integration, and comprehensive admin management.**

[Features](#-key-features) • [Tech Stack](#-technology-stack) • [Installation](#-installation) • [Screenshots](#-screenshots) • [API](#-api-integrations) • [Contributing](#-contributing)

</div>

---

## 📋 Overview

**KoohenCart** is a comprehensive, full-featured e-commerce platform designed for the Bangladesh market. Built with modern technologies and best practices, it provides everything you need to run a successful online store — from product management and inventory tracking to payment processing and courier integration.

### ✨ What Makes KoohenCart Special?

- 🚀 **Production-Ready** — Battle-tested with real-world usage
- 🇧🇩 **Localized for Bangladesh** — Bangla invoice support, local payment & courier
- ⚡ **Real-time UI** — Powered by Livewire for seamless user experience
- 🔐 **Role-Based Access** — Granular permissions with 50+ access controls
- 📱 **Fully Responsive** — Works flawlessly on all devices

---

## 🎯 Key Features

<details>
<summary><b>🛍️ Product Management</b></summary>

- Multi-image product galleries with thumbnails
- Color and size variants with individual stock tracking
- Brand and category organization (hierarchical)
- Product tags for SEO optimization
- Size charts per product/category
- Dynamic pricing (regular, offer, campaign prices)
- Product overview and additional information sections

</details>

<details>
<summary><b>📦 Inventory Management</b></summary>

- Size-wise stock tracking
- Low stock notifications & alerts
- Stock addition with batch tracking
- Category-wise inventory reports
- Real-time stock balance calculation

</details>

<details>
<summary><b>🛒 Shopping Experience</b></summary>

- Add to Cart with variant selection
- Wishlist functionality (persistent for logged-in users)
- Quick View modal for products
- Advanced filtering (category, color, size, price range)
- Real-time cart updates without page reload
- Guest checkout support

</details>

<details>
<summary><b>💳 Checkout & Payments</b></summary>

- **Cash on Delivery (COD)**
- **SSLCommerz Payment Gateway** (Cards, bKash, Nagad, Rocket, EMI)
- Zone-based delivery charge calculation
- Coupon system (percentage & fixed discounts)
- Multiple shipping addresses per customer
- Order comments/notes

</details>

<details>
<summary><b>📋 Order Management</b></summary>

- Complete order lifecycle management
- Order status workflow (Pending → Confirmed → Processing → Shipped → Delivered → Completed)
- Return/refund handling with inventory restoration
- Bulk status updates
- Order item editing (add/remove products)
- PDF invoice generation (with Bangla support)

</details>

<details>
<summary><b>🚚 Courier Integration</b></summary>

- **Steadfast Courier API** integration
- Single & bulk order placement to courier
- Real-time tracking status
- Consignment ID and tracking code management

</details>

<details>
<summary><b>🎯 Marketing & Promotions</b></summary>

- Time-limited campaigns with special pricing
- Offer/discount management
- Coupon system with quantity limits
- Homepage sliders & banner ads
- Featured categories and products

</details>

<details>
<summary><b>🖥️ Point of Sale (POS)</b></summary>

- Quick product search (name/SKU)
- In-store transaction handling
- Customer lookup (email/phone)
- POS-specific invoice generation
- Low stock alerts during sale

</details>

<details>
<summary><b>👥 Customer Management</b></summary>

- Customer registration & profiles
- **Google OAuth** social login
- Order history & tracking
- Transaction history
- Multiple shipping addresses
- Password reset via email

</details>

<details>
<summary><b>📊 Reports & Analytics</b></summary>

- Sales reports with date range filters
- Order statistics (pending, completed, revenue)
- Top-selling products analysis
- Profit/loss calculation
- Customer filtering and insights

</details>

<details>
<summary><b>🔐 Admin & Security</b></summary>

- **Spatie Permission** role-based access control
- 50+ granular permissions
- User management with role assignment
- Secure authentication system
- Maintenance mode with secret bypass

</details>

<details>
<summary><b>📧 Notifications</b></summary>

- Email notifications for orders (admin & customer)
- PDF invoice attachment in emails
- Low stock database notifications
- New order notifications for admin

</details>

<details>
<summary><b>⚙️ CMS & Settings</b></summary>

- Website branding (logo, favicon)
- SEO meta settings
- Contact information management
- Social media links
- About Us, Privacy Policy, Terms pages
- Delivery information page
- Contact form with admin notification

</details>

---

## 🛠️ Technology Stack

| Layer | Technology |
|-------|------------|
| **Backend Framework** | Laravel 10.x |
| **Frontend Reactivity** | Livewire 3.x |
| **CSS Framework** | Tailwind CSS |
| **Build Tool** | Vite |
| **Database** | MySQL |
| **PDF Generation** | mPDF |
| **Image Processing** | Intervention Image |
| **Shopping Cart** | Gloudemans Shoppingcart |
| **Authentication** | Laravel Breeze + Custom Guards |
| **Authorization** | Spatie Laravel Permission |
| **Social Login** | Laravel Socialite |
| **Payment Gateway** | SSLCommerz |
| **Courier Service** | Steadfast Courier API |

---

## 📁 Project Structure

```
koohen-ecommerce/
├── app/
│   ├── Http/Controllers/      # Admin & Auth controllers
│   ├── Livewire/              # 27 Livewire components
│   ├── Models/                # 61 Eloquent models
│   ├── Mail/                  # Email classes
│   ├── Notifications/         # Database notifications
│   └── Library/SslCommerz/    # Payment gateway integration
├── config/
│   ├── sslcommerz.php         # Payment configuration
│   └── steadfast-courier.php  # Courier configuration
├── database/
│   ├── migrations/            # Database schema
│   └── seeders/               # Initial data seeders
├── resources/views/
│   ├── admin/                 # Admin panel views
│   ├── frontend/              # Customer-facing views
│   └── livewire/              # Livewire component views
├── routes/
│   ├── web.php                # Web routes
│   └── api.php                # API routes
└── public/
    ├── admin/                 # Admin assets
    └── frontend/              # Frontend assets
```

---

## 🚀 Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js >= 18.x & npm
- MySQL >= 8.0
- Git

### Step-by-Step Setup

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/koohencart.git
cd koohencart

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install

# 4. Create environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your database in .env file
# DB_DATABASE=koohencart
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# 7. Run database migrations with seeders
php artisan migrate --seed

# 8. Create storage link
php artisan storage:link

# 9. Build frontend assets
npm run build

# 10. Start the development server
php artisan serve
```

### Environment Configuration

Create/update your `.env` file with the following configurations:

```env
# Application
APP_NAME="KoohenCart"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=koohencart
DB_USERNAME=root
DB_PASSWORD=

# SSLCommerz Payment Gateway
SSLCZ_STORE_ID=your_store_id
SSLCZ_STORE_PASSWORD=your_store_password
SSLCZ_TESTMODE=true
IS_LOCALHOST=true

# Steadfast Courier
STEADFAST_BASE_URL=https://portal.steadfast.com.bd/api/v1
STEADFAST_API_KEY=your_api_key
STEADFAST_SECRET_KEY=your_secret_key

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="hello@koohencart.com"
MAIL_FROM_NAME="${APP_NAME}"

# Google OAuth (Optional)
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

---

## 🔌 API Integrations

### SSLCommerz Payment Gateway

KoohenCart integrates with SSLCommerz, Bangladesh's leading payment gateway, supporting:
- Credit/Debit Cards (Visa, Mastercard, Amex)
- Mobile Banking (bKash, Nagad, Rocket)
- Internet Banking
- EMI/Installments

### Steadfast Courier

Seamless courier integration with Bangladesh's Steadfast Courier service:
- Automated order placement
- Bulk order shipping
- Real-time tracking status
- Consignment management

---

## 📸 Screenshots

> *Add screenshots of your application here*

| Feature | Screenshot |
|---------|------------|
| Homepage | ![Homepage](screenshots/homepage.png) |
| Admin Dashboard | ![Dashboard](screenshots/dashboard.png) |
| Product Management | ![Products](screenshots/products.png) |
| Order Management | ![Orders](screenshots/orders.png) |
| POS System | ![POS](screenshots/pos.png) |

---

## 📊 Database Schema

The application uses **61 database tables** organized into:

- **Products**: 11 tables (products, images, prices, stocks, variants)
- **Categories**: 4 tables (categories, subcategories, brands, features)
- **Orders**: 5 tables (orders, items, status, shipping, transactions)
- **Customers**: 3 tables (customers, auth, social login)
- **Promotions**: 6 tables (campaigns, coupons, offers, ads, sliders)
- **Locations**: 5 tables (divisions, districts, upazilas, postcodes, zones)
- **Settings**: 8 tables (web info, SEO, contact, social, content pages)
- **Users**: 5 tables (users, profiles, roles, permissions)

---

## 🔐 Default Credentials

After running seeders, use these credentials:

**Admin Panel** (`/login`)
```
Email: admin@admin.com
Password: password
```

---

## 🗺️ Roadmap

- [ ] Multi-vendor marketplace support
- [ ] Mobile app (Flutter)
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] Pathao/RedX courier integration
- [ ] Review & rating system
- [ ] Product comparison
- [ ] Advanced SEO tools

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Arif Hossen**
- GitHub: [@arif853](https://github.com/arif853)
- LinkedIn: [Arif Hossen](https://www.linkedin.com/in/arif-hossen853/)
- Email: info@arifhossen.site
- Portfolio: [arifhossen.site](https://arifhossen.site)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Spatie](https://spatie.be) - Laravel Permission package
- [SSLCommerz](https://sslcommerz.com) - Payment gateway
- [Steadfast Courier](https://steadfast.com.bd) - Courier service

---

<div align="center">

**⭐ Star this repository if you find it helpful!**

Made with ❤️ in Bangladesh

</div>

