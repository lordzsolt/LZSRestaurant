<?php

/**
 * Attempts to auto-load the all required classes from root, controller or models directory
 */

spl_autoload_register(function ($class) {
    $paths = ['./', './controllers/', './models/'];
    foreach ($paths as $path) {
        if (file_exists($path.$class.'.php')) {
            include $path.$class.'.php';
            return;
        }
    }
});

?>