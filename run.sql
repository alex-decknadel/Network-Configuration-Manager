CREATE DATABASE netcon;
CREATE USER 'website'@'localhost' IDENTIFIED BY 'Team4';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON netcon.* TO 'website'@'localhost';
USE netcon;
CREATE TABLE admins (
	adminID int NOT NULL AUTO_INCREMENT,
	username varchar(50) NOT NULL,
	email varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	adminType varchar(100) NOT NULL,
	PRIMARY KEY (adminID)
);
CREATE TABLE siteAgents (
	agentID int NOT NULL AUTO_INCREMENT,
	siteName varchar(50) NOT NULL,
	PRIMARY KEY (agentID)
);
CREATE TABLE switches (
	switchID int NOT NULL AUTO_INCREMENT,
	switchName varchar(50) NOT NULL,
	ipAddress varchar(15) NOT NULL,
	connectionMode varchar(10) NOT NULL,
	authenticationString varchar(255),
	siteAgent int NOT NULL,
	PRIMARY KEY (switchID),
	FOREIGN KEY (siteAgent) REFERENCES siteAgents(agentID)
);
CREATE TABLE switchConfigs (
	configID int NOT NULL AUTO_INCREMENT,
	filename varchar(255) NOT NULL,
	logTime timestamp NOT NULL,
	switch int NOT NULL,
	authoritative boolean NOT NULL,
	PRIMARY KEY (configID),
	FOREIGN KEY (switch) REFERENCES switches(switchID)
);
CREATE TABLE tasks (
	taskID int NOT NULL AUTO_INCREMENT,
	siteAgent int NOT NULL,
	siteAdmin int NOT NULL,
	PRIMARY KEY (taskID),
	FOREIGN KEY (siteAgent) REFERENCES siteAgents(agentID),
	FOREIGN KEY (siteAdmin) REFERENCES admins(adminID)
);
CREATE TABLE labels (
	labelID int NOT NULL AUTO_INCREMENT,
	labelName varchar(255),
	switchConfig int NOT NULL,
	PRIMARY KEY (labelID),
	FOREIGN KEY (switchConfig) REFERENCES switchConfigs(configID)
);

INSERT INTO admins (username,email,password,adminType) VALUES ('adecknadel','adecknadel19@wou.edu','panopticon','Head Admin');

INSERT INTO admins (username,email,password,adminType) VALUES ('xbai','xbai19@wou.edu','qwerty','Head Admin');

INSERT INTO admins (username,email,password,adminType) VALUES ('tferrell','tferrell18@wou.edu','qwerty','Head Admin');
