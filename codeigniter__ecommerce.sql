CREATE TABLE `category` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`cat_name` varchar(255) NOT NULL,
	`cat_image` TEXT(255) NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`product_name` varchar(255) NOT NULL,
	`product_desc` TEXT(255) NOT NULL,
	`qty` INT NOT NULL,
	`MRP` DECIMAL NOT NULL,
	`selling_price` DECIMAL NOT NULL,
	`image` TEXT NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	`fk_catid` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cat` (
	`id` INT(45) NOT NULL AUTO_INCREMENT,
	`fk_product_id` INT(50) NOT NULL,
	`qyt` INT(50) NOT NULL,
	`cost` DECIMAL(50) NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`order_id` varchar(255) NOT NULL,
	`order_amount` DECIMAL(255) NOT NULL,
	`order_date` DATETIME NOT NULL,
	`order_status` TEXT NOT NULL,
	`fk_userid` INT(50) NOT NULL,
	`order_type` TEXT NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_items` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`item_name` varchar(255) NOT NULL,
	`items_amount` DECIMAL(50) NOT NULL,
	`items_qty` INT(50) NOT NULL,
	`fk_orderid` INT(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user` (
	`id` INT(10) NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`phone` INT(50) NOT NULL,
	`password` varchar(255) NOT NULL,
	`profile_pic` varchar(255) NOT NULL
);








