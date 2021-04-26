DROP TABLE order_history;
DROP TABLE supplier_shipments;
DROP TABLE sales_relations; 
DROP TABLE products;
DROP TABLE supplier;
DROP TABLE customer;
DROP TABLE region;
DROP TABLE branch;
DROP TABLE department; 
DROP TABLE employee; 

CREATE TABLE IF NOT EXISTS `employee`(
`employee_id` INT(11)NOT NULL,
`first_name` VARCHAR(15)NOT NULL,
`last_name` VARCHAR(20)NOT NULL,
`birth_date` DATETIME,
`sex` varchar(1)NOT NULL,
`salary` INT NOT NULL,
`super_id` INT NOT NULL,
`department_id` INT NULL,
`branch_id` INT NOT NULL,
PRIMARY KEY(`employee_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `department`(
`department_id` INT NOT NULL,
`department_name` VARCHAR(40) NOT NULL,
`department_head_id` INT NOT NULL, 
PRIMARY KEY(`department_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `branch`(
`branch_id` INT NOT NULL,
`branch_name` VARCHAR(20) NOT NULL,
`branch_head_id` INT(11)NOT NULL,
`region_id` INT  NOT NULL,
PRIMARY KEY (`branch_id`))ENGINE=InnoDB 
DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `region`(
`region_id`INT NOT NULL,
`region_name` VARCHAR(10)NOT NULL,
`region_sales` INT NOT NULL,
PRIMARY KEY (`region_id`))ENGINE=InnoDB 
DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `customer`( 
`customer_id`INT NOT NULL,
`first_name`VARCHAR(15) NOT NULL,
`last_name`VARCHAR(20) NOT NULL,
`customer_address`VARCHAR(40),
`contact_information`VARCHAR(40),
PRIMARY KEY (`customer_id`))ENGINE=InnoDB 
DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `supplier`(
`supplier_id`INT NOT NULL,
`company_name` VARCHAR(20) NOT NULL,
`contact_information` VARCHAR(40),
`address` VARCHAR(40) NOT NULL, 
PRIMARY KEY (`supplier_id`))ENGINE=InnoDB 
DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `products`(
`product_id` INT,
`product_name` VARCHAR(20)NOT NULL,
`price_per_unit` double NOT NULL,
`Inventory` INT NOT NULL,
PRIMARY KEY (`product_id`)) ENGINE=InnoDB 
DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sales_relations`(
`branch_id` INT NOT NULL,
`customer_id` INT NOT NULL,
`total_sales` double,
PRIMARY KEY (`branch_id`,`customer_id`))
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `supplier_shipments`(
`branch_id` INT NOT NULL,
`supplier_id` INT NOT NULL,
`shipment_id` INT NOT NULL,
`product_id` INT NOT NULL,
`shipment_date` DATETIME NOT NULL,
PRIMARY KEY (`branch_id`,`supplier_id`))ENGINE=InnoDB 
DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `order_history`(
`customer_id` INT NOT NULL, 
`order_id` INT NOT NULL, 
`product_id` INT NOT NULL,
`order_date` DATETIME,
`delivery_date` DATETIME,
PRIMARY KEY (`customer_id`))ENGINE = InnoDB
DEFAULT CHARSET=utf8;

ALTER TABLE employee
ADD FOREIGN KEY(department_id)
REFERENCES department(department_id),
ADD FOREIGN KEY(super_id)
REFERENCES employee(employee_id),
ADD FOREIGN KEY(branch_id)
REFERENCES branch(branch_id);

ALTER TABLE branch 
ADD FOREIGN KEY(region_id)
REFERENCES region(region_id),
ADD FOREIGN KEY(branch_head_id)
REFERENCES employee(employee_id);

TRUNCATE table `employee`;
TRUNCATE table `department`;
TRUNCATE table `branch`;
TRUNCATE table `region`;
TRUNCATE table `customer`;
TRUNCATE table `supplier`;
TRUNCATE table `products`;
TRUNCATE table `sales_relations`;
TRUNCATE table `supplier_shipments`;
TRUNCATE table `order_history`;

SET foreign_key_checks = 0;
INSERT INTO`employee`VALUES(1001,"John","Doe",'1968-04-27',"M",410000,9000,0002,10);
INSERT INTO`employee`VALUE(1002,"James","Smith",'1984-07-22', "M",120000,1001,2221,12);
INSERT INTO`employee`VALUE(1003,"Sally","Johnson",'1992-02-15',"F",52000,1002,2222,12);

INSERT INTO`department`VALUE(0002,"Corporate",1001);
INSERT INTO`department`VALUE(1221,"Human Resources",1499);
INSERT INTO`department`VALUE(1222,"Sales",1599);
INSERT INTO`department`VALUE(2221,"Human Resources",2499);
INSERT INTO`department`VALUE(2222,"Sales",2599);

INSERT INTO`branch`VALUE(10,"Dayton",1001,1400);
INSERT INTO`branch`VALUE(20,"Scranton",2001,2400);


INSERT INTO`region`VALUE(1,"swus",880888.00);

INSERT INTO`customer`VALUE(1001,"Jane","Doe","1002 Neverland Rd","nsdad@yahoo.com");
INSERT INTO`customer`VALUE(2002,"Chris","Smith","2463 Dunken Rd","ChrisS547@hotmail.com");

INSERT INTO`supplier`VALUE(1001,"Adidas","supplier@adidasl.com",
"1965 Eagle Court");
INSERT INTO`supplier`VALUE (2002,"Nike","suuplies@nike.com","123 Office Row");

INSERT INTO`products`VALUE(12401,"Adidas Hat",15,1500);
INSERT INTO`products`VALUE(14302,"Nike Shirt",35,750);
INSERT INTO`products`VALUE(15402,"Adidas Socks",35,750);

 
INSERT INTO`sales_relations`VALUE(1123,1001,75);
INSERT INTO`sales_relations`VALUE(1124,1001,150);

INSERT INTO`supplier_shipments`VALUE(1001,1001,100808,1001, '2021-12-14');

INSERT INTO `order_history`VALUE(1001,110080,1001,'2021-12-14','2021-12-25');

DELIMITER $$
CREATE TRIGGER wrong_update
AFTER UPDATE
ON order_history FOR EACH ROW
BEGIN
    IF order_history.order_date > order_history.delivery_date THEN
 UPDATE order_history
 SET order_history.delivery_date = DATE_ADD(order_history.delivery_date, INTERVAL 10 DAY);
    END IF;
END$$

DELIMITER ;

SET foreign_key_checks = 1;
