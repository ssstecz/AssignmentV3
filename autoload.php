<?php
// Autoloader
spl_autoload_register(
    function ($class) {

        $DIR = DIRECTORY_SEPARATOR;
        $basedir = __DIR__ . $DIR;
        $incdir = $basedir . 'src' . $DIR . 'Include' . $DIR;
        $compPath = (str_replace('Salvio\\Scandiweb\\', $incdir, $class)) . '.php';
        $fpath = str_replace('\\', $DIR, $compPath);
        if (file_exists($fpath) && !is_dir($fpath)) {
            include_once $fpath;
        }
    }
);