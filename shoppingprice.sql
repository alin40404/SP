-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 09 日 21:06
-- 服务器版本: 5.5.29
-- PHP 版本: 5.3.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shoppingprice`
--

-- --------------------------------------------------------

--
-- 表的结构 `sp_ad`
--

CREATE TABLE IF NOT EXISTS `sp_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `place` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:中部 1:头部 2:左侧 3:右侧 4:底部',
  `content` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_closable` tinyint(1) NOT NULL DEFAULT '0',
  `ctime` int(11) DEFAULT NULL,
  `mtime` int(11) DEFAULT NULL,
  `display_order` smallint(2) NOT NULL DEFAULT '0',
  `display_type` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_article`
--

CREATE TABLE IF NOT EXISTS `sp_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `content` text,
  `pid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `img_url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_assortment`
--

CREATE TABLE IF NOT EXISTS `sp_assortment` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aname` varchar(50) NOT NULL COMMENT '品种类别名称',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `sp_assortment`
--

INSERT INTO `sp_assortment` (`aid`, `aname`) VALUES
(1, '食品类'),
(10, '生活用品类');

-- --------------------------------------------------------

--
-- 表的结构 `sp_category`
--

CREATE TABLE IF NOT EXISTS `sp_category` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `cname` varchar(20) NOT NULL COMMENT '商品名称',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `sp_category`
--

INSERT INTO `sp_category` (`cid`, `cname`) VALUES
(40, '菜篮子批发'),
(42, '菜篮子零售'),
(50, '粮油'),
(51, '牲猪 ');

-- --------------------------------------------------------

--
-- 表的结构 `sp_friend_link`
--

CREATE TABLE IF NOT EXISTS `sp_friend_link` (
  `link_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `position_id` tinyint(3) unsigned NOT NULL,
  `link_type` tinyint(1) unsigned NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT '1',
  `link_code` varchar(150) NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `position_id` (`position_id`,`link_type`,`sort_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sp_friend_link`
--

INSERT INTO `sp_friend_link` (`link_id`, `site_name`, `position_id`, `link_type`, `link_url`, `sort_order`, `link_code`) VALUES
(1, '嫁娶网', 101, 1, 'http://www.ijiaqu.com', 1, '嫁娶网'),
(2, '极好居', 101, 1, 'http://www.jihaoju.com', 2, '极好居'),
(3, '青番茄', 101, 1, 'http://www.qfanqie.com', 3, '青番茄'),
(4, '青番茄', 101, 1, 'http://www.tp-coupon.com', 4, 'TP-COUPON');

-- --------------------------------------------------------

--
-- 表的结构 `sp_goods`
--

CREATE TABLE IF NOT EXISTS `sp_goods` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `gname` varchar(20) NOT NULL COMMENT '商品名称',
  `gimg` varchar(255) DEFAULT NULL COMMENT '商品图片',
  `gdescription` text COMMENT '商品描述',
  `vid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`gid`),
  UNIQUE KEY `gname_2` (`gname`),
  KEY `gname` (`gname`),
  KEY `fk_goods_v` (`vid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=189 ;

--
-- 转存表中的数据 `sp_goods`
--

INSERT INTO `sp_goods` (`gid`, `gname`, `gimg`, `gdescription`, `vid`) VALUES
(1, '干水菜心', 'Public/upload/img/goods/20130408190342171.jpg', '干水菜心，蔬菜的一种', 2),
(2, '本地菜心', 'Public/upload/img/goods/20130408200853453.jpg', '蔬菜的一种，本地菜心', 2),
(3, '矮脚白菜(奶白菜）', 'Public/upload/img/goods/20130408190419754.jpg', '蔬菜的一种', 2),
(4, '大芥菜', 'Public/upload/img/goods/20130408190442808.jpg', '蔬菜的一种', 2),
(5, '西生菜', 'Public/upload/img/goods/20130408190825483.jpg', '西生菜，蔬菜的一种', 2),
(6, '红菜心（红菜苔）', 'Public/upload/img/goods/20130408191114280.jpg', '红菜心（红菜苔），蔬菜的一种', 2),
(7, '小塘白菜（上海青）', 'Public/upload/img/goods/20130407230701281.jpg', '小塘白菜（上海青），蔬菜的一种', 2),
(8, '白菜心', 'Public/upload/img/goods/20130408190956680.jpg', '蔬菜的一种', 2),
(9, '油麦菜', 'Public/upload/img/goods/20130408191128953.jpg', '蔬菜的一种', 2),
(10, '甜墨豆', 'Public/upload/img/goods/20130408133419135.jpg', '蔬菜的一种', 2),
(17, '包心芥菜 ', 'Public/images/goods_demo.png', '', 2),
(18, '春菜', 'Public/images/goods_demo.png', '', 2),
(19, '生菜', 'Public/images/goods_demo.png', '', 2),
(20, ' 菠菜', 'Public/images/goods_demo.png', '', 2),
(21, '绍菜(大白菜)', 'Public/images/goods_demo.png', '', 2),
(22, ' 西洋菜', 'Public/images/goods_demo.png', '', 2),
(23, '西红柿', 'Public/images/goods_demo.png', '', 2),
(24, '芥兰', 'Public/images/goods_demo.png', '', 2),
(25, '娃娃菜', 'Public/images/goods_demo.png', '', 2),
(26, '红萝卜', 'Public/images/goods_demo.png', '', 2),
(27, '白萝卜', 'Public/images/goods_demo.png', '', 2),
(28, ' 椰菜花', 'Public/images/goods_demo.png', '', 2),
(29, '西兰花', 'Public/images/goods_demo.png', '', 2),
(30, '水空心菜', 'Public/images/goods_demo.png', '', 2),
(31, '旱空心菜', 'Public/images/goods_demo.png', '', 2),
(32, '青瓜', 'Public/images/goods_demo.png', '', 2),
(33, '茄瓜', 'Public/images/goods_demo.png', '', 2),
(34, '白瓜 ', 'Public/images/goods_demo.png', '', 2),
(35, '节瓜', 'Public/images/goods_demo.png', '', 2),
(36, '青豆角', 'Public/images/goods_demo.png', '', 2),
(37, '白豆角', 'Public/images/goods_demo.png', '', 2),
(38, '土豆', 'Public/images/goods_demo.png', '', 2),
(39, '潺菜', 'Public/images/goods_demo.png', '', 2),
(40, '莴笋', 'Public/images/goods_demo.png', '', 2),
(41, '紫椰菜', 'Public/images/goods_demo.png', '', 2),
(42, '枸杞菜', 'Public/images/goods_demo.png', '', 2),
(43, '西芹', 'Public/images/goods_demo.png', '', 2),
(44, '蕃薯叶', 'Public/images/goods_demo.png', '', 2),
(45, '辣椒叶', 'Public/images/goods_demo.png', '', 2),
(46, '莙荙菜', 'Public/images/goods_demo.png', '', 2),
(47, '红苋菜', 'Public/images/goods_demo.png', '', 2),
(48, '白苋菜', 'Public/images/goods_demo.png', '', 2),
(49, '大蒜', 'Public/images/goods_demo.png', '', 2),
(50, '蒜心', 'Public/images/goods_demo.png', '', 2),
(51, '南瓜苗', 'Public/images/goods_demo.png', '', 2),
(52, '豆苗', 'Public/images/goods_demo.png', '', 2),
(53, '云南小瓜', 'Public/images/goods_demo.png', '', 2),
(54, '丝瓜', 'Public/images/goods_demo.png', '', 2),
(55, '水瓜', 'Public/images/goods_demo.png', '', 2),
(56, '苦瓜', 'Public/images/goods_demo.png', '', 2),
(57, ' 南瓜', 'Public/images/goods_demo.png', '', 2),
(58, '葫芦瓜', 'Public/images/goods_demo.png', '', 2),
(59, '圆椒', 'Public/images/goods_demo.png', '', 2),
(60, '青尖椒', 'Public/images/goods_demo.png', '', 2),
(61, '红尖椒', 'Public/images/goods_demo.png', '', 2),
(62, '玉豆', 'Public/images/goods_demo.png', '', 2),
(63, '荷兰豆', 'Public/images/goods_demo.png', '', 2),
(64, '芦笋', 'Public/images/goods_demo.png', '', 2),
(65, '禾笋', 'Public/images/goods_demo.png', '', 2),
(66, '大豆芽菜', 'Public/images/goods_demo.png', '', 2),
(67, '小豆芽菜', 'Public/images/goods_demo.png', '', 2),
(68, '韭菜', 'Public/images/goods_demo.png', '', 2),
(69, '韭黄', 'Public/images/goods_demo.png', '', 2),
(70, '韭菜花', 'Public/images/goods_demo.png', '', 2),
(71, '大葱', 'Public/images/goods_demo.png', '', 2),
(72, '红葱头', 'Public/images/goods_demo.png', '', 2),
(73, '葱肉', 'Public/images/goods_demo.png', '', 2),
(74, '姜肉', 'Public/images/goods_demo.png', '', 2),
(75, '蒜肉', 'Public/images/goods_demo.png', '', 2),
(76, '芫茜', 'Public/images/goods_demo.png', '', 2),
(77, '洋葱', 'Public/images/goods_demo.png', '', 2),
(78, '白洋葱', 'Public/images/goods_demo.png', '', 2),
(79, '槟芋（香芋）', 'Public/images/goods_demo.png', '', 2),
(80, '大芋头', 'Public/images/goods_demo.png', '', 2),
(81, '甜玉米', 'Public/images/goods_demo.png', '', 2),
(82, '玉米心', 'Public/images/goods_demo.png', '', 2),
(83, '红薯', 'Public/images/goods_demo.png', '', 2),
(84, '马蹄', 'Public/images/goods_demo.png', '', 2),
(85, '子姜', 'Public/images/goods_demo.png', '', 2),
(86, '大肉姜(生姜)', 'Public/images/goods_demo.png', '', 2),
(87, '金针菇', 'Public/images/goods_demo.png', '', 2),
(88, '鸡肶菇', 'Public/images/goods_demo.png', '', 2),
(89, '莲藕', 'Public/images/goods_demo.png', '', 2),
(90, '鲜淮山', 'Public/images/goods_demo.png', '', 2),
(91, '鲜人参', 'Public/images/goods_demo.png', '', 2),
(92, '鲜虫草', 'Public/images/goods_demo.png', '', 2),
(93, '鲜巴戟', 'Public/images/goods_demo.png', '', 2),
(94, '鲜田七', 'Public/images/goods_demo.png', '', 2),
(95, '鲜百合', 'Public/images/goods_demo.png', '', 2),
(96, '竹蔗', 'Public/images/goods_demo.png', '', 2),
(97, '沙葛', 'Public/images/goods_demo.png', '', 2),
(98, '粉葛', 'Public/images/goods_demo.png', '', 2),
(99, '鲜土伏苓', 'Public/images/goods_demo.png', '', 2),
(100, '水豆腐', 'Public/images/goods_demo.png', '', 2),
(101, '油炸豆干', 'Public/images/goods_demo.png', '', 2),
(102, '交笋', 'Public/images/goods_demo.png', '', 2),
(103, '咸菜', 'Public/images/goods_demo.png', '', 2),
(104, '木瓜', 'Public/images/goods_demo.png', '', 2),
(105, '本地葱', 'Public/images/goods_demo.png', '', 2),
(106, '蒜头', 'Public/images/goods_demo.png', '', 2),
(107, '草菇', 'Public/images/goods_demo.png', '', 2),
(108, '紫豆角', 'Public/images/goods_demo.png', '', 2),
(109, '鲜猴头菇', 'Public/images/goods_demo.png', '', 2),
(110, '马蹄肉', 'Public/images/goods_demo.png', '', 2),
(111, '菱角', 'Public/images/goods_demo.png', '', 2),
(112, '日本豆腐', 'Public/images/goods_demo.png', '', 2),
(113, '加工鲜菇', 'Public/images/goods_demo.png', '', 2),
(114, '荷兰土豆', 'Public/images/goods_demo.png', '', 2),
(115, '红圆椒', 'Public/images/goods_demo.png', '', 2),
(116, '小米椒（指天椒）', 'Public/images/goods_demo.png', '', 2),
(117, '香菇', 'Public/images/goods_demo.png', '', 2),
(118, '荷兰芹（番茜）', 'Public/images/goods_demo.png', '', 2),
(119, '水东芥菜', 'Public/images/goods_demo.png', '', 2),
(120, ' 母猪(二元,50公斤左右) ', 'Public/images/goods_demo.png', '', 3),
(121, ' 生猪(良种瘦肉型)', 'Public/images/goods_demo.png', '', 3),
(122, ' 生猪(良种杂交型)', 'Public/images/goods_demo.png', '', 3),
(123, ' 生猪(土杂型)', 'Public/images/goods_demo.png', '', 3),
(124, ' 蛇果(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(125, '苹果(一级红富士)', 'Public/images/goods_demo.png', '', 4),
(126, '红香蕉苹果(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(127, '雪梨(一级)', 'Public/images/goods_demo.png', '', 4),
(128, '鸭梨(国产 一级) ', 'Public/images/goods_demo.png', '', 4),
(129, '贡梨(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(130, '啤梨(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(131, '水晶梨(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(132, '丰水梨(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(133, '香梨(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(134, ' 潮州柑(一级)', 'Public/images/goods_demo.png', '', 4),
(135, '四会桔(一级沙糖桔)', 'Public/images/goods_demo.png', '', 4),
(136, '密柑(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(137, '波萝(一级)', 'Public/images/goods_demo.png', '', 4),
(138, '香蕉(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(139, '西瓜(当地主销 一级)', 'Public/images/goods_demo.png', '', 4),
(140, '无籽西瓜(当地主销 一级)', 'Public/images/goods_demo.png', '', 4),
(141, '西瓜（黑美人）', 'Public/images/goods_demo.png', '', 4),
(142, '柚子(一级沙田柚)', 'Public/images/goods_demo.png', '', 4),
(143, ' 哈密瓜(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(144, ' 白密瓜(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(145, '桃子(一级水密桃)', 'Public/images/goods_demo.png', '', 4),
(146, '芒果(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(147, '草莓(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(148, '柠檬(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(149, '龙眼(一级本地龙眼)', 'Public/images/goods_demo.png', '', 4),
(150, '荔枝(桂味 一级) ', 'Public/images/goods_demo.png', '', 4),
(151, '荔枝(糯米滋 一级)', 'Public/images/goods_demo.png', '', 4),
(152, '柿子(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(153, '蛇果(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(154, '印度青苹(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(155, '红提(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(156, '青提(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(157, '香蕉(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(158, ' 芦柑(一级) ', 'Public/images/goods_demo.png', '', 4),
(159, '  葡萄(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(160, '木瓜(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(161, ' 椰子(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(162, ' 甘蔗(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(163, ' 木瓜(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(164, ' 杨桃(进口 一级) ', 'Public/images/goods_demo.png', '', 4),
(165, '草莓(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(166, '龙眼(进口 一级) ', 'Public/images/goods_demo.png', '', 4),
(167, '柠檬(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(168, '新奇士橙(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(169, '吕宋芒', 'Public/images/goods_demo.png', '', 4),
(170, '青布林', 'Public/images/goods_demo.png', '', 4),
(171, '红布林', 'Public/images/goods_demo.png', '', 4),
(172, '西柚(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(173, '山竹(进口 一级) ', 'Public/images/goods_demo.png', '', 4),
(174, '榴莲(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(175, '奇异果(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(176, '加力果(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(177, '火龙果(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(178, '车厘子', 'Public/images/goods_demo.png', '', 4),
(179, '火龙果(进口 一级)', 'Public/images/goods_demo.png', '', 4),
(180, '枇杷(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(181, '油桃(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(182, '杏子(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(183, '番石榴(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(184, '番茄仔（圣女果）(国产 一级)', 'Public/images/goods_demo.png', '', 4),
(185, '核桃肉(一级)', 'Public/images/goods_demo.png', '', 4),
(186, '红枣(一级鸡心枣)', 'Public/images/goods_demo.png', '', 4),
(187, '蜜枣', 'Public/images/goods_demo.png', '', 4),
(188, '莲子(一级湘莲)', 'Public/images/goods_demo.png', '', 4);

-- --------------------------------------------------------

--
-- 表的结构 `sp_goods_variety`
--

CREATE TABLE IF NOT EXISTS `sp_goods_variety` (
  `vid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型id',
  `vname` varchar(20) NOT NULL COMMENT '商品类型名称',
  `pvid` int(11) unsigned DEFAULT NULL COMMENT '无限分类，指向父类的vid',
  `aid` int(11) unsigned NOT NULL COMMENT '品种分类id',
  PRIMARY KEY (`vid`),
  KEY `fk_goods_variety_ass` (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `sp_goods_variety`
--

INSERT INTO `sp_goods_variety` (`vid`, `vname`, `pvid`, `aid`) VALUES
(2, '蔬菜', NULL, 1),
(3, '牲猪', NULL, 1),
(4, '瓜果', NULL, 1),
(5, '干货', NULL, 1),
(6, '冻品', NULL, 1),
(7, '三鸟', NULL, 1),
(8, '塘鱼', NULL, 1),
(9, '淡水鱼', NULL, 1),
(10, '高档水产品', NULL, 1),
(11, '中杂海鱼', NULL, 1),
(12, '虾类', NULL, 1),
(13, '龙虾类', NULL, 1),
(14, '鲍鱼', NULL, 1),
(15, '蟹类', NULL, 1),
(16, '贝壳类', NULL, 1),
(17, '养殖动物', NULL, 1),
(18, '肉', NULL, 1),
(19, '稻谷、大米及其制品', NULL, 1),
(20, '包装大米', NULL, 1),
(21, '小麦、面粉及其制品', NULL, 1),
(22, '散装食用油', NULL, 1),
(23, '小包装食用油', NULL, 1),
(24, '杂粮', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_market`
--

CREATE TABLE IF NOT EXISTS `sp_market` (
  `mid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mname` varchar(20) NOT NULL,
  `zid` int(11) unsigned NOT NULL,
  `cid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `fk_market_c` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `sp_market`
--

INSERT INTO `sp_market` (`mid`, `mname`, `zid`, `cid`) VALUES
(4, '番禺区市桥街东城市场', 6, 42),
(10, '白云山农产品综合批发市场', 0, 40),
(33, '白云山农产品综合批发市场', 19, 40),
(34, '江村农贸综合批发市场', 19, 40),
(35, '广州江南果菜批发市场', 19, 40),
(36, '黄沙水产交易市场', 20, 40),
(37, '江村家禽批发市场', 19, 40),
(38, '荔湾农产品批发市场', 20, 40),
(39, '广州市百兴三鸟批发市场', 19, 40),
(40, '一德路海之星综合市场', 5, 40),
(41, '南沙区金洲农贸市场', 24, 42),
(42, '从化新城市场', 25, 42),
(43, '白云区景泰市场', 19, 42),
(44, '江南西肉菜市场', 26, 42),
(45, '花都区富华市场', 7, 42),
(46, '萝岗区农副产品综合市场', 22, 42),
(47, '海珠肉菜市场', 26, 42),
(48, '海珠区西华市场', 26, 42),
(49, '宝华生鲜街市', 20, 42),
(50, '豪贤肉菜市场', 5, 42),
(51, '增城富鹏市场', 21, 42),
(52, '石牌市场', 4, 42),
(53, '东川新街市', 5, 42),
(54, '天河区珠江新城猎德农产品市场', 4, 42),
(55, '黄埔区丰乐农产品市场', 27, 42),
(56, '白云区新粮油蛋品批发市场', 19, 50),
(57, '白云山农批粮油市场', 19, 50),
(58, '番禺区物价局价格科', 6, 50),
(59, '花都区物价局', 7, 50),
(60, '增城市荔城粮食管理所', 21, 50),
(61, '从化市城郊粮食管理所', 25, 50),
(62, '海珠区粮油综合交易城', 26, 50),
(63, '广州东兴粮油市场', 5, 50),
(64, ' 广州市8字连锁店有限公司', 20, 50),
(65, '天平粮油食杂批发市场', 4, 50),
(66, '天河肉联厂', 4, 51),
(67, '天河牲畜交易市场', 4, 51),
(68, '广州市嘉禾畜禽交易服务中心', 19, 51),
(69, '广州食品集团孔旺记肉业食品分公司', 20, 51),
(70, '金戎牲畜交易批发市场', 19, 51);

-- --------------------------------------------------------

--
-- 表的结构 `sp_market_city`
--

CREATE TABLE IF NOT EXISTS `sp_market_city` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `pid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `cname` (`cname`),
  KEY `fk_market_city_p` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `sp_market_city`
--

INSERT INTO `sp_market_city` (`cid`, `cname`, `pid`) VALUES
(2, '广州市', 1),
(14, '湛江市', 1),
(15, '柳州市', 5),
(16, '深圳市', 1),
(17, '东莞市', 1),
(18, '阳江市', 1),
(19, '潮州市', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sp_market_goods`
--

CREATE TABLE IF NOT EXISTS `sp_market_goods` (
  `mgid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(11) unsigned NOT NULL,
  `gid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`mgid`),
  KEY `fk_market_goods_m` (`mid`),
  KEY `fk_market_goods_g` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_market_price`
--

CREATE TABLE IF NOT EXISTS `sp_market_price` (
  `priceid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mgid` int(11) unsigned NOT NULL COMMENT '市场上的商品id',
  `mtype` enum('批发','零售') NOT NULL DEFAULT '批发' COMMENT '销售方式:批发或零售',
  `price` decimal(10,3) NOT NULL COMMENT '价格',
  `maxprice` decimal(10,3) DEFAULT '0.000' COMMENT '最高价格',
  `minprice` decimal(10,3) DEFAULT '0.000' COMMENT '最低价格',
  `mtime` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`priceid`),
  UNIQUE KEY `mgid` (`mgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_market_province`
--

CREATE TABLE IF NOT EXISTS `sp_market_province` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `sp_market_province`
--

INSERT INTO `sp_market_province` (`pid`, `pname`) VALUES
(1, '广东省'),
(5, '广西省'),
(6, '河南省'),
(7, '湖南省'),
(8, '海南省'),
(9, '江苏省'),
(10, '湖北省'),
(11, '浙江省'),
(12, '上海市'),
(13, '河北省'),
(14, '内蒙古省');

-- --------------------------------------------------------

--
-- 表的结构 `sp_market_zone`
--

CREATE TABLE IF NOT EXISTS `sp_market_zone` (
  `zid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zname` varchar(20) NOT NULL COMMENT '地区名称',
  `cid` int(11) unsigned NOT NULL COMMENT '城市id',
  PRIMARY KEY (`zid`),
  KEY `zname` (`zname`),
  KEY `fk_market_zone_city` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `sp_market_zone`
--

INSERT INTO `sp_market_zone` (`zid`, `zname`, `cid`) VALUES
(1, '坡头区', 14),
(2, '福田区', 16),
(3, '罗湖区', 16),
(4, '天河区', 2),
(5, '越秀区', 2),
(6, '番禺区', 2),
(7, '花都区', 2),
(8, '霞山区', 14),
(9, '赤坎区', 14),
(16, '善待对方', 15),
(19, '白云区', 2),
(20, '荔湾区', 2),
(21, '增城市', 2),
(22, '萝岗区', 2),
(23, '麻章区', 14),
(24, '南沙区', 2),
(25, '从化市', 2),
(26, '海珠区', 2),
(27, '黄埔区', 2);

-- --------------------------------------------------------

--
-- 表的结构 `sp_user`
--

CREATE TABLE IF NOT EXISTS `sp_user` (
  `uid` int(11) unsigned NOT NULL,
  `upname` varchar(255) NOT NULL COMMENT '昵称',
  `sex` enum('男','女','保密') NOT NULL DEFAULT '男',
  `zid` int(11) unsigned NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  `mtime` int(11) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `rid` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `infor` text,
  PRIMARY KEY (`uid`),
  KEY `fk_user_z` (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sp_user_module`
--

CREATE TABLE IF NOT EXISTS `sp_user_module` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(150) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_user_profile`
--

CREATE TABLE IF NOT EXISTS `sp_user_profile` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `operate` enum('add','delete','select','edit','all') NOT NULL DEFAULT 'all',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sp_user_verified`
--

CREATE TABLE IF NOT EXISTS `sp_user_verified` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isadministrator` tinyint(1) unsigned DEFAULT '0',
  `phone` varchar(50) DEFAULT NULL,
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` varchar(50) NOT NULL,
  `verified` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sp_user_verified`
--

INSERT INTO `sp_user_verified` (`uid`, `uname`, `email`, `password`, `isadministrator`, `phone`, `last_login_time`, `last_login_ip`, `verified`, `url`, `status`) VALUES
(1, 'alin', '302592040@qq.com', '96e79218965eb72c92a549dd5a330112', 1, '1223323232323', 121221212, '1221222111', 'aaaa', 'asssdfeeeffefe', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sp_user_view`
--

CREATE TABLE IF NOT EXISTS `sp_user_view` (
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `content_key` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 限制导出的表
--

--
-- 限制表 `sp_goods`
--
ALTER TABLE `sp_goods`
  ADD CONSTRAINT `fk_goods_v` FOREIGN KEY (`vid`) REFERENCES `sp_goods_variety` (`vid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_goods_variety`
--
ALTER TABLE `sp_goods_variety`
  ADD CONSTRAINT `fk_goods_variety_ass` FOREIGN KEY (`aid`) REFERENCES `sp_assortment` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_market`
--
ALTER TABLE `sp_market`
  ADD CONSTRAINT `fk_market_c` FOREIGN KEY (`cid`) REFERENCES `sp_category` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_market_city`
--
ALTER TABLE `sp_market_city`
  ADD CONSTRAINT `fk_market_city_p` FOREIGN KEY (`pid`) REFERENCES `sp_market_province` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_market_goods`
--
ALTER TABLE `sp_market_goods`
  ADD CONSTRAINT `fk_market_goods_g` FOREIGN KEY (`gid`) REFERENCES `sp_goods` (`gid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_market_goods_m` FOREIGN KEY (`mid`) REFERENCES `sp_market` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_market_price`
--
ALTER TABLE `sp_market_price`
  ADD CONSTRAINT `fk_market_price_mg` FOREIGN KEY (`mgid`) REFERENCES `sp_market_goods` (`mgid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_market_zone`
--
ALTER TABLE `sp_market_zone`
  ADD CONSTRAINT `fk_market_zone_city` FOREIGN KEY (`cid`) REFERENCES `sp_market_city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sp_user`
--
ALTER TABLE `sp_user`
  ADD CONSTRAINT `fk_user_z` FOREIGN KEY (`zid`) REFERENCES `sp_market_zone` (`zid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
