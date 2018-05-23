/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-05-23 20:42:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `admin_id` varchar(255) NOT NULL COMMENT '后台用户账号',
  `password` varchar(255) NOT NULL COMMENT '后台用户密码',
  `admin_name` varchar(255) NOT NULL COMMENT '后台用户名称',
  `admin_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '后台用户登录状态 0==可登录  1==禁止登录',
  `remember_token` varchar(255) NOT NULL COMMENT 'laravel自带需要这个字段',
  `admin_created_at` bigint(20) NOT NULL COMMENT '后台用户创建时间',
  `admin_updated_at` bigint(20) NOT NULL COMMENT '后台用户更新时间',
  `admin_deleted_at` bigint(20) NOT NULL DEFAULT '0' COMMENT '后台用户被删除的时间 0==未被删除状态正常  时间戳==已被删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'admin', '$2y$10$.WFACOEPP8A4wUT40qLISuOW3SViraGaGyTGGUx7hoHz0V2EcjpeS', 'Admin', '0', 'h7Irr1a6LD6cdL72ZXFIQ6znh7fPNwcqYx2AiW9Y4tyqehfcXxI8gbBKrmxJ', '1527055499', '1527055499', '0');

-- ----------------------------
-- Table structure for tb_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id自增 0表示一级菜单 否则都是二级',
  `menu_url` varchar(255) NOT NULL COMMENT '菜单URL 跳到哪个页面',
  `menu_name` varchar(255) NOT NULL COMMENT '菜单名称',
  `parent_id` int(11) NOT NULL COMMENT '父id 0==一级菜单  否则都是二级菜单',
  `icon` varchar(255) NOT NULL DEFAULT '&#xe653;' COMMENT '菜单图标',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序 数值越高排越前',
  `created_at` bigint(20) NOT NULL COMMENT '菜单创建时间',
  `updated_at` bigint(20) NOT NULL COMMENT '菜单更新时间',
  `deleted_at` bigint(20) NOT NULL DEFAULT '0' COMMENT '菜单是否删除 0==未删除  时间戳==已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of tb_menu
-- ----------------------------
INSERT INTO `tb_menu` VALUES ('1', '/robot/index', '机器人管理', '0', '&#xe653;', '0', '1527068387', '1527068387', '0');
INSERT INTO `tb_menu` VALUES ('2', '/robot/index', '机器人列表', '1', '&#xe653;', '0', '1527068506', '1527068506', '0');
INSERT INTO `tb_menu` VALUES ('3', '/robot/index', '机器人详情', '1', '&#xe653;', '0', '1527068506', '1527068506', '0');
INSERT INTO `tb_menu` VALUES ('4', '/robot/index', '系统设置', '0', '&#xe67c;', '0', '1527068506', '1527068506', '0');

-- ----------------------------
-- Table structure for tb_menu_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu_admin`;
CREATE TABLE `tb_menu_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `admin_id` int(11) NOT NULL COMMENT 'admin 表的自增id',
  `menu_id` int(11) NOT NULL COMMENT '菜单menu表里的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台用户拥有菜单表';

-- ----------------------------
-- Records of tb_menu_admin
-- ----------------------------
INSERT INTO `tb_menu_admin` VALUES ('1', '1', '1');
INSERT INTO `tb_menu_admin` VALUES ('2', '1', '2');
INSERT INTO `tb_menu_admin` VALUES ('3', '1', '3');
INSERT INTO `tb_menu_admin` VALUES ('4', '1', '4');

-- ----------------------------
-- Table structure for tb_robot
-- ----------------------------
DROP TABLE IF EXISTS `tb_robot`;
CREATE TABLE `tb_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `robot_id` int(11) NOT NULL COMMENT '机器人id(类似玩家id且不能与玩家id重复)',
  `robot_name` varchar(255) NOT NULL COMMENT '机器人名称',
  `robot_img` varchar(255) NOT NULL COMMENT '机器人头像图片地址',
  `robot_gold` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '机器人的金币（或者是说是积分）',
  `robot_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '机器人工作状态 0==正常可工作  1==工作中  2==禁止工作',
  `robot_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '机器人服务模式 0==主动陪打 1==被动陪打 2==占座',
  `work_time_start` datetime NOT NULL COMMENT '工作时间段起始时间',
  `work_time_end` datetime NOT NULL COMMENT '工作时间段 结束时间',
  `change_desk` int(11) NOT NULL COMMENT '换桌局数 玩多少局换桌',
  `into_intaval` int(11) NOT NULL COMMENT '开好一个桌 机器人多少秒后进入此桌',
  `leave_intavel` int(11) NOT NULL COMMENT '机器人准备离桌 多少秒后离桌',
  `lucky_number` int(11) NOT NULL COMMENT '幸运值 0-100 机器人进行牌局干扰  100为100%干扰',
  `created_at` bigint(20) NOT NULL COMMENT '机器人创建时间',
  `updated_at` bigint(20) NOT NULL COMMENT '更新时间',
  `deleted_at` bigint(20) NOT NULL DEFAULT '0' COMMENT '机器人是否删除 0==未被删除 时间戳==已被删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='机器人表';

-- ----------------------------
-- Records of tb_robot
-- ----------------------------
INSERT INTO `tb_robot` VALUES ('1', '12345', '机器人-罗伯特', '暂无头像', '345', '0', '0', '2018-05-23 20:25:06', '2018-05-23 20:25:11', '5', '8', '8', '50', '1527078340', '1527078340', '0');
INSERT INTO `tb_robot` VALUES ('2', '22345', '机器人-盖伦', '暂无头像', '100', '1', '1', '2018-05-23 20:27:07', '2018-05-23 20:27:10', '3', '7', '7', '100', '1527078340', '1527078340', '0');
INSERT INTO `tb_robot` VALUES ('3', '32345', '机器人-艾利', '暂无头像', '0', '2', '0', '2018-05-23 20:28:01', '2018-05-23 20:28:04', '2', '6', '6', '90', '1527078340', '1527078340', '0');
INSERT INTO `tb_robot` VALUES ('4', '42345', '机器人-张三', '暂无头像', '57', '0', '2', '2018-05-23 20:29:08', '2018-05-23 20:29:11', '8', '9', '9', '0', '1527078340', '1527078340', '0');
