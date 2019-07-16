create database community;
use community;
create table event( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  start DATETIME,
  end DATETIME,
  website text,
  age VARCHAR(200),
  cost VARCHAR(200),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table location( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  street text,
  city text,
  province text,
  postal text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table organization( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table series( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table resource( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table feedback( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  description text,
  rating text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table relationship( id INT(11) NOT NULL AUTO_INCREMENT,
  type VARCHAR(30) NOT NULL,
  a_id INT(11) NOT NULL,
  a_type VARCHAR(30) NOT NULL,
  b_id INT(11) NOT NULL,
  b_type VARCHAR(30) NOT NULL,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table contact( id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(200),
  email VARCHAR(200),
  phone VARCHAR(200),
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);
create table suggestion( id INT(11) NOT NULL AUTO_INCREMENT,
  description text,
  website text,
  find text,
  imagepath text,
  status text,
  created_at DATETIME,
  updated_at DATETIME,
  PRIMARY KEY (id)
);