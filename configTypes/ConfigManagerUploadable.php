<?php

/**
 * Interface for ConfigManager which supports Uploadable images
 */
interface ConfigManagerUploadable {

    /**
     * handle a uploaded image
     *
     * @abstract
     * @return boolean true on success false on error
     */
    function upload();

    /**
     * delete an uploaded icon
     *
     * @abstract
     * @return boolean true on success false on error
     */
    function deleteIcon();
}
