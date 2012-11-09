jQuery(document).ready(function() {
	
	var COOKIE_DESCRIPTION_NAME = 'DW_Admin_ConfManager_showDescription';
	
	var readCookie = function(cookieKey) {
		var ARRcookies=document.cookie.split(";");
		for (var i=0;i<ARRcookies.length;i++) {
			var key = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			var value = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			key = key.replace(/^\s+|\s+$/g,"");
			if (key == cookieKey) {
				return unescape(value);
			}
		}
	};
	
	var setCookie = function(key, value) {
		var expirationDate = new Date();
		expirationDate.setDate(expirationDate.getDate()+365);
		document.cookie = escape(key) + '=' + escape(value) + '; expires=' + expirationDate.toUTCString();
	};
	
	var setDescriptionVisible = function(show) {
		if(show) {
			jQuery('#description').show();
			jQuery('#description_toggle_button').attr('src', 'lib/plugins/confmanager/icons/collapse.png');
		} else {
			jQuery('#description').hide();
			jQuery('#description_toggle_button').attr('src', 'lib/plugins/confmanager/icons/expand.png');
		}
	};
	
	var cookie = readCookie(COOKIE_DESCRIPTION_NAME);
	if(cookie == null) {
		cookie = true;
	}
	var showDescription = cookie != 'false';
	
	setDescriptionVisible(showDescription);
	
	jQuery('#toggleDescription').click(function() {
		showDescription = !showDescription;
		setDescriptionVisible(showDescription);
		setCookie(COOKIE_DESCRIPTION_NAME, showDescription);
		return false;
	});
	
	jQuery('#toggleDefaults').click(function(){
		return false;
	});
});

jQuery(document).ready(function() {
	
	jQuery('.deleteButton').click(function(nr) {
		jQuery(this).parent().parent().remove();
	});
	
	jQuery('#confmanager__config__files').change(function(){
		document.forms['select_config_form'].submit();
	});
});
