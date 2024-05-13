<?php
spl_autoload_register(
    function (string $class) {
        // Преобразуем пространство имен в путь к файлу
        $file = __DIR__ . '/../' . str_replace('\\', '/', lcfirst($class)) . '.php';
        if (file_exists($file)) {
            include_once $file;
        }
    }
);