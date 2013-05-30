CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>custompages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>issues` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8 NOT NULL,
  `category_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=232 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>options` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `<?=$install['dbprefix'];?>options` (`key`, `value`) VALUES
('start_datum', '<?=strtotime($install['startdatum']);?>'),
('end_datum', '<?=strtotime($install['enddatum']);?>'),
('site_title', '<?=$install['pagetitle'];?>');
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>parties` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acronym` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `programme_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `programme_offset` int(11) NOT NULL,
  `doValue` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(2) NOT NULL,
  `programme_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>pledges` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `issue_id` int(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET latin1 NOT NULL,
  `type` int(1) NOT NULL,
  `quotetext` text COLLATE utf8_unicode_ci,
  `quotesource` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quoteurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quotetype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `party_id` int(3) NOT NULL,
  `quotepage` int(4) NOT NULL,
  `default_pledgestatetype_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=776 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>pledgestates` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pledgestatetype_id` int(3) NOT NULL,
  `pledge_id` int(5) NOT NULL,
  `state_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=532 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>pledgestatetypegroups` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pledgestatetype_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;
INSERT INTO `<?=$install['dbprefix'];?>pledgestatetypegroups` (`id`, `pledgestatetype_ids`, `name`, `colour`, `order`) VALUES
(1, 'a:4:{i:0;i:1;i:1;i:2;i:2;i:9;i:3;i:7;}', 'Nichts passiert', '#ddddff', 2),
(2, 'a:3:{i:0;i:3;i:1;i:4;i:2;i:6;}', 'Gehaltene Versprechen', '#00ff00', 1),
(3, 'a:3:{i:0;i:5;i:1;i:8;i:2;i:10;}', 'Gebrochene Versprechen', '#ff0000', 3);
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>pledgestatetypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` float NOT NULL,
  `multipl` int(11) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL,
  `order` int(2) NOT NULL,
  `colour` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour2` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;
INSERT INTO `<?=$install['dbprefix'];?>pledgestatetypes` (`id`, `name`, `value`, `multipl`, `type`, `order`, `colour`, `colour2`) VALUES
(1, 'Nicht begonnen', 0, 1, 0, 6, '#C2E3FF', '#C2E3FF'),
(2, 'An fremder Mehrheit gescheitert', 0, 1, 0, 5, '#999999', '#C2E3FF'),
(3, 'Zum Teil umgesetzt', 0.5, 1, 0, 3, '#99ff99', '#00ff00'),
(4, 'Erfolgreich umgesetzt', 1, 1, 0, 2, '#00ff00', '#00ff00'),
(5, 'Gegenteil umgesetzt', -1, 1, 0, 10, '#bb0000', '#bb0000'),
(6, 'Zustand gewahrt', 1, 1, 1, 1, '#00aa00', '#00ff00'),
(7, 'Zustand in Gefahr', 0, 1, 1, 7, '#ffff00', '#00ff00'),
(8, 'Zustand nicht gewahrt', -1, 1, 1, 9, '#ff0000', '#bb0000'),
(9, 'Angekündigt', 0, 1, 0, 4, '#bbbbbb', '#C2E3FF'),
(-1, 'Nicht in die Wertung aufnehmen', 0, 0, 0, 0, '', ''),
(-2, 'Nicht in die Wertung aufnehmen', 0, 0, 1, 0, '', ''),
(10, 'Nicht umgesetzt', 0, 1, 0, 8, '#ff0000', '#bb0000');
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>states` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `issue_id` int(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum` date NOT NULL,
  `quotetext` text COLLATE utf8_unicode_ci,
  `quotesource` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quoteurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=128 ;
CREATE TABLE IF NOT EXISTS `<?=$install['dbprefix'];?>users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;
INSERT INTO `<?=$install['dbprefix'];?>users` (`id`, `username`, `password`, `name`, `admin`, `email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 1, '');
