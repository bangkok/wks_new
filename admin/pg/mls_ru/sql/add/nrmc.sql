CREATE TABLE nrmc% (
  `mcid` int(10) unsigned NOT NULL auto_increment,
  `mcnm` varchar(150) NOT NULL default '',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`mcid`)
) TYPE=MyISAM COMMENT='Каталог';

INSERT INTO `nrtb` VALUES ('nrmc%', 'Каталог', '', '30', '0', 'n', '');


INSERT INTO `nrat` VALUES ('Operator', 'nrmc%', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


INSERT INTO `nrcf` VALUES ('1', 'mcid', 'nrmc%', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'mcnm', 'nrmc%', 'y', 'Наименование', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
