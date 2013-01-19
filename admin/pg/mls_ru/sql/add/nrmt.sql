CREATE TABLE `nrmt%` (
  `mtid` int(10) unsigned NOT NULL auto_increment,
  `mtmm` int(10) unsigned NOT NULL default '0',
  `mtml` int(10) unsigned NOT NULL default '0',
  `mtda` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`mtid`)
) TYPE=MyISAM COMMENT='Таблица связи Письма/Адреса';

INSERT INTO `nrtb` VALUES ('nrmt%', 'Связка письма/адреса', '', 50, 0, 'y', '');


INSERT INTO `nrat` VALUES ('Operator', 'nrmt%', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


INSERT INTO `nrcf` VALUES ('1', 'mtid', 'nrmt%', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'mtmm', 'nrmt%', 'y', 'ID письма', '', 'y', 'y', 'y', 'y', 'nrmm%', 'mmid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'mtml', 'nrmt%', 'y', 'ID адреса', '', 'y', 'y', 'y', 'y', 'nrml%', 'mlid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'mtda', 'nrmt%', 'y', 'Дата добавления в очередь', '', 'y', 'y', 'y', 'y', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
