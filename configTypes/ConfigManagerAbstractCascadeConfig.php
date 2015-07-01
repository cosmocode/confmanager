<?php

/**
 * Class ConfigManagerAbstractCascadeConfig
 */
abstract class ConfigManagerAbstractCascadeConfig implements ConfigManagerConfigType {
    private $name;
    protected $internalName;
    private $description;
    private $path;

    /**
     * @var helper_plugin_confmanager
     */
    protected $helper;

    /**
     * Load file
     *
     * @param string $fileName
     * @return mixed
     */
    abstract protected function loadFile($fileName);

    /**
     * @param string $name
     */
    public function __construct($name) {
        $this->internalName = $name;
        $this->path = getConfigFiles($name);
        $this->helper = plugin_load('helper', 'confmanager');
    }

    /**
     * Load configs files for all types
     *
     * @return array[]
     */
    protected function readConfig() {
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

    /**
     * Prepare entity for saving
     *
     * @param string $str
     * @return string
     */
    protected function prepareEntity($str) {
        return $this->helper->prepareEntity($str);
    }

    /**
     * Get localized name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set localized name
     *
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Get localized description
     *
     * @return string localized wikitext
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set localized description
     *
     * @param string $description localized wikitext
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * get all paths to config file (local or protected).
     * this is used to generate the config id and warnings if the files are not writeable.
     *
     * @return array
     */
    public function getPaths() {
        return $this->path;
    }
}
