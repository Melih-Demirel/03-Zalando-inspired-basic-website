CREATE TABLE IF NOT EXISTS User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    verification_token TEXT,
    verified BOOLEAN
);


CREATE TABLE IF NOT EXISTS UserRecovery (
    user_recovery_id INT AUTO_INCREMENT PRIMARY KEY,
    user INT NOT NULL,
    recovery_token TEXT NOT NULL,
    exp_date DATETIME NOT NULL,
    FOREIGN KEY (user) REFERENCES User(user_id) ON DELETE CASCADE
);


CREATE TABLE Role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE UserRole (
    user_role_id INT AUTO_INCREMENT PRIMARY KEY,
    user INT NOT NULL,
    role INT NOT NULL,
    FOREIGN KEY (user) REFERENCES User(user_id) ON DELETE CASCADE,
    FOREIGN KEY (role) REFERENCES Role(role_id) ON DELETE CASCADE
);


CREATE TABLE Seller (
    seller_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    bg_color VARCHAR(255) DEFAULT '#FFFFFF',
    text_color VARCHAR(255) DEFAULT '#000000',
    description TEXT NOT NULL,
    user INT NOT NULL,
    FOREIGN KEY (user) REFERENCES User(user_id) ON DELETE CASCADE
);


CREATE TABLE Customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    user INT NOT NULL,
    FOREIGN KEY (user) REFERENCES User(user_id) ON DELETE CASCADE
);


CREATE TABLE SellerImages (
    img_id INT AUTO_INCREMENT PRIMARY KEY,
    seller INT NOT NULL,
    img LONGBLOB NOT NULL,
    FOREIGN KEY (seller) REFERENCES Seller(seller_id) ON DELETE CASCADE
);


CREATE TABLE Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE Product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(5,2) NOT NULL,
    seller INT NOT NULL,
    category INT,
    FOREIGN KEY (seller) REFERENCES Seller(seller_id) ON DELETE CASCADE,
    FOREIGN KEY (category) REFERENCES Category(category_id) ON DELETE SET NULL
);


CREATE TABLE ProductImage(
    img_id INT AUTO_INCREMENT PRIMARY KEY,
    img LONGBLOB NOT NULL,
    product INT NOT NULL,
    FOREIGN KEY (product) REFERENCES Product(product_id) ON DELETE CASCADE
);

CREATE TABLE ProductVideo(
    video_id INT AUTO_INCREMENT PRIMARY KEY,
    video_url TEXT NOT NULL,
    product INT NOT NULL,
    FOREIGN KEY (product) REFERENCES Product(product_id) ON DELETE CASCADE
);


CREATE TABLE ProductInventory (
    product_inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    size VARCHAR(45) NOT NULL,
    stock int NOT NULL,
    product INT NOT NULL,
    FOREIGN KEY (product) REFERENCES Product (product_id) ON DELETE CASCADE
);

CREATE TABLE ProductReview(
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    rating int NOT NULL CHECK (rating >= 0 AND rating <= 5),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    comment TEXT NOT NULL,
    product INT NOT NULL,
    customer INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product) REFERENCES Product (product_id) ON DELETE CASCADE
);

CREATE TABLE `Order`(
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date TIMESTAMP NOT NULL,
    order_type ENUM('Delivery', 'Pick Up') NOT NULL,
    street VARCHAR(255),
    zipcode INT,
    town VARCHAR(255),
    customer INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE
);


CREATE TABLE OrderItem(
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    delivery_date TIMESTAMP NOT NULL,
    order_status ENUM('Ordered','Completed', 'Cancelled') DEFAULT ('Ordered') NOT NULL,
    amount int NOT NULL,
    `order` INT,
    product INT NOT NULL,
    FOREIGN KEY (`order`) REFERENCES `Order`(order_id) ON DELETE SET NULL,
    FOREIGN KEY (product) REFERENCES ProductInventory(product_inventory_id) ON DELETE CASCADE
);

CREATE TABLE Chat(
    chat_id INT AUTO_INCREMENT PRIMARY KEY,
    seller INT NOT NULL,
    customer INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (seller) REFERENCES Seller(seller_id) ON DELETE CASCADE
);

CREATE TABLE ChatMSG(
    msg_id INT AUTO_INCREMENT PRIMARY KEY,
    msg TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    userMSG BOOLEAN NOT NULL,
    chat INT NOT NULL,
    FOREIGN KEY (chat) REFERENCES Chat(chat_id) ON DELETE CASCADE
);


CREATE TABLE NotifyProduct(
    notify_id INT AUTO_INCREMENT PRIMARY KEY,
    product INT NOT NULL,
    customer INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product) REFERENCES ProductInventory(product_inventory_id) ON DELETE CASCADE
);

CREATE TABLE Notifications(
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    viewed BOOLEAN NOT NULL DEFAULT false,
    product INT NOT NULL,
    customer INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product) REFERENCES ProductInventory(product_inventory_id) ON DELETE CASCADE
);


CREATE TABLE ShoppingCart(
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    amount int NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    customer INT NOT NULL,
    product INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product) REFERENCES ProductInventory(product_inventory_id) ON DELETE CASCADE
);

CREATE TABLE Wishlist(
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    customer INT NOT NULL,    
    product INT NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product) REFERENCES Product(product_id) ON DELETE CASCADE
);

INSERT INTO Role (name) VALUES
("Seller"),
("Customer");

INSERT INTO Category (name) VALUES
("T-Shirts & Vests"),
("Shirts"),
("Shorts"),
("Swimwear"),
("Co-ords"),
("Designer"),
("Hoodies & Sweatshirts"),
("Jackets & Coats"),
("Jeans"),
("Joggers"),
("Sportswear"),
("Shoes"),
("Underwear");

CREATE VIEW ProductItem AS
SELECT Product.product_id, Product.name, Seller.name as seller, Seller.seller_id, price, Product.description, Category.name as category, Product.category as category_id
FROM Product, Seller, Category
WHERE  Seller.seller_id = Product.seller AND Product.category = Category.category_id;

CREATE VIEW NotificationView AS 
SELECT Notifications.notification_id, Notifications.customer, Notifications.text, Notifications.added_at, Notifications.viewed, Seller.name as seller, Seller.seller_id, Product.product_id, Product.name as product
FROM Notifications, ProductInventory, Product, Seller
WHERE Notifications.product = ProductInventory.product_inventory_id AND 
    Product.product_id = ProductInventory.product AND
    Seller.seller_id = Product.seller;

CREATE VIEW ShoppingCartView AS
SELECT P.product_id, P.name, P.seller, P.seller_id, P.price, P.description, PInv.size, S.customer, S.amount, S.cart_item_id
FROM ShoppingCart S, ProductInventory PInv,ProductItem P
WHERE S.product = PInv.product_inventory_id AND PInv.product = P.product_id;

CREATE VIEW WishlistView AS
SELECT P.product_id, P.name, P.seller, P.seller_id, P.price, P.description, Wishlist.customer
FROM ProductItem P, Wishlist
WHERE P.product_id = Wishlist.product;

CREATE VIEW ReviewItem AS
SELECT review_id, rating, comment, created_at, Customer.surname, Customer.name, product
FROM ProductReview, Customer
WHERE ProductReview.customer = Customer.customer_id;

CREATE VIEW OrderView AS
SELECT OrderItem.order_item_id, OrderItem.Order, OrderItem.product as product_item_inventory, OrderItem.delivery_date, OrderItem.order_status, OrderItem.amount,
ProductInventory.size, productitem.seller, productitem.seller_id, productitem.price, productitem.description, productitem.product_id as product
FROM OrderItem, ProductInventory, ProductItem
WHERE OrderItem.product = ProductInventory.product_inventory_id AND productitem.product_id = ProductInventory.product;
 
CREATE VIEW sellerorderview AS
SELECT OrderItem.order_item_id, OrderItem.Order, productitem.seller_id, Customer.customer_id, Customer.surname, Customer.name, ProductItem.name as product, ProductItem.product_id, ProductInventory.product_inventory_id,  OrderItem.delivery_date, O.order_date, OrderItem.order_status
FROM OrderItem, `Order` O, Customer, ProductInventory, ProductItem
WHERE OrderItem.Order = O.order_id AND OrderItem.product = ProductInventory.product_inventory_id AND ProductInventory.product = ProductItem.product_id
AND Customer.customer_id = O.customer;

CREATE VIEW ChatView AS
SELECT Chat.chat_id, Seller.seller_id, Customer.customer_id, Seller.name as seller, Customer.surname as customerSurname, Customer.name as customerName
FROM Chat, Seller, Customer
WHERE Chat.seller = Seller.seller_id AND Chat.customer = Customer.customer_id;

CREATE VIEW ChatMSGView AS
SELECT *
FROM ChatView, ChatMSG
WHERE ChatView.chat_id = ChatMSG.chat;