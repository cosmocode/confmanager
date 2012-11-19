<?php

class action_plugin_confmanager_upload extends DokuWiki_Action_Plugin {

    /**
     * @var helper_plugin_confmanager
     */
    var $helper;

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

        $config = $this->getConfig();
        if ($config === false) {
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

    /**
     * @return bool|ConfigManagerUploadable
     */
    private function getConfig() {
        global $INPUT;
        $configId = $INPUT->str($_POST['configId'], null, true);
        if ($configId === null) {
            return false;
        }

        $config = $this->helper->getConfigById($configId);
        if (!$config) {
            return false;
        }

        if (!($config instanceof ConfigManagerUploadable)) {
            return false;
        }
        return $config;
    }
}
