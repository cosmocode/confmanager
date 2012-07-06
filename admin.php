<?php
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'admin.php');
require_once(DOKU_INC.'inc/confutils.php');

class admin_plugin_confmanager extends DokuWiki_Admin_Plugin {

    private $helper;

    public function __construct() {
        $this->helper = plugin_load('helper', 'confmanager');
    }

    function getMenuSort() {
        return 101;
    }

    function handle() {

    }

    function _sortConf( $k1 , $k2 ) {
        return strlen( $k2 ) - strlen( $k1 );
    }

    function _sortHuman( $k1 , $k2 ) {
        $k1 = strtolower($k1);
        $k2 = strtolower($k2);
        return strnatcmp($k1,$k2);
    }

    function html() {
        $configFiles = $this->helper->getConfigFiles();
        include DOKU_INC . '/lib/plugins/confmanager/tpl/selectConfig.php';
    }

}