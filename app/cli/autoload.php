<?php
function __autoload($className) {
    $extensions = array(".php");
    $paths = explode(PATH_SEPARATOR, get_include_path() . ":" . __DIR__);
    $className = str_replace("_" , DIRECTORY_SEPARATOR, $className);
    foreach ($paths as $path) {
        $filename = $path . DIRECTORY_SEPARATOR . $className;
        foreach ($extensions as $ext) {
            if (is_readable($filename . $ext)) {
                require_once $filename . $ext;
                break;
            }
        }
    }
}

/**
 * @return Model_DockerInfo
 */
function getDockerInfo()
{
    return Model_DockerInfo::getInstance();
}
/**
 * @return Model_DockerDigInfo
 */
function getDockerDigInfo()
{
    return Model_DockerDigInfo::getInstance();
}

/**
 * @return Model_InfoPassed
 */
function getInfoPassed()
{
    return Model_InfoPassed::getInstance();
}
/**
 * @return Model_DockerActions
 */
function getDockerActions()
{
    return Model_DockerActions::getInstance();
}
/**
 * @return Model_DockerCommands
 */
function getDockerCommands()
{
    return Model_DockerCommands::getInstance();
}