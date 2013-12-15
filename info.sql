
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `info` ;
CREATE SCHEMA IF NOT EXISTS `info` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `info` ;

-- -----------------------------------------------------
-- Table `info`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `info`.`user` ;

CREATE  TABLE IF NOT EXISTS `info`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '昵称' ,
  `avatar` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '头像' ,
  `location` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '地区' ,
  `gender` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '性别，m：男、f：女、n：未知' ,
  `qqid` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '新浪微博ID' ,
  `sinaid` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '腾讯微博ID' ,
  `site` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL COMMENT '1.sina; 2.qq' ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建日期' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户表';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


