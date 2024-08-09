CREATE DATABASE IF NOT EXISTS hyperef;
USE hyperef;

CREATE TABLE admins (
    name VARCHAR(20) NOT NULL,
    password VARCHAR(30) NOT NULL
);


CREATE TABLE questions (
    id INT(11) NOT NULL PRIMARY KEY,
    question TEXT NOT NULL,
    score INT(11) DEFAULT 0
);

CREATE TABLE submissions (
    schoolcode VARCHAR(50) NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    question INT(11),
    score int(255)
);

CREATE TABLE users (
    schoolcode VARCHAR(15) NOT NULL,
    password VARCHAR(20) NOT NULL,
    school VARCHAR(50) NOT NULL
);

CREATE TABLE testcases (
    id int(32) NOT NULL,
    input VARCHAR(1024) NOT NULL,
    output VARCHAR(1024) NOT NULL
);

insert into admins(name,password) values('admin','admin@!#+330'); -- Change the username and password for the web panel
