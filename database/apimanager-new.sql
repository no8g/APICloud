/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : apimanager

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-12-07 14:18:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api
-- ----------------------------
DROP TABLE IF EXISTS `api`;
CREATE TABLE `api` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '接口编号',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '接口分类id',
  `number` varchar(255) NOT NULL COMMENT '接口编号',
  `url_name` varchar(255) NOT NULL COMMENT '请求地址',
  `name` varchar(255) NOT NULL COMMENT '接口名',
  `description` varchar(255) DEFAULT NULL COMMENT '接口描述',
  `parameter` text COMMENT '请求参数{所有的主求参数,以json格式在此存放}',
  `remark` text COMMENT '备注',
  `res` text COMMENT '返回值',
  `update_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_name` varchar(255) DEFAULT NULL,
  `last_user_id` int(11) unsigned NOT NULL COMMENT '最后修改uid',
  `state` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '{1:正常,0:删除}',
  `type` char(11) NOT NULL COMMENT '请求方式',
  `rank` int(11) NOT NULL DEFAULT '0' COMMENT '排序(值越大,越靠前)',
  PRIMARY KEY (`id`),
  KEY `number` (`number`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='接口明细表';


-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(3) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(3) NOT NULL DEFAULT '1',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ----------------------------
-- Table structure for custom
-- ----------------------------
DROP TABLE IF EXISTS `custom`;
CREATE TABLE `custom` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `custom_name` varchar(255) NOT NULL,
  `url_name` varchar(255) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_name` (`custom_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;




-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(4) NOT NULL,
  `last_login` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `custom_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232F297A57A5A743894A0E4A801FC3', '1', '2015-12-07 14:10:50', '5');

