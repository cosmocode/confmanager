<?php


// These settings must be present and set appropriately for the language.
// Do not change, if you don't know what it does!
$lang['encoding']   = 'utf-8';
$lang['direction']  = 'ltr';
 

// For admin plugins, the menu prompt to be displayed in the admin menu.
// If set here, the plugin doesn't need to override the getMenuText() method
$lang['menu'] = 'Configuration File Manager'; 
 

// Page header
$lang['welcomehead'] = 'Configuration File Manager';
$lang['welcome']     = 'The Configuration File Manager allows you to edit '
    . 'various configuration files from DokuWiki and its plug-ins.';


// Page controls (buttons, labels, etc.)
$lang['save'] = 'Save';
$lang['select_config'] = 'Select a configuration file';
$lang['please_select'] = '--- Please select an entry ---';
$lang['edit'] = 'Edit';
$lang['cannot change default file icon'] = 'Cannot change default icons';
$lang['delete_action'] = 'delete';
$lang['edit_key_action'] = 'edit';
$lang['edit_key_action_tooltip'] = 'Click here to rename this entry';
$lang['delete_action_tooltip'] = 'Click here to delete this entry';
$lang['delete_action_tooltip_disabled'] = 'Cannot delete default values';
$lang['edit_key_action_tooltip_disabled'] = 'Cannot edit default values';
$lang['default_value_tooltip'] = 'This is a default value that cannot be changed';
$lang['edit_icon_action'] = 'edit icon';
$lang['edit_icon_action_tooltip'] = 'Click here to choose another icon';
$lang['edit_icon_action_tooltip_disabled'] = 'Cannot change default icons';
$lang['toggle_description'] = 'Toggle description on/off';
$lang['toggle_defaults'] = 'Toggle display of default values on/off';
$lang['defaults_description'] = 'Please note: default values define the basic behavior of DokuWiki and cannot be changed.';
$lang['add_action'] = 'add';
$lang['add_action_tooltip'] = 'Click here to add the new item to the list';
$lang['no_script_title'] = 'JavaScript is disabled!';
$lang['no_script_message'] = 'As long as JavaScript is disabled, confmanager offers only basic functionality. To benefit from convenience functions like collapsing sections, quick actions on items, etc. turn on your JavaScript. We won\'t hurt you. Promise.';
$lang['file_upload_prompt'] = 'Please select an image file to upload';
$lang['upload'] = 'Upload';
$lang['cancel'] = 'Cancel';
$lang['uploading'] = 'Uploading file...';
$lang['upload_success'] = 'The upload was successful';
$lang['upload_error'] = 'The upload has failed';
$lang['continue'] = 'Continue';
$lang['delete_icon_action'] = 'delete icon';
$lang['delete_icon_action_tooltip'] = 'Click here to delete the icon';
$lang['delete_icon_action_disabled'] = 'cannot delete icon';
$lang['delete_icon_action_tooltip_disabled'] = 'Cannot delete the icon';

// Table headers
$lang['key'] = 'Key';
$lang['value'] = 'Value';
$lang['actions'] = 'Actions';
$lang['user_defined_values'] = 'User defined values';
$lang['default_values'] = 'Default values';


// Names of DokuWiki's default config files
$lang['URL Schemes'] = 'URL Schemes';
$lang['Blacklisting'] = 'Blacklisting';
$lang['Acronyms'] = 'Abbreviations and Acronyms';
$lang['Entity replacements'] = 'Entity replacements';
$lang['MIME configuration'] = 'MIME configuration';
$lang['InterWiki Links'] = 'InterWiki Links';


// Error Messages
$lang['invalid request csrf'] = 'Warning: cross site scripting attempt detected';


// TODO:
$lang['invalid save arguments'] = 'FIXME Beim config speichern ist ein "fehler" aufgetreten';
$lang['changes applied'] = 'Changes have been applied successfully';
$lang['cannot apply changes'] = 'Could not apply changes';
$lang['no local file given'] = 'Beim laden der config - kein ort für die lokale config datei angegeben -- fehlermeldung hauptsächlich für entwickler von plug-ins';

// Fehler beim upload
$lang['upload_errNoAdmin'] = 'user ist kein admin';
$lang['upload_errNoConfig'] = 'keine config gefunden/angegeben';
$lang['upload_errNoFileSend'] = 'keine datei übertragen';
$lang['upload_errNoConfigKeySend'] = 'key parameter nicht angegeben';
$lang['upload_errCannotOverwriteDefaultKey'] = 'kann default icon nicht überschreiben';
$lang['upload_errUploadError'] = 'fehler beim upload';
$lang['upload_errNoFileExtension'] = 'keine datei extension';
$lang['upload_errWrongFileExtension'] = 'falsche datei extension';
$lang['upload_errCannotMoveUploadedFileToFolder'] = 'kann hochgeladene datei nicht in images ordner verschieben (mögl. rechte problematik)';
$lang['iconDelete_error'] = 'Fehler beim löschen des icons (mögl. rechteproblematik)';