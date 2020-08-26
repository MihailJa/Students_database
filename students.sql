CREATE TABLE Students(
    id_code CHAR(11) NOT NULL PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,	
	grade TINYINT unsigned NOT NULL,
	email VARCHAR(20) NOT NULL UNIQUE,
	message VARCHAR(250)
);