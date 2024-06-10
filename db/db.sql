USE ums;

CREATE TABLE users (
	id INT auto_increment NOT NULL,
	username varchar(100) NOT NULL,
	email varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE roles (
	id INT auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	CONSTRAINT roles_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

ALTER TABLE users ADD role_id INTEGER NOT NULL;

INSERT INTO ums.users (username,email,password,role_id) VALUES
	 ('admin','admin@admin.com','7b902e6ff1db9f560443f2048974fd7d386975b0',1),
	 ('Faisal','faisal@user.com','7b902e6ff1db9f560443f2048974fd7d386975b0',2);

INSERT INTO ums.roles (name) VALUES
	 ('admin'),
	 ('user');
