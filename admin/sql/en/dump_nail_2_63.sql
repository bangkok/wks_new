####################
# Nailer MySQL-Dump
# version 2.63
# http://nailer.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: March 02, 2004 at 10:56
# Server version: 4.0.13-max-nt-log
# PHP Version: 4.3.2
# Database : `nail`
#####################


##########
# Table structure for table `nrad`
#
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:27
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
) TYPE=MyISAM COMMENT='Administrators';;

##########
# Dumping data for table `nrad`
##########

INSERT INTO `nrad` VALUES ('nail', '5e91438e4ba85bed', 'Administrator', '65535', '', 'n', 'Standart', 'y', '2002-07-31 09:12:22', '2003-06-24 17:48:42', 'nail', 'r-r-');;


##########
# Table structure for table `nrat`
#
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:57
##########

DROP TABLE IF EXISTS `nrat`;;

CREATE TABLE `nrat` (
  `atrl` char(16) NOT NULL default '',
  `attb` char(16) NOT NULL default '',
  `atac` enum('n','r','w') NOT NULL default 'n',
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`atrl`,`attb`)
) TYPE=MyISAM COMMENT='Table access rights';;

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
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:57
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
) TYPE=MyISAM COMMENT='Table configuration';;

##########
# Dumping data for table `nrcf`
##########

INSERT INTO `nrcf` VALUES ('4', 'crb3', 'nrcr', 'y', 'Background color of odd rows (tables)', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'eeeeee', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'crb2', 'nrcr', 'y', 'Background color of field header rows (tables)', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'cccccc', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'crb1', 'nrcr', 'y', 'Background color of input search parameters row', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '999999', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'crnm', 'nrcr', 'y', 'Name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'cfid', 'nrcf', 'y', '#', 'Sets field order for search and adding.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'cftb', 'nrcf', 'y', 'Table code', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'y', 'n', 'y', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'cfsw', 'nrcf', 'y', 'Visible for edit?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'cfnm', 'nrcf', 'y', 'Name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'cfsv', 'nrcf', 'y', 'Visible for search?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'cfsr', 'nrcf', 'y', 'Field for search?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('11', 'cfen', 'nrcf', 'y', 'Master table', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('15', 'cfdt', 'nrcf', 'y', 'Default value', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('12', 'cfenf', 'nrcf', 'y', 'Field to return', 'Which field from &quot;Master table&quot; will be return..', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('13', 'cfenc', 'nrcf', 'y', 'What to return', 'Sets string with marked place for returnng data (to mark: {*})', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'tbnm', 'nrtb', 'y', 'Table code', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'tbds', 'nrtb', 'y', 'Description', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'tbtx', 'nrtb', 'y', 'Help', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'crb4', 'nrcr', 'y', 'Background color of even rows (tables)', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'FFFFFF', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'adid', 'nrad', 'y', 'Login', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'adpw', 'nrad', 'y', 'Password', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'y', 'n', 'n', 'n', 'n', '', '', 'PASSWORD');;
INSERT INTO `nrcf` VALUES ('5', 'adem', 'nrad', 'y', 'Email', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', 'tools/vm.php?email=', 'tools/vemail.inc.php', '');;
INSERT INTO `nrcf` VALUES ('6', 'ader', 'nrad', 'y', 'Send error reports?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'adbc', 'nrad', 'y', 'Color schemas', '', 'y', 'y', 'y', 'n', 'nrcr', 'crnm', '', 'n', 'Standart', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'lgtb', 'nrlg', 'y', 'Table', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'lgid', 'nrlg', 'y', 'Login', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'atrl', 'nrat', 'y', 'Role', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'attb', 'nrat', 'y', 'Table code', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'atac', 'nrat', 'y', 'Rights', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'lgpk', 'nrlg', 'n', 'ID', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'lgst', 'nrlg', 'y', 'Status', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'lgop', 'nrlg', 'y', 'Operation', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'tbdl', 'nrtb', 'y', 'Days before deleting from Recycle Bin', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'tbro', 'nrtb', 'y', 'Read only?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'lgdt', 'nrlg', 'y', 'Date/time', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('18', 'cfaa', 'nrcf', 'y', 'Field for &quot;Add more&quot;?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'lgip', 'nrlg', 'y', 'IP', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'tbnu', 'nrtb', 'y', 'Records number (search page)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '20', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'tbss', 'nrtb', 'y', 'Script', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'nvid', 'nrnv', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'nvnm', 'nrnv', 'y', 'Name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'nvvr', 'nrnv', 'y', 'Menu entry type', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'nvtb', 'nrnv', 'y', 'Table', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'nvrl', 'nrnv', 'y', 'Role', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'nvad', 'nrnv', 'y', 'Additional parameters', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'crb5', 'nrcr', 'y', 'Main font color', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '336699', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('7', 'crb6', 'nrcr', 'y', 'Background color', '', 'n', 'y', 'y', 'n', '', '', '', 'n', 'FFFFFF', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'crb7', 'nrcr', 'y', 'Link color', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '006699', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('9', 'crb8', 'nrcr', 'y', 'Visited link color', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '993366', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('10', 'crb9', 'nrcr', 'y', 'Active link color', '', 'n', 'y', 'y', 'n', '', '', '', 'n', '006666', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('8', 'adsu', 'nrad', 'n', 'Super admin', '', 'n', 'n', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('22', 'cfmd', 'nrcf', 'y', 'Additional module', 'Link to user file', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'adto', 'nrad', 'y', 'Timeuot, sec', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('24', 'cffn', 'nrcf', 'y', 'Field function', 'SQL function which apply to field data during adding/editing', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'fsid', 'nrfs', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'fstx', 'nrfs', 'y', 'Text', '', 'y', 'y', 'y', 'n', 'nrfs', 'fsid', '<img src="trf.php?id[0]={*}&t=nrfl&f=flim" alt="" border=0>', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('16', 'cfvf', 'nrcf', 'y', 'Which field to show', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'rlid', 'nrrl', 'y', 'Role', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'rlds', 'nrrl', 'y', 'Description', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'urad', 'nrur', 'y', 'User', '', 'y', 'y', 'y', 'n', 'nrad', 'adid', '', 'n', '', '', 'n', 'y', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'urrl', 'nrur', 'y', 'Role', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', 'Operator', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'adrl', 'nrad', 'y', 'Main role', '', 'y', 'y', 'y', 'n', 'nrrl', 'rlid', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'cfds', 'nrcf', 'y', 'Pop-up', 'Field description', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('9', 'cfel', 'nrcf', 'y', 'Link field for table?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'cffl', 'nrcf', 'y', 'Field code', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'y', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('10', 'cfme', 'nrcf', 'y', 'Multy deleting?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('14', 'cfpd', 'nrcf', 'y', 'Send parameters?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('17', 'cfct', 'nrcf', 'y', 'Invisible?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('19', 'cfor', 'nrcf', 'y', 'Order field?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('20', 'cffe', 'nrcf', 'y', 'Mandatory field?', '', 'y', 'y', 'n', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('21', 'cffo', 'nrcf', 'y', 'Not for edit?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('23', 'cfmv', 'nrcf', 'y', 'Spell Check Module', 'String data. Array el[0] - boolean ( error or no), el[1] - message, el[2] - string after spell checking.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('6', 'flex', 'nrfl', 'y', 'Expire (c)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '3600', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('5', 'flim_siz', 'nrfl', 'y', 'File size', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');;
INSERT INTO `nrcf` VALUES ('4', 'flim_fnm', 'nrfl', 'n', 'File name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('3', 'flim', 'nrfl', 'y', 'File', '', 'y', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('1', 'flid', 'nrfl', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;
INSERT INTO `nrcf` VALUES ('2', 'flnm', 'nrfl', 'y', 'Name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');;


##########
# Table structure for table `nrcr`
#
# Creation: July 05, 2003 at 13:29
# Last update: July 05, 2003 at 12:29
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
) TYPE=MyISAM COMMENT='Color schemas';;

##########
# Dumping data for table `nrcr`
##########

INSERT INTO `nrcr` VALUES ('Standart', '999999', 'cccccc', 'eeeeee', 'FFFFFF', '336699', 'FFFFFF', '006699', '993366', '006666');;
INSERT INTO `nrcr` VALUES ('Spring', '99bb99', 'cceecc', 'eeffee', 'fafffa', '336666', 'FFFFFF', '009966', '339966', '006666');;
INSERT INTO `nrcr` VALUES ('Summer', '99bb99', 'cceecc', 'eeffee', 'fafffa', '336666', 'FFFFFF', '996600', '996633', '996666');;
INSERT INTO `nrcr` VALUES ('Autumn', 'FFCC99', 'FFFFBB', 'FFFFEE', 'FFFFFF', '993300', 'FFFFFF', '996600', '996633', '996666');;
INSERT INTO `nrcr` VALUES ('Winter', 'cccccc', 'dddddd', 'eeeeee', 'FFFFFF', '3f6f9f', 'FFFFFF', '336699', '996699', '4477aa');;


##########
# Table structure for table `nrfs`
#
# Creation: July 05, 2003 at 13:29
# Last update: February 24, 2004 at 11:41
##########

DROP TABLE IF EXISTS `nrfs`;;

CREATE TABLE `nrfs` (
  `fsid` smallint(5) unsigned NOT NULL auto_increment,
  `fstx` text NOT NULL,
  `ad` datetime NOT NULL default '0000-00-00 00:00:00',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `dl` enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (`fsid`)
) TYPE=MyISAM COMMENT='Help';;

##########
# Dumping data for table `nrfs`
##########

INSERT INTO `nrfs` VALUES ('1', 'Search masks: <li>&quot;_&quot; - one symbol;<li>&quot;%&quot; - any symbol quintity;<li>Use also: <b>&quot;=&quot;, &quot;!=&quot;, &quot;&lt;&gt;&quot;, &quot;&gt;&quot;, &quot;&lt;&quot;, &quot;&lt;=&gt;&quot;, &quot;&gt;=&quot;, &quot;&lt;=&quot;, &quot;like&quot;, &quot;not like&quot;, &quot;is null&quot;, &quot;is not null&quot;, &quot;regexp&quot;, &quot;not regexp&quot;, &quot;rlike&quot;, &quot;not rlike&quot;</b>.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '2001-09-23 14:45:48', '2001-09-23 14:57:22', 'n');;
INSERT INTO `nrfs` VALUES ('4', 'Simple http link:<br>&nbsp;&nbsp;<font class=b>&lt;a href=&quot;http://website_url&quot;&gt;</font>.', '2001-09-23 14:53:56', '2001-09-23 14:53:56', 'n');;
INSERT INTO `nrfs` VALUES ('5', 'Simple email link:<br>&nbsp;&nbsp;<font class=b>&lt;a href=&quot;mailto:email&quot;&gt;</font>.', '2001-09-23 14:54:32', '2001-09-23 14:54:32', 'n');;
INSERT INTO `nrfs` VALUES ('6', 'Call image from &quot;Image database&quot;:<br>&nbsp;&nbsp;<font class=b>&lt;img src=&quot;trf.php?id[0]=ID&t=nrfl&f=flim&quot; alt=&quot;ALT&quot; border=0&gt;</font><br>где, <br><font class=b>ID</font> - id from &quot;Image database&quot;', '2001-09-23 14:54:43', '2001-09-23 14:54:43', 'n');;


##########
# Table structure for table `nrlg`
#
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:57
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
) TYPE=MyISAM COMMENT='Log';;


##########
# Table structure for table `nrnv`
#
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:57
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
) TYPE=MyISAM COMMENT='Menu';;

##########
# Dumping data for table `nrnv`
##########

INSERT INTO `nrnv` VALUES ('1', '', '', 's', 'nrtb', '');;
INSERT INTO `nrnv` VALUES ('2', '', 'Administration', 'l', '', '');;
INSERT INTO `nrnv` VALUES ('3', '', 'Admins', 't', 'nrad', '');;
INSERT INTO `nrnv` VALUES ('4', '', 'Roles', 't', 'nrrl', '');;
INSERT INTO `nrnv` VALUES ('5', '', 'Admin roles', 't', 'nrur', '');;
INSERT INTO `nrnv` VALUES ('6', '', 'Rights access for tables', 't', 'nrat', '');;
INSERT INTO `nrnv` VALUES ('7', '', 'Color schemas', 't', 'nrcr', '');;
INSERT INTO `nrnv` VALUES ('8', '', 'Menu', 't', 'nrnv', '');;
INSERT INTO `nrnv` VALUES ('9', '', 'Log', 't', 'nrlg', '&sort=lgdt&dir=DESC');;
INSERT INTO `nrnv` VALUES ('10', '', 'Archive manage', 'o', '', 'tools/archive_manage.php');;
INSERT INTO `nrnv` VALUES ('11', '', 'Backup', 'o', '', 'tools/backup.php');;
INSERT INTO `nrnv` VALUES ('12', '', 'Restore', 'o', '', 'tools/restore.php');;
INSERT INTO `nrnv` VALUES ('13', '', 'Load text to base', 'o', '', 'tools/csv_to_base.php');;
INSERT INTO `nrnv` VALUES ('14', '', '', 's', '', '');;
INSERT INTO `nrnv` VALUES ('15', '', 'File', 'l', 'nrfl', '');;
INSERT INTO `nrnv` VALUES ('16', '', 'User files', 't', 'nrfl', '');;
INSERT INTO `nrnv` VALUES ('17', '', 'Upload files', 'o', 'nrfl', 'pg/files_en/ftb.php?l=');;
INSERT INTO `nrnv` VALUES ('18', '', '', 's', 'nrfl', '');;


##########
# Table structure for table `nrrl`
#
# Creation: July 05, 2003 at 13:29
# Last update: July 05, 2003 at 12:29
##########

DROP TABLE IF EXISTS `nrrl`;;

CREATE TABLE `nrrl` (
  `rlid` char(16) NOT NULL default '',
  `rlds` char(255) NOT NULL default '',
  PRIMARY KEY  (`rlid`)
) TYPE=MyISAM COMMENT='Role';;

##########
# Dumping data for table `nrrl`
##########

INSERT INTO `nrrl` VALUES ('Administrator', 'Access to administration');;
INSERT INTO `nrrl` VALUES ('Operator', 'Access to data');;


##########
# Table structure for table `nrtb`
#
# Creation: July 05, 2003 at 13:29
# Last update: March 01, 2004 at 16:57
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
) TYPE=MyISAM COMMENT='Tables';;

##########
# Dumping data for table `nrtb`
##########

INSERT INTO `nrtb` VALUES ('nrcf', 'Table configuration', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrcr', 'Color schemas', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrad', 'Administrators', '<li>If &quot;Password&quot; is empty when edit, password will not change.<li>Colors has hexadecimal values.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrat', 'Table access rights', '<li>Rights: n-access denied, r-only view, w-full access.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrtb', 'Tables', '<li>If &quot;Days to keep data in Recycle Bin&quot; = 0 Recycle Bin is disabled.<li>For property work Recycle Bin is require &quot;Log add/change&quot;.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrlg', 'Log', '', '20', '0', 'y', '');;
INSERT INTO `nrtb` VALUES ('nrnv', 'Menu', '<li>&quot;Type of menu entry&quot;=&quot;t&quot; - SQL table;<br>&quot;c&quot; - catalogue;<br>&quot;f&quot; - forum;<br>&quot;l&quot; - header;<br>&quot;s&quot; - separator;<br>&quot;o&quot; - module.', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrfs', 'Help', '', '20', '7', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrrl', 'Roles', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrur', 'Admin/Role', '', '20', '0', 'n', '');;
INSERT INTO `nrtb` VALUES ('nrfl', 'User Files', '', '20', '2', 'n', '');;


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
) TYPE=MyISAM COMMENT='Link Administrator/Role';;

##########
# Dumping data for table `nrur`
##########



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
) TYPE=MyISAM COMMENT='User Files';;

##########
# Dumping data for table `nrfl`
##########


