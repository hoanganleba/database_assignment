CREATE TABLE IF NOT EXISTS user
(
    ID                   INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName            VARCHAR(30)  NOT NULL,
    lastName             VARCHAR(30)  NOT NULL,
    identificationNumber VARCHAR(30)  NOT NULL,
    address              VARCHAR(200) NOT NULL,
    city                 VARCHAR(30)  NOT NULL,
    country              VARCHAR(30)  NOT NULL,
    profilePicture       VARCHAR(50)  NOT NULL,
    balance              INT DEFAULT 0,
    email                VARCHAR(255) NOT NULL UNIQUE,
    phoneNumber          VARCHAR(30)  NOT NULL UNIQUE,
    password             VARCHAR(30)  NOT NULL,
    role                 VARCHAR(30)  NOT NULL
);

INSERT INTO user
VALUES (1, 'admin', 'admin', 01647474, '123 someplace', 'HCM', 'VN', 'profile.png',0, 'admin@admin', '01234567', '123',
        'admin');