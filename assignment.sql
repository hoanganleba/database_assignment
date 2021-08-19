DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS user;

CREATE TABLE IF NOT EXISTS user
(
    userID               INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    firstName            VARCHAR(30)           NOT NULL,
    lastName             VARCHAR(30)           NOT NULL,
    identificationNumber VARCHAR(30)           NOT NULL,
    address              VARCHAR(200)          NOT NULL,
    city                 VARCHAR(30)           NOT NULL,
    country              VARCHAR(30)           NOT NULL,
    profilePicture       VARCHAR(50)           NOT NULL,
    balance              DECIMAL(10, 2)        NOT NULL DEFAULT 0,
    email                VARCHAR(255)          NOT NULL UNIQUE,
    phoneNumber          VARCHAR(30)           NOT NULL UNIQUE,
    password             VARCHAR(30)           NOT NULL,
    role                 VARCHAR(30)           NOT NULL
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS product
(
    productID    INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    productImage VARCHAR(255)          NOT NULL,
    name         VARCHAR(255)          NOT NULL,
    currentPrice DECIMAL(10, 2)        NOT NULL,
    minimumPrice DECIMAL(10, 2)        NOT NULL,
    closeTime    Timestamp             NOT NULL,
    userID       INT(6)                NOT NULL,
    FOREIGN KEY (userID) REFERENCES user (userID)
) ENGINE = INNODB;

INSERT INTO user
VALUES (1, 'admin', 'example', '01647474', '123 someplace', 'HCM', 'VN', 'profile.png', 0, 'admin@admin', '01234567',
        '123',
        'admin');

INSERT INTO product
VALUES (1, 'https://cdn.tgdd.vn/Products/Images/42/193569/razer-phone-2-600x600.jpg', 'Razer phone', 100, 100,
        '2021-08-11 19:00:00', 1);
INSERT INTO product
VALUES (2, 'https://cdn.tgdd.vn/Products/Images/42/193569/razer-phone-2-600x600.jpg', 'Razer phone', 100, 100,
        '2021-08-11 19:00:00', 1);
INSERT INTO product
VALUES (3, 'https://cdn.tgdd.vn/Products/Images/42/193569/razer-phone-2-600x600.jpg', 'Razer phone', 100, 100,
        '2021-08-11 19:00:00', 1);
INSERT INTO product
VALUES (4, 'https://cdn.tgdd.vn/Products/Images/42/193569/razer-phone-2-600x600.jpg', 'Razer phone', 100, 100,
        '2021-08-11 19:00:00', 1);