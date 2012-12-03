<?php

class ConfigManagerTwoLineLeftImageConfigCascade extends ConfigManagerTwoLineCascadeConfig implements ConfigManagerUploadable {

    private $imageFolder;
    private $extension;

    public function __construct($name, $imageFolder, $extension) {
        parent::__construct($name);
         $this->setImageFolder($imageFolder);
        $this->extension = $extension;
    }

    public function display() {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        uksort($configs, array($this->helper, '_sortHuman'));
        include DOKU_PLUGIN . 'confmanager/tpl/showConfigTwoLineLeftImage.php';
    }

    private function getImage($key) {
        $path = $this->imageFolder . "$key." . $this->extension;
        if (is_file($path)) {
            return DOKU_BASE . $path;
        }
        return '';
    }

    public function setImageFolder($imageFolder) {
        if (substr($imageFolder, strlen($imageFolder) -1) !== '/') {
            $imageFolder = "$imageFolder/";
        }
        $this->imageFolder = $imageFolder;
    }

    public function upload() {
        global $INPUT;
        if (!isset($_FILES['icon'])) {
            dbglog('no icon send', 'confmanager upload');
            return false;
        }
        $icon = $_FILES['icon'];
        $key = $INPUT->str('key');
        if ($key === '') {
            dbglog('no key send', 'confmanager upload');
            return false;
        }
        $configs = $this->readConfig();
        if (in_array($key, $configs['local'])) {
            dbglog('cannot overwrite default key', 'confmanager upload');
            return false;
        }

        if ($icon['error'] != UPLOAD_ERR_OK) {
            dbglog('some upload error ' . $icon['error'], 'confmanager upload');
            return false;
        }

        $extension = strrpos($icon['name'], '.');
        if ($extension === false) {
            dbglog('no extension', 'confmanager upload');
            return false;
        }
        $extension = substr($icon['name'], $extension+1);
        if ($extension !== $this->extension) {
            dbglog('wrong extension', 'confmanager upload');
            return false;
        }

        if (!move_uploaded_file($icon['tmp_name'], DOKU_INC . $this->imageFolder . "$key." . $this->extension)) {
            dbglog('cannot move it to according folder', 'confmanager upload');
            return false;
        }

        return true;
    }
}
