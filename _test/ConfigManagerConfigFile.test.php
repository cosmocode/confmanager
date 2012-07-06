<?php

require_once dirname(__FILE__) . '/../helper.php';

class ConfigFileTest extends DokuWikiTest {

    function test_getLocalPath() {
        $config = ConfigManagerConfigFile::create('/path/to/file.conf');
        $this->assertEquals('/path/to/file.local.conf', $config->getLocalFileName());
    }

    function test_getLocalCorePath() {
        $config = ConfigManagerConfigFile::create('scheme');
        $this->assertEquals(DOKU_CONF . 'scheme.local.conf', $config->getLocalFileName());
    }

    function test_hasImageFolderFalse() {
        $config = ConfigManagerConfigFile::create('/path/to/file.conf');
        $this->assertEquals(false, $config->hasImageFolder());
    }

    function test_hasImageFolderTrue() {
        $config = ConfigManagerConfigFile::create('/path/to/file.conf')->setImageFolder('folder');
        $this->assertEquals(true, $config->hasImageFolder());
    }

    function test_imagePath() {
        $config = ConfigManagerConfigFile::create('/path/to/file.conf')->setImageFolder('folder');
        $this->assertEquals('folder/some', $config->getImagePath('some'));
    }

    function test_imagePathWithExtension() {
        $config = ConfigManagerConfigFile::create('/path/to/file.conf')
            ->setImageFolder('folder')
            ->setExtension('.jpg');
        $this->assertEquals('folder/some.jpg', $config->getImagePath('some'));
    }

}
