CREATE DATABASE eagle athletics;

    use eagle athletics;

CREATE TABLE IF NOT EXISTS `employee`(
`employee_id` INT (11)NOT NULL,
`first_name` VARCHAR(15)NOT NULL,
`last_name` VARCHAR(20)NOT NULL,
`birth_date` DATETIME,
`sex` varchar(1)NOT NULL,
`salary` INT NOT NULL,
`super_id` INT NOT NULL,
`department_id` INT NOT NULL,
`branch_id` INT NOT NULL,
PRIMARY KEY(`employee_id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `department`(
`department_id` INT NOT NULL,
`department_name` VARCHAR(40) NOT NULL,
`department_head_id` INT NOT NULL,
PRIMARY KEY(`department_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `region`(
`region_id`INT NOT NULL,
`region_name` VARCHAR(10)NOT NULL,
`region_sales` INT NOT NULL,
PRIMARY KEY (`region_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `supplier`(
`supplier_id`INT NOT NULL,
`company_name` VARCHAR(20) NOT NULL,
`contact_information` VARCHAR(40),
`address` VARCHAR(40) NOT NULL,
PRIMARY KEY (`supplier_id`))ENGINE=InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `products`(
`product_id` INT,
`product_name` VARCHAR(20)NOT NULL,
`price_per_unit` double NOT NULL,
`Inventory` INT NOT NULL,
PRIMARY KEY (`product_id`)) ENGINE=InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `sales_relations`(
`branch_id` INT NOT NULL,
`customer_id` INT NOT NULL,
`total_sales` double,
PRIMARY KEY (`branch_id`,`customer_id`))ENGINE=InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `supplier_shipments`(
`branch_id` INT NOT NULL,
`supplier_id` INT NOT NULL,
`shipment_id` INT NOT NULL,
`product_id` INT NOT NULL,
`shipment_date` DATETIME NOT NULL,
PRIMARY KEY (`branch_id`,`supplier_id`))ENGINE =InnoDB DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `order_history`(
`customer_id` INT NOT NULL,
`order_id` INT NOT NULL,
`product_id` INT NOT NULL,
`order_date` DATETIME,
`delivery_date` DATETIME,
PRIMARY KEY (`customer_id`))ENGINE = InnoDB DEFAULT CHARSET = utf8;
