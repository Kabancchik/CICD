<?php

namespace App\File;

use App\Parser;

/**
 * Абстрактный класс для файлов
 */
abstract class File
{
    /**
     * Сохранить данные
     *
     * @param \App\Parser $parser
     */
    abstract public function save(Parser $parser);

    /**
     * Получить данные в виде строки
     *
     * @param \App\Parser $parser
     *
     * @return string
     */
    abstract public function getDataAsString(Parser $parser): string ;
}
