CREATE DATABASE IF NOT EXISTS hyperef;
USE hyperef;

CREATE TABLE admins (
    name VARCHAR(20) DEFAULT NULL,
    password VARCHAR(30) DEFAULT NULL
);


CREATE TABLE questions (
    id INT(11) NOT NULL PRIMARY KEY,
    question TEXT DEFAULT NULL,
    score INT(11) DEFAULT 0
);

CREATE TABLE submissions (
    schoolcode VARCHAR(50) DEFAULT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    question INT(11) DEFAULT NULL,
    score int(255) DEFAULT NULL
);

CREATE TABLE users (
    schoolcode VARCHAR(15) DEFAULT NULL,
    password VARCHAR(20) DEFAULT NULL,
    school VARCHAR(50) DEFAULT NULL
);

CREATE TABLE testcases (
    id int(32) NOT NULL,
    input VARCHAR(1024) DEFAULT NULL,
    output VARCHAR(1024) DEFAULT NULL
);

insert into admins(name,password) values('admin','admin@!#+330'); -- Change the username and password for the web panel