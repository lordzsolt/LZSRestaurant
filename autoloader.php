<?php

/**
 * Attempts to auto-load the all required classes from root, controller or models directory
 */

spl_autoload_register(function ($class) {

    if (strpos($class,'\\') !== false) {
        $pattern = '/^[a-zA-Z0-9]*\\\/';
        $class = preg_replace($pattern, '', $class);
    }

    $paths = ['./', './Controllers/', './Models/'];
    foreach ($paths as $path) {
        if (file_exists($path.$class.'.php')) {
            include $path.$class.'.php';
            return;
        }
    }
});

?>