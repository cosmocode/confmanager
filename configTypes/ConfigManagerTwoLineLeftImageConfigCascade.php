<?php

class ConfigManagerTwoLineLeftImageConfigCascade extends ConfigManagerTwoLineCascadeConfig {

    private $imageFolder;
    private $extension;

    public function __construct($name, $imageFolder, $extension) {
        parent::__construct($name);
        $this->imageFolder = $imageFolder;
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

    protected function handleSave($defaultConfig) {
        if (!isset($_FILES['icon'])) {
            return;
        }

        $files = array_keys($_FILES['icon']['name']);
        foreach ($files as $config) {
            $icon = array();
            foreach (array('name', 'type', 'tmp_name', 'error', 'size') as $key) {
                $icon[$key] = $_FILES['icon'][$key][$config];
            }
            if ($icon['error'] != UPLOAD_ERR_OK) {
                if (!empty($icon['name'])) {
                    $this->signalUploadError($config, $icon['error']);
                }
                continue;
            }

            if (array_key_exists($config, $defaultConfig)) {
                msg(sprintf($this->helper->getLang('cannot overwrite default icons'), $config), -1);
                continue;
            }

            $extension = strrpos($icon['name'], '.');
            if ($extension === false) {
                msg(sprintf($this->helper->getLang('cannot determine file type'), $config), -1);
                continue;
            }
            $extension = substr($icon['name'], $extension+1);

            if ($extension !== $this->extension) {
                msg(sprintf($this->helper->getLang('error wrong extension'), $config, $this->extension), -1);
                continue;
            }

            if (move_uploaded_file($icon['tmp_name'], $this->imageFolder . "$config." . $this->extension)) {
                msg(sprintf($this->helper->getLang('changed image of'), $config), 1);
                continue;
            }

            msg(sprintf($this->helper->getLang('server error upload failed'), $config), -1);
        }
    }

    private function signalUploadError($config, $error) {
        if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
            msg(sprintf($this->helper->getLang('file is to big'), $config), -1);
        } elseif ($error === UPLOAD_ERR_PARTIAL || $error === UPLOAD_ERR_NO_FILE) {
            msg(sprintf($this->helper->getLang('upload incomplete'), $config), -1);
        } else {
            msg(sprintf($this->helper->getLang('server error upload failed'), $config), -1);
        }
    }

    private function getImage($key) {
        $path = $this->imageFolder . "$key." . $this->extension;
        if (is_file($path)) {
            return DOKU_BASE . $path;
        }
        return '';
    }
}
