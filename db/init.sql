USE `travel_data`;

CREATE TABLE IF NOT EXISTS `users`
(
    `id`         BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(64)  NOT NULL,
    `email`      VARCHAR(320) NOT NULL UNIQUE,
    `pass`       VARCHAR(60)  NOT NULL,
    `admin`      BOOLEAN      NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `locations`
(
    `id`         BIGINT      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(32) NOT NULL UNIQUE,
    `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `travels`
(
    `id`          BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `location_id` BIGINT       NOT NULL,
    `name`        VARCHAR(32)  NOT NULL UNIQUE,
    `description` VARCHAR(140) NOT NULL,
    `price_int`   INT          NOT NULL,
    `price_dec`   INT          NOT NULL,
    `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `bookings`
(
    `id`         BIGINT    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    BIGINT    NOT NULL,
    `travel_id`  BIGINT    NOT NULL,
    `begin_date` DATE      NOT NULL,
    `end_date`   DATE      NOT NULL,
    `approved`   BOOLEAN   NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `reviews`
(
    `id`         BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    BIGINT       NOT NULL,
    `travel_id`  BIGINT       NOT NULL,
    `score`      TINYINT(4)   NOT NULL,
    `content`    VARCHAR(120) NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `contact`
(
    `id`         BIGINT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(64)  NOT NULL,
    `email`      VARCHAR(320) NOT NULL,
    `message`    TEXT         NOT NULL,
    `answered`   BOOLEAN      NOT NULL DEFAULT FALSE,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
)