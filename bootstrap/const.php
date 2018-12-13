<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('BOOTSTRAP_PATH')) {
    define('BOOTSTRAP_PATH', __DIR__ . DS);
}

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DS . '..' . DS);
}

if (!defined('VENDOR_PATH')) {
    define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
}

if (!defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', ROOT_PATH . 'public' . DS);
}

if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', ROOT_PATH . 'config' . DS);
}

if (!defined('SRC_PATH')) {
    define('SRC_PATH', ROOT_PATH . 'src' . DS);
}

if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', SRC_PATH);
}

if (!defined('VAR_PATH')) {
    define('VAR_PATH', ROOT_PATH . 'var' . DS);
}

if (!defined('CACHE_PATH')) {
    define('CACHE_PATH', VAR_PATH . 'cache' . DS);
}

if (!defined('LOG_PATH')) {
    define('LOG_PATH', VAR_PATH . 'log' . DS);
}

if (!defined('ENV_DEV')) {
    define('ENV_DEV', 'dev');
}

if (!defined('ENV_TEST')) {
    define('ENV_TEST', 'test');
}

if (!defined('ENV_PROD')) {
    define('ENV_PROD', 'prod');
}

if (!defined('CLI_SAPI')) {
    define('CLI_SAPI', 'cli');
}
