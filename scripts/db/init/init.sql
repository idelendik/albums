CREATE SCHEMA IF NOT EXISTS `albums`;


CREATE TABLE IF NOT EXISTS `albums`.`albums` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `albums`.`images` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `album_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL,
    `image_link_full` VARCHAR(255) NOT NULL,
    `image_link_thumbnail` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `albums`.`comments` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `text` VARCHAR(255) NOT NULL,
    `image_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `albums`.`images_meta` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_id` BIGINT UNSIGNED NOT NULL,
    `likes_count` BIGINT UNSIGNED NOT NULL,
    `dislikes_count` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;