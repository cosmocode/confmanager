<?php

if(!defined('DOKU_PLUGIN_ICONS')) define('DOKU_PLUGIN_ICONS',DOKU_BASE.'lib/plugins/confmanager/icons/');

require_once DOKU_PLUGIN . 'confmanager/adminActions/ConfigManagerAdminAction.php';
require_once DOKU_PLUGIN . 'confmanager/adminActions/ConfigManagerAdminOverview.php';
require_once DOKU_PLUGIN . 'confmanager/adminActions/ConfigManagerAdminShowConfig.php';

/**
 * Class admin_plugin_confmanager
 */
class admin_plugin_confmanager extends DokuWiki_Admin_Plugin {

    /**
     * @var ConfigManagerAdminAction action to run
     */
    private $adminAction;

    /**
     * Determine position in list in admin window
     * Lower values are sorted up
     *
     * @return int
     */
    public function getMenuSort() {
        return 101;
    }

    /**
     * Carry out required processing
     */
    public function handle() {
        $this->determineAction();
        $this->adminAction->handle();
    }

    private function determineAction() {
        if (!isset($_REQUEST['configFile'])) {
            $this->adminAction = new ConfigManagerAdminOverview();
            return;
        }
        $this->adminAction = new ConfigManagerAdminShowConfig();
    }

    /**
     * Output html of the admin page
     */
    public function html() {
        echo '<div id="confmanager">';
        $this->adminAction->html();
        echo '</div>';
    }
}
