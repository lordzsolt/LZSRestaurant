<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 13:49
 */

class MVCView {

    public function create($path, $vars = null) {
        $file = 'Views/'.$path.'.php';
        if (!file_exists($file)) {
            throw new Exception('The $path argument points to a non-existent view: "'.$path.'".');
        }
        if (!empty($vars)) {
            extract($vars);
        }
        include $file;
    }
}