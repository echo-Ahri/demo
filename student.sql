/*
Navicat MySQL Data Transfer

Source Server         : Ahri
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : student

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2022-08-21 10:31:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_name` varchar(10) NOT NULL DEFAULT '' COMMENT '学生姓名',
  `stu_class` varchar(20) NOT NULL DEFAULT '' COMMENT '班级',
  `stu_jz` varchar(10) NOT NULL DEFAULT '' COMMENT '家长',
  `rx_time` int(11) NOT NULL COMMENT '入学时间',
  `by_time` int(11) NOT NULL COMMENT '毕业时间',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `stu_name` (`stu_name`) USING BTREE,
  KEY `stu_jz` (`stu_jz`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生表';

-- ----------------------------
-- Records of student
-- ----------------------------

-- ----------------------------
-- Table structure for `stu_data`
-- ----------------------------
DROP TABLE IF EXISTS `stu_data`;
CREATE TABLE `stu_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL COMMENT '学生表id',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '资源地址',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '权重',
  `desc` varchar(150) NOT NULL DEFAULT '' COMMENT '描述',
  `fs_time` int(11) NOT NULL COMMENT '发生时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '类型 1图片 2视频 3文件',
  PRIMARY KEY (`id`),
  KEY `stu_id` (`stu_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='信息表';

-- ----------------------------
-- Records of stu_data
-- ----------------------------
