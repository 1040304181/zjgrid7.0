-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 09 月 03 日 00:36
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zjdata`
--

-- --------------------------------------------------------

--
-- 表的结构 `self_full_test`
--

CREATE TABLE IF NOT EXISTS `self_full_test` (
  `ID` int(50) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `number` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT '学号',
  `name` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT '姓名',
  `translation` mediumtext COLLATE utf8_bin COMMENT '简介',
  `time` datetime DEFAULT NULL COMMENT '填表时间',
  `score` double DEFAULT NULL COMMENT '绩效',
  `Ffruit` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT '最喜欢的水果',
  `Lfruit` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT '喜欢的水果',
  `Fnation` char(20) COLLATE utf8_bin DEFAULT NULL COMMENT '世界上最有潜力的国家',
  `Lnation` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT '你喜欢那些国家',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `self_full_test`
--

INSERT INTO `self_full_test` (`ID`, `number`, `name`, `translation`, `time`, `score`, `Ffruit`, `Lfruit`, `Fnation`, `Lnation`, `sub`) VALUES
(1, '10140122', '巨扩展', '毕业于兰州理工大学，带领大部分一块偷懒，然而这需要大量的脑力劳动。把人尽量从机械式劳动中解放出来。能省一步是一步。要加快信息查询和录入速度方便信息共享。', '2017-08-27 19:12:51', 99.99, 'A:苹果', 'B:梨子;;C:桃子;;', 'A:中国', 'A:中国;;B:美国;;C:日本;;G:加拿大;;', NULL),
(2, '10140122', '巨扩展', '毕业于兰州理工大学，带领大部分一块偷懒，然而这需要大量的脑力劳动。把人尽量从机械式劳动中解放出来。能省一步是一步。要加快信息查询和录入速度方便信息共享。', '2017-08-27 19:12:51', 99.99, 'A:苹果', 'A:苹果;;B:梨子;;C:桃子;;', 'A:中国', 'B:美国;;C:日本;;D:俄罗斯;;', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tool`
--

CREATE TABLE IF NOT EXISTS `tool` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `toolname` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '工具名',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin NOT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tool`
--

INSERT INTO `tool` (`ID`, `toolname`, `type`, `num`, `unit`, `cause`, `borrowtime`, `borrower`, `tel`, `borrowadmin`, `deadline`, `returntime`, `returnadmin`, `mortgage`, `note`, `sub`) VALUES
(1, '免爬器充电器', '通用', 2, '个', '日常检修使用', '2017-01-07 00:00:00', '梁学鑫', '13698263688', '李靖玮', '2017-12-31 00:00:00', NULL, NULL, NULL, NULL, 0),
(2, '安全围栏', '通用', 1, '组', '施工用', '2017-02-17 00:00:00', '逍遥', '17723131186', '李靖玮', '2017-02-20 00:00:00', NULL, NULL, NULL, NULL, 0),
(3, '焊机', 'rirnad', 1, '台', '施工', '2017-02-19 00:00:00', '肖红', '13698263688', '李松', '2017-03-19 00:00:00', NULL, NULL, NULL, NULL, 0),
(4, '焊接面罩', 'rirnad', 1, '台', '施工', '2017-02-19 00:00:00', '肖红', '13698263688', '李松', '2017-03-19 00:00:00', NULL, NULL, NULL, NULL, 0),
(5, ' 焊条', '大西洋', 1, '把', '施工', '2017-02-19 00:00:00', '肖红', '13698263688', '李松', '2017-03-19 00:00:00', NULL, NULL, NULL, NULL, 0),
(6, ' 焊机面罩', '3M', 1, '把', '施工', '2017-02-19 00:00:00', '肖红', '13698263688', '李松', '2017-03-19 00:00:00', NULL, NULL, NULL, NULL, 0),
(7, ' 撬棍', '1.5M', 1, '条', '风机维修', '2017-03-01 00:00:00', '苏挺', '18313038119', '巨扩展', '2017-03-04 00:00:00', NULL, NULL, NULL, NULL, 0),
(8, '手锤', '普通', 1, '把', '施工', '2017-03-04 00:00:00', '肖红', '13658436597', '易浩', '2017-03-11 00:00:00', NULL, NULL, NULL, NULL, 0),
(9, '潜水泵', '12', 1, '副', '加注液压油', '2017-03-10 10:40:18', '巨扩展', '15883456521', '曾飞', '2017-03-17 10:40:24', NULL, NULL, '30元人民币', '没有', 0),
(10, '防护眼镜2', '普通型', 1, '只', '加注液压油', '2017-03-10 10:41:03', '巨扩展', '15883456521', '曾飞', '2017-03-17 10:41:13', NULL, NULL, '30元人民币', '没有', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `login_time` int(10) DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(32) DEFAULT NULL COMMENT '登录IP',
  `login_counts` int(10) NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `login_time`, `login_ip`, `login_counts`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1503834862, '127.0.0.1', 195);

-- --------------------------------------------------------

--
-- 表的结构 `zj_document_register_form`
--

CREATE TABLE IF NOT EXISTS `zj_document_register_form` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `NO` int(10) DEFAULT NULL COMMENT '编号',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returner` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还人',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zj_key_register_form`
--

CREATE TABLE IF NOT EXISTS `zj_key_register_form` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `NO` int(10) DEFAULT NULL COMMENT '编号',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returner` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还人',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zj_other_register_form`
--

CREATE TABLE IF NOT EXISTS `zj_other_register_form` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `NO` int(10) DEFAULT NULL COMMENT '编号',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returner` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还人',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zj_self_defined_forms`
--

CREATE TABLE IF NOT EXISTS `zj_self_defined_forms` (
  `formszname` varchar(15) NOT NULL,
  `formsyname` varchar(15) NOT NULL,
  `fieldzname` varchar(15) NOT NULL,
  `fieldyname` varchar(15) NOT NULL,
  `char_type` varchar(15) NOT NULL,
  `char_size` int(15) NOT NULL,
  `show_width` int(10) NOT NULL,
  `values` varchar(255) NOT NULL,
  `document` int(2) NOT NULL,
  `sign` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zj_self_defined_forms`
--

INSERT INTO `zj_self_defined_forms` (`formszname`, `formsyname`, `fieldzname`, `fieldyname`, `char_type`, `char_size`, `show_width`, `values`, `document`, `sign`) VALUES
('完整测试', 'app', '整数', 'zs', 'int', 0, 0, '', 0, 0),
('完整测试', 'app', '短文本', 'duan', 'char', 0, 0, '', 0, 0),
('完整测试', 'app', '长文本', 'cwb', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'app', '时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'app', '小数', 'double', 'double', 0, 0, '', 0, 0),
('完整测试', 'app', '单选', 'single', 'radio', 0, 0, '', 0, 0),
('完整测试', 'app', '复选', 'fx', 'checkbox', 0, 0, '', 0, 0),
('完整测试', 'app', '下拉单选', 'xldx', 'select', 0, 0, '', 0, 0),
('完整测试', 'app', '下拉复选', 'lbdx', 'selectmul', 0, 0, '', 0, 0),
('完整测试', 'app', '标签', 'lable', 'mylabel', 0, 0, '模拟单选题:1、左右潜力的国家', 0, 0),
('完整测试', 'app', '第一题', 'yi', 'select', 0, 0, 'A:中国;B美国', 0, 0),
('完整测试', 'app', '整数', 'zs', 'int', 0, 0, '', 0, 0),
('完整测试', 'app', '短文本', 'duan', 'char', 0, 0, '', 0, 0),
('完整测试', 'app', '长文本', 'cwb', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'app', '时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'app', '小数', 'double', 'double', 0, 0, '', 0, 0),
('完整测试', 'app', '单选', 'single', 'radio', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '复选', 'fx', 'checkbox', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉单选', 'xldx', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉复选', 'lbdx', 'selectmul', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '标签', 'lable', 'mylabel', 0, 0, '模拟单选题:1、左右潜力的国家', 0, 0),
('完整测试', 'app', '第一题', 'yi', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '整数', 'zs', 'int', 0, 0, '', 0, 0),
('完整测试', 'app', '短文本', 'duan', 'char', 0, 0, '', 0, 0),
('完整测试', 'app', '长文本', 'cwb', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'app', '时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'app', '小数', 'double', 'double', 0, 0, '5', 0, 0),
('完整测试', 'app', '单选', 'single', 'radio', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '复选', 'fx', 'checkbox', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉单选', 'xldx', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉复选', 'lbdx', 'selectmul', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '标签', 'lable', 'mylabel', 0, 0, '模拟单选题:1、左右潜力的国家', 0, 0),
('完整测试', 'app', '第一题', 'yi', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '整数', 'zs', 'int', 0, 0, '', 0, 0),
('完整测试', 'app', '短文本', 'duan', 'char', 0, 0, '', 0, 0),
('完整测试', 'app', '长文本', 'cwb', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'app', '时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'app', '小数', 'double', 'double', 0, 0, '', 0, 0),
('完整测试', 'app', '单选', 'single', 'radio', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '复选', 'fx', 'checkbox', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉单选', 'xldx', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '下拉复选', 'lbdx', 'selectmul', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('完整测试', 'app', '标签', 'lable', 'mylabel', 0, 0, '模拟单选题:1、左右潜力的国家', 0, 0),
('完整测试', 'app', '第一题', 'yi', 'select', 0, 0, 'A:中国;B美国;C:俄罗斯', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '', '', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '风机编号', 'fengjibianhao', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '开始时间', 'kaishishijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '结束时间', 'jieshushijian', 'datetime', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '持续时间', 'chixushijian', 'double', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '损失电量', 'sunshidianliang', 'int', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '故障名称', 'guzhangmingchen', 'char', 0, 0, '', 0, 0),
('风机故障记录', 'fengjiguzhangji', '故障系统', 'guzhangxitong', 'select', 0, 0, '远程控制系统;通讯系统;风轮;变桨调节系统;传动变速系统;发电机系统;液压系统;偏航系统;机舱及塔架;电气控制系统;变频系统;电源系统;无', 0, 0),
('风机故障', 'gzb', '风机编号', 'bh', 'char', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'eaf', 'q', 'mediumtext', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'adfsd', 'w', 'datetime', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'zdf', 'r', 'double', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'dfasdf', 'e', 'radio', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'fasdfa', 't', 'checkbox', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asd', 'y', 'select', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asdq', 'yu', 'selectmul', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'z', 'yu', 'mylabel', 0, 0, 'qwegbssdfdrew4rh', 0, 0),
('风机故障', 'gzb', '风机编号', 'bh', 'char', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'eaf', 'q', 'mediumtext', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'adfsd', 'w', 'datetime', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'zdf', 'r', 'double', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'dfasdf', 'e', 'radio', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'fasdfa', 't', 'checkbox', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asd', 'y', 'select', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asdq', 'yu', 'selectmul', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'z', 'yu', 'mylabel', 0, 0, 'qwegbssdfdrew4rh', 0, 0),
('风机故障', 'gzb', '风机编号', 'bh', 'char', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'eaf', 'q', 'mediumtext', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'adfsd', 'w', 'datetime', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'zdf', 'r', 'double', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'dfasdf', 'e', 'radio', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'fasdfa', 't', 'checkbox', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asd', 'y', 'select', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asdq', 'yu', 'selectmul', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'z', 'yu2', 'mylabel', 0, 0, 'qwegbssdfdrew4rh', 0, 0),
('风机故障', 'gzb', '风机编号', 'bh', 'char', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'eaf', 'q', 'mediumtext', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'adfsd', 'w', 'datetime', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'zdf', 'r', 'double', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'dfasdf', 'e', 'radio', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'fasdfa', 't', 'checkbox', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asd', 'y', 'select', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asdq', 'yu', 'selectmul', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'z', 'yu2', 'mylabel', 0, 0, 'qwegbssdfdrew4rh', 0, 0),
('风机故障', 'gzb', '风机编号', 'bh', 'char', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'eaf', 'q', 'mediumtext', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'adfsd', 'w', 'datetime', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'zdf', 'r', 'double', 0, 0, '', 0, 0),
('风机故障', 'gzb', 'dfasdf', 'e', 'radio', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'fasdfa', 't', 'checkbox', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asd', 'y', 'select', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'asdq', 'yu', 'selectmul', 0, 0, 'A:橘子;B:梨子;C:苹果', 0, 0),
('风机故障', 'gzb', 'z', 'yu2', 'mylabel', 0, 0, 'qwegbssdfdrew4rh', 0, 0),
('完整的测试', 'FULL_TEST', '整数', 'integer', 'int', 0, 0, '', 0, 0),
('完整的测试', 'FULL_TEST', '姓名', 'name', 'char', 0, 0, '', 0, 1),
('完整的测试', 'FULL_TEST', '毕业学校', 'college', 'mediumtext', 0, 0, '', 0, 0),
('完整的测试', 'FULL_TEST', '毕业时间', 'ctime', 'datetime', 0, 0, '', 0, 0),
('完整的测试', 'FULL_TEST', '成绩', 'score', 'double', 0, 0, '', 0, 0),
('完整的测试', 'FULL_TEST', '最喜欢的运动', 'single_select', 'radio', 0, 0, 'A:台球;B:乒乓球;C:篮球;D:足球', 0, 0),
('完整的测试', 'FULL_TEST', '喜欢的运动', '', 'checkbox', 0, 0, 'A:台球;B:乒乓球;C:篮球;D:足球', 0, 0),
('完整的测试', 'FULL_TEST', '最喜欢的国家', '', 'select', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整的测试', 'FULL_TEST', '喜欢的国家', '', 'selectmul', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整测试', 'full_test', '学号', 'number', 'int', 0, 0, '', 0, 0),
('完整测试', 'full_test', '姓名', 'name', 'char', 0, 0, '', 0, 0),
('完整测试', 'full_test', '简介', 'translation', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'full_test', '填表时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'full_test', '绩效', 'score', 'double', 0, 0, '', 0, 0),
('完整测试', 'full_test', '最喜欢的水果', 'Ffruit', 'radio', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '喜欢的水果', 'Lfruit', 'checkbox', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '世界上最有潜力的国家', 'Fnation', 'select', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整测试', 'full_test', '你喜欢那些国家', 'Lnation', 'selectmul', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯;E:印度;F:法国;G:加拿大', 0, 0),
('完整测试', 'full_test', '学号', 'number', 'int', 0, 0, '', 0, 0),
('完整测试', 'full_test', '姓名', 'name', 'char', 0, 0, '', 0, 1),
('完整测试', 'full_test', '简介', 'translation', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'full_test', '填表时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'full_test', '绩效', 'score', 'double', 0, 0, '', 0, 0),
('完整测试', 'full_test', '最喜欢的水果', 'Ffruit', 'radio', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '喜欢的水果', 'Lfruit', 'checkbox', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '世界上最有潜力的国家', 'Fnation', 'select', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整测试', 'full_test', '你喜欢那些国家', 'Lnation', 'selectmul', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯;E:印度;F:法国;G:加拿大', 0, 0),
('完整测试', 'full_test', '学号', 'number', 'int', 0, 0, '', 0, 0),
('完整测试', 'full_test', '姓名', 'name', 'char', 0, 0, '', 0, 1),
('完整测试', 'full_test', '简介', 'translation', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'full_test', '填表时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'full_test', '绩效', 'score', 'double', 0, 0, '', 0, 0),
('完整测试', 'full_test', '最喜欢的水果', 'Ffruit', 'radio', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '喜欢的水果', 'Lfruit', 'checkbox', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '世界上最有潜力的国家', 'Fnation', 'select', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整测试', 'full_test', '你喜欢那些国家', 'Lnation', 'selectmul', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯;E:印度;F:法国;G:加拿大', 0, 0),
('完整测试', 'full_test', '学号', 'number', 'int', 0, 0, '', 0, 0),
('完整测试', 'full_test', '姓名', 'name', 'char', 0, 0, '', 0, 1),
('完整测试', 'full_test', '简介', 'translation', 'mediumtext', 0, 0, '', 0, 0),
('完整测试', 'full_test', '填表时间', 'time', 'datetime', 0, 0, '', 0, 0),
('完整测试', 'full_test', '绩效', 'score', 'double', 0, 0, '', 0, 0),
('完整测试', 'full_test', '最喜欢的水果', 'Ffruit', 'radio', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '喜欢的水果', 'Lfruit', 'checkbox', 0, 0, 'A:苹果;B:梨子;C:桃子;D:杏子', 0, 0),
('完整测试', 'full_test', '世界上最有潜力的国家', 'Fnation', 'select', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯', 0, 0),
('完整测试', 'full_test', '你喜欢那些国家', 'Lnation', 'selectmul', 0, 0, 'A:中国;B:美国;C:日本;D:俄罗斯;E:印度;F:法国;G:加拿大', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zj_spare_register_form`
--

CREATE TABLE IF NOT EXISTS `zj_spare_register_form` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `NO` int(10) DEFAULT NULL COMMENT '编号',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returner` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还人',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zj_tool_register_form`
--

CREATE TABLE IF NOT EXISTS `zj_tool_register_form` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `NO` int(10) DEFAULT NULL COMMENT '编号',
  `type` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '型号',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `unit` varchar(6) COLLATE utf8_bin DEFAULT NULL COMMENT '单位',
  `cause` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '事由',
  `borrowtime` datetime DEFAULT NULL COMMENT '借用时间',
  `borrower` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用人',
  `tel` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `borrowadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '借用管理人',
  `deadline` datetime DEFAULT NULL COMMENT '最后期限',
  `returntime` datetime DEFAULT NULL COMMENT '归还时间',
  `returner` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还人',
  `returnadmin` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT '归还管理人',
  `mortgage` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '抵押',
  `note` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `sub` tinyint(1) DEFAULT NULL COMMENT '提交',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `zj_tool_register_form`
--

INSERT INTO `zj_tool_register_form` (`ID`, `name`, `NO`, `type`, `num`, `unit`, `cause`, `borrowtime`, `borrower`, `tel`, `borrowadmin`, `deadline`, `returntime`, `returner`, `returnadmin`, `mortgage`, `note`, `sub`) VALUES
(1, 'sdfg', 112, 'adfg', 3, '1234', 'q4t', '2017-07-15 17:13:03', '23r', '15883456521', 'q345', '2017-07-26 17:13:14', NULL, NULL, NULL, '12', 'qwertaqe', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
