<?php
/**
 * PSR-4 совместимый автозагрузчик
 *
 * @param string $class абсолютное имя класса.
 * @return void
 */
spl_autoload_register(function ($class) {
    // префикс пространства имён проекта
    $prefixList = [
        'App\\'  => __DIR__ . '/src/',
        'Tests\\' => __DIR__ . '/tests/',
    ];

    // класс использует префикс?
    foreach ($prefixList as $prefix => $base_dir) {
        $len = strlen($prefix);

        if (strncmp($prefix, $class, $len) === 0) {
            $prefixFound = true;

            break;
        }
    }

    if (empty($prefixFound)) {
        return;
    }

    // обрубаем префикс
    $relative_class = substr($class, $len);
    // находим файл и подключаем
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
