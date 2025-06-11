-- Create user and grant privileges
CREATE USER IF NOT EXISTS `user`;
ALTER USER 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON travel_data.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE `travel_data`;

CREATE TABLE IF NOT EXISTS `users`
(
    `user_id`    BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(64)  NOT NULL,
    `email`      VARCHAR(320) NOT NULL UNIQUE,
    `pass`       VARCHAR(60)  NOT NULL,
    `is_admin`   BOOLEAN      NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `locations`
(
    `location_id` BIGINT      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`        VARCHAR(32) NOT NULL UNIQUE,
    `created_at`  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `travels`
(
    `travel_id`   BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `location_id` BIGINT       NOT NULL,
    `name`        VARCHAR(32)  NOT NULL UNIQUE,
    `description` VARCHAR(140) NOT NULL,
    `price`       VARCHAR(10)  NOT NULL,
    `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_travel_location
        FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`)
);

CREATE TABLE IF NOT EXISTS `bookings`
(
    `booking_id` BIGINT    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    BIGINT    NOT NULL,
    `travel_id`  BIGINT    NOT NULL,
    `begin_date` DATE      NOT NULL,
    `end_date`   DATE      NOT NULL,
    `approved`   BOOLEAN   NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_booking_user
        FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    CONSTRAINT fk_booking_travel
        FOREIGN KEY (`travel_id`) REFERENCES `travels` (`travel_id`)
);

CREATE TABLE IF NOT EXISTS `reviews`
(
    `review_id`  BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    BIGINT       NOT NULL,
    `travel_id`  BIGINT       NOT NULL,
    `score`      TINYINT(4)   NOT NULL,
    `content`    VARCHAR(120) NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_review_user
        FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    CONSTRAINT fk_review_travel
        FOREIGN KEY (`travel_id`) REFERENCES `travels` (`travel_id`)
);

CREATE TABLE IF NOT EXISTS `contact`
(
    `contact_id` BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(64)  NOT NULL,
    `email`      VARCHAR(320) NOT NULL,
    `message`    TEXT         NOT NULL,
    `answered`   BOOLEAN      NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
