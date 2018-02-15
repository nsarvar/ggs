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

ALTER TABLE  `course` ADD  `course_group_id` INT NULL ,
ADD  `faculty_id` INT NULL ;

CREATE TABLE `subject_category` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `subject_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `subject_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subject_category`
  ADD CONSTRAINT `subject_category_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `subject_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;