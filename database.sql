CREATE TABLE category (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(25) NULL,
  PRIMARY KEY(id)
);

CREATE TABLE invoice (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  shopping_cart_id INTEGER UNSIGNED NOT NULL,
  name VARCHAR(50) NULL,
  description TEXT NULL,
  status_2 INTEGER UNSIGNED NULL,
  city VARCHAR(50) NULL,
  street VARCHAR(50) NULL,
  zip VARCHAR(50) NULL,
  PRIMARY KEY(id),
  INDEX invoice_FKIndex1(shopping_cart_id)
);

CREATE TABLE product (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  category_id INTEGER UNSIGNED NOT NULL,
  name VARCHAR(50) NULL,
  price FLOAT NULL,
  quantity INTEGER UNSIGNED NULL,
  description TEXT NULL,
  article_nr VARCHAR(10) NULL,
  PRIMARY KEY(id),
  INDEX product_FKIndex1(category_id)
);

CREATE TABLE product_image (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  product_id INTEGER UNSIGNED NOT NULL,
  filename VARCHAR(50) NULL,
  PRIMARY KEY(id),
  INDEX product_image_FKIndex1(product_id)
);

CREATE TABLE shopping_cart (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  user__id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(id),
  INDEX shopping_cart_FKIndex1(user__id)
);

CREATE TABLE shopping_cart_inside (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  product_id INTEGER UNSIGNED NOT NULL,
  shopping_cart_id INTEGER UNSIGNED NOT NULL,
  quantity INTEGER UNSIGNED NULL,
  PRIMARY KEY(id),
  INDEX shopping_cart_inside_FKIndex1(shopping_cart_id),
  INDEX shopping_cart_inside_FKIndex2(product_id)
);

CREATE TABLE user (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(15) NULL,
  lastname VARCHAR(25) NULL,
  email VARCHAR(50) NULL,
  password_2 VARCHAR(32) NULL,
  street VARCHAR(50) NULL,
  register INTEGER UNSIGNED NULL DEFAULT 0,
  city VARCHAR(50) NULL,
  zip VARCHAR(50) NULL,
  PRIMARY KEY(id)
);

