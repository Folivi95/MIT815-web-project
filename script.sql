--create user table with the script below
CREATE TABLE `mitclassdb`.`users` ( `id` INT(11) NOT NULL , `firstname` TEXT NULL DEFAULT NULL , 
`lastname` TEXT NULL DEFAULT NULL , `usertype` VARCHAR(40) NULL DEFAULT NULL , 
`password` TEXT NULL DEFAULT NULL ,
`classid` INT(11) NOT NULL ,PRIMARY KEY (`id`),
FOREIGN KEY (classid) REFERENCES classes(id)) ENGINE = MyISAM;

--create classes table with the script below
CREATE TABLE `mitclassdb`.`classes` ( `id` INT NOT NULL DEFAULT '0' , `name` TEXT NULL DEFAULT NULL , 
`venue` TEXT NULL DEFAULT NULL , `day` TEXT NULL DEFAULT NULL , `starttime` TIME NOT NULL, 
`stoptime` TIME NOT NULL, `noofparticipants` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = MyISAM