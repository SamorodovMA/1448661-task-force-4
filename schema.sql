--
-- SQL-код для создания новой базы данных.
--
CREATE DATABASE task_forse
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE task_forse;
-- --------------------------------------------------------
--
-- Таблица category
CREATE TABLE `categories`
(
  `id`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = InnoDB;

-- Таблица  cities
CREATE TABLE `cities`
(
  `id`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = InnoDB;

-- Таблица locations
CREATE TABLE `locations`
(
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id`    INT UNSIGNED NOT NULL,
  `latitude`   INT UNSIGNED NOT NULL,
  `longtitude` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- feedback
CREATE TABLE `feedback`
(
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`       INT UNSIGNED NOT NULL,
  `task_id`       INT UNSIGNED NOT NULL,
  `date_creation` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description`   TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

-- Таблица files
CREATE TABLE files
(
  `id`      INT          NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `task_id` INT UNSIGNED NOT NULL,
  `path`    VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

--
-- Таблица users
CREATE TABLE `users`
(
  id              INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(255)     NOT NULL,
  `email`         VARCHAR(128)     NOT NULL,
  `password`      CHAR(64)         NOT NULL,
  `date_creation` DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id`   INT UNSIGNED     NOT NULL,
  `rating`        INT                       DEFAULT 0,
  `popularity`    INT                       DEFAULT 0,
  `avatar`        VARCHAR(255),
  `birthday`      DATETIME,
  `phone`         VARCHAR(11),
  `telegram`      VARCHAR(50),
  `bio`           TEXT,
  `orders_num`    INT                       DEFAULT 0,
  `user_status`   TINYINT UNSIGNED NOT NULL,
  `is_executor`   BOOLEAN          NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`email`)
) ENGINE = InnoDB;


-- Таблица tasks
CREATE TABLE `tasks`
(
  `id`               INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(255)     NOT NULL,
  `date_creation`    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id`      INT UNSIGNED     NOT NULL,
  `user_id`          INT UNSIGNED     NOT NULL,
  `status`           TINYINT UNSIGNED NOT NULL,
  `budget`           INT UNSIGNED     NOT NULL,
  `period_execution` DATETIME         NOT NULL,
  `task_statuses_id` INT UNSIGNED     NOT NULL,
  `city_id`          INT UNSIGNED     NOT NULL,
  `locations_id`     INT UNSIGNED     NOT NULL,
  `essence_work`     TEXT             NOT NULL,
  `description`      TEXT,
  `file_id`          INT              NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE users
  ADD FOREIGN KEY (category_id)
    REFERENCES categories (id);

ALTER TABLE tasks
  ADD FOREIGN KEY (category_id)
    REFERENCES categories (id),
  ADD FOREIGN KEY (user_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (city_id)
    REFERENCES cities (id),
  ADD FOREIGN KEY (locations_id)
    REFERENCES locations (id),
  ADD FOREIGN KEY (file_id)
    references files (id);

ALTER TABLE locations
  ADD FOREIGN KEY (city_id)
    REFERENCES cities (id);

ALTER TABLE feedback
  ADD FOREIGN KEY (user_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (task_id)
    REFERENCES tasks (id);

ALTER TABLE files
  ADD FOREIGN KEY (user_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (task_id)
    REFERENCES tasks (id);
