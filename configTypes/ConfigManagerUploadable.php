<?php

interface ConfigManagerUploadable {

    /**
     * handle a uploaded image
     *
     * @abstract
     * @return boolean
     */
    function upload();
}