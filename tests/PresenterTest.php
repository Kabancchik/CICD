<?php

use App\Presenter;

class PresenterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Проверка, если город задан верно
     */
    public function testPositiveCityWasFound()
    {
        $parser = new \App\Parser(\Tests\City::NAME);

        $presenter = new Presenter($parser);

        $this->assertEquals(\Tests\City::ID, $presenter->cityId);
        $this->assertEquals(\Tests\City::NAME, $presenter->city);
        $this->assertTrue($presenter->isCityCorrect());
    }

    /**
     * Проверка, если города нет или записан некорректно
     */
    public function testNegativeCityNotFound()
    {
        $parser = new \App\Parser('ERT');

        $presenter = new Presenter($parser);

        $this->assertFalse($presenter->isCityCorrect());
        $this->assertNull($presenter->cityId);
        $this->assertNull($presenter->city);
    }
}
