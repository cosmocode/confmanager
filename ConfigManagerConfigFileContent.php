<?php

class ConfigManagerConfigFileContent {

    private $file;
    private $config = null;

    public function __construct(ConfigManagerConfigFile $file) {
        $this->file = $file;
        if ($file->getRows() == 2) {
            $this->loadTwoLineConfigFiles();
        } else {

        }
    }

    public function loadTwoLineConfigFiles() {
        $defaultConfig = $this->loadTwoLineConfigFromFile($this->file->getFileName());
        $localConfig = $this->loadTwoLineConfigFromFile($this->file->getLocalFileName());
        $this->mergeTwoLineConfigs($defaultConfig, $localConfig);
    }

    private function loadTwoLineConfigFromFile($path) {
        if (file_exists($path)) {
            return confToHash($path);
        }
        return array();
    }

    private function mergeTwoLineConfigs($default, $local) {
        $this->config = array();
        $configNames = array_merge(array_keys($default), array_keys($default));
        foreach ($configNames as $name) {
            $defaultValue = null;
            $localValue = null;

            if (isset($default[$name])) {
                $defaultValue = $default[$name];
            }

            if (isset($local[$name])) {
                $localValue = $local[$name];
            }
            $this->config[] = new ConfigManagerTwoLineConfigFileItem($name, $defaultValue, $localValue);
        }
    }

}

class ConfigManagerTwoLineConfigFileItem {

    public $leftValue;
    public $rightValue;
    public $defaultValue = null;

    public function __construct($name, $defaultValue, $localValue) {
        $this->leftValue = $name;
        $this->defaultValue = $defaultValue;
        if ($localValue === null) {
            $this->rightValue = $defaultValue;
        } else {
            $this->rightValue = $localValue;
        }
    }

    public function isDefaultValue() {
        if ($this->defaultValue != null) {
            return false;
        }
        return $this->rightValue === $this->defaultValue;
    }
}

class ConfigManagerOneLineConfigFileItem {
    public $value;
    private $default = false;

    public function __construct($value, $default) {
        $this->value = $value;
        $this->default = $default;
    }

    public function isDefault() {
        return $this->default;
    }
}