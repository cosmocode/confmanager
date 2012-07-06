<?php

class ConfigManagerConfigFile {
    private $fileName;
    private $localName;
    private $imageFolder = '';
    private $extension = '';
    private $rows = 2;
    private $imagePos = 2;

    private function __construct() {}

    public static  function create($fileName) {
        $file = new ConfigManagerConfigFile();
        $file->setFileName($fileName);
        return $file;
    }

    public function setImageFolder($imageFolder) {
        if ($imageFolder === '') {
            $this->imageFolder = '';
            return $this;
        }
        $imageFolder = str_replace('\\', '/', $imageFolder);
        if (substr($imageFolder, strlen($imageFolder) -1) !== '/') {
            $imageFolder .= '/';
        }
        $this->imageFolder = $imageFolder;
        return $this;
    }

    public function setFileName($name) {
        $name = str_replace('\\', '/', $name);
        $name = preg_replace('/.conf$/', '', $name);

        if ($this->isCoreConfig($name)) {
            global $config_cascade;
            $this->fileName = $config_cascade[$name]['default'][0];
            $this->localName = $config_cascade[$name]['local'][0];
            return $this;
        }

        $this->fileName = $name . '.conf';
        $this->localName = $name . '.local.conf';
        return $this;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
        return $this;
    }

    public function setImagePosLeft() {
        $this->imagePos = 1;
        return $this;
    }

    public function setImagePosRight() {
        $this->imagePos = 2;
        return $this;
    }

    public function setOneLine() {
        $this->rows = 1;
        return $this;
    }

    public function setTwoLine() {
        $this->rows = 2;
        return $this;
    }

    private function isCoreConfig($name) {
        if (strpos($name, '/') !== false) {
            return false;
        }

        global $config_cascade;
        return isset($config_cascade[$name]);
    }

    public function hasImageFolder() {
        return $this->imageFolder !== '';
    }

    public function getImagePath($name) {
        return $this->imageFolder . $name . $this->extension;
    }

    public function getLocalFileName() {
        return $this->localName;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getImagePos() {
        return $this->imagePos;
    }

    public function getRows() {
        return $this->rows;
    }

    public function getFileName() {
        return $this->fileName;
    }


}
