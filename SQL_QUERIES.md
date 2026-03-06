# Candy Shop Database - SQL Queries

## Database Setup

```sql
-- Create Database
CREATE DATABASE IF NOT EXISTS candy_shop_db;

-- Use Database
USE candy_shop_db;
```

---

## Table Creation

### Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(255) NOT NULL DEFAULT 'user',
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Products Table
```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    price DECIMAL(8, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category VARCHAR(255) NOT NULL DEFAULT 'Candy',
    image VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Sessions Table
```sql
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
);
```

---

## Product Queries (CRUD Operations)

### INSERT - Add New Product
```sql
INSERT INTO products (name, description, price, stock, category, image)
VALUES ('Dark Chocolate Truffles', 'Premium handcrafted dark chocolate', 15.99, 100, 'Chocolate', 'products/chocolate.jpg');

INSERT INTO products (name, description, price, stock, category, image)
VALUES ('Gummy Bears', 'Colorful fruity gummy bears', 5.99, 200, 'Gummy', 'products/gummy.jpg');

INSERT INTO products (name, description, price, stock, category, image)
VALUES ('Lollipops', 'Rainbow swirl lollipops', 2.99, 150, 'Candy', 'products/lollipop.jpg');

INSERT INTO products (name, description, price, stock, category, image)
VALUES ('Milk Chocolate Bar', 'Creamy milk chocolate', 8.99, 120, 'Chocolate', 'products/milk-chocolate.jpg');

INSERT INTO products (name, description, price, stock, category, image)
VALUES ('Strawberry Toffee', 'Sweet strawberry flavored toffee', 6.99, 80, 'Toffee', 'products/toffee.jpg');
```

### SELECT - View All Products
```sql
SELECT * FROM products;

-- View products ordered by newest first
SELECT * FROM products ORDER BY created_at DESC;

-- View products ordered by price
SELECT * FROM products ORDER BY price ASC;
```

### SELECT - View Single Product
```sql
SELECT * FROM products WHERE id = 1;

SELECT * FROM products WHERE name = 'Dark Chocolate Truffles';
```

### SELECT - View Products by Category
```sql
SELECT * FROM products WHERE category = 'Chocolate';

SELECT * FROM products WHERE category = 'Candy';

SELECT * FROM products WHERE category = 'Gummy';
```

### UPDATE - Edit Product
```sql
-- Update product price
UPDATE products 
SET price = 18.99 
WHERE id = 1;

-- Update product name and description
UPDATE products 
SET name = 'Premium Dark Chocolate Truffles',
    description = 'Ultimate handcrafted dark chocolate truffles with cocoa nibs'
WHERE id = 1;

-- Update product stock
UPDATE products 
SET stock = 150 
WHERE id = 1;

-- Update complete product
UPDATE products 
SET name = 'Deluxe Chocolate Truffles',
    description = 'Premium quality chocolate',
    price = 19.99,
    stock = 200,
    category = 'Chocolate',
    image = 'products/new-chocolate.jpg'
WHERE id = 1;
```

### DELETE - Remove Product
```sql
DELETE FROM products WHERE id = 1;

DELETE FROM products WHERE name = 'Dark Chocolate Truffles';

DELETE FROM products WHERE stock = 0;
```

---

## User Queries

### INSERT - Register New User
```sql
-- Register as regular user (default role)
INSERT INTO users (name, email, password, role)
VALUES ('John Doe', 'john@example.com', '$2y$12$hashed_password_here', 'user');

-- Register as admin
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@example.com', '$2y$12$hashed_password_here', 'admin');

INSERT INTO users (name, email, password, role)
VALUES ('Jane Smith', 'jane@example.com', '$2y$12$another_hashed_password', 'user');
```

### SELECT - View All Users
```sql
SELECT * FROM users;

SELECT id, name, email, created_at FROM users;
```

### SELECT - Find User by Email
```sql
SELECT * FROM users WHERE email = 'john@example.com';
```

### UPDATE - Update User Information
```sql
UPDATE users 
SET name = 'John Smith' 
WHERE id = 1;

UPDATE users 
SET email = 'newemail@example.com' 
WHERE id = 1;
```

### DELETE - Remove User
```sql
DELETE FROM users WHERE id = 1;
```

---

## Advanced Product Queries

### Search Products by Name
```sql
SELECT * FROM products WHERE name LIKE '%chocolate%';

SELECT * FROM products WHERE name LIKE '%gummy%';

SELECT * FROM products WHERE description LIKE '%premium%';
```

### Filter Products by Price Range
```sql
SELECT * FROM products WHERE price BETWEEN 5.00 AND 15.00;

SELECT * FROM products WHERE price < 10.00;

SELECT * FROM products WHERE price > 20.00;
```

### Filter Products by Stock
```sql
-- Low stock products
SELECT * FROM products WHERE stock < 10;

-- Out of stock products
SELECT * FROM products WHERE stock = 0;

-- Products in stock
SELECT * FROM products WHERE stock > 0;
```

### Count Products by Category
```sql
SELECT category, COUNT(*) as total_products 
FROM products 
GROUP BY category;
```

### Calculate Total Inventory Value
```sql
SELECT SUM(price * stock) as total_inventory_value FROM products;
```

### Calculate Average Product Price
```sql
SELECT AVG(price) as average_price FROM products;

SELECT category, AVG(price) as average_price 
FROM products 
GROUP BY category;
```

### Get Most Expensive Products
```sql
SELECT * FROM products ORDER BY price DESC LIMIT 5;
```

### Get Cheapest Products
```sql
SELECT * FROM products ORDER BY price ASC LIMIT 5;
```

### Get Total Products Count
```sql
SELECT COUNT(*) as total_products FROM products;
```

### Get Products with Stock Value
```sql
SELECT 
    id,
    name,
    price,
    stock,
    (price * stock) as stock_value
FROM products
ORDER BY stock_value DESC;
```

---

## Combined Queries

### Products with Category Statistics
```sql
SELECT 
    category,
    COUNT(*) as total_products,
    SUM(stock) as total_stock,
    AVG(price) as average_price,
    MIN(price) as min_price,
    MAX(price) as max_price
FROM products
GROUP BY category;
```

### Search and Filter Combined
```sql
SELECT * 
FROM products 
WHERE category = 'Chocolate' 
  AND price < 20.00 
  AND stock > 0
ORDER BY price ASC;
```

### Multiple Condition Search
```sql
SELECT * 
FROM products 
WHERE (category = 'Chocolate' OR category = 'Candy')
  AND stock > 50
  AND price BETWEEN 5.00 AND 15.00;
```

---

## Data Management Queries

### Update Stock After Sale
```sql
-- Decrease stock by 1 when product is sold
UPDATE products 
SET stock = stock - 1 
WHERE id = 1;

-- Decrease stock by specific quantity
UPDATE products 
SET stock = stock - 5 
WHERE id = 1;
```

### Restock Products
```sql
-- Add to existing stock
UPDATE products 
SET stock = stock + 100 
WHERE id = 1;
```

### Mark Product as Out of Stock
```sql
UPDATE products 
SET stock = 0 
WHERE id = 1;
```

### Delete Out of Stock Products
```sql
DELETE FROM products WHERE stock = 0;
```

### Delete Products Below Minimum Price
```sql
DELETE FROM products WHERE price < 2.00;
```

---

## Reporting Queries

### Daily Product Summary
```sql
SELECT 
    DATE(created_at) as date,
    COUNT(*) as products_added,
    SUM(stock) as total_stock_added
FROM products
GROUP BY DATE(created_at)
ORDER BY date DESC;
```

### Category Wise Inventory Report
```sql
SELECT 
    category,
    COUNT(*) as total_products,
    SUM(stock) as total_items,
    ROUND(SUM(price * stock), 2) as total_value
FROM products
GROUP BY category
ORDER BY total_value DESC;
```

### Low Stock Alert
```sql
SELECT 
    id,
    name,
    category,
    stock,
    price
FROM products
WHERE stock < 20
ORDER BY stock ASC;
```

---

## Table Maintenance

### Add Indexes for Performance
```sql
CREATE INDEX idx_category ON products(category);
CREATE INDEX idx_price ON products(price);
CREATE INDEX idx_stock ON products(stock);
CREATE INDEX idx_created_at ON products(created_at);
```

### View Table Structure
```sql
DESCRIBE products;
DESCRIBE users;
```

### View All Tables
```sql
SHOW TABLES;
```

### Truncate Table (Delete All Data)
```sql
TRUNCATE TABLE products;
```

### Drop Table
```sql
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sessions;
```

### Drop Database
```sql
DROP DATABASE IF EXISTS candy_shop_db;
```

### 3. `orders` Table
Stores completed customer transactions.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| user_id | BIGINT | Foreign key to users table |
| total_amount | DECIMAL(10,2) | Total order cost |
| status | VARCHAR(255) | Order status (e.g., 'completed') |
| customer_name | VARCHAR(255) | Name for delivery |
| customer_email | VARCHAR(255) | Contact email |
| shipping_address | TEXT | Delivery address |
| created_at | TIMESTAMP | Order date |

### 4. `order_items` Table
Stores individual products within an order.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| order_id | BIGINT | Foreign key to orders table |
| product_id | BIGINT | Foreign key to products table |
| quantity | INT | Quantity purchased |
| price | DECIMAL(10,2) | Price at time of purchase |

---

## 🛍️ Data Manipulation (CRUD) - Orders

### INSERT - Create New Order
```sql
-- Step 1: Create the main order record
INSERT INTO orders (user_id, total_amount, status, customer_name, customer_email, shipping_address, created_at, updated_at)
VALUES (2, 21.98, 'completed', 'John Doe', 'john@example.com', '123 Sweet Street, Candy City', NOW(), NOW());

-- Step 2: Add items to the order (e.g., assuming order_id = 1)
INSERT INTO order_items (order_id, product_id, quantity, price, created_at, updated_at)
VALUES (1, 1, 1, 15.99, NOW(), NOW()), (1, 2, 1, 5.99, NOW(), NOW());

-- Step 3: Update product stock after purchase
UPDATE products SET stock = stock - 1 WHERE id = 1;
UPDATE products SET stock = stock - 1 WHERE id = 2;
```

### SELECT - View User Order History
```sql
SELECT orders.id, orders.total_amount, orders.status, orders.created_at,
       COUNT(order_items.id) as total_items
FROM orders
LEFT JOIN order_items ON orders.id = order_items.id
WHERE orders.user_id = 2
GROUP BY orders.id
ORDER BY orders.created_at DESC;
```

### SELECT - View Order Details (Detailed Recap)
```sql
SELECT orders.id as order_number, products.name as product_name, order_items.quantity, order_items.price as purchase_price
FROM orders
JOIN order_items ON orders.id = order_items.order_id
JOIN products ON order_items.product_id = products.id
WHERE orders.id = 1;
```

---

## 📊 Reporting Queries

### Total Sales Report
```sql
SELECT SUM(total_amount) as total_revenue, COUNT(id) as total_orders
FROM orders
WHERE status = 'completed';
```

### Best Selling Products
```sql
SELECT products.name, SUM(order_items.quantity) as total_sold
FROM order_items
JOIN products ON order_items.product_id = products.id
GROUP BY products.id
ORDER BY total_sold DESC
LIMIT 5;
```

---

## Sample Data Insertion

```sql
-- Insert multiple products at once
INSERT INTO products (name, description, price, stock, category, image) VALUES
('Dark Chocolate Truffles', 'Premium handcrafted dark chocolate', 15.99, 100, 'Chocolate', NULL),
('Gummy Bears', 'Colorful fruity gummy bears', 5.99, 200, 'Gummy', NULL),
('Lollipops', 'Rainbow swirl lollipops', 2.99, 150, 'Candy', NULL),
('Milk Chocolate Bar', 'Creamy milk chocolate', 8.99, 120, 'Chocolate', NULL),
('Strawberry Toffee', 'Sweet strawberry flavored toffee', 6.99, 80, 'Toffee', NULL),
('Sour Gummy Worms', 'Tangy sour gummy worms', 4.99, 180, 'Gummy', NULL),
('Caramel Candies', 'Soft caramel candies', 7.49, 90, 'Candy', NULL),
('White Chocolate', 'Smooth white chocolate bar', 9.99, 110, 'Chocolate', NULL),
('Mint Toffee', 'Refreshing mint toffee', 6.49, 70, 'Toffee', NULL),
('Jelly Beans', 'Assorted jelly beans', 3.99, 220, 'Candy', NULL);
```

---

**Database:** candy_shop_db  
**Total Tables:** 5 (users, products, sessions, orders, order_items)  
**Main Entity:** Products  
**Operations:** CREATE, READ, UPDATE, DELETE

---

## 🔧 Complete Table Creation Scripts with Constraints

### 1. Users Table (with Constraints)
```sql
-- Drop table if exists (for fresh creation)
DROP TABLE IF EXISTS users;

-- Create Users Table with All Constraints
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- PRIMARY KEY Constraint
    CONSTRAINT pk_users PRIMARY KEY (id),
    
    -- UNIQUE Constraint
    CONSTRAINT uk_users_email UNIQUE (email),
    
    -- CHECK Constraints
    CONSTRAINT chk_users_name CHECK (LENGTH(name) >= 2),
    CONSTRAINT chk_users_email CHECK (email LIKE '%@%.%')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Index for Performance
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_users_created_at ON users(created_at);
```

### 2. Products Table (with Constraints)
```sql
-- Drop table if exists
DROP TABLE IF EXISTS products;

-- Create Products Table with All Constraints
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category VARCHAR(255) NOT NULL DEFAULT 'Candy',
    image VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- PRIMARY KEY Constraint
    CONSTRAINT pk_products PRIMARY KEY (id),
    
    -- CHECK Constraints
    CONSTRAINT chk_products_price CHECK (price >= 0),
    CONSTRAINT chk_products_stock CHECK (stock >= 0),
    CONSTRAINT chk_products_name CHECK (LENGTH(name) >= 2),
    CONSTRAINT chk_products_category CHECK (category IN ('Candy', 'Chocolate', 'Gummy', 'Toffee', 'Lollipop', 'Other'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Indexes for Performance
CREATE INDEX idx_products_category ON products(category);
CREATE INDEX idx_products_price ON products(price);
CREATE INDEX idx_products_stock ON products(stock);
CREATE INDEX idx_products_created_at ON products(created_at);
```

### 3. Orders Table (with Constraints)
```sql
-- Drop table if exists
DROP TABLE IF EXISTS orders;

-- Create Orders Table with All Constraints
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    shipping_address TEXT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- PRIMARY KEY Constraint
    CONSTRAINT pk_orders PRIMARY KEY (id),
    
    -- FOREIGN KEY Constraint
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    
    -- CHECK Constraints
    CONSTRAINT chk_orders_total CHECK (total_amount >= 0),
    CONSTRAINT chk_orders_status CHECK (status IN ('pending', 'processing', 'completed', 'cancelled')),
    CONSTRAINT chk_orders_customer_name CHECK (LENGTH(customer_name) >= 2),
    CONSTRAINT chk_orders_customer_email CHECK (customer_email LIKE '%@%.%')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Indexes for Performance
CREATE INDEX idx_orders_user_id ON orders(user_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_created_at ON orders(created_at);
```

### 4. Order Items Table (with Constraints)
```sql
-- Drop table if exists
DROP TABLE IF EXISTS order_items;

-- Create Order Items Table with All Constraints
CREATE TABLE order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    order_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- PRIMARY KEY Constraint
    CONSTRAINT pk_order_items PRIMARY KEY (id),
    
    -- FOREIGN KEY Constraints
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) 
        REFERENCES orders(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    
    CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) 
        REFERENCES products(id) 
        ON DELETE RESTRICT 
        ON UPDATE CASCADE,
    
    -- CHECK Constraints
    CONSTRAINT chk_order_items_quantity CHECK (quantity > 0),
    CONSTRAINT chk_order_items_price CHECK (price >= 0),
    
    -- UNIQUE Constraint (prevent duplicate products in same order)
    CONSTRAINT uk_order_items_order_product UNIQUE (order_id, product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Indexes for Performance
CREATE INDEX idx_order_items_order_id ON order_items(order_id);
CREATE INDEX idx_order_items_product_id ON order_items(product_id);
```

### 5. Sessions Table (with Constraints)
```sql
-- Drop table if exists
DROP TABLE IF EXISTS sessions;

-- Create Sessions Table
CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    
    -- PRIMARY KEY Constraint
    CONSTRAINT pk_sessions PRIMARY KEY (id),
    
    -- FOREIGN KEY Constraint (optional - allows NULL for guest sessions)
    CONSTRAINT fk_sessions_user FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Indexes for Performance
CREATE INDEX idx_sessions_user_id ON sessions(user_id);
CREATE INDEX idx_sessions_last_activity ON sessions(last_activity);
```

---

## 📐 Relational Algebra Queries

### Query A: List all products in a department (category)

#### Relational Algebra Expression:
```
σ(category = 'Chocolate')(Products)
```

**Explanation:**
- σ (sigma) = Selection operator
- We select all tuples from Products where category = 'Chocolate'

#### SQL Implementation:
```sql
-- List all products in 'Chocolate' category
SELECT * 
FROM products 
WHERE category = 'Chocolate';

-- List all products in 'Candy' category
SELECT * 
FROM products 
WHERE category = 'Candy';

-- List all products in 'Gummy' category
SELECT * 
FROM products 
WHERE category = 'Gummy';

-- More detailed query with specific columns
SELECT 
    id,
    name,
    description,
    price,
    stock,
    category
FROM products 
WHERE category = 'Chocolate'
ORDER BY name ASC;
```

#### Extended Relational Algebra (with Projection):
```
π(id, name, price, stock)(σ(category = 'Chocolate')(Products))
```

**Explanation:**
- π (pi) = Projection operator
- σ (sigma) = Selection operator
- First, select products where category = 'Chocolate'
- Then, project only specific columns (id, name, price, stock)

#### SQL Implementation:
```sql
SELECT 
    id,
    name,
    price,
    stock
FROM products 
WHERE category = 'Chocolate';
```

---

### Query B: Find customers who ordered a specific product

#### Relational Algebra Expression:
```
π(customer_name, customer_email)(
    σ(product_id = 1)(
        Orders ⋈ OrderItems
    )
)
```

**Explanation:**
- ⋈ (bowtie) = Natural Join operator
- σ (sigma) = Selection operator
- π (pi) = Projection operator
- Join Orders and OrderItems tables
- Select rows where product_id = 1
- Project customer_name and customer_email

#### SQL Implementation:
```sql
-- Find customers who ordered product with ID = 1
SELECT DISTINCT
    o.customer_name,
    o.customer_email,
    o.id AS order_id,
    o.created_at AS order_date
FROM orders o
INNER JOIN order_items oi ON o.id = oi.order_id
WHERE oi.product_id = 1
ORDER BY o.created_at DESC;

-- Find customers who ordered 'Dark Chocolate Truffles'
SELECT DISTINCT
    o.customer_name,
    o.customer_email,
    p.name AS product_name,
    o.id AS order_id,
    oi.quantity,
    o.created_at AS order_date
FROM orders o
INNER JOIN order_items oi ON o.id = oi.order_id
INNER JOIN products p ON oi.product_id = p.id
WHERE p.name = 'Dark Chocolate Truffles'
ORDER BY o.created_at DESC;
```

#### Extended Relational Algebra (with Product Details):
```
π(customer_name, customer_email, product_name, quantity)(
    σ(product_name = 'Dark Chocolate Truffles')(
        Orders ⋈ OrderItems ⋈ Products
    )
)
```

**Explanation:**
- Join three tables: Orders, OrderItems, and Products
- Select rows where product_name = 'Dark Chocolate Truffles'
- Project customer and product details

#### SQL Implementation:
```sql
SELECT 
    o.customer_name,
    o.customer_email,
    p.name AS product_name,
    oi.quantity,
    oi.price AS unit_price,
    (oi.quantity * oi.price) AS total_price,
    o.created_at AS order_date
FROM orders o
INNER JOIN order_items oi ON o.id = oi.order_id
INNER JOIN products p ON oi.product_id = p.id
WHERE p.name = 'Dark Chocolate Truffles'
ORDER BY o.created_at DESC;
```

---

## 🔍 Additional Relational Algebra Queries

### Query C: Find all orders with their total items count

#### Relational Algebra Expression:
```
γ(order_id; COUNT(*) AS item_count)(OrderItems) ⋈ Orders
```

**Explanation:**
- γ (gamma) = Grouping/Aggregation operator
- Group OrderItems by order_id and count items
- Join result with Orders table

#### SQL Implementation:
```sql
SELECT 
    o.id AS order_id,
    o.customer_name,
    o.total_amount,
    COUNT(oi.id) AS total_items,
    o.created_at
FROM orders o
LEFT JOIN order_items oi ON o.id = oi.order_id
GROUP BY o.id, o.customer_name, o.total_amount, o.created_at
ORDER BY o.created_at DESC;
```

---

### Query D: Find products never ordered

#### Relational Algebra Expression:
```
Products - π(product_id)(OrderItems)
```

**Explanation:**
- - (minus) = Set Difference operator
- Get all products
- Subtract products that appear in OrderItems
- Result: products never ordered

#### SQL Implementation:
```sql
SELECT 
    p.id,
    p.name,
    p.category,
    p.price,
    p.stock
FROM products p
LEFT JOIN order_items oi ON p.id = oi.product_id
WHERE oi.product_id IS NULL
ORDER BY p.name;

-- Alternative using NOT IN
SELECT 
    id,
    name,
    category,
    price,
    stock
FROM products
WHERE id NOT IN (
    SELECT DISTINCT product_id 
    FROM order_items
)
ORDER BY name;
```

---

### Query E: Find customers who ordered from multiple categories

#### Relational Algebra Expression:
```
π(customer_email)(
    σ(category_count > 1)(
        γ(customer_email; COUNT(DISTINCT category) AS category_count)(
            Orders ⋈ OrderItems ⋈ Products
        )
    )
)
```

**Explanation:**
- Join Orders, OrderItems, and Products
- Group by customer_email and count distinct categories
- Select customers with more than 1 category
- Project customer_email

#### SQL Implementation:
```sql
SELECT 
    o.customer_name,
    o.customer_email,
    COUNT(DISTINCT p.category) AS categories_ordered,
    GROUP_CONCAT(DISTINCT p.category ORDER BY p.category) AS category_list
FROM orders o
INNER JOIN order_items oi ON o.id = oi.order_id
INNER JOIN products p ON oi.product_id = p.id
GROUP BY o.customer_email, o.customer_name
HAVING COUNT(DISTINCT p.category) > 1
ORDER BY categories_ordered DESC;
```

---

## 📊 Summary of Constraints Used

### 1. **PRIMARY KEY Constraints**
- Ensures unique identification of each record
- Automatically creates an index
- Cannot be NULL

### 2. **FOREIGN KEY Constraints**
- Maintains referential integrity between tables
- `ON DELETE CASCADE`: Deletes child records when parent is deleted
- `ON DELETE RESTRICT`: Prevents deletion if child records exist
- `ON UPDATE CASCADE`: Updates child records when parent key changes

### 3. **UNIQUE Constraints**
- Ensures column values are unique across all records
- Example: `email` in users table

### 4. **CHECK Constraints**
- Validates data before insertion/update
- Examples:
  - `price >= 0` (no negative prices)
  - `stock >= 0` (no negative stock)
  - `email LIKE '%@%.%'` (valid email format)
  - `status IN ('pending', 'completed', ...)` (valid status values)

### 5. **NOT NULL Constraints**
- Ensures column cannot contain NULL values
- Example: `name`, `email`, `price` fields

### 6. **DEFAULT Constraints**
- Provides default values when not specified
- Examples:
  - `role DEFAULT 'user'`
  - `stock DEFAULT 0`
  - `created_at DEFAULT CURRENT_TIMESTAMP`

---

## 🎯 Relational Algebra Operators Summary

| Operator | Symbol | Description | SQL Equivalent |
|----------|--------|-------------|----------------|
| Selection | σ (sigma) | Filters rows based on condition | WHERE clause |
| Projection | π (pi) | Selects specific columns | SELECT columns |
| Join | ⋈ (bowtie) | Combines tables based on common attribute | JOIN |
| Union | ∪ | Combines results from two queries | UNION |
| Intersection | ∩ | Common rows from two queries | INTERSECT |
| Difference | - | Rows in first but not in second | EXCEPT / NOT IN |
| Cartesian Product | × | All combinations of rows | CROSS JOIN |
| Grouping | γ (gamma) | Groups rows and applies aggregation | GROUP BY |
| Rename | ρ (rho) | Renames attributes/relations | AS alias |

---

**End of SQL Queries Documentation**
