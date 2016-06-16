/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : sojg

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-15 21:53:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(32) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为启用，0为禁用',
  `created` int(32) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('00000000000000000000000000000001', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '0');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `sorting` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `user_name` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名称',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Admin',
  `admin_name` varchar(64) NOT NULL DEFAULT '' COMMENT '审核管理员',
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `theme_ids` varchar(512) NOT NULL DEFAULT '' COMMENT 'theme_ids',
  `active_ids` varchar(512) NOT NULL DEFAULT '' COMMENT '相关活动',
  `cp_category_ids` varchar(512) NOT NULL DEFAULT '' COMMENT '相关企业',
  `headline` varchar(256) NOT NULL DEFAULT '' COMMENT '摘要',
  `image` varchar(128) NOT NULL DEFAULT '' COMMENT '封面图',
  `content` text NOT NULL COMMENT '新闻内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为显示，0为隐藏',
  `origin` varchar(64) NOT NULL DEFAULT '' COMMENT '来源地址',
  `original_author` varchar(32) NOT NULL DEFAULT '' COMMENT '原作者',
  `tag` varchar(32) NOT NULL DEFAULT '0' COMMENT '聚合标签',
  `approve_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `fav_count` int(8) NOT NULL DEFAULT '0' COMMENT '收藏量',
  `view_count` int(8) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `eval_count` int(8) NOT NULL DEFAULT '0' COMMENT '评论量',
  `like_count` int(8) NOT NULL DEFAULT '0' COMMENT '爱看',
  `dislike_count` int(8) NOT NULL DEFAULT '0' COMMENT '不爱看',
  `tab` varchar(32) NOT NULL,
  `created` int(32) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `area_code` varchar(32) NOT NULL DEFAULT '' COMMENT '新闻地点',
  `source` varchar(32) NOT NULL DEFAULT '' COMMENT '新闻来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('5', '小萌', '0', '1', '', '0', '', '1', '', '', '', '', '', '<p><span style=\"color: rgb(255, 0, 0);\"><em><strong>小萌是猪</strong></em></span></p>', '1', '', '', '0', '0', '0', '0', '0', '0', '0', '', '1465954948', '', '');
INSERT INTO `news` VALUES ('6', 'haha', '0', '1', '', '0', '', '15', '', '', '', '', '/upload/1606/1521/43/57615b70307d2.jpg', '<p>sdfdsf<br/></p>', '1', '', '', '0', '0', '0', '0', '0', '0', '0', '', '1465998195', '', '');

-- ----------------------------
-- Table structure for news_category
-- ----------------------------
DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '新闻类名称',
  `sorting` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为显示，0为隐藏',
  `created` int(32) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_category
-- ----------------------------
INSERT INTO `news_category` VALUES ('15', '小萌', '0', '1', '1465896220');
INSERT INTO `news_category` VALUES ('16', '哈哈', '0', '1', '1465896456');

-- ----------------------------
-- Table structure for upload
-- ----------------------------
DROP TABLE IF EXISTS `upload`;
CREATE TABLE `upload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` int(10) NOT NULL DEFAULT '0' COMMENT '用户类型，管理平台0',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `item_type` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `file` varchar(50) NOT NULL,
  `size` int(10) NOT NULL DEFAULT '0',
  `ext` varchar(5) NOT NULL,
  `thumbs` varchar(32) NOT NULL COMMENT '缩略图',
  `uniqid` varchar(15) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1->被使用，2->已删除',
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='上传表';

-- ----------------------------
-- Records of upload
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '手机',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0普通，1企业',
  `qq` varchar(16) NOT NULL DEFAULT '' COMMENT 'qq',
  `wechat` varchar(256) NOT NULL DEFAULT '' COMMENT '微信二维码',
  `fax` varchar(16) NOT NULL DEFAULT '' COMMENT '传真',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
  `realname` varchar(16) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `nickname` varchar(64) NOT NULL DEFAULT '' COMMENT '昵称',
  `birthday` char(8) NOT NULL DEFAULT '' COMMENT '出生年月',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0保密，1男，2女',
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login` int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `last_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `reg_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '注册IP',
  `work_area_code` varchar(32) NOT NULL DEFAULT '' COMMENT '工作地点',
  `work_area_name` varchar(64) NOT NULL DEFAULT '' COMMENT '工作地点',
  `work_address` varchar(256) NOT NULL DEFAULT '' COMMENT '工作地址',
  `personal_signature` text NOT NULL COMMENT '个性签名',
  `user_private` text NOT NULL COMMENT '用户对外权限',
  `is_vip` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是VIP',
  `company_id` int(11) NOT NULL DEFAULT '0' COMMENT '公司id',
  `refuse_friend_list` text COMMENT '拒绝好友申请的会员ID',
  `fans_count` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `view_count` int(11) NOT NULL DEFAULT '0' COMMENT '官网浏览量',
  `view_home_count` int(11) NOT NULL DEFAULT '0' COMMENT '个人主页浏览量',
  `fav_home_count` int(11) NOT NULL DEFAULT '0' COMMENT '个人主页搜藏量',
  `fav_count` int(11) NOT NULL DEFAULT '0' COMMENT '个人主页浏览量',
  `zuopin_count` int(11) NOT NULL DEFAULT '0' COMMENT '作品数量',
  `ukw_type_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '企业或者精英类别',
  `ukw_type_values` varchar(512) NOT NULL DEFAULT '',
  `ukw_style_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '擅长风格',
  `ukw_style_values` varchar(512) NOT NULL DEFAULT '',
  `ukw_major_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '擅长专业',
  `ukw_major_values` varchar(512) NOT NULL DEFAULT '',
  `ukw_project_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '擅长项目',
  `ukw_project_values` varchar(512) NOT NULL DEFAULT '',
  `jb_year` tinyint(1) NOT NULL DEFAULT '0' COMMENT '工作年限',
  `website_module_ids` text NOT NULL COMMENT '开启模块',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '会员积分',
  `approve_state` int(11) NOT NULL DEFAULT '1' COMMENT '状态：-2-已删除 -1-审核未通过 0-审核中 1-审核通过',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `vip_expire_time` int(11) NOT NULL DEFAULT '0' COMMENT 'vip过期时间',
  `vip_apply_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'vip申请状态 0-未申请 1-已申请',
  `sorting` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `sorting` (`sorting`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '小萌', '', '', '', '0', '', '', '', '', '', '', '', '0', '0', '0', '', '', '', '', '', '', '', '0', '0', null, '0', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '0', '', '0', '1', '0', '0', '0', '0');
