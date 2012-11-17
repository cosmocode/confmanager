jQuery(document).ready(function() {
	
	var COOKIE_DESCRIPTION_NAME = 'DW_Admin_ConfManager_showDescription';
	var COOKIE_DEFAULTS_NAME = 'DW_Admin_ConfManager_showDefaults';
	
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
	
	/*
	 * defaultValue is a boolean value the function should return if the cookie is not set (undefined).
	 * returns false if cookie is undefined and defaultValue not specified
	 */
	var getBooleanFromCookie = function(key, defaultValue) {
		var cookie = readCookie(key);
		if(cookie == null || cookie == undefined) {
			return defaultValue == undefined ? false : defaultValue;
		}
		return cookie == 'true' ? true : false;
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
	
	var setDefaultsVisible = function(show) {
		if(show) {
			jQuery('.defaults').show();
			jQuery('#defaults_toggle_button').attr('src', 'lib/plugins/confmanager/icons/collapse.png');
		} else {
			jQuery('.defaults').hide();
			jQuery('#defaults_toggle_button').attr('src', 'lib/plugins/confmanager/icons/expand.png');
		}
	};
	
	var showDescription = getBooleanFromCookie(COOKIE_DESCRIPTION_NAME, true);
	var showDefaults = getBooleanFromCookie(COOKIE_DEFAULTS_NAME, true);
	
	setDescriptionVisible(showDescription);
	setDefaultsVisible(showDefaults);
	
	jQuery('#toggleDescription').click(function() {
		showDescription = !showDescription;
		setDescriptionVisible(showDescription);
		setCookie(COOKIE_DESCRIPTION_NAME, showDescription);
		return false;
	});
	
	jQuery('#toggleDefaults').click(function() {
		showDefaults = !showDefaults;
		setDefaultsVisible(showDefaults);
		setCookie(COOKIE_DEFAULTS_NAME, showDefaults);
		return false;
	});
});

jQuery(document).ready(function() {
	
	var isInputValid = function() {
		var result = true;
		jQuery('.newItem').each(function(){
			var inputString = jQuery(this).val();
			if(inputString == null || inputString == '') {
				result = false;
			}
		});
		return result;
	};
	
	var submitForm = function(id) {
		document.forms[id].submit();
	};
	
	jQuery('.deleteButton').click(function(nr) {
		jQuery(this).parent().parent().remove();
		submitForm('configForm');
	});
	
	jQuery('#confmanager__config__files').change(function(){
		submitForm('select_config_form');
	});
	
	jQuery('.submitOnTab').keydown(function(event){
		if(event.which != 9) {
			return true;
		}
		if(!isInputValid()) {
			return true;
		}
		submitForm('configForm');
	});
});

jQuery(document).ready(function(){
	jQuery('.newItem').first().focus();
});
