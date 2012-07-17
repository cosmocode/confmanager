<?php

class admin_plugin_confmanager_show extends DokuWiki_Admin_Plugin {

    private $helper;
    private $configId;
    private $config;

    public function __construct() {
        $this->helper = plugin_load('helper', 'confmanager');
    }

    public function getMenuSort() {
        return 101;
    }

    public function handle() {
        global $INPUT;
        global $ID;

        $this->configId = $INPUT->str('configFile');
        $this->config = $this->helper->getConfigById($this->configId);
        if ($this->config === false) {
            $params = array(
                'do' => 'admin',
                'page' => 'confmanager_index'
            );
            send_redirect(wl($ID, $params, false, '&'));
        }
    }

    public function _sortConf( $k1 , $k2 ) {
        return strlen( $k2 ) - strlen( $k1 );
    }

    public function _sortHuman( $k1 , $k2 ) {
        $k1 = strtolower($k1);
        $k2 = strtolower($k2);
        return strnatcmp($k1,$k2);
    }

    public function html() {
        $this->header();
        $this->displayConfig();
    }

    private function header() {
        $configFiles = $this->helper->getConfigFiles();
        $default = $this->configId;
        include DOKU_PLUGIN . 'confmanager/tpl/selectConfig.php';
    }

    public function displayConfig() {
        include DOKU_PLUGIN . 'confmanager/tpl/showConfig.php';
    }
}