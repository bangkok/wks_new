CREATE TABLE `nrmo%` (
  `moid` tinyint(3) unsigned NOT NULL auto_increment,
  `moqt` smallint(5) unsigned NOT NULL default '0',
  `mofq` tinyint(3) unsigned NOT NULL default '0',
  `mods` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`moid`)
) TYPE=MyISAM COMMENT='��������� ������ ��������';

INSERT INTO `nrmo%` VALUES ('1', '3', '1', '0000-00-00 00:00:00');
INSERT INTO `nrtb` VALUES ('nrmo%', '��������� ��������', '', 20, 0, 'n', '');


INSERT INTO `nrat` VALUES ('Operator', 'nrmo%', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


INSERT INTO `nrcf` VALUES ('1', 'moid', 'nrmo%', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'moqt', 'nrmo%', 'y', '�� ������� ����� �������� �� ���', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'mofq', 'nrmo%', 'y', '��� ����� �������� (���)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'mods', 'nrmo%', 'y', '���� ��������� �������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');


INSERT INTO `nrnv` VALUES (###, '', '��������', 'l', 'nrmo%', '');
INSERT INTO `nrnv` VALUES (###, '', '��������� ��������', 't', 'nrmo%', '');
INSERT INTO `nrnv` VALUES (###, '', '�������', 't', 'nrmc%', '');
INSERT INTO `nrnv` VALUES (###, '', '������', 't', 'nrmm%', '');
INSERT INTO `nrnv` VALUES (###, '', '������� ������/������', 't', 'nrmt%', '');
INSERT INTO `nrnv` VALUES (###, '', 'Email ������', 't', 'nrml%', '');
INSERT INTO `nrnv` VALUES (###, '', '�������� Email', 'o', 'nrmo%', 'tools/vm.php?l=%');
INSERT INTO `nrnv` VALUES (###, '', '', 's', 'nrmo%', '');
