
CREATE TABLE `audit` (
  `modified_when` bigint(14),
  `modified_from` bigint(14) NOT NULL,
  `modified_to` bigint(14) NOT NULL,
  `modified_by_ip` varchar(39) COLLATE utf8_bin NOT NULL DEFAULT '',
  `modified_by_user` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `modified_why` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_modified` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE INDEX audit_modified_when ON audit (modified_when);

ALTER TABLE `employees` ADD `disabled`  TINYINT(1)  NOT NULL DEFAULT '0';
ALTER TABLE `info`      ADD `ipaddress` VARCHAR(39) NOT NULL DEFAULT '';

UPDATE `dbversion` SET `dbversion` = '1.4';
