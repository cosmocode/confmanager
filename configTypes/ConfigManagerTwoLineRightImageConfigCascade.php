<?php

/**
 * Like ConfigManagerTwoLineCascadeConfig but with image support.
 * An image pointed with value. I.e. the smileys config
 */
class ConfigManagerTwoLineRightImageConfigCascade extends ConfigManagerTwoLineLeftImageConfigCascade {

    /**
     * Constructor
     *
     * @param string $name
     * @param string $imageFolder
     * @param string $extension
     */
    public function __construct($name, $imageFolder, $extension) {
        parent::__construct($name, $imageFolder, $extension);

        $this->imageAlignment = 'right';
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
     * @param string $key               key of entry
     * @param string $value             value of entry
     * @param string $upload_name       name of upload
     * @param string $upload_extension  extension of upload
     * @return string
     */
    protected function getImageFilename($key, $value, $upload_name, $upload_extension) {
        $extension_position = strrpos($value, '.');
        if($extension_position) {
            $filename = substr($value, 0, $extension_position);
        } else {
            $filename = $value;
        }
        if(empty($filename)) {
            $filename = $upload_name;
        }

        $filename = trim($filename);
        if(substr($filename, 0, 6) !=  'local/') {
            $filename = 'local/' . $filename;
        }

        if(empty(substr($filename,6))) {
            return '';
        }

        return "$filename.$upload_extension";
    }

    /**
     * Update image path
     *
     * @param string $key
     * @param string $value
     * @return bool success?
     */
    protected function updateValue($key, $value) {
        $config = $this->readConfig();

        $haschanges = false;

        foreach($config['local'] as $confkey => $confvalue) {
            if($confkey == $key && $confvalue != $value) {
                $config['local'][$confkey] = $value;
                $haschanges = true;
            }
        }

        if($haschanges) {
            $this->saveToFile($config['local']);
        }
        return true;
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
