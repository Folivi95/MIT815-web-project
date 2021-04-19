--create user table with the script below
CREATE TABLE `mitclassdb`.`users` ( `id` INT(11) NOT NULL AUTO_INCREMENT, `firstname` TEXT NULL DEFAULT NULL , 
`lastname` TEXT NULL DEFAULT NULL , `usertype` VARCHAR(40) NULL DEFAULT NULL , 
`classnames` TEXT NULL DEFAULT NULL ,
`password` TEXT NULL DEFAULT NULL ,
PRIMARY KEY (`id`)) ENGINE = MyISAM;

--create classes table with the script below
CREATE TABLE `mitclassdb`.`classes` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NULL DEFAULT NULL , 
`venue` TEXT NULL DEFAULT NULL , `day` TEXT NULL DEFAULT NULL , `starttime` TIME NOT NULL, 
`stoptime` TIME NOT NULL, `noofparticipants` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = MyISAM

CREATE TABLE `mitclassdb`.`usersclass` ( `classesid` INT(11) NOT NULL , 
`usersid` INT(11) NOT NULL ) ENGINE = MyISAM;