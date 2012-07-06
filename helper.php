<?php

require_once DOKU_INC . 'lib/plugins/confmanager/ConfigManagerConfigFile.php';
require_once DOKU_INC . 'lib/plugins/confmanager/ConfigManagerConfigFileContent.php';

class helper_plugin_confmanager extends DokuWiki_Plugin {

    public function getConfigFiles() {
        static $configs = null;
        if ($configs === null) {
            $configs = $this->getCoreConfigFiles();
            trigger_event('CONFMANAGER_CONFIGFILES_REGISTER', $configs, null, false);
        }
        return $configs;
    }

    private function getCoreConfigFiles() {
        return array(
            ConfigManagerConfigFile::create('acronyms'),
            ConfigManagerConfigFile::create('entities'),
            ConfigManagerConfigFile::create('interwiki')
                ->setImageFolder(DOKU_INC . 'lib/images/interwiki/')
                ->setExtension('.gif')
                ->setImagePosLeft(),
            ConfigManagerConfigFile::create('mime'),
            ConfigManagerConfigFile::create('smileys')->setImageFolder(DOKU_INC . 'lib/images/smileys/'),
            ConfigManagerConfigFile::create('scheme')->setOneLine(),
            ConfigManagerConfigFile::create('wordblock')->setOneLine()
        );
    }

    public function writeConfig(ConfigManagerConfigFile $file, array $content) {
        str_repeat('%s', $file->getRows());
    }

    public function readConfig(ConfigManagerConfigFile $file) {

    }
}

