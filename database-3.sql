CREATE TABLE `user`
(
    `id`       int PRIMARY KEY AUTO_INCREMENT,
    `email`    varchar(255) UNIQUE,
    `phoneNum` varchar(255) UNIQUE,
    `password` varchar(255),
    `role_id`  int
);

CREATE TABLE `role`
(
    `id`   int PRIMARY KEY,
    `type` varchar(255)
);

CREATE TABLE `customer`
(
    `id`                 int PRIMARY KEY AUTO_INCREMENT,
    `last_name`          varchar(255),
    `first_name`         varchar(255),
    `created_at`         timestamp,
    `branch_code`        int,
    `address`            varchar(255),
    `city`               varchar(255),
    `country`            varchar(255),
    `identification_num` varchar(255) UNIQUE,
    `profile_pic`        varchar(255),
    `user_id`            int
);

CREATE TABLE `branch`
(
    `branch_code` int PRIMARY KEY AUTO_INCREMENT,
    `branch_name` varchar(255) UNIQUE,
    `address`     varchar(255),
    `hotline_num` varchar(255)
);

CREATE TABLE `bid`
(
    `bid_id`      int PRIMARY KEY AUTO_INCREMENT,
    `customer_id` int,
    `product_id`  varchar(255),
    `value`       int
);

CREATE TABLE `transaction`
(
    `id`                 int PRIMARY KEY AUTO_INCREMENT,
    `seller_id`          int,
    `buyer_id`           int,
    `transaction_date`   timestamp
);

CREATE TABLE `wallet`
(
    `customer_id` int UNIQUE,
    `balance`     int
);

ALTER TABLE `customer`
    ADD FOREIGN KEY (`branch_code`) REFERENCES `branch` (`branch_code`);

ALTER TABLE `wallet`
    ADD FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

ALTER TABLE `transaction`
    ADD FOREIGN KEY (`seller_id`) REFERENCES `customer` (`id`);

ALTER TABLE `transaction`
    ADD FOREIGN KEY (`buyer_id`) REFERENCES `customer` (`id`);

ALTER TABLE `customer`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user`
    ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

INSERT INTO branch
VALUES (50, 'HCM branch', '12/34/Nam Ki Khoi Nghia', '08989451236');

INSERT INTO branch
VALUES (43, 'Da Nang branch', '56 Le Loi', '0895135746');

INSERT INTO branch
VALUES (30, 'Ha Noi branch', '31 Lan Ong', '0865425891');

INSERT INTO role
VALUES (1, 'admin');
INSERT INTO role
VALUES (2, 'customer');

INSERT INTO user
VALUES (1, 'admin@admin', null, '123456', 1);

INSERT INTO user
VALUES (2, 'nguyenVanA@gmail.com', '1900123456', 'password', 2);

INSERT INTO user
VALUES (3, 'huynhLeB@gmail.com', '1900987654', 'password', 2);

INSERT INTO user
VALUES (4, 'phamThiMinhC@gmail.com', '1900246879', 'password', 2);

INSERT INTO customer
VALUES (1, 'Nguyen', 'Van A', '2021-08-11 19:00:00', '50',
        '1 Nguyen Van Linh', 'Ho Chi Minh', 'Vietnam', '000001',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU', 2);

INSERT INTO customer
VALUES (2, 'Huynh', 'Le B', '2021-08-12 20:00:00', '43', '1 Hai Ba Trung', 'Da Nang', 'Vietnam', '000002',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU', 3);

INSERT INTO customer
VALUES (3, 'Pham', 'Thi Minh C', '2021-08-14 15:00:00', '30', '1 Hang Trong', 'Ha Noi', 'Vietnam', '000003',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQa9aZaBVIwyx-C6Os35WtNviD00boWcWfpQ&usqp=CAU', 4);

INSERT INTO wallet
VALUES (1, 100);

INSERT INTO wallet
VALUES (2, 100);

INSERT INTO wallet
VALUES (3, 100);