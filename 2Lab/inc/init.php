<?php

include 'config.php';

session_start();

function load_class($className) {
    $filename = __DIR__ . "/../classes/$className.php";

    if (!file_exists($filename)) {
        throw new Exception("Класс $className не найден");
    }

    include $filename;

    if (!class_exists($className)) {
        throw new Exception("Класс $className не найден");
    }
}

spl_autoload_register('load_class');
