
ALTER TABLE `employees` ADD `displayname` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `employees` ADD `email` VARCHAR(75) NOT NULL DEFAULT '';
ALTER TABLE `employees` ADD `groups` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `employees` ADD `office` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `employees` ADD `admin` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `employees` ADD `reports` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `employees` ADD `time_admin` TINYINT(1) NOT NULL DEFAULT '0';
INSERT INTO employees (empfullname, employee_passwd, displayname, `admin`, reports, time_admin) VALUES ('admin', 'xy.RY2HT1QTc2', 'administrator', 1, 1, 1);

CREATE TABLE groups (
  groupname VARCHAR(50) NOT NULL DEFAULT '',
  groupid   INT(10)     NOT NULL AUTO_INCREMENT,
  officeid  INT(10)     NOT NULL DEFAULT '0',
  PRIMARY KEY (groupid)
) TYPE = MyISAM;

ALTER TABLE `info` CHANGE `inout` `inout` VARCHAR(50) NOT NULL;

CREATE TABLE offices (
  officename VARCHAR(50) NOT NULL DEFAULT '',
  officeid   INT(10)     NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (officeid)
) TYPE = MyISAM;

ALTER TABLE `punchlist` CHANGE `punchitems` `punchitems` VARCHAR(50) NOT NULL;
ALTER TABLE `punchlist` ADD `in_or_out` TINYINT(1) DEFAULT '0' NOT NULL;
UPDATE `punchlist` SET `in_or_out` = '1' WHERE `punchitems` = 'in'    LIMIT 1;
UPDATE `punchlist` SET `in_or_out` = '0' WHERE `punchitems` = 'out'   LIMIT 1;
UPDATE `punchlist` SET `in_or_out` = '0' WHERE `punchitems` = 'break' LIMIT 1;
UPDATE `punchlist` SET `in_or_out` = '0' WHERE `punchitems` = 'lunch' LIMIT 1;

UPDATE `dbversion` SET `dbversion` = '1.0';
