<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$installer->getTable('matthijs_adminlogger')};
CREATE TABLE {$installer->getTable('matthijs_adminlogger')} (
	`entity_id` INT(11) NOT NULL AUTO_INCREMENT,
	`action_info` VARCHAR(255),
	`object_info` VARCHAR(255),
	`change_info` VARCHAR(8000),
	`admin_user` VARCHAR(255),
	`timestamp` DATETIME,
	PRIMARY KEY (`entity_id`)
) Engine=InnoDB DEFAULT CHARSET=utf8
");

$installer->endSetup();