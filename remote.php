<?php

/**
 * Class remote_plugin_confmanager
 */
class remote_plugin_confmanager extends DokuWiki_Remote_Plugin {

    /**
     * @var helper_plugin_confmanager
     */
    private $helper;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->helper = $this->loadHelper('confmanager', null);
    }

    /**
     * Get all available methods with remote access.
     *
     * @return array Information about all provided methods.
     */
    public function _getMethods() {
        return array(
            'getConfigs' => array(
                'args' => array(),
                'return' => 'array'
            )
        );
    }

    /**
     * @return mixed
     * @throws RemoteAccessDeniedException
     */
    public function getConfigs() {
        $this->ensureAdmin();
        $this->helper->getConfigFiles();
        return $this->getApi()->toDate(time());
    }

    private function ensureAdmin() {
        if (!auth_isadmin()) {
            throw new RemoteAccessDeniedException();
        }
    }
}
