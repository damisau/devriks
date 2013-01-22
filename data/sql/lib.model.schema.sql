
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- rikssym_country
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_country`;


CREATE TABLE `rikssym_country`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`show` TINYINT,
	`iso_countrycode` VARCHAR(2),
	`iso3_countrycode` VARCHAR(3),
	`cow_code` INTEGER,
	`georegion` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `rikssym_country_FI_1` (`georegion`),
	CONSTRAINT `rikssym_country_FK_1`
		FOREIGN KEY (`georegion`)
		REFERENCES `rikssym_georegion` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_development
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_development`;


CREATE TABLE `rikssym_development`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`text` TEXT  NOT NULL,
	`date_published` DATE  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_arrangement
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_arrangement`;


CREATE TABLE `rikssym_arrangement`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`abbrev` VARCHAR(255),
	`georegion_id` INTEGER,
	`show` TINYINT,
	PRIMARY KEY (`id`),
	INDEX `rikssym_arrangement_FI_1` (`georegion_id`),
	CONSTRAINT `rikssym_arrangement_FK_1`
		FOREIGN KEY (`georegion_id`)
		REFERENCES `rikssym_georegion` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_georegion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_georegion`;


CREATE TABLE `rikssym_georegion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_master
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_master`;


CREATE TABLE `rikssym_master`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER,
	`institute` VARCHAR(255),
	`program_title` VARCHAR(255),
	`url` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rikssym_master_FI_1` (`country_id`),
	CONSTRAINT `rikssym_master_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `rikssym_country` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_training
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_training`;


CREATE TABLE `rikssym_training`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER,
	`institute` VARCHAR(255),
	`program_title` VARCHAR(255),
	`url` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rikssym_training_FI_1` (`country_id`),
	CONSTRAINT `rikssym_training_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `rikssym_country` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_phd
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_phd`;


CREATE TABLE `rikssym_phd`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER,
	`institute` VARCHAR(255),
	`program_title` VARCHAR(255),
	`url` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rikssym_phd_FI_1` (`country_id`),
	CONSTRAINT `rikssym_phd_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `rikssym_country` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_arrangement_country
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_arrangement_country`;


CREATE TABLE `rikssym_arrangement_country`
(
	`arrangement_id` INTEGER  NOT NULL,
	`country_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `rikssym_arrangement_country_FI_1` (`arrangement_id`),
	CONSTRAINT `rikssym_arrangement_country_FK_1`
		FOREIGN KEY (`arrangement_id`)
		REFERENCES `rikssym_arrangement` (`id`),
	INDEX `rikssym_arrangement_country_FI_2` (`country_id`),
	CONSTRAINT `rikssym_arrangement_country_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `rikssym_country` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_document
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_document`;


CREATE TABLE `rikssym_document`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title_short` TEXT  NOT NULL,
	`title_long` TEXT,
	`type` VARCHAR(255),
	`date_signed` INTEGER,
	`date_force` INTEGER,
	`filename` VARCHAR(255)  NOT NULL,
	`language` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_document_entity
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_document_entity`;


CREATE TABLE `rikssym_document_entity`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`document_id` INTEGER  NOT NULL,
	`arrangement_id` INTEGER,
	`country_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `rikssym_document_entity_FI_1` (`document_id`),
	CONSTRAINT `rikssym_document_entity_FK_1`
		FOREIGN KEY (`document_id`)
		REFERENCES `rikssym_document` (`id`),
	INDEX `rikssym_document_entity_FI_2` (`arrangement_id`),
	CONSTRAINT `rikssym_document_entity_FK_2`
		FOREIGN KEY (`arrangement_id`)
		REFERENCES `rikssym_arrangement` (`id`),
	INDEX `rikssym_document_entity_FI_3` (`country_id`),
	CONSTRAINT `rikssym_document_entity_FK_3`
		FOREIGN KEY (`country_id`)
		REFERENCES `rikssym_country` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_entry
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_entry`;


CREATE TABLE `rikssym_entry`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_data
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_data`;


CREATE TABLE `rikssym_data`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`reporter_id` INTEGER  NOT NULL,
	`partner_id` INTEGER,
	`type_id` INTEGER  NOT NULL,
	`value` BIGINT,
	`source_id` INTEGER  NOT NULL,
	`period` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `rikssym_data_FI_1` (`reporter_id`),
	CONSTRAINT `rikssym_data_FK_1`
		FOREIGN KEY (`reporter_id`)
		REFERENCES `rikssym_country` (`id`),
	INDEX `rikssym_data_FI_2` (`partner_id`),
	CONSTRAINT `rikssym_data_FK_2`
		FOREIGN KEY (`partner_id`)
		REFERENCES `rikssym_country` (`id`),
	INDEX `rikssym_data_FI_3` (`type_id`),
	CONSTRAINT `rikssym_data_FK_3`
		FOREIGN KEY (`type_id`)
		REFERENCES `rikssym_datatype` (`id`),
	INDEX `rikssym_data_FI_4` (`source_id`),
	CONSTRAINT `rikssym_data_FK_4`
		FOREIGN KEY (`source_id`)
		REFERENCES `rikssym_sources` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_sources
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_sources`;


CREATE TABLE `rikssym_sources`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` TEXT  NOT NULL,
	`url` TEXT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_datatype
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_datatype`;


CREATE TABLE `rikssym_datatype`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`unit` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_indicator
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_indicator`;


CREATE TABLE `rikssym_indicator`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`ispublic` TINYINT,
	`classname` VARCHAR(255)  NOT NULL,
	`unit_title` VARCHAR(255)  NOT NULL,
	`method` VARCHAR(255)  NOT NULL,
	`category` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_journal
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_journal`;


CREATE TABLE `rikssym_journal`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`region_id` INTEGER,
	`url` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `rikssym_journal_FI_1` (`region_id`),
	CONSTRAINT `rikssym_journal_FK_1`
		FOREIGN KEY (`region_id`)
		REFERENCES `rikssym_georegion` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_center
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_center`;


CREATE TABLE `rikssym_center`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`region_id` INTEGER,
	`url` TEXT,
	PRIMARY KEY (`id`),
	INDEX `rikssym_center_FI_1` (`region_id`),
	CONSTRAINT `rikssym_center_FK_1`
		FOREIGN KEY (`region_id`)
		REFERENCES `rikssym_georegion` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rikssym_dblinks
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rikssym_dblinks`;


CREATE TABLE `rikssym_dblinks`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`url` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
