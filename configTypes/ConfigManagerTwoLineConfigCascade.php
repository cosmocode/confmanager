<?php

class ConfigManagerTwoLineCoreConfig implements ConfigManagerConfigType {

    private $name;
    private $internalName;
    private $description;
    private $path;

    /**
     * @var helper_plugin_confmanager
     */
    private $helper;

    public function __construct($name) {
        $this->internalName = $name;
        $this->path = getConfigFiles($name);
        $this->helper = plugin_load('helper', 'confmanager');
    }

    private function readConfig() {
        global $config_cascade;
        $config = array();

        foreach (array('default', 'local', 'protected') as $type) {
            $config[$type] = array();

            if (!isset($config_cascade[$this->internalName][$type])) {
                continue;
            }

            foreach ($config_cascade[$this->internalName][$type] as $file) {
                $config[$type] = array_merge($config[$type], confToHash($file));
            }
        }

        return $config;
    }

    public function display() {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        uksort($configs, array($this->helper, '_sortHuman'));
        include DOKU_PLUGIN . 'confmanager/tpl/showConfigTwoLine.php';
    }

    public function save() {
        global $INPUT;
        $config = $this->readConfig();
        $lines = $INPUT->arr('line');
        $lines = array_merge($lines, $this->getNewValues());

        $custom = $this->getCustomEntries($lines, $config['default']);

        $this->saveToFile($custom);
    }

    private function getCustomEntries($input, $default) {
        $save = array();
        foreach ($input as $key => $value) {

            if (array_key_exists($key, $default)) {
                if ($default[$key] === $value) {
                    continue;
                }
            }

            $key = $this->prepareEntity($key);
            $value = $this->prepareEntity($value);
            if ($key === '' || $value === '') {
                continue;
            }
            $save[$key] = $value;
        }

        return $save;
    }

    private function prepareEntity($str) {
        $str = trim($str);
        $str = str_replace("\n", '', $str);
        $str = str_replace("\r", '', $str);
        $str = str_replace('#', '\\#', $str);
        return $str;
    }

    private function saveToFile($config) {
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

        uksort($config, array($this->helper, '_sortConf'));
        $content = $this->helper->getCoreConfigHeader();
        foreach ($config as $key => $value) {
            $content .= "$key\t$value\n";
        }

        file_put_contents($file, $content);
        msg($this->helper->getLang('changes applied'), 1);
    }

    private function getNewValues() {
        global $INPUT;
        $newKey = $INPUT->arr('newKey');
        $newValue = $INPUT->arr('newValue');
        if (count($newKey) !== count($newValue)) {
            return array();
        }

        return array_combine($newKey, $newValue);
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPaths() {
        return $this->path;
    }
}