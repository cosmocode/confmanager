<?php

class action_plugin_confmanager_upload extends DokuWiki_Action_Plugin {

    /**
     * @var helper_plugin_confmanager
     */
    var $helper;

    /**
     * Register its handlers with the dokuwiki's event controller
     * @param Doku_Event_Handler $controller
     */
    public function register(Doku_Event_Handler &$controller) {
        $controller->register_hook('AJAX_CALL_UNKNOWN', 'BEFORE',  $this, 'upload', array());
        $this->helper = plugin_load('helper', 'confmanager');
    }

    public function upload(Doku_Event &$event, $param) {
        if ($event->data !== 'confmanager_upload') {
            return;
        }

        $event->preventDefault();
        $event->stopPropagation();

        if (!auth_isadmin()) {
            header('HTTP/1.1 403 Forbidden');
            return;
        }

        global $INPUT;
        $configId = $INPUT->str($_POST['configId'], null, true);
        if ($configId === null) {
            header('HTTP/1.1 405 Method Not Allowed');
            echo '0';
            return;
        }

        $config = $this->helper->getConfigById($configId);
        if (!$config) {
            header('HTTP/1.1 405 Method Not Allowed');
            echo '0';
            return;
        }

        if (!($config instanceof ConfigManagerUploadable)) {
            header('HTTP/1.1 405 Method Not Allowed');
            echo '0';
            return;
        }

        if (!$config->upload()) {
            header('HTTP/1.1 500 Internal Server Error');
            echo '0';
            return;
        }
        echo '1';
    }
}
