<?php

/**
 * Like ConfigManagerTwoLineCascadeConfig but with image support.
 * An image pointed with value. I.e. the smileys config
 */
class ConfigManagerTwoLineRightImageConfigCascade extends ConfigManagerTwoLineLeftImageConfigCascade {

    public function display() {
        $this->displayTpl(DOKU_PLUGIN . 'confmanager/tpl/showConfigTwoLineRightImage.php');
    }

    /**
     * Returns path to image file
     *
     * @param string $key
     * @return string
     */
    protected function getImagePath($key) {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        $path = $this->imageFolder . $configs[$key];

        if (is_file(DOKU_INC . $path)) {
            return $path;
        }
        return '';
    }

    /**
     * Build path to file location
     *
     * @param string $key
     * @param string $value
     * @param string $extension
     * @param string $filename  filename provided by upload
     * @return string
     */
    protected function getImageDestination($key, $value, $extension, $filename) {
        $use_form_value = true;
        $ext_value    = strrpos($value, '.');
        if ($ext_value === false) {
            //no extension
            $use_form_value = false;
        } else {
            $ext_value = strtolower(substr($value, $ext_value + 1));
            if($ext_value != $extension) {
                // image has different extension than predefined location
                $use_form_value = false;
            }
        }

        if($use_form_value) {
            $filename = $value;
        }
        $filename = trim($filename);
        if(substr($filename, 0, 6) !=  'local/') {
            $filename = 'local/' . $filename;
        }

        return DOKU_INC . $this->imageFolder . $filename;
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
