ALTER TABLE `nrcf` ADD `cfenc` VARCHAR( 255 ) NOT NULL AFTER `cfenf`;
ALTER TABLE `nrtb` DROP `tbcs`;

UPDATE `nrad` SET `adpw`=PASSWORD(`adpw`);

DELETE FROM `nrnv` WHERE `nvid`>=1 AND `nvid`<=11;
INSERT INTO `nrnv` VALUES ('1', '', '', 's', 'nrtb', '');
INSERT INTO `nrnv` VALUES ('2', '', '����������������e', 'l', '', '');
INSERT INTO `nrnv` VALUES ('3', '', '��������������', 't', 'nrad', '');
INSERT INTO `nrnv` VALUES ('4', '', '����', 't', 'nrrl', '');
INSERT INTO `nrnv` VALUES ('5', '', '���� ���������������', 't', 'nrur', '');
INSERT INTO `nrnv` VALUES ('6', '', '����� ������� � ����', 't', 'nrat', '');
INSERT INTO `nrnv` VALUES ('7', '', '�������� �����', 't', 'nrcr', '');
INSERT INTO `nrnv` VALUES ('8', '', '����', 't', 'nrnv', '');
INSERT INTO `nrnv` VALUES ('9', '', '������ ��������', 't', 'nrlg', '&sort=lgdt&dir=DESC');
INSERT INTO `nrnv` VALUES ('10', '', '���������', 'o', '', 'tools/backup.php');
INSERT INTO `nrnv` VALUES ('11', '', '', 's', '', '');


DELETE FROM `nrcf` WHERE `cftb`='nrcf' OR `cftb`='nrtb' OR `cftb`='nrlg';
INSERT INTO `nrcf` VALUES ('1', 'cfid', 'nrcf', 'y', '# ����', '���������� ������� ���������� ���� ��� ������ � � ����� ����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'y', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'cffl', 'nrcf', 'y', '��� ����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'y', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'cftb', 'nrcf', 'y', '��� �������', '', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'y', 'n', 'y', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'cfsw', 'nrcf', 'y', '������� �� ��� ��������������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'cfnm', 'nrcf', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'cfds', 'nrcf', 'y', '����������� ���������', '�������� ����, ��������� ��� ��������� �� �������� ����.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'cfsv', 'nrcf', 'y', '������� �� � ������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('8', 'cfsr', 'nrcf', 'y', '�������� �� ����� �� ����?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('9', 'cfel', 'nrcf', 'y', '������� ������� �� ����� ����?', '���� ���������� ������ ������, �� ������� ��������� � &quot;��������� �������&quot; ����� �������� �� �������� ������ ���� �� ��� ���� ������ � ������ �������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('10', 'cfme', 'nrcf', 'y', '��������������?', '���� �� �� ��� �������� ��� ������� ������� ���������� ������ ���� ������� (�������� � ���), ����� ������� �� ����� ������. ������ � ������� �� ����������� ������ �� ��������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('11', 'cfen', 'nrcf', 'y', '������ �������', '�� ��������� ������� ����� ������������ ������ � ������.', 'y', 'y', 'y', 'n', 'nrtb', 'tbnm', '', 'n', '', 'tbds', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('12', 'cfenf', 'nrcf', 'y', '���� ��� ��������', '����� ���� �� &quot;������ �������&quot; ����� ������������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('13', 'cfenc', 'nrcf', 'y', '�������� ��������', '������� ������ � �������� ����� ��� ����������� ������. (����� ������� - {*})', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('14', 'cfpd', 'nrcf', 'y', '�������� ��� ������ �������<br>������� �������� ����������?', '��� ������ ������� ����� �������� ������� �������� ���������� � ������ ������� � �������� ��������������� ������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('15', 'cfdt', 'nrcf', 'y', '���������������� ��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('16', 'cfvf', 'nrcf', 'y', '����� ���� ����������', '����� ���� �� &quot;������ �������&quot; ����� ������������ ��� ���������������� �����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('17', 'cfct', 'nrcf', 'y', '�� ���������� ��������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('18', 'cfaa', 'nrcf', 'y', '���� ��� ������� &quot;�������� ���&quot;?', '�������� ���� ����� ������������ ��� ������� &quot;�������� ���&quot;.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('19', 'cfor', 'nrcf', 'y', '���� ��� ����������?', '���� �������� ����� ��� ����������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('20', 'cffe', 'nrcf', 'y', '���� ����������� ��� ����������?', '�� �������� ��� ���a - BLOB.', 'y', 'y', 'n', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('21', 'cffo', 'nrcf', 'y', '�������������� ���������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', 'n', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('22', 'cfmd', 'nrcf', 'y', '�������������� ������', '������ �� ���� ������ ������� ����� ������������ �������� ������� ���� ��� ��������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('23', 'cfmv', 'nrcf', 'y', '������ �������� � ���������<br>��������� ������.', '�������� ������ � ���� ������, � ������ ������ ��� el[0] - boolean (������ ��� ���), el[1] - ���������, el[2] - ������ ����� ���������/���������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('24', 'cffn', 'nrcf', 'y', '������� ��� ����', '������� SQL ������� ����� ���������� � ������ ���� ��� ���������� � �������������� ������.', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

INSERT INTO `nrcf` VALUES ('1', 'tbnm', 'nrtb', 'y', '��� �������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'tbds', 'nrtb', 'y', '��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'tbtx', 'nrtb', 'y', '����� ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'tbnu', 'nrtb', 'y', '�� ������� ������� ���������� � ������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '20', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'tbdl', 'nrtb', 'y', '����� ������� ���� ������� �� �������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'tbro', 'nrtb', 'y', '������ ������?', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'tbss', 'nrtb', 'y', '������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

INSERT INTO `nrcf` VALUES ('1', 'lgpk', 'nrlg', 'n', 'ID', '', 'n', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('2', 'lgid', 'nrlg', 'y', '�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('3', 'lgtb', 'nrlg', 'y', '�������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('4', 'lgop', 'nrlg', 'y', '��������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('5', 'lgst', 'nrlg', 'y', '������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('6', 'lgip', 'nrlg', 'y', 'IP', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO `nrcf` VALUES ('7', 'lgdt', 'nrlg', 'y', '����/�����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');

UPDATE `nrcf` SET `cffn`='PASSWORD' WHERE `cffl`=`adpw` AND `cftb`=`nrad`;
