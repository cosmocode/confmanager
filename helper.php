<?php

require_once DOKU_INC . 'lib/plugins/confmanager/ConfigManagerConfigFile.php';
require_once DOKU_INC . 'lib/plugins/confmanager/ConfigManagerConfigFileContent.php';

class helper_plugin_confmanager extends DokuWiki_Plugin {

    public function getConfigFiles() {
        static $configs = null;
        if ($configs === null) {
            $configs = array();
            trigger_event('CONFMANAGER_CONFIGFILES_REGISTER', $configs, null, false);
        }
        return $configs;
    }

    public function getConfigById($id) {
        foreach ($this->getConfigFiles() as $config) {
            if ($config->getId() === $id) {
                return $config;
            }
        }
        return false;
    }

    public function writeConfig(ConfigManagerConfigFile $file, array $content) {
        str_repeat('%s', $file->getRows());
    }

    public function readConfig(ConfigManagerConfigFile $file) {

    }
}

