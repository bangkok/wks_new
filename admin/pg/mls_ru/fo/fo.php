<?
$NoUser="Нет такого пользователя.";
$ConfirmReg="Подписка подтверждена.";
$DeleteReg="Подписка удалена.";
$EmailError="Неверно введен email.";
$YouChangeNotConfirm="Вы добавлены в базу. Вам по почте будет выслано сообщение для подтверждения подписки.";
$YouChange="Вы добавлены в базу. Вам по почте будет выслано сообщение для подтверждения подписки.";
$YouAdded="Вы добавлены в базу. Вам по почте будет выслано сообщение для подтверждения подписки.";
$TitleEmail="Подтверждение подписки.";
$GoToSite="Перейти на сайт.";
$YouDontFound="Нет пользователя с таким адресом.";
$YouRequestToDeliteFromMLS="Вам по почте будет выслано сообщение для подтверждения операции.";

if ($formenter=="yes" || (isset($usr) && isset($email)))
{
	if (isset($usr) && isset($email))
	{
		$query="SELECT mlnm FROM nrml WHERE mlpw='$usr' and mlnm='$email'";
		$result=mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD1-c.');
		if(!list($mlnm)=mysql_fetch_row($result))
		{
			print $NoUser;
		}
		else
		{
			if ($stat!='del')
			{
				$query="UPDATE nrml SET mlcf='r' WHERE mlpw='$usr' and mlnm='$email'";
				mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD2-c.');
				@mail($admin_mail, convert_cyr_string("Подтвердил подписку $email",'w','k'), convert_cyr_string("Подтвердил подписку $email",'w','k') , "From: $email_from");
				print $ConfirmReg;
				print "<br><a href=\"$href\">$GoToSite</a>";
			}
			else
			{
				$query="UPDATE nrml SET mlcf='d' WHERE mlpw='$usr' and mlnm='$email'";
				mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD2-c.');
				@mail($admin_mail, convert_cyr_string("Удалил подписку $email",'w','k'), convert_cyr_string("Удалил подписку $email",'w','k') , "From: $email_from");
				print $DeleteReg;
			}
		}
	}
	else
	{
		$er='false';

		if (!$email || $email=="" || !ereg("@", $email) || $email=='Ваш@Email' || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
		{
			print $EmailError;
			$er='true';
		}

		if ($er!='true' && $sub=='Подписаться')
		{
			$flag_mlnm=false;
			$query="SELECT mlnm FROM nrml WHERE mlnm='$email'";
			$result=mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD1.');
			if (list($mlnm)=mysql_fetch_row($result))
				$flag_mlnm=true;

			if ($flag_mlnm)
			{
				$query="UPDATE nrml SET mlnm='$email', up='".date("Y-m-d h:i:s")."' WHERE mlnm='$email'";
				mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD2.');
				
				$query="SELECT mlpw, mlcf FROM nrml WHERE mlnm='$email'";
				$result=mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD3.');
				if (list($mlpw, $mlcf)=mysql_fetch_row($result))
				{
					if ($mlcf=='c')
					{
						$TextEmail="Кто-то, возможно Вы подписался на рассылку $href. Если Вы хотите подтвердить рассылку загрузите следующию ссылку ".$href."mail_list.php?usr=".$mlpw."&email=".$email;
						@mail($email, convert_cyr_string($TitleEmail,'w','k'), convert_cyr_string($TextEmail,'w','k'), "From: $email_from");
						@mail($admin_mail, convert_cyr_string("Подписался еще раз не подтвердив подписку - $email",'w','k'), convert_cyr_string("Подписался еще раз не подтвердив подписку - $email",'w','k'), "From: $email_from");
						print $YouChangeNotConfirm;
					}
					else
					{
						@mail($admin_mail, convert_cyr_string("Подписался еще раз - $email",'w','k'), convert_cyr_string("Подписался еще раз - $email",'w','k'), "From: $email_from");
						print $YouChange;
					}
				}
			}
			else
			{
				$query="INSERT INTO nrml (mlnm, mlpw, mlcf, ad) VALUES ('$email', PASSWORD('$email'), 'c', '".date("Y-m-d h:i:s")."')";
				mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD4.');

				$query="SELECT mlpw FROM nrml WHERE mlnm='$email'";
				$result=mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD5.');
				if (list($mlpw)=mysql_fetch_row($result))
				{
					$TextEmail="Кто-то, возможно Вы подписался на рассылку $href. Если Вы хотите подтвердить рассылку загрузите следующию ссылку ".$href."mail_list.php?usr=".$mlpw."&email=".$email;
					@mail($email, convert_cyr_string($TitleEmail,'w','k'), convert_cyr_string($TextEmail,'w','k'), "From: $email_from");
					@mail($admin_mail, convert_cyr_string("Подписался  - $email",'w','k'), convert_cyr_string("Подписался - $email",'w','k'), "From: $email_from");
					print $YouAdded;
				}
			}
		}
		elseif ($er!='true' && $sub=='Отписаться')
		{
			$flag_mlnm=false;
			$query="SELECT mlnm, mlpw FROM nrml WHERE mlnm='$email' AND mlcf IN ('r', 'c')";
			$result=mysql_db_query($base,$query,$ident) or  mysql_die ($error.' COD1.');
			if (list($mlnm, $mlpw)=mysql_fetch_row($result))
				$flag_mlnm=true;

			if ($flag_mlnm)
			{
				$TextEmail="Кто-то, возможно Вы пытались отписаться от рассылки $href. Если Вы действительно хотите отписаться, загрузите следующию ссылку ".$href."mail_list.php?usr=".$mlpw."&email=".$email."&stat=del";
				@mail($email, convert_cyr_string($TitleEmail,'w','k'), convert_cyr_string($TextEmail,'w','k'), "From: $email_from");
				@mail($admin_mail, convert_cyr_string("Запрос на отказ от рассылки - $email",'w','k'), convert_cyr_string("Запрос на отказ от рассылки - $email",'w','k'), "From: $email_from");
				print $YouRequestToDeliteFromMLS;
			}
			else
			{
				print $YouDontFound;
			}
		}
	}
?>
<br><br>
<a href="javascript:history.go(-1)">&lt;&lt;назад</a>
<?
}
else
{
?>
<div align=center>
<form method=post action="index.php">
<input type=hidden name=formenter value="yes">
<input type=hidden name=m value="<?print $m?>">
<font class=bms>Подписка на рассылку:</font><br>
<input type=text name=email value="<?if (isset($sem)) print $sem; else print "Ваш@Email";?>">
<input type=submit name=sub value="Подписаться">&nbsp;<input type=submit value="Отписаться">
</form>
</div>
<?
}
?>