/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : yii2advanced

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-01-05 18:30:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='授权条目对用户的指派情况（用户-角色的关联表）';

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('博客管理', '1', '1513938404');
INSERT INTO `auth_assignment` VALUES ('文章修改', '2', '1513935862');
INSERT INTO `auth_assignment` VALUES ('超级管理员', '1', '1513844622');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL COMMENT 'type=1是角色，type=2是权限和路由（取决于name字段的第一个字符有没有‘/’）',
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色和权限（用户存储角色、权限、路由）';

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/*', '2', null, null, null, '1487816675', '1487816675');
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/assignment/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/assignment/revoke', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/assignment/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/permission/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/role/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/assign', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/refresh', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/route/remove', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/create', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/update', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/rule/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/activate', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/change-password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/delete', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/request-password-reset', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/reset-password', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/signup', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/admin/user/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/article/update', '2', '文章修改', null, null, '1503397316', '1503397316');
INSERT INTO `auth_item` VALUES ('/batch/*', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/cruds', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/index', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/batch/models', '2', null, null, null, '1487839853', '1487839853');
INSERT INTO `auth_item` VALUES ('/blog/create', '2', null, null, null, '1515147084', '1515147084');
INSERT INTO `auth_item` VALUES ('/blog/delete', '2', null, null, null, '1515147084', '1515147084');
INSERT INTO `auth_item` VALUES ('/blog/index', '2', '博客列表', null, null, '1513937523', '1513937523');
INSERT INTO `auth_item` VALUES ('/blog/update', '2', null, null, null, '1515147084', '1515147084');
INSERT INTO `auth_item` VALUES ('/blog/view', '2', null, null, null, '1515147084', '1515147084');
INSERT INTO `auth_item` VALUES ('/debug/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/rbac/*', '2', null, null, null, '1513841490', '1513841490');
INSERT INTO `auth_item` VALUES ('/rbac/init', '2', null, null, null, '1513841490', '1513841490');
INSERT INTO `auth_item` VALUES ('/site/*', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/error', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/index', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/login', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/site/logout', '2', null, null, null, '1487816732', '1487816732');
INSERT INTO `auth_item` VALUES ('/user-backend/*', '2', null, null, null, '1513841490', '1513841490');
INSERT INTO `auth_item` VALUES ('/user-backend/create', '2', null, null, null, '1513839374', '1513839374');
INSERT INTO `auth_item` VALUES ('/user-backend/delete', '2', null, null, null, '1513839374', '1513839374');
INSERT INTO `auth_item` VALUES ('/user-backend/index', '2', null, null, null, '1513839374', '1513839374');
INSERT INTO `auth_item` VALUES ('/user-backend/signup', '2', null, null, null, '1513841490', '1513841490');
INSERT INTO `auth_item` VALUES ('/user-backend/update', '2', null, null, null, '1513839374', '1513839374');
INSERT INTO `auth_item` VALUES ('/user-backend/view', '2', null, null, null, '1513839374', '1513839374');
INSERT INTO `auth_item` VALUES ('博客管理', '1', null, null, null, '1513938113', '1513938113');
INSERT INTO `auth_item` VALUES ('文章修改', '2', '只针对文章的修改', null, null, '1513839434', '1513935571');
INSERT INTO `auth_item` VALUES ('超级管理员', '1', null, null, null, '1487817275', '1487817275');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='授权条目的层次关系（角色-权限的关联表）';

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/assignment/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/assignment/assign');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/assignment/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/assignment/revoke');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/assignment/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/default/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/default/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/create');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/delete');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/update');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/menu/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/assign');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/create');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/delete');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/remove');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/update');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/permission/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/assign');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/create');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/delete');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/remove');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/update');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/role/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/assign');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/create');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/refresh');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/route/remove');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/create');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/delete');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/update');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/rule/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/activate');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/change-password');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/delete');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/login');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/logout');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/request-password-reset');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/reset-password');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/signup');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/admin/user/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/batch/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/batch/cruds');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/batch/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/batch/models');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog/create');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog/delete');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog/index');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog/update');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/db-explain');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/download-mail');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/toolbar');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/debug/default/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/action');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/diff');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/preview');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/gii/default/view');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/site/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/site/error');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/site/index');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/site/login');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/site/logout');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '/site/logout');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/user-backend/create');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/user-backend/delete');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/user-backend/index');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/user-backend/update');
INSERT INTO `auth_item_child` VALUES ('文章修改', '/user-backend/view');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='规则';

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('文章', 0x4F3A33303A226261636B656E645C636F6D706F6E656E74735C41727469636C6552756C65223A333A7B733A343A226E616D65223B733A363A22E69687E7ABA0223B733A393A22637265617465644174223B693A313530333339373134363B733A393A22757064617465644174223B693A313530333339373134363B7D, '1503397146', '1503397146');

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否删除 1未删除 2已删除',
  `created_at` datetime NOT NULL COMMENT '添加时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '11111');
INSERT INTO `goods` VALUES ('2', '22222');
INSERT INTO `goods` VALUES ('3', '333');
INSERT INTO `goods` VALUES ('4', '444');
INSERT INTO `goods` VALUES ('5', '555');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '系统设置', null, null, '100', 'fa fa-wrench');
INSERT INTO `menu` VALUES ('2', '菜单列表', '1', '/admin/menu/index', '1', 'fa fa-bars');
INSERT INTO `menu` VALUES ('3', '角色列表', '1', '/admin/role/index', '2', 'fa fa-users');
INSERT INTO `menu` VALUES ('4', '用户管理', '1', '/admin/user/index', '3', 'fa fa-user');
INSERT INTO `menu` VALUES ('5', '权限列表', '1', '/admin/permission/index', '6', 'fa fa-lock');
INSERT INTO `menu` VALUES ('6', '路由列表', '1', '/admin/route/index', '4', 'fa fa-internet-explorer');
INSERT INTO `menu` VALUES ('7', '规则列表', '1', '/admin/rule/index', '5', 'fa fa-list');
INSERT INTO `menu` VALUES ('8', '分配权限', '1', '/admin/assignment/index', '7', 'fa fa-unlock');
INSERT INTO `menu` VALUES ('9', '权限管理', null, '/admin/default/index', '1', null);
INSERT INTO `menu` VALUES ('10', '权限控制', '9', '/admin/default/index', '1', null);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of migration
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'qw73GDuSx8RpVzPeAplnwzfqMtUg7jQU', '$2y$13$Tbg8MyIdpfLw84yVtbxwF.Uj1L3dFQaUMdWM2p9aBC35c2iYQufQe', null, '2689182194@qq.com', '10', '10', '1502176685', '1502176685');

-- ----------------------------
-- Table structure for user_backend
-- ----------------------------
DROP TABLE IF EXISTS `user_backend`;
CREATE TABLE `user_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_backend
-- ----------------------------
INSERT INTO `user_backend` VALUES ('1', 'test1', '8yXsAgqt6V5ZqxzdWY5ShQMYMIxG6QRW', '$2y$13$Tbg8MyIdpfLw84yVtbxwF.Uj1L3dFQaUMdWM2p9aBC35c2iYQufQe', '2689182194@qq.com', '2017-08-21 08:46:46', '2017-08-21 08:46:47');
INSERT INTO `user_backend` VALUES ('2', 'test2', 'T7fu2Pc_tZygfCpf9xW7bzF4-9v3Fmjq', '$2y$13$lV85aWfHqsm3woHEvLH.o.l3r6qPgWVUgSvyjyNjeASv4nchtScme', '1963047941@qq.com', '2017-08-22 07:53:29', '2017-08-22 07:53:29');
