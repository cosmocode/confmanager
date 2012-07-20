<?php

class ConfigManagerSingleLineCoreConfig implements ConfigManagerConfigType {

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
                $config[$type] = array_merge($config[$type], $this->loadFile($file));
            }
        }

        return $config;
    }

    private function loadFile($fileName) {
        if (@!file_exists($fileName)) {
            return array();
        }
        $config = file($fileName);
        $config = array_map('trim', $config);
        $config = preg_replace('/^#.*/', '', $config);
        $config = str_replace('\\#', '#', $config);
        $config = array_filter($config);
        return $config;
    }

    public function display() {
        $configs = $this->readConfig();
        $default = $configs['default'];
        $local = $configs['local'];
        $configs = array_merge($default, $local);

        usort($configs, array($this->helper, '_sortHuman'));
        include DOKU_PLUGIN . 'confmanager/tpl/showConfigSingleLine.php';
    }

    public function save() {
        global $INPUT;
        $lines = $INPUT->arr('line');
        $config = $this->readConfig();
        $custom = $this->getCustomEntries($lines, $config['default']);

        $this->saveToFile($custom);
    }

    private function getCustomEntries($input, $default) {
        $save = array();
        foreach ($input as $line) {
            if (in_array($line, $default)) {
                continue;
            }
            $line = $this->prepareEntity($line);
            if ($line === '') {
                continue;
            }

            $save[] = $line;
        }

        return $save;
    }

    private function prepareEntity($str) {
        $str = trim($str);
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

        $content = $this->helper->getCoreConfigHeader();
        foreach ($config as $item) {
            $content .= "$item\n";
        }

        file_put_contents($file, $content);
        msg($this->helper->getLang('changes applied'), 1);
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