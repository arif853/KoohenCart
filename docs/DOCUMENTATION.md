# KoohenCart - Project Documentation

## 📖 Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Database Design](#database-design)
3. [API Reference](#api-reference)
4. [Admin Panel Guide](#admin-panel-guide)
5. [Frontend Components](#frontend-components)
6. [Payment Integration](#payment-integration)
7. [Courier Integration](#courier-integration)
8. [Deployment Guide](#deployment-guide)

---

## Architecture Overview

### Technology Stack

```
┌─────────────────────────────────────────────────────────────┐
│                        Frontend                              │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │   Blade     │  │  Livewire   │  │   Tailwind CSS      │  │
│  │  Templates  │  │  Components │  │   + Alpine.js       │  │
│  └─────────────┘  └─────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                     Laravel Backend                          │
│  ┌───────────┐  ┌───────────┐  ┌───────────┐  ┌──────────┐ │
│  │Controllers│  │  Models   │  │ Services  │  │Middleware│ │
│  └───────────┘  └───────────┘  └───────────┘  └──────────┘ │
│  ┌───────────┐  ┌───────────┐  ┌───────────────────────────┐│
│  │   Mail    │  │   Jobs    │  │     Notifications         ││
│  └───────────┘  └───────────┘  └───────────────────────────┘│
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                      Data Layer                              │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │    MySQL    │  │    Redis    │  │    File Storage     │  │
│  │  Database   │  │   (Cache)   │  │   (Images/PDFs)     │  │
│  └─────────────┘  └─────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                   External Services                          │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │ SSLCommerz  │  │  Steadfast  │  │   Google OAuth      │  │
│  │  Payment    │  │   Courier   │  │                     │  │
│  └─────────────┘  └─────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

### Directory Structure

```
app/
├── Console/                 # Artisan commands
├── Exceptions/              # Exception handlers
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   ├── Frontend/       # Frontend controllers
│   │   └── Auth/           # Authentication controllers
│   ├── Middleware/         # HTTP middleware
│   └── Requests/           # Form request validation
├── Library/
│   └── SslCommerz/         # Payment gateway library
├── Livewire/               # Livewire components (27 total)
├── Mail/                   # Mailable classes
├── Models/                 # Eloquent models (61 total)
├── Notifications/          # Notification classes
├── Providers/              # Service providers
└── View/                   # View composers & components
```

---

## Database Design

### Entity Relationship Diagram (Simplified)

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   Category   │────<│   Products   │>────│    Brand     │
└──────────────┘     └──────────────┘     └──────────────┘
                            │
         ┌──────────────────┼──────────────────┐
         ▼                  ▼                  ▼
┌──────────────┐   ┌──────────────┐   ┌──────────────┐
│Product_image │   │Product_price │   │Product_stock │
└──────────────┘   └──────────────┘   └──────────────┘
         
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   Customer   │────<│    Order     │>────│  Shipping    │
└──────────────┘     └──────────────┘     └──────────────┘
                            │
                            ▼
                    ┌──────────────┐
                    │ Order_items  │
                    └──────────────┘
```

### Key Tables

| Table | Records | Purpose |
|-------|---------|---------|
| products | - | Main product information |
| orders | - | Customer orders |
| customers | - | Customer profiles |
| categories | - | Product categories |
| transactions | - | Payment transactions |

---

## Admin Panel Guide

### Dashboard Metrics

The admin dashboard displays:
- **Order Statistics**: Total, pending, completed orders
- **Revenue**: Total revenue, paid, due amounts
- **Inventory**: Product count, stock levels
- **Alerts**: Low stock notifications, new orders

### User Roles & Permissions

| Role | Description |
|------|-------------|
| Super Admin | Full access to all features |
| Admin | Access to most features except user management |
| Manager | Access to orders, inventory, customers |
| Staff | Limited access to POS and orders |

### Permission Categories

- Product Management (view, create, update, delete)
- Order Management (view, create, update, delete)
- Customer Management
- Inventory Management
- POS Access
- Report Generation
- Settings Management

---

## Frontend Components

### Livewire Components

| Component | Purpose |
|-----------|---------|
| HomeComponent | Homepage products & campaigns |
| ShopComponent | Product listing with filters |
| ProductComponent | Single product view |
| CartComponent | Shopping cart management |
| CheckoutComponent | Order checkout process |
| WishlistComponent | Wishlist management |
| AreaSelectComponent | Location selection dropdowns |

### Key Features

1. **Real-time Cart Updates**: Cart updates without page reload
2. **Dynamic Filtering**: Product filters update instantly
3. **Quick View**: Modal for quick product preview
4. **Form Validation**: Real-time input validation

---

## Payment Integration

### SSLCommerz Setup

```php
// config/sslcommerz.php
return [
    'store_id' => env('SSLCZ_STORE_ID'),
    'store_password' => env('SSLCZ_STORE_PASSWORD'),
    'sandbox' => env('SSLCZ_TESTMODE', true),
];
```

### Payment Flow

```
Customer → Checkout → SSLCommerz → Payment Gateway
                                        │
                                        ▼
                    ┌─────────────────────────────────┐
                    │  Payment Methods                │
                    │  • Cards (Visa/Master/Amex)     │
                    │  • Mobile (bKash/Nagad/Rocket)  │
                    │  • Internet Banking             │
                    │  • EMI                          │
                    └─────────────────────────────────┘
                                        │
                                        ▼
            Success ────► Order Confirmed + Email Sent
            Fail    ────► Order Cancelled + User Notified
```

---

## Courier Integration

### Steadfast Courier API

```php
// config/steadfast-courier.php
return [
    'base_url' => env('STEADFAST_BASE_URL'),
    'api_key' => env('STEADFAST_API_KEY'),
    'secret_key' => env('STEADFAST_SECRET_KEY'),
];
```

### API Endpoints Used

| Endpoint | Purpose |
|----------|---------|
| POST /create_order | Create shipping order |
| POST /create_order/bulk-order | Bulk order creation |
| GET /status_by_cid/{id} | Check order status |

---

## Deployment Guide

### Server Requirements

- PHP >= 8.1 with extensions: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- MySQL >= 8.0
- Nginx or Apache
- SSL Certificate
- Composer
- Node.js >= 18.x

### Production Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure database credentials
- [ ] Set up SSL/HTTPS
- [ ] Configure mail settings
- [ ] Set up payment gateway (live mode)
- [ ] Configure courier API (production keys)
- [ ] Set up cron for scheduled tasks
- [ ] Configure queue worker
- [ ] Set up backups

### Performance Optimization

```bash
# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

---

## Support

For questions or issues:
- Create a GitHub Issue
- Email: support@youremail.com

---

*Last Updated: January 2024*
