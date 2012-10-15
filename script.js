var COOKIE_DESCRIPTION_NAME = 'DW_Admin_ConfManager_showDescription';

var showDescription = true;

jQuery(document).ready(function() {
	var cookie = readCookie(COOKIE_DESCRIPTION_NAME);
	if(cookie == null) {
		cookie = true;
	}
	showDescription = (cookie == 'false' ? false : true);
	if(!showDescription) {
		jQuery('#description').hide();
	}
});

function toggleDescription() {
	if(!showDescription) {
		jQuery('#description').show();
	} else {
		jQuery('#description').hide();
	}
	showDescription = !showDescription;
	setCookie(COOKIE_DESCRIPTION_NAME, showDescription);
}

function setCookie(key, value) {
	var expirationDate = new Date();
	expirationDate.setDate(expirationDate.getDate()+365);
	document.cookie = escape(key) + '=' + escape(value) + '; expires=' + expirationDate.toUTCString();
}

function readCookie(cookieKey) {
	var ARRcookies=document.cookie.split(";");
	for (var i=0;i<ARRcookies.length;i++) {
		var key = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		var value = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		key = key.replace(/^\s+|\s+$/g,"");
		if (key == cookieKey) {
			return unescape(value);
		}
	}
}

function submitForm(name) {
	document.forms[name].submit();
}

function deleteLine(nr) {
	jQuery('#value'+nr).val('');
	jQuery('#tableLine'+nr).toggle();
}

function renameLine(nr) {
	var key = jQuery('#key'+nr).text();
	jQuery('#value'+nr).val('');
	jQuery('#tableLine'+nr).toggle();
}
