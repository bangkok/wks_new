CREATE TABLE `nrml%` (
  `mlid` int(10) unsigned NOT NULL auto_increment,
  `mlnm` char(80) NOT NULL default '',
  `mlpw` char(16) NOT NULL default '',
  `mlcf` enum('c','r','d') NOT NULL default 'c',
  `mlmc` int(11) NOT NULL default '0',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `dl` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`mlid`),
  UNIQUE KEY `mlnm` (`mlnm`)
) TYPE=MyISAM COMMENT='Рассылка (Email адреса)';

INSERT INTO `nrtb` VALUES ('nrml%', 'Email', '', 50, 14, 'n', '');


INSERT INTO `nrat` VALUES ('Operator', 'nrml%', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


INSERT INTO `nrcf` VALUES ('1', 'mlid', 'nrml%', 'n', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'mlnm', 'nrml%', 'y', 'Email', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', 'tools/vm.php?email=', 'tools/vemail.inc.php', '');
INSERT INTO `nrcf` VALUES ('3', 'mlpw', 'nrml%', 'y', 'Пароль', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'mlcf', 'nrml%', 'y', 'Статус', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'mlmc', 'nrml%', 'y', 'ID каталога', '', 'y', 'y', 'y', 'n', 'nrmc%', 'mcid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
