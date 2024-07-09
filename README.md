#A Complete Ecommerce Website

## Overview
Koohen is a comprehensive ecommerce platform developed using Laravel, HTML, CSS, and JavaScript. It offers a range of features to facilitate seamless online shopping experiences for both customers and administrators.

## Features
- **Product Management**: Manage products with color and size variants, Brand, Category, ensuring a dynamic catalog presentation.
- **Point of Sale (POS) System**: Streamline transactions with an intuitive POS interface for in-store operations.
- **Order and Customer Management**: Easily track and manage orders while maintaining a detailed customer database.
- **Supplier Management**: Efficiently manage supplier relationships and inventory replenishments.
- **Product Showcase**: Highlight featured products by category and individual highlights for enhanced visibility.
- **Basic Sales Reports**: Access insightful sales reports for informed decision-making.
- **Inventory Management**: Maintain basic inventory control with size-wise stock updates.
- **Offers and Coupons**: Implement promotional offers and coupons to drive sales and customer engagement.
- **Campaign and Zone Wise Delivery Charges**: Apply specific delivery charges based on delivery zones and make Campaign for specific products with limited time and price.
- **Add to Cart and Wishlist**: Allow customers to add items to their cart for later purchase and create wishlists for future reference.
- **Interactive Customer Login and Registration**: Seamlessly onboard customers with interactive registration and login features.
- **Cash on Delivery Checkout**: Offer cash on delivery as a payment option during checkout for customer convenience.
- **Interactive Invoice with Bangla Language**: Generate interactive invoices in Bangla language for a personalized customer experience.
- **Email Notifications**: Automatically send order confirmation emails to customers and administrators upon order placement.
- **Order Tracking System**: Provide customers with a unique order tracking ID to monitor their order status.

## Installation
1. Clone the repository: `git clone [repository_url]`
2. Install dependencies: `composer install && npm install`
3. Set up your environment variables by renaming `.env.example` to `.env` and configuring accordingly.
4. Run migrations and seeders: `php artisan migrate --seed`
5. Generate application key: `php artisan key:generate`
6. Serve the application: `php artisan serve`

## Usage
- Access the admin panel by visiting `/login` and login with provided credentials.
- Explore various modules such as product management, order management, etc., from the admin dashboard.
- Utilize the POS system for in-store transactions.
- Monitor sales reports for business insights.

## Contributing
Contributions are welcome! Please fork the repository and submit pull requests for any enhancements, bug fixes, or new features.

