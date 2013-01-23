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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- 
-- 导出表中的数据 `sp_article`
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
  `vid` varchar(11) NOT NULL,
  PRIMARY KEY  (`gid`),
  KEY `gname` (`gname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_goods`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_goods_varity`
-- 

CREATE TABLE `sp_goods_varity` (
  `vid` int(11) unsigned NOT NULL auto_increment COMMENT '商品类型id',
  `vname` varchar(20) NOT NULL COMMENT '商品类型名称',
  `lgid` int(11) NOT NULL,
  PRIMARY KEY  (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_goods_varity`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_living_goods`
-- 

CREATE TABLE `sp_living_goods` (
  `lgid` int(11) unsigned NOT NULL auto_increment COMMENT '商品id',
  `lgtname` varchar(20) NOT NULL COMMENT '商品名称',
  PRIMARY KEY  (`lgid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_living_goods`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market`
-- 

CREATE TABLE `sp_market` (
  `mid` int(11) unsigned NOT NULL auto_increment,
  `mname` varchar(20) NOT NULL,
  `zid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_city`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_price`
-- 

CREATE TABLE `sp_market_price` (
  `gid` int(11) unsigned NOT NULL,
  `mid` int(11) unsigned NOT NULL COMMENT '市场id',
  `mtid` int(11) unsigned NOT NULL COMMENT '销售方式id',
  `price` decimal(10,3) NOT NULL COMMENT '价格',
  `mtime` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY  (`gid`,`mid`,`mtid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `sp_market_price`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_province`
-- 

CREATE TABLE `sp_market_province` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `pname` varchar(20) NOT NULL,
  PRIMARY KEY  (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_province`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_type`
-- 

CREATE TABLE `sp_market_type` (
  `mtid` int(11) unsigned NOT NULL auto_increment COMMENT '销售方式id',
  `mtname` varchar(20) NOT NULL COMMENT '销售方式名称',
  PRIMARY KEY  (`mtid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_type`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_market_zone`
-- 

CREATE TABLE `sp_market_zone` (
  `zid` int(11) unsigned NOT NULL auto_increment,
  `zname` varchar(20) NOT NULL,
  `cid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`zid`),
  KEY `zname` (`zname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_market_zone`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user`
-- 

CREATE TABLE `sp_user` (
  `uid` int(11) unsigned NOT NULL,
  `sex` enum('男','女','保密') NOT NULL default '男',
  `province` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  `mtime` int(11) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `rid` int(11) NOT NULL,
  `isadministrator` tinyint(1) unsigned default '0',
  `infor` text NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `sp_user`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user_profile`
-- 

CREATE TABLE `sp_user_profile` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `module` varchar(150) NOT NULL,
  `data` longtext,
  `type` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `sp_user_profile`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `sp_user_verified`
-- 

CREATE TABLE `sp_user_verified` (
  `uid` int(11) NOT NULL auto_increment,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login_time` int(11) unsigned NOT NULL default '0',
  `last_login_ip` varchar(50) NOT NULL,
  `verified` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `sp_user_view`
-- 

