CREATE TABLE nrfl% (
  flid smallint(5) unsigned NOT NULL auto_increment,
  flnm varchar(50) NOT NULL default '',
  flim mediumblob NOT NULL,
  flim_fnm varchar(50) NOT NULL default '',
  flim_siz int(11) NOT NULL default '0',
  flex mediumint(8) unsigned NOT NULL default '0',
  ad datetime NOT NULL default '0000-00-00 00:00:00',
  up datetime NOT NULL default '0000-00-00 00:00:00',
  dl enum('y','n') NOT NULL default 'n',
  PRIMARY KEY  (flid)
) TYPE=MyISAM COMMENT='����� ������������';

INSERT INTO nrcf VALUES (1, 'flid', 'nrfl%', 'y', 'ID', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO nrcf VALUES (2, 'flnm', 'nrfl%', 'y', '������������', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO nrcf VALUES (3, 'flim', 'nrfl%', 'y', '����', '', 'y', 'n', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO nrcf VALUES (4, 'flim_fnm', 'nrfl%', 'n', '������������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '');
INSERT INTO nrcf VALUES (5, 'flim_siz', 'nrfl%', 'y', '������ �����', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'y', '', '', '');
INSERT INTO nrcf VALUES (6, 'flex', 'nrfl%', 'y', 'Expire (c)', '', 'y', 'y', 'y', 'n', '', '', '', 'n', '0', '', 'n', 'n', 'n', 'n', 'n', '', '', '');


INSERT INTO nrnv VALUES (###, '', '����� ##', 'l', 'nrfl%', '');
INSERT INTO nrnv VALUES (###, '', '����� ������������', 't', 'nrfl%', '');
INSERT INTO nrnv VALUES (###, '', '������� ������', 'o', 'nrfl%', 'pg/files/ftb.php?l=%');
INSERT INTO nrnv VALUES (###, '', '', 's', 'nrfl%', '');

INSERT INTO nrtb VALUES ('nrfl%', '����� ������������', '', 20, 2, 'n', '');
INSERT INTO nrat VALUES ('Operator', 'nrfl%', 'w', '2002-07-25 14:22:23', '2002-07-25 14:22:23');

INSERT INTO nrfs VALUES (6, '��� ������ �������� �� &quot;���� ��������&quot; ���������� �������� ��������:<br>\r\n&nbsp;&nbsp;<font class=b>&lt;img src=&quot;trf.php?id[0]=ID&t=nrfl&f=flim&quot; alt=&quot;ALT&quot; border=0&gt;</font><br>\r\n���, <br><font class=b>ID</font> - ����� �� &quot;���� ��������&quot;, ����������� �� ��������<br>\r\n<font class=b>ALT</font> - ����������� ��������� ���������.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������� ����� ��������� ��������� <font class=b>width=������</font> � <font class=b>height=������</font>, ��� <font class=b>������</font> � <font class=b>������</font> �������� �������� ��������������� ���������� ��������.', '2001-09-23 14:54:43', '2001-09-23 14:54:43', 'n');

