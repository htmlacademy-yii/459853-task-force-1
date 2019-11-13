DROP DATABASE IF EXISTS taskforce;

CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE taskforce;

CREATE TABLE attachments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  path VARCHAR(255),
  type VARCHAR(50),
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE statuses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128) NOT NULL,
  code VARCHAR(128) NOT NULL
);

CREATE TABLE specializations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128) NOT NULL,
  code VARCHAR(128) NOT NULL
);

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128) NOT NULL,
  code VARCHAR(128) NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(128) NOT NULL UNIQUE,
  name VARCHAR(50) NOT NULL,
  location VARCHAR(128) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL,
  avatar VARCHAR(128),
  birth_date DATE,
  attachment VARCHAR(255),
  phone VARCHAR(50),
  social VARCHAR(50),
  specialization_id VARCHAR(255),
  show_contacts TINYINT(1),
  notification_email TINYINT(1),
  notification_action TINYINT(1),
  notification_review TINYINT(1),
  last_login DATETIME,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128) NOT NULL,
  description TEXT NOT NULL,
  category_id INT NOT NULL,
  attachment VARCHAR(255),
  location CHAR(128) NOT NULL,
  price INT NOT NULL,
  end_date DATE NOT NULL,
  user_create_id INT NOT NULL,
  user_employee_id INT,
  status_id INT NOT NULL,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY fk_tasks_user_employee_id (user_employee_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY fk_tasks_user_create_id (user_create_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY fk_tasks_category_id (category_id) REFERENCES category(id) ON DELETE CASCADE,
  FOREIGN KEY fk_tasks_status_id (status_id) REFERENCES statuses(id) ON DELETE CASCADE
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_create_id INT NOT NULL,
  user_employee_id INT NOT NULL,
  description TEXT,
  rating INT NOT NULL,
  FOREIGN KEY fk_comment_user_employee_id (user_employee_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY fk_comment_user_create_id (user_create_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY fk_comment_user_tasks_id (task_id) REFERENCES tasks (id) ON DELETE CASCADE
);

CREATE TABLE task_response (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_employee_id INT NOT NULL,
  description TEXT,
  price INT NOT NULL,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY fk_comment_user_employee_id (user_employee_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY fk_comment_user_task_id (task_id) REFERENCES tasks (id) ON DELETE CASCADE
);

CREATE FULLTEXT INDEX title_descr ON tasks(title, description);
