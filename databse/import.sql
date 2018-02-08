RENAME TABLE `ggs`.`parent` TO `ggs`.`parents` ;

ALTER TABLE `times` ADD UNIQUE `unique_index`(`parent_id`, `type`, `weekday`, `time`)