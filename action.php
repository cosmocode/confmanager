<?php

require_once DOKU_PLUGIN . 'confmanager/configTypes/ConfigManagerConfigType.php';
require_once DOKU_PLUGIN . 'confmanager/configTypes/ConfigManagerSingleLineConfigCascade.php';

class action_plugin_confmanager extends DokuWiki_Action_Plugin {
    var $helper;

    /**
     * Register its handlers with the dokuwiki's event controller
     */
    public function register(&$controller) {
        $controller->register_hook('CONFMANAGER_CONFIGFILES_REGISTER', 'BEFORE',  $this, 'addCoreConfigFiles', array());
    }

    public function addCoreConfigFiles(&$event, $param) {
        /*
        $event->data[] = ConfigManagerConfigFile::create('acronyms')
            ->setConfigName('Abbreviations and Acronyms');
        $event->data[] = ConfigManagerConfigFile::create('entities')
            ->setConfigName('Entity replacements');
        $event->data[] = ConfigManagerConfigFile::create('interwiki')
            ->setImageFolder(DOKU_INC . 'lib/images/interwiki/')
            ->setExtension('.gif')
            ->setImagePosLeft()
            ->setConfigName('InterWiki Links');
        $event->data[] = ConfigManagerConfigFile::create('mime')
            ->setConfigName('MIME configuration');
        $event->data[] = ConfigManagerConfigFile::create('smileys')
            ->setImageFolder(DOKU_INC . 'lib/images/smileys/')
            ->setConfigName('Smileys');
        */

        $scheme = new ConfigManagerSingleLineCoreConfig('scheme');
        $scheme->setName($this->getLang('URL Schemes'));
        $scheme->setDescription($this->getDescription('scheme'));
        $event->data[] = $scheme;

        $wordBlock = new ConfigManagerSingleLineCoreConfig('wordblock');
        $wordBlock->setName($this->getLang('Blacklisting'));
        $wordBlock->setDescription($this->getDescription('wordblock'));
        $event->data[] = $wordBlock;
    }

    private function getDescription($id) {
        $fn = $this->localFN($id);
        if (!@file_exists($fn)) {
            return '';
        }
        $content = file_get_contents($fn);
        return $content;
    }
}
