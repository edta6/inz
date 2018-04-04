CREATE TABLE USERS (id_user int NOT NULL PRIMARY KEY, first_name varchar(28), last_name varchar(57), nick varchar(20),  pass text, role tinyint, active tinyint, UNIQUE(nick));

CREATE TABLE PUPILS (id_pupil int NOT NULL PRIMARY KEY, first_name varchar(15), last_name varchar(20), id_user int, active tinyint, date_add date, date_out date);

CREATE DATABASE edocumen DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

Zalecenia nazwy pól w tabelach pisać wszystko z małych liter, a nazwy Tabel Drukowanymi.