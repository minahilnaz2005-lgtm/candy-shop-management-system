# 🍬 Candy & Chocolate Shop - E-Commerce System

A full-featured e-commerce web application for managing and selling candies, chocolates, and sweet treats. Built with Laravel, MySQL, and modern web technologies.

![Project Status](https://img.shields.io/badge/status-active-success.svg)
![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Architecture](#system-architecture)
- [Database Schema](#database-schema)
- [Installation Guide](#installation-guide)
- [User Roles & Access](#user-roles--access)
- [Key Functionalities](#key-functionalities)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Screenshots](#screenshots)
- [Testing](#testing)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

---

## 🎯 Overview

The **Candy & Chocolate Shop** is a comprehensive e-commerce platform designed to manage inventory, process orders, and provide customers with a seamless shopping experience for sweet treats. The system features separate interfaces for administrators and customers, with real-time stock management and sales reporting.

### Project Objectives

- **Inventory Management**: Track product stock levels with automatic updates
- **Order Processing**: Handle customer orders with complete transaction history
- **Sales Analytics**: Generate reports on revenue, orders, and product performance
- **User Management**: Support multiple user roles (Admin, Customer)
- **Responsive Design**: Mobile-friendly interface for all devices

---

## ✨ Features

### 🔐 Authentication & Authorization
- User registration and login system
- Role-based access control (Admin/Customer)
- Email verification support
- Password reset functionality
- Session management

### 👨‍💼 Admin Features
- **Dashboard Analytics**
  - Total revenue display
  - Total orders count
  - Recent sales activity (last 5 orders)
  - Low stock alerts
  - Out of stock notifications
  
- **Product Management**
  - Create, Read, Update, Delete (CRUD) operations
  - Product categorization (Candy, Chocolate, Gummy, Toffee, etc.)
  - Image upload support
  - Stock quantity management
  - Price management (in Rupees)
  
- **Inventory Monitoring**
  - Real-time stock level tracking
  - Visual stock indicators (progress bars)
  - Low stock filtering (< 10 items)
  - Automatic stock reduction on orders
  
- **Sales Reporting**
  - Total revenue calculation
  - Order history with customer details
  - Product-wise sales analysis
  - Date-wise order tracking

### 🛍️ Customer Features
- **Product Browsing**
  - View all available products
  - Filter by category
  - Product detail pages with descriptions
  - Stock availability indicators
  
- **Shopping Cart**
  - Add/remove products
  - Update quantities
  - View cart summary
  - Real-time total calculation
  
- **Checkout Process**
  - Customer information form
  - Shipping address collection
  - Order summary review
  - Cash on Delivery payment option
  
- **Order Management**
  - View order history
  - Order confirmation page
  - Order tracking with status

### 🔄 Automated Features
- **Stock Management**
  - Automatic stock reduction on order placement
  - Database transaction safety
  - Rollback on errors
  
- **Notifications**
  - Success/error messages
  - Low stock alerts
  - Order confirmation

---

## 🛠️ Technology Stack

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: MySQL 8.0+
- **ORM**: Eloquent
- **Authentication**: Laravel Breeze

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS 3.x
- **Build Tool**: Vite
- **JavaScript**: Vanilla JS (ES6+)

### Development Tools
- **Package Manager**: Composer (PHP), NPM (JavaScript)
- **Version Control**: Git
- **Server**: Apache/Nginx + PHP-FPM
- **Local Development**: Laravel Artisan Server

---

## 🏗️ System Architecture

```
┌─────────────────────────────────────────────────────────┐
│                     Client Browser                       │
│              (Customer / Admin Interface)                │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│                   Laravel Application                    │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  │
│  │  Controllers │  │  Middleware  │  │    Models    │  │
│  └──────────────┘  └──────────────┘  └──────────────┘  │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  │
│  │    Routes    │  │  Validation  │  │    Views     │  │
│  └──────────────┘  └──────────────┘  └──────────────┘  │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────┐
│                   MySQL Database                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐              │
│  │  Users   │  │ Products │  │  Orders  │              │
│  └──────────┘  └──────────┘  └──────────┘              │
│  ┌──────────┐  ┌──────────┐                            │
│  │Order Items│ │ Sessions │                            │
│  └──────────┘  └──────────┘                            │
└─────────────────────────────────────────────────────────┘
```

---

## 🗄️ Database Schema

### Tables Overview

| Table | Description | Relationships |
|-------|-------------|---------------|
| `users` | User accounts (admin/customer) | Has many orders |
| `products` | Product catalog | Has many order_items |
| `orders` | Customer orders | Belongs to user, has many order_items |
| `order_items` | Individual items in orders | Belongs to order and product |
| `sessions` | User session data | Belongs to user |

### Entity Relationship Diagram

```
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│    Users    │         │   Orders    │         │Order Items  │
├─────────────┤         ├─────────────┤         ├─────────────┤
│ id (PK)     │────┐    │ id (PK)     │────┐    │ id (PK)     │
│ name        │    │    │ user_id (FK)│◄───┘    │ order_id(FK)│◄───┐
│ email       │    └───►│ total_amount│         │product_id   │    │
│ role        │         │ status      │         │ quantity    │    │
│ password    │         │customer_name│         │ price       │    │
└─────────────┘         │customer_email        └─────────────┘    │
                        │shipping_addr│                           │
                        └─────────────┘                           │
                                                                  │
┌─────────────┐                                                  │
│  Products   │                                                  │
├─────────────┤                                                  │
│ id (PK)     │──────────────────────────────────────────────────┘
│ name        │
│ description │
│ price       │
│ stock       │
│ category    │
│ image       │
└─────────────┘
```

### Detailed Schema

#### Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Products Table
```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),
    category VARCHAR(255) NOT NULL DEFAULT 'Candy',
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Orders Table
```sql
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL CHECK (total_amount >= 0),
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    shipping_address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### Order Items Table
```sql
CREATE TABLE order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT,
    UNIQUE (order_id, product_id)
);
```

---

## 📦 Installation Guide

### Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **MySQL** >= 8.0
- **Git**

### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd candy-shop
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install JavaScript Dependencies

```bash
npm install
```

### Step 4: Environment Configuration

1. Copy the example environment file:
```bash
cp .env.example .env
```

2. Generate application key:
```bash
php artisan key:generate
```

3. Configure your `.env` file:
```env
APP_NAME="Candy Shop"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8081

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=candy_shop_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Database Setup

1. Create the database:
```bash
mysql -u root -p
CREATE DATABASE candy_shop_db;
exit;
```

2. Run migrations:
```bash
php artisan migrate
```

3. (Optional) Seed sample data:
```bash
php artisan db:seed
```

### Step 6: Storage Link

Create symbolic link for file uploads:
```bash
php artisan storage:link
```

### Step 7: Build Frontend Assets

```bash
npm run dev
```

### Step 8: Start Development Server

In a new terminal:
```bash
php artisan serve --port=8081
```

### Step 9: Access the Application

- **Application URL**: http://localhost:8081
- **Admin Dashboard**: http://localhost:8081/products (login as admin)
- **Shop**: http://localhost:8081/shop (customer view)

### Default Credentials

Create an admin user manually or via seeder:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@candyshop.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

**Login Credentials:**
- Email: `admin@candyshop.com`
- Password: `password`

---

## 👥 User Roles & Access

### Admin Role

**Access Level**: Full system access

**Permissions:**
- ✅ View admin dashboard with analytics
- ✅ Manage products (Create, Read, Update, Delete)
- ✅ View all orders and customer information
- ✅ Access sales reports and revenue data
- ✅ Monitor inventory and stock levels
- ✅ View low stock alerts

**Default Route**: `/products` (Admin Dashboard)

### Customer Role

**Access Level**: Limited to shopping features

**Permissions:**
- ✅ Browse products and categories
- ✅ Add products to shopping cart
- ✅ Place orders
- ✅ View own order history
- ✅ Update profile information
- ❌ Cannot access admin dashboard
- ❌ Cannot manage products
- ❌ Cannot view other customers' orders

**Default Route**: `/shop` (Product Catalog)

---

## 🔑 Key Functionalities

### 1. Product Management (Admin)

**Create Product:**
```
Route: /products/create
Method: GET (form), POST (submit)
Features:
- Product name, description
- Category selection
- Price in Rupees
- Stock quantity
- Image upload
```

**Edit Product:**
```
Route: /products/{id}/edit
Method: GET (form), PUT (update)
Features:
- Update all product details
- Change product image
- Adjust stock levels
```

**Delete Product:**
```
Route: /products/{id}
Method: DELETE
Features:
- Soft delete with confirmation
- Removes product image from storage
```

### 2. Shopping Cart (Customer)

**Add to Cart:**
```
Route: /cart/add/{id}
Method: POST
Process:
1. Validate product availability
2. Add to session cart
3. Update cart count
4. Show success message
```

**Update Cart:**
```
Route: /cart/update
Method: PATCH
Process:
1. Update quantities
2. Recalculate totals
3. Validate stock availability
```

**Remove from Cart:**
```
Route: /cart/remove
Method: DELETE
Process:
1. Remove item from session
2. Update cart totals
```

### 3. Order Processing

**Checkout Flow:**
```
1. Customer fills shipping information
2. Reviews order summary
3. Confirms order (Cash on Delivery)
4. System processes order:
   - Creates order record
   - Creates order items
   - Reduces product stock
   - Clears cart
5. Shows order confirmation
```

**Stock Reduction Logic:**
```php
DB::beginTransaction();
try {
    // Create order
    $order = Order::create([...]);
    
    // Create order items and reduce stock
    foreach($cart as $id => $details) {
        OrderItem::create([...]);
        
        $product = Product::find($id);
        $product->stock = $product->stock - $details['quantity'];
        $product->save();
    }
    
    DB::commit();
} catch (\Exception $e) {
    DB::rollback();
    // Handle error
}
```

### 4. Sales Reporting (Admin)

**Revenue Calculation:**
```php
$totalRevenue = Order::sum('total_amount');
$totalOrders = Order::count();
$recentSales = Order::latest()->take(5)->get();
```

**Stock Alerts:**
```php
$lowStockCount = Product::where('stock', '<', 10)->count();
$outOfStockCount = Product::where('stock', '=', 0)->count();
```

---

## 📁 Project Structure

```
candy-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php      # Product CRUD
│   │   │   ├── ShopController.php         # Customer shop
│   │   │   ├── CartController.php         # Shopping cart
│   │   │   ├── OrderController.php        # Order processing
│   │   │   └── ProfileController.php      # User profile
│   │   └── Middleware/
│   │       └── AdminMiddleware.php        # Admin access control
│   └── Models/
│       ├── User.php                       # User model
│       ├── Product.php                    # Product model
│       ├── Order.php                      # Order model
│       └── OrderItem.php                  # Order item model
├── database/
│   ├── migrations/                        # Database migrations
│   └── seeders/                           # Database seeders
├── public/
│   ├── storage/                           # Uploaded images
│   └── index.php                          # Entry point
├── resources/
│   ├── views/
│   │   ├── products/                      # Admin product views
│   │   │   ├── index.blade.php           # Product list
│   │   │   ├── create.blade.php          # Create form
│   │   │   └── edit.blade.php            # Edit form
│   │   ├── shop/                          # Customer shop views
│   │   │   ├── index.blade.php           # Product catalog
│   │   │   └── show.blade.php            # Product details
│   │   ├── cart/
│   │   │   └── index.blade.php           # Shopping cart
│   │   ├── orders/
│   │   │   ├── checkout.blade.php        # Checkout page
│   │   │   ├── show.blade.php            # Order confirmation
│   │   │   └── index.blade.php           # Order history
│   │   └── layouts/
│   │       └── app.blade.php             # Main layout
│   └── css/
│       └── app.css                        # Tailwind CSS
├── routes/
│   ├── web.php                            # Web routes
│   └── auth.php                           # Auth routes
├── storage/
│   └── app/
│       └── public/
│           └── products/                  # Product images
├── .env                                   # Environment config
├── composer.json                          # PHP dependencies
├── package.json                           # JS dependencies
├── README.md                              # This file
└── SQL_QUERIES.md                         # SQL documentation
```

---

## 🌐 API Endpoints

### Public Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Welcome page |
| GET | `/register` | Registration form |
| POST | `/register` | Register new user |
| GET | `/login` | Login form |
| POST | `/login` | Authenticate user |

### Authenticated Routes

| Method | Endpoint | Description | Role |
|--------|----------|-------------|------|
| GET | `/dashboard` | Redirect to role-based dashboard | All |
| GET | `/profile` | User profile | All |
| PATCH | `/profile` | Update profile | All |

### Admin Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/products` | Product list & dashboard |
| GET | `/products/create` | Create product form |
| POST | `/products` | Store new product |
| GET | `/products/{id}` | View product |
| GET | `/products/{id}/edit` | Edit product form |
| PUT | `/products/{id}` | Update product |
| DELETE | `/products/{id}` | Delete product |

### Customer Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/shop` | Product catalog |
| GET | `/shop/{id}` | Product details |
| GET | `/cart` | View cart |
| POST | `/cart/add/{id}` | Add to cart |
| PATCH | `/cart/update` | Update cart |
| DELETE | `/cart/remove` | Remove from cart |
| GET | `/checkout` | Checkout page |
| POST | `/checkout` | Place order |
| GET | `/orders` | Order history |
| GET | `/orders/{id}` | Order details |

---

## 📸 Screenshots

### Admin Dashboard
- Sales & Revenue Report
- Low Stock Alerts
- Product Inventory Grid
- Recent Sales Activity

### Customer Shop
- Product Catalog with Categories
- Product Detail Pages
- Shopping Cart
- Checkout Process
- Order Confirmation

---

## 🧪 Testing

### Manual Testing Checklist

**Admin Features:**
- [ ] Login as admin
- [ ] Create new product
- [ ] Edit existing product
- [ ] Delete product
- [ ] View sales report
- [ ] Check low stock alerts

**Customer Features:**
- [ ] Register new account
- [ ] Browse products
- [ ] Add to cart
- [ ] Update cart quantities
- [ ] Complete checkout
- [ ] View order confirmation
- [ ] Check order history

**Stock Management:**
- [ ] Place order and verify stock reduction
- [ ] Check low stock indicator (< 10)
- [ ] Verify out of stock display (= 0)

---

## 🚀 Deployment

### Production Checklist

1. **Environment Configuration:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize Application:**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

3. **Database:**
```bash
php artisan migrate --force
```

4. **File Permissions:**
```bash
chmod -R 775 storage bootstrap/cache
```

5. **Web Server Configuration:**
- Point document root to `/public`
- Enable HTTPS
- Configure URL rewriting

---

## 📊 Database Constraints

### Primary Keys
- All tables have auto-incrementing primary keys
- Ensures unique identification of records

### Foreign Keys
- `orders.user_id` → `users.id` (CASCADE)
- `order_items.order_id` → `orders.id` (CASCADE)
- `order_items.product_id` → `products.id` (RESTRICT)

### Check Constraints
- `price >= 0` (No negative prices)
- `stock >= 0` (No negative stock)
- `quantity > 0` (Order items must have quantity)
- `email LIKE '%@%.%'` (Valid email format)

### Unique Constraints
- `users.email` (Unique email addresses)
- `order_items(order_id, product_id)` (No duplicate products in same order)

---

## 🔐 Security Features

- **Password Hashing**: Bcrypt encryption
- **CSRF Protection**: Laravel's built-in CSRF tokens
- **SQL Injection Prevention**: Eloquent ORM parameterized queries
- **XSS Protection**: Blade template escaping
- **Role-Based Access**: Middleware authorization
- **Session Security**: Secure session management

---

## 💡 Future Enhancements

- [ ] Payment gateway integration (Razorpay, Stripe)
- [ ] Email notifications for orders
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Advanced search and filters
- [ ] Discount codes and coupons
- [ ] Multi-image product gallery
- [ ] Order status tracking
- [ ] Admin analytics dashboard
- [ ] Export sales reports (PDF, Excel)

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 👨‍💻 Developer Information

**Project Name**: Candy & Chocolate Shop E-Commerce System  
**Version**: 1.0.0  
**Framework**: Laravel 11.x  
**Database**: MySQL 8.0+  
**Currency**: Indian Rupees (Rs)  

---

## 📞 Support

For support, email support@candyshop.com or create an issue in the repository.

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Font Awesome Icons
- Google Fonts

---

**Made with ❤️ for sweet tooth enthusiasts!** 🍫🍬🍭
