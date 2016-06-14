<?php

/**
 * Like ConfigManagerTwoLineCascadeConfig but with image support.
 * An image can be assigned for every key. I.e. the mime or interwiki config
 */
class ConfigManagerTwoLineLeftImageConfigCascade extends ConfigManagerTwoLineCascadeConfig implements ConfigManagerUploadable {

    protected $imageFolder;
    protected $extension;

    /**
     * @param $name
     * @param $imageFolder
     * @param $extension
     */
    public function __construct($name, $imageFolder, $extension) {
        parent::__construct($name);
         $this->setImageFolder($imageFolder);
        $this->extension = explode(',',$extension);
    }

    public function display() {
        $this->displayTpl(DOKU_PLUGIN . 'confmanager/tpl/showConfigTwoLineLeftImage.php');
    }

    /**
     * @param string $tpl file path
     */
    protected function displayTpl($tpl) {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        uksort($configs, array($this->helper, '_sortHuman'));
        include $tpl;
    }

    /**
     * Returns path to image file
     *
     * @param string $key
     * @return string
     */
    protected function getImagePath($key) {
        foreach($this->extension as $ext){
            $path = $this->imageFolder . "$key." . $ext;
             if (is_file(DOKU_INC . $path)) {
                return $path;
            }
        }
        return '';
    }

    /**
     * Returns url to image file
     *
     * @param string $key
     * @return string
     */
    protected function getImage($key) {
        $path = $this->getImagePath($key);
        if($path) {
            return DOKU_BASE . $path;
        }
        return '';
    }

    /**
     * @param string $imageFolder
     */
    public function setImageFolder($imageFolder) {
        if (substr($imageFolder, strlen($imageFolder) -1) !== '/') {
            $imageFolder = "$imageFolder/";
        }
        $this->imageFolder = $imageFolder;
    }

    /**
     * @return bool
     */
    public function upload() {
        global $INPUT;
        if (!isset($_FILES['icon'])) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errNoFileSend');
            return false;
        }
        $icon = $_FILES['icon'];
        $key = $INPUT->str('key');
        $value = $INPUT->str('value');
        if ($key === '') {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errNoConfigKeySend');
            return false;
        }
        $configs = $this->readConfig();
        if (isset($configs['default'][$key])) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errCannotOverwriteDefaultKey');
            return false;
        }

        if ($icon['error'] != UPLOAD_ERR_OK) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errUploadError');
            return false;
        }

        $extension = strrpos($icon['name'], '.');
        if ($extension === false) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errNoFileExtension');
            return false;
        }
        $extension = substr($icon['name'], $extension+1);
        if (!in_array($extension, $this->extension)) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errWrongFileExtension');
            return false;
        }

        $destination = $this->getImageDestination($key, $value, $extension, $icon['name']);
        if (!@move_uploaded_file($icon['tmp_name'], $destination)) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errCannotMoveUploadedFileToFolder');
            return false;
        }

        return true;
    }

    /**
     * Build path to file location
     *
     * @param string $key
     * @param string $value
     * @param string $extension
     * @return string
     */
    protected function getImageDestination($key, $value, $extension, $filename) {
         return DOKU_INC . $this->imageFolder . "$key." . $extension;
    }

    /**
     * @return bool
     */
    public function deleteIcon() {
        global $INPUT;

        $key = $INPUT->str('key');
        if ($key === '') {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errNoConfigKeySend');
            return false;
        }

        $configs = $this->readConfig();
        if (isset($configs['default'][$key])) {
            header('Content-Type: text/plain');
            echo $this->helper->getLang('upload_errCannotOverwriteDefaultKey');
            return false;
        }

        $path = $this->getImagePath($key);
        if (!@unlink(DOKU_INC . $path)) {
            echo $this->helper->getLang('iconDelete_error');
            return false;
        }

        return true;
    }


}
