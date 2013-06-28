-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_trashbouncer_categories`
-- 

CREATE TABLE `tl_trashbouncer_categories` (
  `ham` int(10) unsigned NOT NULL default '0',
  `spam` int(10) unsigned NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  PRIMARY KEY  (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_trashbouncer_log`
-- 

CREATE TABLE `tl_trashbouncer_log` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `info` varchar(30) NULL default '',
  `text` text NULL,
  `cat` tinyint(4) NOT NULL default '0',
  `lang` char(2) NOT NULL default '',
  `ip` varchar(64) NOT NULL default '',
  `tstamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cat` (`cat`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_trashbouncer_specialtokens`
-- 

CREATE TABLE `tl_trashbouncer_specialtokens` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `token` varchar(60) NOT NULL default '',
  `type` char(1) NOT NULL default '',
  `lang` char(2) NOT NULL default '',
  `tstamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `token` (`token`),
  KEY `type` (`type`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_trashbouncer_tokens`
-- 

CREATE TABLE `tl_trashbouncer_tokens` (
  `token` varchar(60) NOT NULL default '',
  `lang` char(2) NOT NULL default '',
  `ham` int(10) unsigned NOT NULL default '0',
  `spam` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`token`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;