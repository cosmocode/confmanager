<?php

class admin_plugin_confmanager_index extends DokuWiki_Admin_Plugin {

    private $helper;

    public function __construct() {
        $this->helper = plugin_load('helper', 'confmanager');
    }

    public function getMenuSort() {
        return 101;
    }

    public function handle() {}

    public function html() {
        $configFiles = $this->helper->getConfigFiles();
        $default = '';
        include DOKU_PLUGIN . 'confmanager/tpl/selectConfig.php';
    }

}