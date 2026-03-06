# 🗄️ Complete Entity Relationship Diagram (ERD)
# Candy Shop Database - Admin & Customer Functionalities

## Database: `candy_shop_db`

---

## 📊 COMPLETE VISUAL ERD WITH ALL FUNCTIONALITIES

```
┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
│                           CANDY SHOP - COMPLETE DATABASE ERD WITH ROLE FUNCTIONALITIES                          │
│                                    (Admin CRUD + Customer Shopping Operations)                                   │
└─────────────────────────────────────────────────────────────────────────────────────────────────────────────────┘


                                    ┌──────────────────────────────────────────┐
                                    │          USERS TABLE                     │
                                    ├──────────────────────────────────────────┤
                                    │ PK  id (BIGINT UNSIGNED)                 │
                                    │     name (VARCHAR 255) NOT NULL          │
                                    │ UK  email (VARCHAR 255) UNIQUE           │
                                    │     role (ENUM: 'admin', 'user')         │
                                    │     password (VARCHAR 255) HASHED        │
                                    │     created_at, updated_at (TIMESTAMP)   │
                                    └──────────────────────────────────────────┘
                                                    │
                                                    │
                        ┌───────────────────────────┴────────────────────────────┐
                        │                                                        │
                        │                                                        │
            ┌───────────▼──────────┐                              ┌─────────────▼────────────┐
            │   ADMIN ROLE         │                              │   CUSTOMER ROLE          │
            │   (role = 'admin')   │                              │   (role = 'user')        │
            └───────────┬──────────┘                              └─────────────┬────────────┘
                        │                                                        │
                        │                                                        │
                        │ ADMIN OPERATIONS:                                      │ CUSTOMER OPERATIONS:
                        │ ✅ CREATE Products                                     │ ✅ BROWSE Products
                        │ ✅ UPDATE Products                                     │ ✅ VIEW Product Details
                        │ ✅ DELETE Products                                     │ ✅ ADD to Cart (Session)
                        │ ✅ VIEW All Orders                                     │ ✅ UPDATE Cart Quantities
                        │ ✅ VIEW Sales Reports                                  │ ✅ REMOVE from Cart
                        │ ✅ MONITOR Stock Levels                                │ ✅ PLACE Orders
                        │ ✅ MANAGE Inventory                                    │ ✅ VIEW Own Orders
                        │                                                        │ ✅ TRACK Order Status
                        │                                                        │
                        ▼                                                        ▼
        ┌───────────────────────────────────┐                    ┌──────────────────────────────────┐
        │     PRODUCTS TABLE                │                    │     SESSIONS TABLE               │
        ├───────────────────────────────────┤                    ├──────────────────────────────────┤
        │ PK  id (BIGINT UNSIGNED)          │                    │ PK  id (VARCHAR 255)             │
        │     name (VARCHAR 255)            │                    │ FK  user_id (BIGINT) NULL        │
        │     description (TEXT)            │                    │     ip_address (VARCHAR 45)      │
        │     price (DECIMAL 10,2)          │                    │     payload (LONGTEXT)           │
        │     stock (INT) CHECK >= 0        │                    │     last_activity (INT)          │
        │     category (VARCHAR 255)        │                    │                                  │
        │     image (VARCHAR 255)           │                    │ STORES:                          │
        │     created_at, updated_at        │                    │ • Shopping Cart Data             │
        │                                   │                    │ • Cart Items & Quantities        │
        │ ADMIN FUNCTIONS:                  │                    │ • Session State                  │
        │ ✅ INSERT (Create Product)        │                    │                                  │
        │ ✅ UPDATE (Edit Product)          │                    │ CUSTOMER FUNCTIONS:              │
        │ ✅ DELETE (Remove Product)        │                    │ ✅ ADD Item to Cart              │
        │ ✅ SELECT (View All)              │                    │ ✅ UPDATE Cart Quantity          │
        │ ✅ UPDATE Stock Manually          │                    │ ✅ REMOVE Item from Cart         │
        │ ✅ Upload/Change Image            │                    │ ✅ VIEW Cart Contents            │
        │                                   │                    │ ✅ CLEAR Cart on Checkout        │
        │ CUSTOMER FUNCTIONS:               │                    └──────────────────────────────────┘
        │ ✅ SELECT (Browse/View)           │                                    │
        │ ✅ SELECT WHERE stock > 0         │                                    │
        │ ❌ Cannot INSERT                  │                                    │
        │ ❌ Cannot UPDATE                  │                                    │
        │ ❌ Cannot DELETE                  │                                    │
        └───────────────┬───────────────────┘                                    │
                        │                                                        │
                        │                                                        │
                        │                                      ┌─────────────────▼─────────────────┐
                        │                                      │ CHECKOUT PROCESS                  │
                        │                                      │ (Customer Action)                 │
                        │                                      │                                   │
                        │                                      │ 1. Get Cart from Session          │
                        │                                      │ 2. Fill Shipping Info             │
                        │                                      │ 3. Confirm Order                  │
                        │                                      │ 4. CREATE Order Record            │
                        │                                      │ 5. CREATE Order Items             │
                        │                                      │ 6. REDUCE Product Stock           │
                        │                                      │ 7. CLEAR Cart Session             │
                        │                                      └───────────────┬───────────────────┘
                        │                                                      │
                        │                                                      │
                        │                                      ┌───────────────▼───────────────────┐
                        │                                      │     ORDERS TABLE                  │
                        │                                      ├───────────────────────────────────┤
                        │                                      │ PK  id (BIGINT UNSIGNED)          │
                        │                                      │ FK  user_id (BIGINT)              │
                        │                                      │     total_amount (DECIMAL 10,2)   │
                        │                                      │     status (VARCHAR 50)           │
                        │                                      │     customer_name (VARCHAR 255)   │
                        │                                      │     customer_email (VARCHAR 255)  │
                        │                                      │     shipping_address (TEXT)       │
                        │                                      │     created_at, updated_at        │
                        │                                      │                                   │
                        │                                      │ ADMIN FUNCTIONS:                  │
                        │                                      │ ✅ SELECT (View All Orders)       │
                        │                                      │ ✅ SELECT (Filter by Status)      │
                        │                                      │ ✅ SELECT (Filter by Date)        │
                        │                                      │ ✅ UPDATE (Change Status)         │
                        │                                      │ ✅ DELETE (Remove Order)          │
                        │                                      │ ✅ Calculate Total Revenue        │
                        │                                      │ ✅ View Recent Sales (Last 5)     │
                        │                                      │                                   │
                        │                                      │ CUSTOMER FUNCTIONS:               │
                        │                                      │ ✅ INSERT (Place New Order)       │
                        │                                      │ ✅ SELECT (View Own Orders)       │
                        │                                      │ ✅ SELECT (View Order Details)    │
                        │                                      │ ❌ Cannot UPDATE Orders           │
                        │                                      │ ❌ Cannot DELETE Orders           │
                        │                                      │ ❌ Cannot View Others' Orders     │
                        │                                      └───────────────┬───────────────────┘
                        │                                                      │
                        │                                                      │ 1:N
                        │                                                      │ (One Order → Many Items)
                        │                                                      │
                        │                                      ┌───────────────▼───────────────────┐
                        │                                      │   ORDER_ITEMS TABLE               │
                        │                                      ├───────────────────────────────────┤
                        │                                      │ PK  id (BIGINT UNSIGNED)          │
                        │                                      │ FK  order_id (BIGINT)             │
                        │                                      │ FK  product_id (BIGINT)           │
                        │                                      │     quantity (INT) CHECK > 0      │
                        │                                      │     price (DECIMAL 10,2)          │
                        │                                      │     created_at, updated_at        │
                        │                                      │ UK  (order_id, product_id)        │
                        │                                      │                                   │
                        │                                      │ ADMIN FUNCTIONS:                  │
                        │                                      │ ✅ SELECT (View All Items)        │
                        │                                      │ ✅ SELECT (Sales Analysis)        │
                        │                                      │ ✅ SELECT (Revenue by Product)    │
                        │                                      │ ✅ DELETE (Remove Item)           │
                        │                                      │                                   │
                        │                                      │ CUSTOMER FUNCTIONS:               │
                        │                                      │ ✅ INSERT (Auto on Checkout)      │
                        │                                      │ ✅ SELECT (View Own Items)        │
                        │                                      │ ❌ Cannot UPDATE Items            │
                        │                                      │ ❌ Cannot DELETE Items            │
                        └──────────────────────────────────────┴───────────────────────────────────┘
                                                               │
                                                               │ N:1
                                                               │ (Many Items → One Product)
                                                               │
                                                               │ AUTOMATIC STOCK REDUCTION:
                                                               │ When Order is Placed:
                                                               │ UPDATE products
                                                               │ SET stock = stock - quantity
                                                               │ WHERE id = product_id
                                                               │
                                                               └─────────────────────────────────────┘


┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
│                                         RELATIONSHIP SUMMARY                                                     │
├─────────────────────────────────────────────────────────────────────────────────────────────────────────────────┤
│                                                                                                                  │
│  USERS (1) ──────────────────────── (N) ORDERS        │  One User → Many Orders                                │
│  USERS (1) ──────────────────────── (N) SESSIONS      │  One User → Many Sessions                              │
│  ORDERS (1) ─────────────────────── (N) ORDER_ITEMS   │  One Order → Many Order Items                          │
│  PRODUCTS (1) ───────────────────── (N) ORDER_ITEMS   │  One Product → Many Order Items                        │
│  USERS (N) ──── ORDERS ──── ORDER_ITEMS ──── (M) PRODUCTS  │  Many-to-Many through Junction Table            │
│                                                                                                                  │
└─────────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 🔄 COMPLETE WORKFLOW DIAGRAMS

### 1️⃣ ADMIN WORKFLOW - Product Management

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                        ADMIN PRODUCT MANAGEMENT FLOW                         │
└─────────────────────────────────────────────────────────────────────────────┘

    ┌──────────────┐
    │ ADMIN LOGIN  │
    │ (role=admin) │
    └──────┬───────┘
           │
           ▼
    ┌──────────────────┐
    │ Access Dashboard │
    │   /products      │
    └──────┬───────────┘
           │
           ├─────────────────┬─────────────────┬─────────────────┐
           │                 │                 │                 │
           ▼                 ▼                 ▼                 ▼
    ┌────────────┐    ┌────────────┐   ┌────────────┐   ┌────────────┐
    │   CREATE   │    │   UPDATE   │   │   DELETE   │   │    VIEW    │
    │  PRODUCT   │    │  PRODUCT   │   │  PRODUCT   │   │   REPORTS  │
    └─────┬──────┘    └─────┬──────┘   └─────┬──────┘   └─────┬──────┘
          │                 │                 │                 │
          ▼                 ▼                 ▼                 ▼
    ┌──────────────────────────────────────────────────────────────┐
    │              INSERT INTO products                            │
    │              (name, price, stock,                            │
    │               category, image)                               │
    │              VALUES (?, ?, ?, ?, ?)                          │
    └──────────────────────────────────────────────────────────────┘
          │                 │                 │                 │
          ▼                 ▼                 ▼                 ▼
    ┌──────────────────────────────────────────────────────────────┐
    │              UPDATE products                                 │
    │              SET name=?, price=?,                            │
    │                  stock=?, category=?                         │
    │              WHERE id=?                                      │
    └──────────────────────────────────────────────────────────────┘
          │                 │                 │                 │
          ▼                 ▼                 ▼                 ▼
    ┌──────────────────────────────────────────────────────────────┐
    │              DELETE FROM products                            │
    │              WHERE id=?                                      │
    │              (RESTRICT if in orders)                         │
    └──────────────────────────────────────────────────────────────┘
          │                 │                 │                 │
          ▼                 ▼                 ▼                 ▼
    ┌──────────────────────────────────────────────────────────────┐
    │              SELECT * FROM orders                            │
    │              SELECT SUM(total_amount)                        │
    │              SELECT COUNT(*) FROM products                   │
    │              WHERE stock < 10                                │
    └──────────────────────────────────────────────────────────────┘
          │
          ▼
    ┌──────────────────┐
    │ View Updated     │
    │ Dashboard with   │
    │ • Stock Levels   │
    │ • Sales Report   │
    │ • Low Stock Alert│
    └──────────────────┘
```

---

### 2️⃣ CUSTOMER WORKFLOW - Shopping & Ordering

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                     CUSTOMER SHOPPING & ORDERING FLOW                        │
└─────────────────────────────────────────────────────────────────────────────┘

    ┌──────────────┐
    │CUSTOMER LOGIN│
    │ (role=user)  │
    └──────┬───────┘
           │
           ▼
    ┌──────────────────┐
    │ Browse Products  │
    │     /shop        │
    └──────┬───────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │ SELECT * FROM products               │
    │ WHERE stock > 0                      │
    │ ORDER BY created_at DESC             │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────┐
    │ View Product     │
    │ Details          │
    │  /shop/{id}      │
    └──────┬───────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │ SELECT * FROM products               │
    │ WHERE id = ? AND stock > 0           │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────┐
    │  ADD TO CART     │
    │ (Store in        │
    │  Session)        │
    └──────┬───────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │ INSERT/UPDATE Session                │
    │ payload = serialize([                │
    │   'cart' => [                        │
    │     product_id => [                  │
    │       'name' => ?,                   │
    │       'price' => ?,                  │
    │       'quantity' => ?,               │
    │       'image' => ?                   │
    │     ]                                │
    │   ]                                  │
    │ ])                                   │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────┐
    │  VIEW CART       │
    │   /cart          │
    └──────┬───────────┘
           │
           ├────────────┬────────────┐
           │            │            │
           ▼            ▼            ▼
    ┌──────────┐ ┌──────────┐ ┌──────────┐
    │ UPDATE   │ │ REMOVE   │ │CONTINUE  │
    │ QUANTITY │ │   ITEM   │ │SHOPPING  │
    └──────────┘ └──────────┘ └────┬─────┘
           │            │            │
           └────────────┴────────────┘
                       │
                       ▼
    ┌──────────────────────────────────────┐
    │     PROCEED TO CHECKOUT              │
    │        /checkout                     │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │ Fill Shipping Information:           │
    │ • Customer Name                      │
    │ • Customer Email                     │
    │ • Shipping Address                   │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │     CONFIRM ORDER                    │
    │  (Database Transaction)              │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │ START TRANSACTION;                   │
    │                                      │
    │ 1. INSERT INTO orders                │
    │    (user_id, total_amount,           │
    │     status, customer_name,           │
    │     customer_email,                  │
    │     shipping_address)                │
    │    VALUES (?, ?, 'completed',        │
    │            ?, ?, ?)                  │
    │                                      │
    │ 2. INSERT INTO order_items           │
    │    (order_id, product_id,            │
    │     quantity, price)                 │
    │    VALUES (?, ?, ?, ?)               │
    │    [For each cart item]              │
    │                                      │
    │ 3. UPDATE products                   │
    │    SET stock = stock - ?             │
    │    WHERE id = ?                      │
    │    [For each product]                │
    │                                      │
    │ 4. DELETE FROM sessions              │
    │    WHERE id = ?                      │
    │    [Clear cart]                      │
    │                                      │
    │ COMMIT;                              │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │   ORDER CONFIRMATION                 │
    │   /orders/{id}                       │
    │                                      │
    │ • Order Number                       │
    │ • Order Items                        │
    │ • Total Amount                       │
    │ • Shipping Details                   │
    └──────┬───────────────────────────────┘
           │
           ▼
    ┌──────────────────────────────────────┐
    │   VIEW ORDER HISTORY                 │
    │   /orders                            │
    │                                      │
    │ SELECT * FROM orders                 │
    │ WHERE user_id = ?                    │
    │ ORDER BY created_at DESC             │
    └──────────────────────────────────────┘
```

---

## 📋 COMPLETE CRUD OPERATIONS TABLE

### PRODUCTS Entity

| Role | Operation | SQL Query | Route | Access |
|------|-----------|-----------|-------|--------|
| **ADMIN** | **CREATE** | `INSERT INTO products (name, description, price, stock, category, image) VALUES (?, ?, ?, ?, ?, ?)` | `POST /products` | ✅ Full |
| **ADMIN** | **READ** | `SELECT * FROM products ORDER BY created_at DESC` | `GET /products` | ✅ Full |
| **ADMIN** | **UPDATE** | `UPDATE products SET name=?, price=?, stock=?, category=?, image=? WHERE id=?` | `PUT /products/{id}` | ✅ Full |
| **ADMIN** | **DELETE** | `DELETE FROM products WHERE id=?` | `DELETE /products/{id}` | ✅ Full |
| **ADMIN** | **Stock Adjust** | `UPDATE products SET stock=? WHERE id=?` | `PUT /products/{id}` | ✅ Full |
| **ADMIN** | **Low Stock** | `SELECT * FROM products WHERE stock < 10` | `GET /products?filter=low_stock` | ✅ Full |
| **CUSTOMER** | **READ** | `SELECT * FROM products WHERE stock > 0` | `GET /shop` | ✅ Read-Only |
| **CUSTOMER** | **CREATE** | N/A | N/A | ❌ Denied |
| **CUSTOMER** | **UPDATE** | N/A | N/A | ❌ Denied |
| **CUSTOMER** | **DELETE** | N/A | N/A | ❌ Denied |

---

### ORDERS Entity

| Role | Operation | SQL Query | Route | Access |
|------|-----------|-----------|-------|--------|
| **ADMIN** | **READ ALL** | `SELECT * FROM orders ORDER BY created_at DESC` | Dashboard | ✅ Full |
| **ADMIN** | **READ ONE** | `SELECT * FROM orders WHERE id=?` | `GET /orders/{id}` | ✅ Full |
| **ADMIN** | **UPDATE** | `UPDATE orders SET status=? WHERE id=?` | `PUT /orders/{id}` | ✅ Full |
| **ADMIN** | **DELETE** | `DELETE FROM orders WHERE id=?` | Admin Panel | ✅ Full |
| **ADMIN** | **Revenue** | `SELECT SUM(total_amount) FROM orders WHERE status='completed'` | Dashboard | ✅ Full |
| **CUSTOMER** | **CREATE** | `INSERT INTO orders (user_id, total_amount, status, customer_name, customer_email, shipping_address) VALUES (?, ?, ?, ?, ?, ?)` | `POST /checkout` | ✅ Create |
| **CUSTOMER** | **READ OWN** | `SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC` | `GET /orders` | ✅ Limited |
| **CUSTOMER** | **READ ALL** | N/A | N/A | ❌ Denied |
| **CUSTOMER** | **UPDATE** | N/A | N/A | ❌ Denied |
| **CUSTOMER** | **DELETE** | N/A | N/A | ❌ Denied |

---

### CART (SESSIONS) Operations

| Role | Operation | Description | Implementation | Access |
|------|-----------|-------------|----------------|--------|
| **CUSTOMER** | **ADD TO CART** | Add product to shopping cart | `Session::put('cart.'.$id, $product_data)` | ✅ Full |
| **CUSTOMER** | **UPDATE CART** | Change product quantity | `Session::put('cart.'.$id.'.quantity', $qty)` | ✅ Full |
| **CUSTOMER** | **REMOVE FROM CART** | Delete item from cart | `Session::forget('cart.'.$id)` | ✅ Full |
| **CUSTOMER** | **VIEW CART** | Display cart contents | `Session::get('cart', [])` | ✅ Full |
| **CUSTOMER** | **CLEAR CART** | Empty cart after checkout | `Session::forget('cart')` | ✅ Auto |
| **ADMIN** | **VIEW CARTS** | See all active carts | `SELECT * FROM sessions` | ✅ Full |

---

### ORDER_ITEMS Entity

| Role | Operation | SQL Query | Route | Access |
|------|-----------|-----------|-------|--------|
| **ADMIN** | **READ ALL** | `SELECT * FROM order_items` | Admin Panel | ✅ Full |
| **ADMIN** | **SALES ANALYSIS** | `SELECT product_id, SUM(quantity) as total_sold FROM order_items GROUP BY product_id` | Dashboard | ✅ Full |
| **ADMIN** | **DELETE** | `DELETE FROM order_items WHERE id=?` | Admin Panel | ✅ Full |
| **CUSTOMER** | **CREATE** | `INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)` | Auto on Checkout | ✅ Auto |
| **CUSTOMER** | **READ OWN** | `SELECT * FROM order_items WHERE order_id IN (SELECT id FROM orders WHERE user_id=?)` | `GET /orders/{id}` | ✅ Limited |
| **CUSTOMER** | **UPDATE** | N/A | N/A | ❌ Denied |
| **CUSTOMER** | **DELETE** | N/A | N/A | ❌ Denied |

---

## 🔐 FOREIGN KEY RELATIONSHIPS & CASCADE RULES

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                         FOREIGN KEY CONSTRAINTS                              │
└─────────────────────────────────────────────────────────────────────────────┘

1. ORDERS.user_id → USERS.id
   ON DELETE CASCADE    (Delete user → Delete all their orders)
   ON UPDATE CASCADE    (Update user ID → Update in orders)

2. ORDER_ITEMS.order_id → ORDERS.id
   ON DELETE CASCADE    (Delete order → Delete all order items)
   ON UPDATE CASCADE    (Update order ID → Update in order items)

3. ORDER_ITEMS.product_id → PRODUCTS.id
   ON DELETE RESTRICT   (Cannot delete product if in orders)
   ON UPDATE CASCADE    (Update product ID → Update in order items)

4. SESSIONS.user_id → USERS.id
   ON DELETE CASCADE    (Delete user → Delete all their sessions)
   ON UPDATE CASCADE    (Update user ID → Update in sessions)
```

---

## 🎯 KEY FEATURES SUMMARY

### ✅ ADMIN CAPABILITIES
1. **Product Management**
   - ✅ CREATE new products with images
   - ✅ UPDATE product details, prices, stock
   - ✅ DELETE products (if not in orders)
   - ✅ VIEW all products with stock levels
   - ✅ FILTER by category, low stock
   - ✅ UPLOAD/CHANGE product images

2. **Order Management**
   - ✅ VIEW all customer orders
   - ✅ FILTER orders by status, date
   - ✅ UPDATE order status
   - ✅ DELETE orders
   - ✅ VIEW customer shipping details

3. **Analytics & Reports**
   - ✅ Total revenue calculation
   - ✅ Total orders count
   - ✅ Recent sales (last 5 orders)
   - ✅ Low stock alerts (< 10 items)
   - ✅ Out of stock count
   - ✅ Best-selling products
   - ✅ Revenue by product

### ✅ CUSTOMER CAPABILITIES
1. **Product Browsing**
   - ✅ VIEW available products (stock > 0)
   - ✅ VIEW product details
   - ✅ FILTER by category
   - ✅ SEARCH products

2. **Shopping Cart**
   - ✅ ADD products to cart
   - ✅ UPDATE cart quantities
   - ✅ REMOVE items from cart
   - ✅ VIEW cart summary
   - ✅ Cart stored in session

3. **Order Placement**
   - ✅ CHECKOUT process
   - ✅ FILL shipping information
   - ✅ PLACE order (creates order + order items)
   - ✅ AUTOMATIC stock reduction
   - ✅ CLEAR cart after order

4. **Order Tracking**
   - ✅ VIEW own order history
   - ✅ VIEW order details
   - ✅ TRACK order status
   - ❌ Cannot view others' orders

---

**Database Version**: 1.0  
**DBMS**: MySQL 8.0+  
**Total Tables**: 5 (users, products, orders, order_items, sessions)  
**Total Relationships**: 4 Foreign Keys  
**Normalization**: 3NF (Third Normal Form)  

---

**END OF COMPLETE ERD DOCUMENTATION** 🎯
