--
-- SQL-код для создания новой базы данных.
--
CREATE DATABASE taskforсe
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE taskforсe;
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
  `id`         INT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)   NOT NULL,
  `latitude`   DECIMAL(11, 8) NOT NULL,
  `longtitude` DECIMAL(11, 8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = InnoDB;

-- Таблица locations
CREATE TABLE `locations`
(
  `id`         INT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `city_id`    INT UNSIGNED   NOT NULL,
  `latitude`   DECIMAL(11, 8) NOT NULL,
  `longtitude` DECIMAL(11, 8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- feedback
CREATE TABLE `feedback`
(
  `id`            INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `customer_id`   INT UNSIGNED     NOT NULL,
  `task_id`       INT UNSIGNED     NOT NULL,
  `date_creation` DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description`   TEXT NOT NULL,
  `rating`        TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

-- Таблица files
CREATE TABLE files
(
  `id`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE task_files
(
  `id`      INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` INT UNSIGNED NOT NULL,
  `file_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;
--
-- Таблица users
CREATE TABLE `users`
(
  id                 INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(255)     NOT NULL,
  `email`            VARCHAR(128)     NOT NULL,
  `password`         CHAR(64)         NOT NULL,
  `date_creation`    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id`      INT UNSIGNED     NOT NULL,
  `rating`           INT                       DEFAULT 0,
  `popularity`       INT                       DEFAULT 0,
  `avatar_file_id`   INT UNSIGNED     NULL,
  `birthday`         DATETIME,
  `phone`            VARCHAR(11),
  `telegram`         VARCHAR(50),
  `bio`              TEXT,
  `orders_num`       INT                       DEFAULT 0,
  `head_card_status` TINYINT UNSIGNED NOT NULL,
  `is_executor`      BOOLEAN          NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`email`)
) ENGINE = InnoDB;

-- Таблица tasks
CREATE TABLE `tasks`
(
  `id`               INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(255)     NOT NULL,
  `description`      TEXT,
  `date_creation`    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id`      INT UNSIGNED     NOT NULL,
  `customer_id`      INT UNSIGNED     NOT NULL,
  `executor_id`      INT UNSIGNED,
  `status`           TINYINT UNSIGNED NOT NULL,
  `budget`           INT UNSIGNED     NOT NULL,
  `period_execution` DATETIME         NOT NULL,
  `city_id`          INT UNSIGNED     NOT NULL,
  `location_id`      INT UNSIGNED     NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

-- Таблица response
CREATE TABLE response
(
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `task_id`       INT UNSIGNED NOT NULL,
  `executor_id`   INT UNSIGNED NOT NULL,
  `price`         INT UNSIGNED,
  `comment`       VARCHAR(255),
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE users
  ADD FOREIGN KEY (category_id)
    REFERENCES categories (id),
  ADD FOREIGN KEY (avatar_file_id)
    references files (id);

ALTER TABLE tasks
  ADD FOREIGN KEY (category_id)
    REFERENCES categories (id),
  ADD FOREIGN KEY (customer_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (executor_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (city_id)
    REFERENCES cities (id),
  ADD FOREIGN KEY (location_id)
    REFERENCES locations (id);


ALTER TABLE locations
  ADD FOREIGN KEY (city_id)
    REFERENCES cities (id);

ALTER TABLE feedback
  ADD FOREIGN KEY (customer_id)
    REFERENCES users (id),
  ADD FOREIGN KEY (task_id)
    REFERENCES tasks (id);

ALTER TABLE task_files
  ADD FOREIGN KEY (task_id)
    REFERENCES tasks (id),
  ADD FOREIGN KEY (file_id)
    REFERENCES files (id);

ALTER TABLE response
  ADD FOREIGN KEY (task_id)
    REFERENCES tasks (id),
  ADD FOREIGN KEY (`executor_id`)
    REFERENCES users (id);
