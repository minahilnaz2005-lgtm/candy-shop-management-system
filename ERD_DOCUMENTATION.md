# 🗄️ Entity Relationship Diagram (ERD) - Candy Shop Database

## Database: `candy_shop_db`

---

## 📊 ERD Overview

The Candy Shop database consists of **5 main entities** with well-defined relationships to support **dual-role e-commerce operations**:
- **Admin Role**: Product management, inventory control, sales reporting
- **Customer Role**: Product browsing, shopping cart, order placement

### System Architecture by Role

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                     ADMIN & CUSTOMER ROLE ARCHITECTURE                       │
└─────────────────────────────────────────────────────────────────────────────┘

    ┌──────────────────┐                    ┌──────────────────┐
    │   ADMIN ROLE     │                    │  CUSTOMER ROLE   │
    │   (role='admin') │                    │  (role='user')   │
    └────────┬─────────┘                    └────────┬─────────┘
             │                                       │
             │                                       │
    ┌────────▼─────────────────────────────────────▼────────┐
    │                    USERS TABLE                         │
    │  - Stores both Admin and Customer accounts             │
    │  - Role field determines access level                  │
    └────────┬───────────────────────────────────┬───────────┘
             │                                   │
             │ ADMIN FUNCTIONS:                  │ CUSTOMER FUNCTIONS:
             │ • Create Products                 │ • Browse Products
             │ • Update Products                 │ • View Product Details
             │ • Delete Products                 │ • Add to Cart
             │ • View Sales Reports              │ • Place Orders
             │ • Monitor Stock                   │ • View Order History
             │ • Manage Inventory                │ • Track Orders
             │                                   │
             ▼                                   ▼
    ┌─────────────────┐              ┌─────────────────┐
    │    PRODUCTS     │◄─────────────│    SESSIONS     │
    │  (Managed by    │              │  (Cart Data)    │
    │     Admin)      │              │                 │
    └────────┬────────┘              └─────────────────┘
             │                                   │
             │                                   │
             │                        ┌──────────▼──────────┐
             │                        │      ORDERS         │
             │                        │  (Customer Orders)  │
             │                        └──────────┬──────────┘
             │                                   │
             │                                   │
             └──────────────┬────────────────────┘
                            │
                            ▼
                   ┌─────────────────┐
                   │   ORDER_ITEMS   │
                   │ (Order Details) │
                   │ (Stock Update)  │
                   └─────────────────┘
```

---

## 🎨 Complete Visual ERD Diagram

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    CANDY SHOP - COMPLETE DATABASE SCHEMA                     │
│                      (Admin + Customer Functionalities)                      │
└─────────────────────────────────────────────────────────────────────────────┘

┌──────────────────────┐
│       USERS          │
├──────────────────────┤
│ PK  id               │ BIGINT UNSIGNED AUTO_INCREMENT
│     name             │ VARCHAR(255) NOT NULL
│ UK  email            │ VARCHAR(255) NOT NULL UNIQUE
│     role             │ ENUM('admin','user') DEFAULT 'user'
│     email_verified_at│ TIMESTAMP NULL
│     password         │ VARCHAR(255) NOT NULL
│     remember_token   │ VARCHAR(100) NULL
│     created_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
│     updated_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
└──────────────────────┘
         │
         │ 1
         │
         │ has many
         │
         │ *
         ▼
┌──────────────────────┐
│      ORDERS          │
├──────────────────────┤
│ PK  id               │ BIGINT UNSIGNED AUTO_INCREMENT
│ FK  user_id          │ BIGINT UNSIGNED NOT NULL
│     total_amount     │ DECIMAL(10,2) NOT NULL CHECK(>=0)
│     status           │ VARCHAR(50) DEFAULT 'pending'
│     customer_name    │ VARCHAR(255) NOT NULL
│     customer_email   │ VARCHAR(255) NOT NULL
│     shipping_address │ TEXT NOT NULL
│     created_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
│     updated_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
└──────────────────────┘
         │
         │ 1
         │
         │ has many
         │
         │ *
         ▼
┌──────────────────────┐
│    ORDER_ITEMS       │
├──────────────────────┤
│ PK  id               │ BIGINT UNSIGNED AUTO_INCREMENT
│ FK  order_id         │ BIGINT UNSIGNED NOT NULL
│ FK  product_id       │ BIGINT UNSIGNED NOT NULL
│     quantity         │ INT NOT NULL CHECK(>0)
│     price            │ DECIMAL(10,2) NOT NULL CHECK(>=0)
│     created_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
│     updated_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
│ UK  (order_id, product_id) UNIQUE
└──────────────────────┘
         │
         │ *
         │
         │ belongs to
         │
         │ 1
         ▼
┌──────────────────────┐
│     PRODUCTS         │
├──────────────────────┤
│ PK  id               │ BIGINT UNSIGNED AUTO_INCREMENT
│     name             │ VARCHAR(255) NOT NULL
│     description      │ TEXT NULL
│     price            │ DECIMAL(10,2) NOT NULL CHECK(>=0)
│     stock            │ INT NOT NULL DEFAULT 0 CHECK(>=0)
│     category         │ VARCHAR(255) DEFAULT 'Candy'
│     image            │ VARCHAR(255) NULL
│     created_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
│     updated_at       │ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
└──────────────────────┘


┌──────────────────────┐
│     SESSIONS         │
├──────────────────────┤
│ PK  id               │ VARCHAR(255)
│ FK  user_id          │ BIGINT UNSIGNED NULL
│     ip_address       │ VARCHAR(45) NULL
│     user_agent       │ TEXT NULL
│     payload          │ LONGTEXT NOT NULL
│     last_activity    │ INT NOT NULL
└──────────────────────┘
         ▲
         │ *
         │
         │ belongs to
         │
         │ 1
         │
    ┌────┴────┐
    │  USERS  │
    └─────────┘
```

---

## 📋 Detailed Entity Descriptions

### 1. **USERS** Entity

**Purpose**: Stores user account information for both administrators and customers.

**Attributes:**

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique user identifier |
| `name` | VARCHAR(255) | NOT NULL, CHECK(LENGTH >= 2) | User's full name |
| `email` | VARCHAR(255) | NOT NULL, UNIQUE, CHECK(LIKE '%@%.%') | User's email address |
| `role` | ENUM | NOT NULL, DEFAULT 'user' | User role: 'admin' or 'user' |
| `email_verified_at` | TIMESTAMP | NULL | Email verification timestamp |
| `password` | VARCHAR(255) | NOT NULL | Hashed password (bcrypt) |
| `remember_token` | VARCHAR(100) | NULL | Remember me token |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Account creation date |
| `updated_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Last update timestamp |

**Relationships:**
- **One-to-Many** with ORDERS (One user can have many orders)
- **One-to-Many** with SESSIONS (One user can have many sessions)

**Business Rules:**
- Email must be unique across all users
- Role determines access level (admin vs customer)
- Password must be hashed before storage
- Name must be at least 2 characters

---

### 2. **PRODUCTS** Entity

**Purpose**: Stores the candy and chocolate product catalog.

**Attributes:**

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique product identifier |
| `name` | VARCHAR(255) | NOT NULL, CHECK(LENGTH >= 2) | Product name |
| `description` | TEXT | NULL | Product description |
| `price` | DECIMAL(10,2) | NOT NULL, CHECK(>= 0) | Product price in Rupees |
| `stock` | INT | NOT NULL, DEFAULT 0, CHECK(>= 0) | Available quantity |
| `category` | VARCHAR(255) | NOT NULL, DEFAULT 'Candy' | Product category |
| `image` | VARCHAR(255) | NULL | Image file path |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Product creation date |
| `updated_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Last update timestamp |

**Relationships:**
- **One-to-Many** with ORDER_ITEMS (One product can be in many order items)

**Business Rules:**
- Price cannot be negative
- Stock cannot be negative
- Valid categories: Candy, Chocolate, Gummy, Toffee, Lollipop, Other
- Stock automatically decreases when orders are placed
- Low stock alert when stock < 10
- Out of stock when stock = 0

**Indexes:**
- `idx_products_category` on `category`
- `idx_products_price` on `price`
- `idx_products_stock` on `stock`
- `idx_products_created_at` on `created_at`

---

### 3. **ORDERS** Entity

**Purpose**: Stores customer order information and shipping details.

**Attributes:**

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique order identifier |
| `user_id` | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | Reference to users.id |
| `total_amount` | DECIMAL(10,2) | NOT NULL, CHECK(>= 0) | Total order amount in Rs |
| `status` | VARCHAR(50) | NOT NULL, DEFAULT 'pending' | Order status |
| `customer_name` | VARCHAR(255) | NOT NULL, CHECK(LENGTH >= 2) | Customer name for delivery |
| `customer_email` | VARCHAR(255) | NOT NULL, CHECK(LIKE '%@%.%') | Customer contact email |
| `shipping_address` | TEXT | NOT NULL | Full shipping address |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Order placement date |
| `updated_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Last update timestamp |

**Relationships:**
- **Many-to-One** with USERS (Many orders belong to one user)
- **One-to-Many** with ORDER_ITEMS (One order has many items)

**Foreign Keys:**
- `user_id` REFERENCES `users(id)` ON DELETE CASCADE ON UPDATE CASCADE

**Business Rules:**
- Total amount cannot be negative
- Valid statuses: 'pending', 'processing', 'completed', 'cancelled'
- Customer email must be valid format
- When user is deleted, their orders are also deleted (CASCADE)

**Indexes:**
- `idx_orders_user_id` on `user_id`
- `idx_orders_status` on `status`
- `idx_orders_created_at` on `created_at`

---

### 4. **ORDER_ITEMS** Entity

**Purpose**: Stores individual products within each order (junction table).

**Attributes:**

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique order item identifier |
| `order_id` | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | Reference to orders.id |
| `product_id` | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | Reference to products.id |
| `quantity` | INT | NOT NULL, CHECK(> 0) | Quantity ordered |
| `price` | DECIMAL(10,2) | NOT NULL, CHECK(>= 0) | Price at time of purchase |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Item creation date |
| `updated_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Last update timestamp |

**Relationships:**
- **Many-to-One** with ORDERS (Many items belong to one order)
- **Many-to-One** with PRODUCTS (Many items reference one product)

**Foreign Keys:**
- `order_id` REFERENCES `orders(id)` ON DELETE CASCADE ON UPDATE CASCADE
- `product_id` REFERENCES `products(id)` ON DELETE RESTRICT ON UPDATE CASCADE

**Unique Constraints:**
- `UNIQUE(order_id, product_id)` - Prevents duplicate products in same order

**Business Rules:**
- Quantity must be greater than 0
- Price is stored at time of purchase (historical pricing)
- When order is deleted, items are also deleted (CASCADE)
- Products cannot be deleted if they exist in orders (RESTRICT)
- Same product cannot appear twice in the same order

**Indexes:**
- `idx_order_items_order_id` on `order_id`
- `idx_order_items_product_id` on `product_id`

---

### 5. **SESSIONS** Entity

**Purpose**: Stores user session data for authentication and cart management.

**Attributes:**

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| `id` | VARCHAR(255) | PRIMARY KEY | Unique session identifier |
| `user_id` | BIGINT UNSIGNED | FOREIGN KEY, NULL | Reference to users.id |
| `ip_address` | VARCHAR(45) | NULL | User's IP address |
| `user_agent` | TEXT | NULL | Browser user agent |
| `payload` | LONGTEXT | NOT NULL | Serialized session data |
| `last_activity` | INT | NOT NULL | Last activity timestamp |

**Relationships:**
- **Many-to-One** with USERS (Many sessions can belong to one user)

**Foreign Keys:**
- `user_id` REFERENCES `users(id)` ON DELETE CASCADE ON UPDATE CASCADE

**Business Rules:**
- user_id can be NULL for guest sessions
- Session data includes cart information
- When user is deleted, their sessions are also deleted (CASCADE)

**Indexes:**
- `idx_sessions_user_id` on `user_id`
- `idx_sessions_last_activity` on `last_activity`

---

## � Role-Based Functionality Matrix

### Complete Admin & Customer Operations by Entity

This section details **every operation** that Admin and Customer roles can perform on each database entity.

---

### 🔐 **USERS Entity** - Role-Based Operations

#### **Admin Role Operations:**

| Operation | Access | Description | SQL Query |
|-----------|--------|-------------|-----------|
| **View All Users** | ✅ Full Access | View list of all users (admin + customers) | `SELECT * FROM users ORDER BY created_at DESC` |
| **View User Details** | ✅ Full Access | View specific user information | `SELECT * FROM users WHERE id = ?` |
| **Create User** | ✅ Full Access | Register new admin or customer accounts | `INSERT INTO users (name, email, role, password) VALUES (?, ?, ?, ?)` |
| **Update User** | ✅ Full Access | Modify user information, change roles | `UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?` |
| **Delete User** | ✅ Full Access | Remove user accounts (CASCADE deletes orders) | `DELETE FROM users WHERE id = ?` |
| **View User Orders** | ✅ Full Access | See all orders placed by any user | `SELECT * FROM orders WHERE user_id = ?` |
| **User Statistics** | ✅ Full Access | Count users by role, registration trends | `SELECT role, COUNT(*) FROM users GROUP BY role` |

#### **Customer Role Operations:**

| Operation | Access | Description | SQL Query |
|-----------|--------|-------------|-----------|
| **View Own Profile** | ✅ Limited | View only their own account information | `SELECT * FROM users WHERE id = ? AND id = auth_user_id` |
| **Update Own Profile** | ✅ Limited | Update own name, email, password | `UPDATE users SET name = ?, email = ? WHERE id = auth_user_id` |
| **View All Users** | ❌ Denied | Cannot view other users | N/A |
| **Create Users** | ❌ Denied | Cannot create other accounts | N/A |
| **Delete Users** | ❌ Denied | Cannot delete any accounts | N/A |
| **Change Role** | ❌ Denied | Cannot modify user roles | N/A |

---

### 🍬 **PRODUCTS Entity** - Role-Based Operations

#### **Admin Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **View All Products** | ✅ Full Access | See complete product catalog with stock | `SELECT * FROM products ORDER BY created_at DESC` | `GET /products` |
| **View Product Details** | ✅ Full Access | View specific product information | `SELECT * FROM products WHERE id = ?` | `GET /products/{id}` |
| **Create Product** | ✅ Full Access | Add new candy/chocolate products | `INSERT INTO products (name, description, price, stock, category, image) VALUES (?, ?, ?, ?, ?, ?)` | `POST /products` |
| **Update Product** | ✅ Full Access | Modify product details, price, stock | `UPDATE products SET name = ?, price = ?, stock = ?, category = ? WHERE id = ?` | `PUT /products/{id}` |
| **Delete Product** | ✅ Full Access | Remove products (RESTRICT if in orders) | `DELETE FROM products WHERE id = ?` | `DELETE /products/{id}` |
| **Adjust Stock** | ✅ Full Access | Manually increase/decrease stock levels | `UPDATE products SET stock = ? WHERE id = ?` | `PUT /products/{id}` |
| **Upload Image** | ✅ Full Access | Add/update product images | File upload to `storage/products/` | `POST /products` |
| **Filter by Category** | ✅ Full Access | View products by category | `SELECT * FROM products WHERE category = ?` | `GET /products?filter=category` |
| **Low Stock Alert** | ✅ Full Access | View products with stock < 10 | `SELECT * FROM products WHERE stock < 10` | `GET /products?filter=low_stock` |
| **Out of Stock** | ✅ Full Access | View products with stock = 0 | `SELECT * FROM products WHERE stock = 0` | Dashboard |
| **Stock Statistics** | ✅ Full Access | Total inventory, value calculations | `SELECT SUM(stock * price) AS inventory_value FROM products` | Dashboard |

#### **Customer Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **Browse Products** | ✅ Read-Only | View available products (stock > 0) | `SELECT * FROM products WHERE stock > 0 ORDER BY created_at DESC` | `GET /shop` |
| **View Product Details** | ✅ Read-Only | See product information, price, stock | `SELECT * FROM products WHERE id = ?` | `GET /shop/{id}` |
| **Filter by Category** | ✅ Read-Only | Browse products by category | `SELECT * FROM products WHERE category = ? AND stock > 0` | `GET /shop?category=?` |
| **Search Products** | ✅ Read-Only | Search by product name | `SELECT * FROM products WHERE name LIKE ? AND stock > 0` | `GET /shop?search=?` |
| **Create Product** | ❌ Denied | Cannot add products | N/A | N/A |
| **Update Product** | ❌ Denied | Cannot modify products | N/A | N/A |
| **Delete Product** | ❌ Denied | Cannot remove products | N/A | N/A |
| **View Stock Levels** | ✅ Limited | See availability (In Stock / Limited / Out of Stock) | Visual indicators only | `GET /shop` |

---

### 📦 **ORDERS Entity** - Role-Based Operations

#### **Admin Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **View All Orders** | ✅ Full Access | See all customer orders | `SELECT * FROM orders ORDER BY created_at DESC` | Dashboard |
| **View Order Details** | ✅ Full Access | See complete order information | `SELECT * FROM orders WHERE id = ?` | `GET /orders/{id}` |
| **View Recent Sales** | ✅ Full Access | Last 5 orders for dashboard | `SELECT * FROM orders ORDER BY created_at DESC LIMIT 5` | Dashboard |
| **Filter by Status** | ✅ Full Access | View orders by status | `SELECT * FROM orders WHERE status = ?` | Dashboard |
| **Filter by Date** | ✅ Full Access | Orders within date range | `SELECT * FROM orders WHERE created_at BETWEEN ? AND ?` | Reports |
| **Update Order Status** | ✅ Full Access | Change order status | `UPDATE orders SET status = ? WHERE id = ?` | `PUT /orders/{id}` |
| **View Customer Info** | ✅ Full Access | See customer details for orders | `SELECT customer_name, customer_email, shipping_address FROM orders WHERE id = ?` | `GET /orders/{id}` |
| **Calculate Revenue** | ✅ Full Access | Total revenue from all orders | `SELECT SUM(total_amount) FROM orders WHERE status = 'completed'` | Dashboard |
| **Order Count** | ✅ Full Access | Total number of orders | `SELECT COUNT(*) FROM orders` | Dashboard |
| **Delete Order** | ✅ Full Access | Remove orders (CASCADE deletes items) | `DELETE FROM orders WHERE id = ?` | Admin Panel |

#### **Customer Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **Place Order** | ✅ Create | Create new order from cart | `INSERT INTO orders (user_id, total_amount, status, customer_name, customer_email, shipping_address) VALUES (?, ?, ?, ?, ?, ?)` | `POST /checkout` |
| **View Own Orders** | ✅ Limited | See only their order history | `SELECT * FROM orders WHERE user_id = auth_user_id ORDER BY created_at DESC` | `GET /orders` |
| **View Own Order Details** | ✅ Limited | See specific order information | `SELECT * FROM orders WHERE id = ? AND user_id = auth_user_id` | `GET /orders/{id}` |
| **Track Order Status** | ✅ Limited | Check order status | `SELECT status FROM orders WHERE id = ? AND user_id = auth_user_id` | `GET /orders/{id}` |
| **View All Orders** | ❌ Denied | Cannot see other customers' orders | N/A | N/A |
| **Update Orders** | ❌ Denied | Cannot modify orders after placement | N/A | N/A |
| **Delete Orders** | ❌ Denied | Cannot cancel/delete orders | N/A | N/A |
| **View Revenue** | ❌ Denied | Cannot access sales data | N/A | N/A |

---

### 🛒 **ORDER_ITEMS Entity** - Role-Based Operations

#### **Admin Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **View All Order Items** | ✅ Full Access | See all items across all orders | `SELECT * FROM order_items ORDER BY created_at DESC` | Admin Panel |
| **View Items by Order** | ✅ Full Access | Items in specific order | `SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?` | `GET /orders/{id}` |
| **View Items by Product** | ✅ Full Access | All orders containing specific product | `SELECT oi.*, o.customer_name FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE oi.product_id = ?` | Reports |
| **Product Sales Analysis** | ✅ Full Access | Best-selling products | `SELECT product_id, SUM(quantity) as total_sold FROM order_items GROUP BY product_id ORDER BY total_sold DESC` | Dashboard |
| **Revenue by Product** | ✅ Full Access | Revenue per product | `SELECT product_id, SUM(quantity * price) as revenue FROM order_items GROUP BY product_id` | Reports |
| **Delete Order Item** | ✅ Full Access | Remove item from order | `DELETE FROM order_items WHERE id = ?` | Admin Panel |

#### **Customer Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **Create Order Items** | ✅ Create | Add items when placing order | `INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)` | `POST /checkout` |
| **View Own Order Items** | ✅ Limited | See items in their own orders | `SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id IN (SELECT id FROM orders WHERE user_id = auth_user_id)` | `GET /orders/{id}` |
| **View All Order Items** | ❌ Denied | Cannot see other customers' items | N/A | N/A |
| **Update Order Items** | ❌ Denied | Cannot modify items after order placement | N/A | N/A |
| **Delete Order Items** | ❌ Denied | Cannot remove items from placed orders | N/A | N/A |

---

### 🔄 **SESSIONS Entity** - Role-Based Operations

#### **Admin Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **View All Sessions** | ✅ Full Access | See all active sessions | `SELECT * FROM sessions ORDER BY last_activity DESC` | Admin Panel |
| **View User Sessions** | ✅ Full Access | Sessions for specific user | `SELECT * FROM sessions WHERE user_id = ?` | Admin Panel |
| **Delete Session** | ✅ Full Access | Force logout users | `DELETE FROM sessions WHERE id = ?` | Admin Panel |
| **Session Statistics** | ✅ Full Access | Active users, guest sessions | `SELECT COUNT(*) FROM sessions WHERE last_activity > ?` | Dashboard |

#### **Customer Role Operations:**

| Operation | Access | Description | SQL Query | Route |
|-----------|--------|-------------|-----------|-------|
| **Create Session** | ✅ Auto | Session created on login | `INSERT INTO sessions (id, user_id, payload, last_activity) VALUES (?, ?, ?, ?)` | Auto |
| **Update Session** | ✅ Auto | Cart data stored in session | `UPDATE sessions SET payload = ?, last_activity = ? WHERE id = ?` | Auto |
| **View Own Session** | ✅ Limited | Access own cart data | Session data retrieval | Auto |
| **Delete Own Session** | ✅ Limited | Logout | `DELETE FROM sessions WHERE id = ? AND user_id = auth_user_id` | `POST /logout` |
| **View Other Sessions** | ❌ Denied | Cannot access other users' sessions | N/A | N/A |

---

## 🔄 **Automated Business Logic** (Both Roles)

### Stock Reduction on Order Placement

**Trigger**: When customer places order  
**Affected Entity**: PRODUCTS  
**Process**:

```sql
-- Automatic stock reduction
START TRANSACTION;

-- 1. Create order
INSERT INTO orders (...) VALUES (...);

-- 2. Create order items
INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES (?, ?, ?, ?);

-- 3. Reduce stock AUTOMATICALLY
UPDATE products 
SET stock = stock - ? 
WHERE id = ?;

COMMIT;
```

**Business Rules**:
- Stock reduced immediately upon order confirmation
- Transaction ensures atomicity (all or nothing)
- If stock update fails, entire order is rolled back
- Admin can view updated stock levels in real-time

---

## 📊 **Dashboard Features by Role**

### Admin Dashboard (`/products`)

**Displayed Information:**

1. **Sales & Revenue Report**
   - Total Revenue: `SUM(total_amount) FROM orders`
   - Total Orders: `COUNT(*) FROM orders`
   - Recent Sales: Last 5 orders with customer details

2. **Stock Management**
   - Total Inventory: `COUNT(*) FROM products`
   - Low Stock Alert: `COUNT(*) FROM products WHERE stock < 10`
   - Out of Stock: `COUNT(*) FROM products WHERE stock = 0`

3. **Product Inventory**
   - All products with stock levels
   - Visual stock indicators (progress bars)
   - Quick edit/delete actions
   - Filter by low stock

**Admin Capabilities:**
- ✅ Create new products
- ✅ Edit existing products
- ✅ Delete products
- ✅ View sales analytics
- ✅ Monitor inventory
- ✅ Access all customer orders

### Customer Dashboard (`/shop`)

**Displayed Information:**

1. **Product Catalog**
   - Available products (stock > 0)
   - Product images, names, prices
   - Category badges
   - Stock availability indicators

2. **Shopping Cart**
   - Cart items with quantities
   - Subtotals and grand total
   - Remove item option

3. **Order History** (`/orders`)
   - Past orders
   - Order status
   - Order details

**Customer Capabilities:**
- ✅ Browse products
- ✅ Add to cart
- ✅ Place orders
- ✅ View order history
- ❌ Cannot access admin features
- ❌ Cannot modify products
- ❌ Cannot view sales reports

---

## 🔒 **Access Control Summary**

| Feature | Admin | Customer |
|---------|-------|----------|
| **Product Management** | Full CRUD | Read-Only |
| **Order Management** | View All | View Own |
| **User Management** | Full CRUD | Update Own |
| **Sales Reports** | Full Access | No Access |
| **Stock Control** | Full Access | View Only |
| **Dashboard Analytics** | Full Access | No Access |
| **Shopping Cart** | N/A | Full Access |
| **Checkout** | N/A | Full Access |

---

## �🔗 Relationship Summary

### Cardinality Notation

```
1:N  = One-to-Many
N:1  = Many-to-One
N:M  = Many-to-Many (through junction table)
```

### Relationship Matrix

| Entity 1 | Relationship | Entity 2 | Type | Description |
|----------|--------------|----------|------|-------------|
| USERS | 1:N | ORDERS | One-to-Many | One user can place many orders |
| USERS | 1:N | SESSIONS | One-to-Many | One user can have many sessions |
| ORDERS | 1:N | ORDER_ITEMS | One-to-Many | One order contains many items |
| PRODUCTS | 1:N | ORDER_ITEMS | One-to-Many | One product can be in many orders |
| USERS | N:M | PRODUCTS | Many-to-Many | Through ORDERS and ORDER_ITEMS |

---

## 🔑 Constraint Details

### Primary Keys (PK)

All tables have a primary key for unique identification:

```sql
-- USERS
CONSTRAINT pk_users PRIMARY KEY (id)

-- PRODUCTS
CONSTRAINT pk_products PRIMARY KEY (id)

-- ORDERS
CONSTRAINT pk_orders PRIMARY KEY (id)

-- ORDER_ITEMS
CONSTRAINT pk_order_items PRIMARY KEY (id)

-- SESSIONS
CONSTRAINT pk_sessions PRIMARY KEY (id)
```

### Foreign Keys (FK)

Foreign keys maintain referential integrity:

```sql
-- ORDERS references USERS
CONSTRAINT fk_orders_user 
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE 
    ON UPDATE CASCADE

-- ORDER_ITEMS references ORDERS
CONSTRAINT fk_order_items_order 
    FOREIGN KEY (order_id) REFERENCES orders(id)
    ON DELETE CASCADE 
    ON UPDATE CASCADE

-- ORDER_ITEMS references PRODUCTS
CONSTRAINT fk_order_items_product 
    FOREIGN KEY (product_id) REFERENCES products(id)
    ON DELETE RESTRICT 
    ON UPDATE CASCADE

-- SESSIONS references USERS
CONSTRAINT fk_sessions_user 
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE 
    ON UPDATE CASCADE
```

### Unique Constraints (UK)

Ensure data uniqueness:

```sql
-- USERS
CONSTRAINT uk_users_email UNIQUE (email)

-- ORDER_ITEMS
CONSTRAINT uk_order_items_order_product UNIQUE (order_id, product_id)
```

### Check Constraints

Validate data integrity:

```sql
-- USERS
CONSTRAINT chk_users_name CHECK (LENGTH(name) >= 2)
CONSTRAINT chk_users_email CHECK (email LIKE '%@%.%')

-- PRODUCTS
CONSTRAINT chk_products_price CHECK (price >= 0)
CONSTRAINT chk_products_stock CHECK (stock >= 0)
CONSTRAINT chk_products_name CHECK (LENGTH(name) >= 2)
CONSTRAINT chk_products_category CHECK (category IN ('Candy', 'Chocolate', 'Gummy', 'Toffee', 'Lollipop', 'Other'))

-- ORDERS
CONSTRAINT chk_orders_total CHECK (total_amount >= 0)
CONSTRAINT chk_orders_status CHECK (status IN ('pending', 'processing', 'completed', 'cancelled'))
CONSTRAINT chk_orders_customer_name CHECK (LENGTH(customer_name) >= 2)
CONSTRAINT chk_orders_customer_email CHECK (customer_email LIKE '%@%.%')

-- ORDER_ITEMS
CONSTRAINT chk_order_items_quantity CHECK (quantity > 0)
CONSTRAINT chk_order_items_price CHECK (price >= 0)
```

---

## 📈 Data Flow Diagram

### Order Placement Flow

```
┌──────────┐
│  USERS   │
│ (Customer)│
└────┬─────┘
     │
     │ 1. Browse Products
     ▼
┌──────────┐
│ PRODUCTS │
│ (Catalog)│
└────┬─────┘
     │
     │ 2. Add to Cart (Session)
     ▼
┌──────────┐
│ SESSIONS │
│  (Cart)  │
└────┬─────┘
     │
     │ 3. Place Order
     ▼
┌──────────┐
│  ORDERS  │
│  (New)   │
└────┬─────┘
     │
     │ 4. Create Order Items
     ▼
┌──────────┐
│ORDER_ITEMS│
│  (New)   │
└────┬─────┘
     │
     │ 5. Reduce Stock
     ▼
┌──────────┐
│ PRODUCTS │
│ (Updated)│
└──────────┘
```

---

## 🎯 Business Logic Implementation

### Stock Management

**When an order is placed:**

```sql
-- Transaction ensures data consistency
START TRANSACTION;

-- 1. Create order
INSERT INTO orders (user_id, total_amount, status, customer_name, customer_email, shipping_address)
VALUES (1, 500.00, 'completed', 'John Doe', 'john@example.com', '123 Street');

-- 2. Create order items
INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES (1, 5, 2, 250.00);

-- 3. Reduce product stock
UPDATE products 
SET stock = stock - 2 
WHERE id = 5;

COMMIT;
```

### Sales Reporting

**Calculate total revenue:**

```sql
SELECT SUM(total_amount) AS total_revenue
FROM orders
WHERE status = 'completed';
```

**Find best-selling products:**

```sql
SELECT 
    p.name,
    SUM(oi.quantity) AS total_sold,
    SUM(oi.quantity * oi.price) AS revenue
FROM products p
INNER JOIN order_items oi ON p.id = oi.product_id
GROUP BY p.id, p.name
ORDER BY total_sold DESC
LIMIT 10;
```

---

## 📊 Sample Data

### Users
```sql
INSERT INTO users (name, email, role, password) VALUES
('Admin User', 'admin@candyshop.com', 'admin', '$2y$12$hashed_password'),
('John Doe', 'john@example.com', 'user', '$2y$12$hashed_password'),
('Jane Smith', 'jane@example.com', 'user', '$2y$12$hashed_password');
```

### Products
```sql
INSERT INTO products (name, description, price, stock, category) VALUES
('Dark Chocolate Truffles', 'Premium handcrafted dark chocolate', 500.00, 100, 'Chocolate'),
('Gummy Bears', 'Colorful fruity gummy bears', 150.00, 200, 'Gummy'),
('Lollipops', 'Rainbow swirl lollipops', 50.00, 150, 'Candy');
```

### Orders
```sql
INSERT INTO orders (user_id, total_amount, status, customer_name, customer_email, shipping_address) VALUES
(2, 650.00, 'completed', 'John Doe', 'john@example.com', '123 Main St, City, State 12345');
```

### Order Items
```sql
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 500.00),
(1, 2, 1, 150.00);
```

---

## 🔍 Query Examples

### Find all orders by a customer
```sql
SELECT o.*, COUNT(oi.id) AS total_items
FROM orders o
LEFT JOIN order_items oi ON o.id = oi.order_id
WHERE o.user_id = 2
GROUP BY o.id
ORDER BY o.created_at DESC;
```

### Find low stock products
```sql
SELECT id, name, stock, category
FROM products
WHERE stock < 10
ORDER BY stock ASC;
```

### Find customers who ordered a specific product
```sql
SELECT DISTINCT o.customer_name, o.customer_email
FROM orders o
INNER JOIN order_items oi ON o.id = oi.order_id
WHERE oi.product_id = 1;
```

---

## 📝 Normalization Level

**Database Normalization: 3NF (Third Normal Form)**

✅ **1NF**: All attributes contain atomic values  
✅ **2NF**: No partial dependencies (all non-key attributes depend on entire primary key)  
✅ **3NF**: No transitive dependencies (non-key attributes don't depend on other non-key attributes)

---

## 🎨 ERD Legend

```
PK  = Primary Key
FK  = Foreign Key
UK  = Unique Key
1   = One
*   = Many
─── = Relationship Line
│   = Vertical Connection
└── = Branch Connection
```

---

**Database Version**: 1.0  
**Last Updated**: January 2026  
**DBMS**: MySQL 8.0+  
**Character Set**: utf8mb4  
**Collation**: utf8mb4_unicode_ci  

---

**End of ERD Documentation** 🎯
