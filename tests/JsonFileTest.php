<?php

namespace Tests;

use App\File\JsonFile;
use App\Parser;
use PHPUnit\Framework\TestCase;

/**
 * Проверка работы с json файлом
 */
class JsonFileTest extends TestCase
{
    /**
     * Проверка корректной записи
     */
    public function testPositiveGetDataAsString()
    {
        $parser = new Parser(City::NAME);

        $jsonFile = new JsonFile();
        $data     = json_decode($jsonFile->getDataAsString($parser), 1);

        $this->assertEquals(City::NAME, $data['city']);
        $this->assertEquals(City::ID, $data['cityId']);
    }

    /**
     * Проверка порядка полей при сохранений
     * Для JSON первыми по порядку должны быть поля:
     * Дата
     * Температура
     * Направление ветра
     */
    public function testPropertyOrdering()
    {
        $parser = new Parser(City::NAME);

        $jsonFile = new JsonFile();
        $data     = json_decode($jsonFile->getDataAsString($parser), 1);

        $correctPropertyOrder = ['date', 'temp', 'windDirection'];
        $index                = 0;
        foreach ($data as $property => $value) {
            $this->assertEquals($correctPropertyOrder[$index], $property);
            $index++;

            if ($index >= 3) {
                break;
            }
        }
    }

    /**
     * Проверка, если город передан неверно
     */
    public function testNegativeGetDataAsString()
    {
        $parser = new Parser(City::INCORRECT_NAME);

        $jsonFile = new JsonFile();
        $data     = json_decode($jsonFile->getDataAsString($parser), 1);

        $this->assertEquals('Choose correct city', $data['error']);
    }
}
