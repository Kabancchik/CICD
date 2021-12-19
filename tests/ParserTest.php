<?php

use App\Exception\CityNotFoundException;
use PHPUnit\Framework\TestCase;
use Tests\City;

class ParserTest extends TestCase
{
    /**
     * Проверка верного ответа от АПИ
     */
    public function testPositiveParsing()
    {
        $parser = new \App\Parser('Almaty');
        $data = $parser->parse();

        $this->assertEquals(City::ID, $data['id']);
        $this->assertEquals(City::NAME, $data['name']);
    }

    /**
     * Проверка отрицательного ответа от АПИ
     */
    public function testNegativeParsing()
    {
        $this->expectException(CityNotFoundException::class);

        $parser = new \App\Parser('ERT');
        $parser->parse();
    }
}