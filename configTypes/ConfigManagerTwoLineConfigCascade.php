<?php

/**
 * Every line is a config option. The first word in the line is a config key .
 * The config is a associative array. I.e. the acronyms or entities config
 */
class ConfigManagerTwoLineCascadeConfig extends ConfigManagerAbstractCascadeConfig {

    /**
     * Load file
     *
     * @param string $fileName
     * @return array
     */
    protected function loadFile($fileName) {
        return confToHash($fileName);
    }

    public function display() {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        uksort($configs, [$this->helper, '_sortHuman']);
        include DOKU_PLUGIN . 'confmanager/tpl/showConfigTwoLine.php';
    }

    public function save() {
        global $INPUT;
        $config = $this->readConfig();
        $keys = $INPUT->arr('keys');
        $values = $INPUT->arr('values');
        if (count($keys) !== count($values)) {
            msg($this->helper->getLang('invalid save arguments'), -1);
        }

        if (empty($keys)) {
            $lines = [];
        } else {
            $lines = array_combine($keys, $values);
        }

        $lines = array_merge($lines, $this->getNewValues());

        $custom = $this->getCustomEntries($lines, $config['default']);

        $this->saveToFile($custom);
        $this->handleSave($config['default']);
    }

    protected function handleSave() {}

    /**
     * Get the custom entries from the input
     *
     * @param array $input
     * @param array $default
     * @return array
     */
    private function getCustomEntries($input, $default) {
        $save = [];
        foreach ($input as $key => $value) {

            if (array_key_exists($key, $default)) {
                if ($default[$key] === $value) {
                    continue;
                }
            }

            $key = $this->prepareEntity($key);
            $value = $this->prepareEntity($value);
            if ($key === '') {
                continue;
            }
            $save[$key] = $value;
        }

        return $save;
    }

    /**
     * @param $config
     */
    protected function saveToFile($config) {
        global $config_cascade;
        if (!isset($config_cascade[$this->internalName]['local'])
            || count($config_cascade[$this->internalName]['local']) === 0) {
            msg($this->helper->getLang('no local file given'),-1);
            return;
        }

        $file = $config_cascade[$this->internalName]['local'][0];

        if (empty($config)) {
            if (!@unlink($file)) {
                msg($this->helper->getLang('cannot apply changes'), -1);
                return;
            }
            msg($this->helper->getLang('changes applied'), 1);
            return;
        }

        uksort($config, [$this->helper, '_sortConf']);
        $content = $this->helper->getCoreConfigHeader();
        foreach ($config as $key => $value) {
            $content .= "$key\t$value\n";
        }

        $this->helper->saveFile($file, $content);
    }

    /**
     * Returns new values as associative array
     *
     * @return array
     */
    private function getNewValues() {
        global $INPUT;
        $newKey = $INPUT->arr('newKey');
        $newValue = $INPUT->arr('newValue');
        if (count($newKey) !== count($newValue)) {
            return [];
        }

        return array_combine($newKey, $newValue);
    }
}
