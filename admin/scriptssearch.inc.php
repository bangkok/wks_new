<script language="JavaScript">
<!--
function SelectOne(msg)
{
	<?
		$context = ereg_replace("{}amp;", "&", $context);
	?>
	AddSearche(msg, '<?print $type?>', '<?print $engN?>', '<?print substr($context, 0, strpos($context, "{*}"))?>', '<?print substr($context, strpos($context, "{*}") + 3)?>');
	<?
		$context = urlencode($context);
	?>
//	window.close();
}
function AddSearche(msg, type, i, cont1, cont2)
{
	if (type == 0 || type == "")
	{
		with(opener.document.sendmessage)
		{
			if (msg!="")
			{
				opener.document.sendmessage.elements["fields["+i+"]"].value=msg;
				//IE support
				if (opener.document.selection) {
					opener.document.sendmessage.elements["fields["+i+"]"].focus();
					sel = opener.document.selection.createRange();
					opener.document.sendmessage.insert.focus();
				}
			}
		}
	}
	else if (type == 1)
	{
		var area = opener.document.sendmessage.elements["fields["+i+"]"];

		//IE support
		if (opener.document.selection) {
			area.focus();
			sel = opener.document.selection.createRange();
			sel.text = cont1 + msg + cont2;
			opener.document.sendmessage.insert.focus();
		}
		//MOZILLA/NETSCAPE support
		else if (opener.document.sendmessage.elements["fields["+i+"]"].selectionStart || opener.document.sendmessage.elements["fields["+i+"]"].selectionStart == "0") {
			var startPos = opener.document.sendmessage.elements["fields["+i+"]"].selectionStart;
			var endPos = opener.document.sendmessage.elements["fields["+i+"]"].selectionEnd;
			var chaine = opener.document.sendmessage.elements["fields["+i+"]"].value;

			area.value = chaine.substring(0, startPos) + cont1 + msg + cont2 + chaine.substring(endPos, chaine.length);
		} else {
			area.value += msg;
		}
	}
	else if (type == 2)
	{
		opener.setImage(cont1 + msg + cont2);
		window.close();
	}
}
function ToggleAll(e, l)
{
	if (e.checked) {
		CheckAll(l);
	}
	else {
		ClearAll(l);
	}
}
function CheckAll(l)
{
	var sr = document.searchlist;
	var len = l;
	for (var i = 0; i < len; i++)
	{
		sr.elements["dl_["+i+"]"].checked = true;
	}
	sr.toggleAll.checked = true;
}

function ClearAll(l)
{
	var sr = document.searchlist;
	var len = l;
	for (var i = 0; i < len; i++)
	{
		sr.elements["dl_["+i+"]"].checked = false;
	}
	sr.toggleAll.checked = false;
}

//-->
</script>
