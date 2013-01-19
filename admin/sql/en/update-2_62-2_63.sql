ALTER TABLE `nrcf` ADD `cfenc` VARCHAR( 255 ) NOT NULL AFTER `cfenf`;
ALTER TABLE `nrtb` DROP `tbcs`;

UPDATE `nrad` SET `adpw`=PASSWORD(`adpw`);

DELETE FROM `nrnv` WHERE `nvid`>=1 AND `nvid`<=11;
INSERT INTO `nrnv` VALUES ('1', '', '', 's', 'nrtb', '');
INSERT INTO `nrnv` VALUES ('2', '', 'Administration', 'l', '', '');
INSERT INTO `nrnv` VALUES ('3', '', 'Administrators', 't', 'nrad', '');
INSERT INTO `nrnv` VALUES ('4', '', 'Role', 't', 'nrrl', '');
INSERT INTO `nrnv` VALUES ('5', '', 'Administrator roles', 't', 'nrur', '');
INSERT INTO `nrnv` VALUES ('6', '', 'Access rights', 't', 'nrat', '');
INSERT INTO `nrnv` VALUES ('7', '', 'Color schemes', 't', 'nrcr', '');
INSERT INTO `nrnv` VALUES ('8', '', 'Menu', 't', 'nrnv', '');
INSERT INTO `nrnv` VALUES ('9', '', 'Log', 't', 'nrlg', '&sort=lgdt&dir=DESC');
INSERT INTO `nrnv` VALUES ('10', '', 'Archive', 'o', '', 'tools/backup.php');
INSERT INTO `nrnv` VALUES ('11', '', '', 's', '', '');


DELETE FROM `nrcf` WHERE `cftb`='nrcf' OR `cftb`='nrtb' OR `cftb`='nrlg';
INSERT INTO `nrcf` VALUES ('1', 'cfid', 'nrcf', 'y', '#', 'Sets field order for search and adding.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'cffl', 'nrcf', 'y', 'Field code', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'y', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'cftb', 'nrcf', 'y', 'Table code', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'y', 'n', 'y', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'cfsw', 'nrcf', 'y', 'Edit?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'cfnm', 'nrcf', 'y', 'name', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'cfds', 'nrcf', 'y', 'Pop-up', 'Field description.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'cfsv', 'nrcf', 'y', 'Visible (search)?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('8', 'cfsr', 'nrcf', 'y', 'Use for search?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('9', 'cfel', 'nrcf', 'y', 'For table link?', 'For linked record protect. Se also &quot;linked tables&quot;.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('10', 'cfme', 'nrcf', 'y', 'Multy deleting?', 'If yes, all linked records will be deleted.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('11', 'cfen', 'nrcf', 'y', 'Master table', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('12', 'cfenf', 'nrcf', 'y', 'Field to return', 'Which field from &quot;Master table&quot; will be return.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('13', 'cfenc', 'nrcf', 'y', 'What to return', 'Sets string with marked place for returnng data (to mark: {*})', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('14', 'cfpd', 'nrcf', 'y', 'Send parameters?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('15', 'cfdt', 'nrcf', 'y', 'Default value', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('16', 'cfvf', 'nrcf', 'y', 'Field to show', 'Sets field from &quot;Master table&quot;.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('17', 'cfct', 'nrcf', 'y', 'Invisible?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('18', 'cfaa', 'nrcf', 'y', 'Field for &quot;Add more&quot;?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('19', 'cfor', 'nrcf', 'y', 'Field for order?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('20', 'cffe', 'nrcf', 'y', 'Mandatory field?', '', 'y', 'y', 'n', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('21', 'cffo', 'nrcf', 'y', 'Edit denied?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('22', 'cfmd', 'nrcf', 'y', 'Addition module', 'Link to user file', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('23', 'cfmv', 'nrcf', 'y', 'Spell Check Module', 'String data. Array el[0] - boolean ( error or no), el[1] - message, el[2] - string after spell checking.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('24', 'cffn', 'nrcf', 'y', 'Field function', 'SQL function which apply to field data during adding/editing.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

INSERT INTO `nrcf` VALUES ('1', 'tbnm', 'nrtb', 'y', 'Table code', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'tbds', 'nrtb', 'y', 'Description', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'tbtx', 'nrtb', 'y', 'Help', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'tbnu', 'nrtb', 'y', 'Records number (search page)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '20', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'tbdl', 'nrtb', 'y', 'Days before deleting from Recycle Bin', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'tbro', 'nrtb', 'y', 'Read only?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'tbss', 'nrtb', 'y', 'Script', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

INSERT INTO `nrcf` VALUES ('1', 'lgpk', 'nrlg', 'n', 'ID', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'lgid', 'nrlg', 'y', 'login', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'lgtb', 'nrlg', 'y', 'Table', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'lgop', 'nrlg', 'y', 'Operation', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'lgst', 'nrlg', 'y', 'Status', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'lgip', 'nrlg', 'y', 'IP', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'lgdt', 'nrlg', 'y', 'Date/time', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

UPDATE `nrcf` SET `cffn`='PASSWORD' WHERE `cffl`=`adpw` AND `cftb`=`nrad`;