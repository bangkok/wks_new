####################
# Nailer MySQL-Dump
# version 2.63
# http://nailer.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: March 03, 2004 at 11:00
# Server version: 4.0.13-max-nt-log
# PHP Version: 4.3.2
# Database : `nail`
#####################


##########
# Table structure for table `nrad`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrad`;;

CREATE TABLE `nrad` (
  `adid` char(16) NOT NULL default '',
  `adpw` char(16) NOT NULL default '',
  `adrl` char(16) NOT NULL default '',
  `adto` smallint(5) unsigned NOT NULL default '0',
  `adem` char(40) NOT NULL default '',
  `ader` enum('y','n') NOT NULL default 'n',
  `adbc` char(15) NOT NULL default '',
  `adsu` enum('y','n') NOT NULL default 'n',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `urr` char(16) NOT NULL default '',
  `rt` enum('rwrw','rwr-','r-r-') NOT NULL default 'r-r-',
  PRIMARY KEY  (`adid`)
) ENGINE=MyISAM COMMENT='��������������';;

##########
# Dumping data for table `nrad`
##########

INSERT INTO `nrad` VALUES ('stoh', '0a4b3ec904929849', 'Administrator', '65535', '', 'n', '��������', 'y', '2009-04-07 15:57:13', '2009-04-07 15:57:13', 'nail', 'r-r-');;
INSERT INTO `nrad` VALUES ('kost', '69c12ff427dabfb5', 'Administrator', '65535', '', 'n', '��������', 'y', '2002-07-31 09:12:22', '2003-06-24 17:48:42', 'nail', 'r-r-');;



##########
# Table structure for table `nrat`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrat`;;

CREATE TABLE `nrat` (
  `atrl` char(16) NOT NULL default '',
  `attb` char(16) NOT NULL default '',
  `atac` enum('n','r','w') NOT NULL default 'n',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`atrl`,`attb`)
) ENGINE=MyISAM COMMENT='����� ������� � ����';;

##########
# Dumping data for table `nrat`
##########

INSERT INTO `nrat` VALUES ('Administrator', 'nrtb', 'w', '2002-07-25 14:19:28', '2002-07-25 14:19:28');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrcf', 'w', '2002-07-25 14:19:35', '2002-07-25 14:21:34');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrfs', 'w', '2002-07-25 14:20:00', '2002-07-25 14:21:43');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrad', 'w', '2002-07-25 14:20:12', '2002-07-25 14:20:15');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrrl', 'w', '2002-07-25 14:20:22', '2002-07-25 14:21:46');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrur', 'w', '2002-07-25 14:20:29', '2002-07-25 14:21:51');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrat', 'w', '2002-07-25 14:20:38', '2002-07-25 14:20:38');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrcr', 'w', '2002-07-25 14:20:55', '2002-07-25 14:21:55');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrnv', 'w', '2002-07-25 14:21:04', '2002-07-25 14:21:59');;
INSERT INTO `nrat` VALUES ('Administrator', 'nrlg', 'r', '2002-07-25 14:21:29', '2002-07-25 14:21:29');;
INSERT INTO `nrat` VALUES ('Operator', 'nrfl', 'w', '2002-07-25 14:22:23', '2002-07-25 14:22:23');;


##########
# Table structure for table `nrcf`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrcf`;;

CREATE TABLE `nrcf` (
  `cfid` tinyint(3) unsigned NOT NULL default '0',
  `cffl` varchar(16) NOT NULL default '',
  `cftb` varchar(16) NOT NULL default '',
  `cfsw` enum('y','n') NOT NULL default 'y',
  `cfnm` varchar(200) NOT NULL default '',
  `cfds` varchar(255) NOT NULL default '',
  `cfsv` enum('y','n') NOT NULL default 'y',
  `cfsr` enum('y','n') NOT NULL default 'y',
  `cfel` enum('y','n') NOT NULL default 'y',
  `cfme` enum('y','n') NOT NULL default 'n',
  `cfen` varchar(16) NOT NULL default '',
  `cfenf` varchar(16) NOT NULL default '',
  `cfenc` varchar(255) NOT NULL default '',
  `cfpd` enum('y','n') NOT NULL default 'n',
  `cfdt` varchar(255) NOT NULL default '',
  `cfvf` varchar(16) NOT NULL default '',
  `cfct` enum('y','n') NOT NULL default 'n',
  `cfaa` enum('y','n') NOT NULL default 'n',
  `cfor` enum('y','n') NOT NULL default 'n',
  `cffe` enum('y','n') NOT NULL default 'n',
  `cffo` enum('y','n') NOT NULL default 'n',
  `cfmd` varchar(150) NOT NULL default '',
  `cfmv` varchar(150) NOT NULL default '',
  `cffn` enum('','PASSWORD','ENCRYPT') NOT NULL default '',
  PRIMARY KEY  (`cfid`,`cftb`,`cffl`)
) ENGINE=MyISAM COMMENT='������������ ������';;

##########
# Dumping data for table `nrcf`
##########

INSERT INTO `nrcf` VALUES ('4', 'crb3', 'nrcr', 'y', '���� ���� �������� ����� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'eeeeee', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'crb2', 'nrcr', 'y', '���� ���� ������� ������ ���������� �����', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'cccccc', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'crb1', 'nrcr', 'y', '���� ���� ������� ������ ����� ���������� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '999999', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'crnm', 'nrcr', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'cfid', 'nrcf', 'y', '# ����', '���������� ������� ���������� ���� ��� ������ � � ����� ����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'cftb', 'nrcf', 'y', '��� �������', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'y', 'n', 'y', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'cfsw', 'nrcf', 'y', '������� �� ��� ��������������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'cfnm', 'nrcf', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'cfsv', 'nrcf', 'y', '������� �� � ������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'cfsr', 'nrcf', 'y', '�������� �� ����� �� ����?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('11', 'cfen', 'nrcf', 'y', '������ �������', '�� ��������� ������� ����� ������������ ������ � ������.', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('15', 'cfdt', 'nrcf', 'y', '���������������� ��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('12', 'cfenf', 'nrcf', 'y', '���� ��� ��������', '����� ���� �� &quot;������ �������&quot; ����� ������������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('13', 'cfenc', 'nrcf', 'y', '�������� ��������', '������� ������ � �������� ����� ��� ����������� ������. (����� ������� - {*})', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'tbnm', 'nrtb', 'y', '��� �������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'tbds', 'nrtb', 'y', '��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'tbtx', 'nrtb', 'y', '����� ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'crb4', 'nrcr', 'y', '���� ���� ������ ����� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'FFFFFF', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'adid', 'nrad', 'y', '�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'adpw', 'nrad', 'y', '������', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'y', 'n', 'n', 'n', 'n', '', '', 'PASSWORD');;
INSERT INTO `nrcf` VALUES ('5', 'adem', 'nrad', 'y', 'Email', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', 'tools/vm.php?email=', 'tools/vemail.inc.php', '');;
INSERT INTO `nrcf` VALUES ('6', 'ader', 'nrad', 'y', '�������� ����������� �� �������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'adbc', 'nrad', 'y', '�������� �����', '', 'y', 'y', 'y', 'n', 'nrcr', 'crnm', '', 'n', '��������', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'lgtb', 'nrlg', 'y', '�������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'lgid', 'nrlg', 'y', '�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'atrl', 'nrat', 'y', '����', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'attb', 'nrat', 'y', '��� �������', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'atac', 'nrat', 'y', '�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'lgpk', 'nrlg', 'n', 'ID', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'lgst', 'nrlg', 'y', '������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'lgop', 'nrlg', 'y', '��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'tbdl', 'nrtb', 'y', '����� ������� ���� ������� �� �������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'tbro', 'nrtb', 'y', '������ ������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'lgdt', 'nrlg', 'y', '����/�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('18', 'cfaa', 'nrcf', 'y', '���� ��� ������� &quot;�������� ���&quot;?', '�������� ���� ����� ������������ ��� ������� &quot;�������� ���&quot;.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'lgip', 'nrlg', 'y', 'IP', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'tbnu', 'nrtb', 'y', '�� ������� ������� ���������� � ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '20', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'tbss', 'nrtb', 'y', '������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'nvid', 'nrnv', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'nvnm', 'nrnv', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'nvvr', 'nrnv', 'y', '��� ������ ����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'nvtb', 'nrnv', 'y', '�������', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'nvrl', 'nrnv', 'y', '����', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'nvad', 'nrnv', 'y', '�������������� ���������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'crb5', 'nrcr', 'y', '���� ��������� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '336699', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'crb6', 'nrcr', 'y', '���� ����', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'FFFFFF', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'crb7', 'nrcr', 'y', '���� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '006699', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('9', 'crb8', 'nrcr', 'y', '���� ���������� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '993366', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('10', 'crb9', 'nrcr', 'y', '���� �������� ������', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '006666', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'adsu', 'nrad', 'n', '����� �����', '', 'n', 'n', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('22', 'cfmd', 'nrcf', 'y', '�������������� ������', '������ �� ���� ������ ������� ����� ������������ �������� ������� ���� ��� ��������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'adto', 'nrad', 'y', '������� � ���.', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('24', 'cffn', 'nrcf', 'y', '������� ��� ����', '������� SQL ������� ����� ���������� � ������ ���� ��� ���������� � �������������� ������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'fsid', 'nrfs', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'fstx', 'nrfs', 'y', '�����', '', 'y', 'y', 'y', 'n', 'nrfs', 'fsid', '<img src="trf.php?id[0]={*}&t=nrfl&f=flim" alt="" border=0>', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('16', 'cfvf', 'nrcf', 'y', '����� ���� ����������', '����� ���� �� &quot;������ �������&quot; ����� ������������ ��� ���������������� �����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'rlid', 'nrrl', 'y', '����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'rlds', 'nrrl', 'y', '��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'urad', 'nrur', 'y', '������������', '', 'y', 'y', 'y', 'n', 'nrad', 'adid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'urrl', 'nrur', 'y', '����', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', 'Operator', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'adrl', 'nrad', 'y', '�������� ����', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'cfds', 'nrcf', 'y', '����������� ���������', '�������� ����, ��������� ��� ��������� �� �������� ����.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('9', 'cfel', 'nrcf', 'y', '������� ������� �� ����� ����?', '���� ���������� ������ ������, �� ������� ��������� � &quot;��������� �������&quot; ����� �������� �� �������� ������ ���� �� ��� ���� ������ � ������ �������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'cffl', 'nrcf', 'y', '��� ����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'y', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('10', 'cfme', 'nrcf', 'y', '��������������?', '���� �� �� ��� �������� ��� ������� ������� ���������� ������ ���� ������� (�������� � ���), ����� ������� �� ����� ������. ������ � ������� �� ����������� ������ �� ��������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('14', 'cfpd', 'nrcf', 'y', '�������� ��� ������ �������<br>������� �������� ����������?', '��� ������ ������� ����� �������� ������� �������� ���������� � ������ ������� � �������� ��������������� ������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('17', 'cfct', 'nrcf', 'y', '�� ���������� ��������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('19', 'cfor', 'nrcf', 'y', '���� ��� ����������?', '���� �������� ����� ��� ����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('20', 'cffe', 'nrcf', 'y', '���� ����������� ��� ����������?', '�� �������� ��� ���a - BLOB.', 'y', 'y', 'n', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('21', 'cffo', 'nrcf', 'y', '�������������� ���������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('23', 'cfmv', 'nrcf', 'y', '������ �������� � ���������<br>��������� ������.', '�������� ������ � ���� ������, � ������ ������ ��� el[0] - boolean (������ ��� ���), el[1] - ���������, el[2] - ������ ����� ���������/���������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'flex', 'nrfl', 'y', 'Expire (c)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '3600', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'flim_siz', 'nrfl', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'flim_fnm', 'nrfl', 'n', '������������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'flim', 'nrfl', 'y', '����', '', 'y', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'flid', 'nrfl', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'flnm', 'nrfl', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;


##########
# Table structure for table `nrcr`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrcr`;;

CREATE TABLE `nrcr` (
  `crnm` char(15) NOT NULL default '',
  `crb1` char(6) NOT NULL default '999999',
  `crb2` char(6) NOT NULL default 'cccccc',
  `crb3` char(6) NOT NULL default 'eeeeee',
  `crb4` char(6) NOT NULL default 'ffffff',
  `crb5` char(6) NOT NULL default '336699',
  `crb6` char(6) NOT NULL default 'ffffff',
  `crb7` char(6) NOT NULL default '006699',
  `crb8` char(6) NOT NULL default '993366',
  `crb9` char(6) NOT NULL default '006666',
  PRIMARY KEY  (`crnm`)
) ENGINE=MyISAM COMMENT='�������� �����';;

##########
# Dumping data for table `nrcr`
##########

INSERT INTO `nrcr` VALUES ('��������', '999999', 'cccccc', 'eeeeee', 'FFFFFF', '336699', 'FFFFFF', '006699', '993366', '006666');;
INSERT INTO `nrcr` VALUES ('�����', '99bb99', 'cceecc', 'eeffee', 'fafffa', '336666', 'FFFFFF', '009966', '339966', '006666');;
INSERT INTO `nrcr` VALUES ('����', '99bb99', 'cceecc', 'eeffee', 'fafffa', '336666', 'FFFFFF', '996600', '996633', '996666');;
INSERT INTO `nrcr` VALUES ('�����', 'FFCC99', 'FFFFBB', 'FFFFEE', 'FFFFFF', '993300', 'FFFFFF', '996600', '996633', '996666');;
INSERT INTO `nrcr` VALUES ('����', 'cccccc', 'dddddd', 'eeeeee', 'FFFFFF', '3f6f9f', 'FFFFFF', '336699', '996699', '4477aa');;


##########
# Table structure for table `nrfl`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrfl`;;

CREATE TABLE `nrfl` (
  `flid` smallint(5) unsigned NOT NULL auto_increment,
  `flnm` varchar(50) NOT NULL default '',
  `flim` mediumblob NOT NULL,
  `flim_fnm` varchar(50) NOT NULL default '',
  `flim_siz` int(11) NOT NULL default '0',
  `flex` mediumint(8) unsigned NOT NULL default '0',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `dl` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`flid`)
) ENGINE=MyISAM COMMENT='����� ������������';;

##########
# Dumping data for table `nrfl`
##########



##########
# Table structure for table `nrfs`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:27
##########

DROP TABLE IF EXISTS `nrfs`;;

CREATE TABLE `nrfs` (
  `fsid` smallint(5) unsigned NOT NULL auto_increment,
  `fstx` text NOT NULL,
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `dl` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`fsid`)
) ENGINE=MyISAM COMMENT='������';;

##########
# Dumping data for table `nrfs`
##########

INSERT INTO `nrfs` VALUES ('1', '��� ������ �������� ������������� �����. ��� ����� ������ ������� ������������ ������ &quot;_&quot;, ��� ����� ������ ���������� ����� �������� ������������ ������ &quot;%&quot;. ������: ���������� ����� ������ � ���������� � ������������ ����� &quot;�����������&quot;, ��� ����� � ��������������� ���� ���������� ������� &quot;%�����������%&quot; � ������ ������ &quot;������&quot;.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ����������� ������ ����������� � ���, ��� ����� ������� ���� ������� �������� �� ���������� ����, ��� ����� ���������� ������� ��� ������� ����� ������ � �������� ������� { }. ��������� �������� �������: <b>&quot;=&quot;, &quot;!=&quot;, &quot;&lt;&gt;&quot;, &quot;&gt;&quot;, &quot;&lt;&quot;, &quot;&lt;=&gt;&quot;, &quot;&gt;=&quot;, &quot;&lt;=&quot;, &quot;like&quot;, &quot;not like&quot;, &quot;is null&quot;, &quot;is not null&quot;, &quot;regexp&quot;, &quot;not regexp&quot;, &quot;rlike&quot;, &quot;not rlike&quot;</b>.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������:<br>{>=}45<br>{not like}%��%', '2001-09-23 14:45:48', '2001-09-23 14:57:22', 'n');;
INSERT INTO `nrfs` VALUES ('2', '��� ����, ����� ������������� ������ �� ��������� ����, ���������� �������� �� ��������� ����, ��� ��� ����������� ���������� ������������ �� �������� ��� �� ������� ��������� �� ��������.', '2001-09-23 14:45:39', '2001-09-23 14:52:01', 'n');;
INSERT INTO `nrfs` VALUES ('3', '��� ����, ����� ������� ������ ���� ���� �� ��, �������� &quot;none&quot; � ������� &quot;Update&quot;.', '2001-09-23 14:45:45', '2001-09-23 14:52:16', 'n');;
INSERT INTO `nrfs` VALUES ('4', '��� ������� ������ �� ������ ���� ������:<br>&nbsp;&nbsp;<font class=b>&lt;a href=&quot;http://�����_�����&quot;&gt;</font>.', '2001-09-23 14:53:56', '2001-09-23 14:53:56', 'n');;
INSERT INTO `nrfs` VALUES ('5', '��� ������� ������ �� �������� ����� ������:<br>&nbsp;&nbsp;<font class=b>&lt;a href=&quot;mailto: �����������_�����&quot;&gt;</font>.', '2001-09-23 14:54:32', '2001-09-23 14:54:32', 'n');;
INSERT INTO `nrfs` VALUES ('7', '��������� �������� ����:<br>������� �� ����� ������ - (<b>&lt;br&gt;</b>).', '2001-09-23 14:54:52', '2001-09-23 14:54:52', 'n');;
INSERT INTO `nrfs` VALUES ('8', '��� ����, ����� ���������� � ������ ����������:<br>(<b>&quot;</b>) - ���������� �������� (<b>&amp;quot;</b>);<br>(<b>&lt;</b>) - ���������� �������� (<b>&amp;lt;</b>);<br>(<b>&gt;</b>) - ���������� �������� (<b>&amp;gt;</b>);<br>(<b>&copy;</b>) - ���������� �������� (<b>&amp;copy;</b>);<br>(<b>&reg;</b>) - ���������� �������� (<b>&amp;reg;</b>);<br>(<b>&trade;</b>) - ���������� �������� (<b>&amp;trade;</b>);<br>(<b>&amp;</b>) - ���������� �������� (<b>&amp;amp;</b>);<br>������ - (<b>&amp;nbsp;</b>).<br><br>��� ������� �� ����������� ��� HTML �����.<br>', '2001-09-23 14:55:07', '2001-09-23 14:55:07', 'n');;
INSERT INTO `nrfs` VALUES ('6', '��� ������ �������� �� &quot;���� ��������&quot; ���������� �������� ��������:<br>&nbsp;&nbsp;<font class=b>&lt;img src=&quot;trf.php?id[0]=ID&t=nrfl&f=flim&quot; alt=&quot;ALT&quot; border=0&gt;</font><br>���, <br><font class=b>ID</font> - ����� �� &quot;���� ��������&quot;, ����������� �� ��������<br><font class=b>ALT</font> - ����������� ��������� ���������.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������� ����� ��������� ��������� <font class=b>width=������</font> � <font class=b>height=������</font>, ��� <font class=b>������</font> � <font class=b>������</font> �������� �������� ��������������� ���������� ��������.', '2001-09-23 14:54:43', '2001-09-23 14:54:43', 'n');;


##########
# Table structure for table `nrlg`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 03, 2004 at 10:57
##########

DROP TABLE IF EXISTS `nrlg`;;

CREATE TABLE `nrlg` (
  `lgpk` mediumint(9) NOT NULL auto_increment,
  `lgid` char(16) NOT NULL default '',
  `lgtb` char(16) NOT NULL default '',
  `lgop` char(10) NOT NULL default '',
  `lgst` enum('ok','error','timeout') NOT NULL default 'error',
  `lgip` char(15) NOT NULL default '',
  `lgdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`lgpk`)
) ENGINE=MyISAM COMMENT='������ ��������';;

##########
# Dumping data for table `nrlg`
##########


##########
# Table structure for table `nrnv`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrnv`;;

CREATE TABLE `nrnv` (
  `nvid` smallint(5) unsigned NOT NULL auto_increment,
  `nvrl` char(16) NOT NULL default '',
  `nvnm` char(30) NOT NULL default '0',
  `nvvr` enum('t','c','f','l','s','o') NOT NULL default 't',
  `nvtb` char(16) NOT NULL default '',
  `nvad` char(70) NOT NULL default '',
  PRIMARY KEY  (`nvid`,`nvrl`)
) ENGINE=MyISAM COMMENT='����';;

##########
# Dumping data for table `nrnv`
##########

INSERT INTO `nrnv` VALUES ('1', '', '', 's', 'nrtb', '');;
INSERT INTO `nrnv` VALUES ('2', '', '����������������e', 'l', '', '');;
INSERT INTO `nrnv` VALUES ('3', '', '��������������', 't', 'nrad', '');;
INSERT INTO `nrnv` VALUES ('4', '', '����', 't', 'nrrl', '');;
INSERT INTO `nrnv` VALUES ('5', '', '���� ���������������', 't', 'nrur', '');;
INSERT INTO `nrnv` VALUES ('6', '', '����� ������� � ����', 't', 'nrat', '');;
INSERT INTO `nrnv` VALUES ('7', '', '�������� �����', 't', 'nrcr', '');;
INSERT INTO `nrnv` VALUES ('8', '', '����', 't', 'nrnv', '');;
INSERT INTO `nrnv` VALUES ('9', '', '������ ��������', 't', 'nrlg', '&sort=lgdt&dir=DESC');;
INSERT INTO `nrnv` VALUES ('10', '', '���������� ��������', 'o', '', 'tools/archive_manage.php');;
INSERT INTO `nrnv` VALUES ('11', '', '���������', 'o', '', 'tools/backup.php');;
INSERT INTO `nrnv` VALUES ('12', '', '��������������', 'o', '', 'tools/restore.php');;
INSERT INTO `nrnv` VALUES ('13', '', '�������� �� ���������� �����', 'o', '', 'tools/csv_to_base.php');;
INSERT INTO `nrnv` VALUES ('14', '', '', 's', '', '');;
INSERT INTO `nrnv` VALUES ('15', '', '�����', 'l', 'nrfl', '');;
INSERT INTO `nrnv` VALUES ('16', '', '����� ������������', 't', 'nrfl', '');;
INSERT INTO `nrnv` VALUES ('17', '', '������� ������', 'o', 'nrfl', 'pg/files_ru/ftb.php?l=');;
INSERT INTO `nrnv` VALUES ('18', '', '', 's', 'nrfl', '');;


##########
# Table structure for table `nrrl`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrrl`;;

CREATE TABLE `nrrl` (
  `rlid` char(16) NOT NULL default '',
  `rlds` char(255) NOT NULL default '',
  PRIMARY KEY  (`rlid`)
) ENGINE=MyISAM COMMENT='Role';;

##########
# Dumping data for table `nrrl`
##########

INSERT INTO `nrrl` VALUES ('Administrator', '������ � �����������������');;
INSERT INTO `nrrl` VALUES ('Operator', '������ � ������');;


##########
# Table structure for table `nrtb`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrtb`;;

CREATE TABLE `nrtb` (
  `tbnm` varchar(16) NOT NULL default '',
  `tbds` varchar(100) NOT NULL default '',
  `tbtx` text NOT NULL,
  `tbnu` smallint(5) unsigned NOT NULL default '0',
  `tbdl` smallint(5) unsigned NOT NULL default '0',
  `tbro` enum('y','n') NOT NULL default 'n',
  `tbss` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`tbnm`)
) ENGINE=MyISAM COMMENT='�������';;

##########
# Dumping data for table `nrtb`
##########

INSERT INTO `nrtb` VALUES ('nrcf', '������������ ������', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrcr', '�������� �����', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrad', '��������������', '<li>���� ��� �������������� ���������� ���� &quot;������&quot; �� ��������� - �� ������ ��������� ��������.<li>����� �������� � ����������������� ������� ���������.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrat', '����� ������� � ��������', '<li>�����: n-������� ���, r-������ ��������, w-������ ������.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrtb', '�������', '<li>���� ���� &quot;����� ������� ���� ������� �� �������&quot; = 0 �� ������� ���������.<li>��� ������ ������� ���������� �������� &quot;����� �� ���� ������� ����������/���������?&quot;.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrlg', '����', '', '20', '0', 'y', '');;
INSERT INTO `nrtb` VALUES ('nrnv', '����', '<li>���� ���� &quot;�����&quot; ������ �� ��� ���� ����� ������������.<li>���� &quot;��� ������ ����&quot;=&quot;t&quot; - ������� �������;<br>&quot;��� ������ ����&quot; = &quot;c&quot; - �������;<br>&quot;��� ������ ����&quot; = &quot;f&quot; - �����;<br>&quot;��� ������ ����&quot; = &quot;l&quot; - ���������;<br>&quot;��� ������ ����&quot; = &quot;s&quot; - ���������;<br>&quot;��� ������ ����&quot; = &quot;o&quot; - ������ ������ (� ������. ��������� �������� ������).', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrfs', '������', '', '20', '7', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrrl', '����', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrur', '������ ���./����', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrfl', '����� ������������', '', '20', '2', 'n', '');;


##########
# Table structure for table `nrur`
#
# Creation: March 02, 2004 at 11:12
# Last update: March 02, 2004 at 11:12
##########

DROP TABLE IF EXISTS `nrur`;;

CREATE TABLE `nrur` (
  `urad` char(16) NOT NULL default '',
  `urrl` char(16) NOT NULL default '',
  PRIMARY KEY  (`urad`,`urrl`)
) ENGINE=MyISAM COMMENT='������ �������������/����';;

##########
# Dumping data for table `nrur`
##########


