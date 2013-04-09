-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2013 年 01 月 23 日 06:34
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `shoppingprice`
-- 

drop database if exists shoppingprice;
create database shoppingprice;
use shoppingprice;
-- --------------------------------------------------------

-- 
-- 表的结构 `sp_ad`
-- 

CREATE TABLE `sp_ad` (
  `ad_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `place` tinyint(1) NOT NULL default '0' COMMENT '0:中部 1:头部 2:左侧 3:右侧 4:底部',
  `content` text,
  `is_active` tinyint(1) NOT NULL default '1',
  `is_closable` tinyint(1) NOT NULL default '0',
  `ctime` int(11) default NULL,
  `mtime` int(11) default NULL,
  `display_order` smallint(2) NOT NULL default '0',
  `display_type` tinyint(1) unsigned default '1',
  PRIMARY KEY  (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `sp_ad`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_article`
-- 

CREATE TABLE `sp_article` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) default NULL,
  `content` text,
  `pid` int(11) default '0',
  `keywords` text,
  `description` text,
  `status` int(4) default '1',
  `img_url` varchar(255) default NULL,
  `sort` int(11) default NULL,
  `dateline` int(11) default NULL,
  `href` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- 
-- 导出表中的数据 `sp_article`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `sp_category`
-- 

CREATE TABLE `sp_category` (
  `cid` int(11) unsigned NOT NULL auto_increment COMMENT '商品id',
  `cname` varchar(20) NOT NULL COMMENT '商品名称',
  PRIMARY KEY  (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_category`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_goods_variety`
-- 

CREATE TABLE `sp_goods_variety` (
  `vid` int(11) unsigned NOT NULL auto_increment COMMENT '商品类型id',
  `vname` varchar(20) NOT NULL COMMENT '商品类型名称',
  `pvid` int(11) unsigned default null COMMENT '无限分类，指向父类的vid',
  `aid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- 
-- 导出表中的数据 `sp_goods_variety`
-- 




-- --------------------------------------------------------

-- 
-- 表的结构 `sp_goods`
-- 

CREATE TABLE `sp_goods` (
  `gid` int(11) unsigned NOT NULL auto_increment COMMENT '商品id',
  `gname` varchar(20) NOT NULL COMMENT '商品名称',
  `gimg` varchar(255) default NULL COMMENT '商品图片',
  `gdescription` text COMMENT '商品描述',
  `vid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`gid`),
  KEY `gname` (`gname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
  
-- 
-- 导出表中的数据 `sp_goods`
-- 



-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market`
-- 

CREATE TABLE `sp_market` (
  `mid` int(11) unsigned NOT NULL auto_increment,
  `mname` varchar(20) NOT NULL,
  `zid` int(11) unsigned NOT NULL,
  `cid` int(11)  unsigned NOT NULL,
  PRIMARY KEY  (`mid`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- 
-- 导出表中的数据 `sp_market`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_province`
-- 

CREATE TABLE `sp_market_province` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `pname` varchar(20) NOT NULL,
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_province`
-- 



-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_city`
-- 

CREATE TABLE `sp_market_city` (
  `cid` int(11) unsigned NOT NULL auto_increment,
  `cname` varchar(20) NOT NULL,
  `pid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`cid`),
  KEY `cname` (`cname`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- 
-- 导出表中的数据 `sp_market_city`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_price`
-- 

CREATE TABLE `sp_market_price` (
`priceid` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL COMMENT '商品id',
  `mid` int(11) unsigned NOT NULL COMMENT '市场id',
  `mtid` int(11) unsigned NOT NULL COMMENT '销售方式id:批发或零售',
  `price` decimal(10,3) NOT NULL COMMENT '价格',
   `maxprice` decimal(10,3) default 0.000 COMMENT '最高价格',
    `minprice` decimal(10,3) default 0.000 COMMENT '最低价格',
  `mtime` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY  (`priceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `sp_market_price`
-- 




-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_type`
-- 

CREATE TABLE `sp_market_type` (
  `mtid` int(11) unsigned NOT NULL auto_increment COMMENT '销售方式id',
  `mtname` varchar(20) NOT NULL COMMENT '销售方式名称：批发或零售',
  PRIMARY KEY  (`mtid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_type`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_zone`
-- 

CREATE TABLE `sp_market_zone` (
  `zid` int(11) unsigned NOT NULL auto_increment,
  `zname` varchar(20) NOT NULL COMMENT '地区名称',
  `cid` int(11) unsigned NOT NULL COMMENT '城市id',
  PRIMARY KEY  (`zid`),
  KEY `zname` (`zname`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- 
-- 导出表中的数据 `sp_market_zone`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user`
-- 

CREATE TABLE `sp_user` (
  `uid` int(11) unsigned NOT NULL,
  `upname` varchar(255) NOT NULL COMMENT '昵称',
  `sex` enum('男','女','保密') NOT NULL default '男',
  `zid` int(11) unsigned NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  `mtime` int(11) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `rid` int(11) NOT NULL,
  `address` varchar(255),
  `infor` text ,
  PRIMARY KEY  (`uid`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    

-- 
-- 导出表中的数据 `sp_user`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user_profile`
-- 

CREATE TABLE `sp_user_profile` (
  `pid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
 -- `data` longtext,
 -- `type` varchar(60) NOT NULL,
 `operate` enum('add','delete','select','edit','all')  not null default 'all',
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_user_profile`
-- 


-- --------------------------------------------------------

CREATE TABLE `sp_user_module`(
		`mid` int(11) NOT	NULL	auto_increment,
		`mname` varchar(150) not null,
		primary key(`mid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------
-- 
-- 表的结构 `sp_user_verified`
-- 

CREATE TABLE `sp_user_verified` (
  `uid` int(11) NOT NULL auto_increment,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
   `isadministrator` tinyint(1) unsigned default '0',
   `phone` varchar(50),
  `last_login_time` int(11) unsigned NOT NULL default '0',
  `last_login_ip` varchar(50) NOT NULL,
  `verified` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_user_verified`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user_view`
-- 

CREATE TABLE `sp_user_view` (
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `content_key` varchar(255) NOT NULL,
  `count` int(11) NOT NULL default '0',
  `mtime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `sp_user_view`
-- 



-- 
-- 表的结构 `sp_friend_link`
-- 

CREATE TABLE `sp_friend_link` (
  `link_id` smallint(5) unsigned NOT NULL auto_increment,
  `site_name` varchar(100) NOT NULL,
  `position_id` tinyint(3) unsigned NOT NULL,
  `link_type` tinyint(1) unsigned NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `sort_order` smallint(5) unsigned NOT NULL default '1',
  `link_code` varchar(150) NOT NULL,
  PRIMARY KEY  (`link_id`),
  KEY `position_id` (`position_id`,`link_type`,`sort_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `sp_friend_link`
-- 

--
--   品种分类表
--
create table `sp_assortment`(
`aid` int(11)  unsigned NOT NULL auto_increment,
`aname` varchar(50) not null,
 PRIMARY KEY  (`aid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- ------------------修改外键-------------------------

alter table `sp_market_city` add
constraint `fk_market_city_p` foreign key(`pid`) 
references `sp_market_province`(`pid`) on update cascade on delete cascade ;



alter table `sp_goods_variety` add
constraint `fk_goods_variety_ass` foreign key(`aid`) 
 references `sp_assortment`(`aid`) on update cascade on delete cascade ;


--alter table `sp_goods` drop foreign key `fk_goods_v`;

alter table `sp_goods` add
constraint `fk_goods_v` foreign key(`vid`)
references `sp_goods_variety`(`vid`) on update cascade on delete cascade ;


alter table `sp_market` add
constraint `fk_market_c` foreign key(`cid`) 
references `sp_category`(`cid`) on update cascade on delete cascade ;


alter table `sp_market_zone` add
 constraint `fk_market_zone_city` foreign key(`cid`) 
 references `sp_market_city`(`cid`) on update cascade on delete cascade ;


alter table `sp_user` add
constraint `fk_user_z` foreign key(`zid`) 
references `sp_market_zone`(`zid`) on update cascade on delete cascade ;

--  -----------------------------------------------------------


INSERT INTO `sp_friend_link` VALUES (1, '嫁娶网', 101, 1, 'http://www.ijiaqu.com', 1, '嫁娶网');
INSERT INTO `sp_friend_link` VALUES (2, '极好居', 101, 1, 'http://www.jihaoju.com', 2, '极好居');
INSERT INTO `sp_friend_link` VALUES (3, '青番茄', 101, 1, 'http://www.qfanqie.com', 3, '青番茄');
INSERT INTO `sp_friend_link` VALUES (4, '青番茄', 101, 1, 'http://www.tp-coupon.com', 4, 'TP-COUPON');


