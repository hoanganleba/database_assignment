CREATE TABLE IF NOT EXISTS user (
    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(255),
    lastName varchar(255),
    email varchar(255),
    password varchar(255),
    role varchar(255)
);

INSERT INTO user VALUES (1, 'admin', 'admin', 'admin@admin', '123', 'admin');