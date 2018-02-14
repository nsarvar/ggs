RENAME TABLE `ggs`.`parent` TO `ggs`.`parents` ;

ALTER TABLE `times` ADD UNIQUE `unique_index`(`parent_id`, `type`, `weekday`, `time`)

ALTER TABLE  `student` ADD  `avatar` INT NULL AFTER  `phone` ;

ALTER TABLE `subject` ADD `parent_id` INT NULL AFTER `name`;

CREATE TABLE files (
   id int NOT NULL AUTO_INCREMENT,
   filename varchar(250) NOT NULL,
   size int NOT NULL,
   ext varchar(5) NOT NULL,
   filetype varchar(25) NOT NULL,
   CONSTRAINT files_pk PRIMARY KEY (id)
);