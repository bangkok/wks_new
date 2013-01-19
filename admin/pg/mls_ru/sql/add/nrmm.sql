CREATE TABLE `nrmm%` (
  `mmid` int(10) unsigned NOT NULL auto_increment,
  `mmmc` int(11) NOT NULL default '0',
  `mmst` varchar(50) NOT NULL default '',
  `mmad` varchar(50) NOT NULL default '',
  `mmfr` varchar(50) NOT NULL default '',
  `mmnm` varchar(255) NOT NULL default '',
  `mmmlt` text NOT NULL,
  `mmmlh` text NOT NULL,
  `mmi1` blob NOT NULL,
  `mmi1_fnm` varchar(50) NOT NULL default '',
  `mmi1_siz` int(11) NOT NULL default '0',
  `mmi2` blob NOT NULL,
  `mmi2_fnm` varchar(50) NOT NULL default '',
  `mmi2_siz` int(11) NOT NULL default '0',
  `mmi3` blob NOT NULL,
  `mmi3_fnm` varchar(50) NOT NULL default '',
  `mmi3_siz` int(11) NOT NULL default '0',
  `mmfl` mediumblob NOT NULL,
  `mmfl_fnm` varchar(50) NOT NULL default '',
  `mmfl_siz` int(11) NOT NULL default '0',
  `mmds` datetime NOT NULL default '0000-00-00 00:00:00',
  `mmnw` enum('y','n') NOT NULL default 'n',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `dl` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`mmid`)
) TYPE=MyISAM COMMENT='������ ��� ��������';


INSERT INTO `nrtb` VALUES ('nrmm%', '������ ��������', '<li>������������� ����� ��������� ���� ����������� ��� ���������� ���������� ������� CRON ���������.<li>������ � crontab: */1 * * * * /PATH/pg/mls_ru/mls_cron.php &gt; /dev/null 2&gt;&1<li>���� �� ������ ��������� ���������� ���� ������������� �� ��������� CRON ��������� �������� ��� ���� &lt;�������� ����������!&gt; = y', 50, 3, 'n', 'pg/mls_ru/mls.inc.php');


INSERT INTO `nrat` VALUES ('Operator', 'nrmm%', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


INSERT INTO `nrcf` VALUES ('1', 'mmid', 'nrmm%', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'mmmc', 'nrmm%', 'y', 'ID ��������', '', 'y', 'y', 'y', 'n', 'nrmc%', 'mcid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'mmst', 'nrmm%', 'y', '������������ �����.', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'mmad', 'nrmm%', 'y', 'Email - ���� �������� ����������� � ���� ��������.', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'mmfr', 'nrmm%', 'y', '�������� Email.', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'mmnm', 'nrmm%', 'y', '���� ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'mmmlt', 'nrmm%', 'y', '��������� ������ ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('8', 'mmmlh', 'nrmm%', 'y', 'HTML ������ ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('9', 'mmi1', 'nrmm%', 'y', '�������� 1', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('10', 'mmi1_fnm', 'nrmm%', 'n', '�������� 1', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('11', 'mmi1_siz', 'nrmm%', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');
INSERT INTO `nrcf` VALUES ('12', 'mmi2', 'nrmm%', 'y', '�������� 2', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('13', 'mmi2_fnm', 'nrmm%', 'n', '�������� 2', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('14', 'mmi2_siz', 'nrmm%', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');
INSERT INTO `nrcf` VALUES ('15', 'mmi3', 'nrmm%', 'y', '�������� 3', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('16', 'mmi3_fnm', 'nrmm%', 'n', '�������� 3', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('17', 'mmi3_siz', 'nrmm%', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');
INSERT INTO `nrcf` VALUES ('18', 'mmfl', 'nrmm%', 'y', '������������� ����', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('19', 'mmfl_fnm', 'nrmm%', 'n', '������������� ����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('20', 'mmfl_siz', 'nrmm%', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');
INSERT INTO `nrcf` VALUES ('21', 'mmds', 'nrmm%', 'y', '���� ��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('22', 'mmnw', 'nrmm%', 'y', '�������� ����������!', '������� ����� ���� ������������� (���� ��������� ����� ������ � �� ����� �����������). ����� ��������� �� �� ��� ������ ��� ��� �������� ��� ����� � �������. ���� �������� �� n, �� ������ ����� �������� ��� ���.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');