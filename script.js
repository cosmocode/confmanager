function toggleDescription() {
	jQuery('#description').toggle();
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