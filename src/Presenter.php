<?php

namespace App;

use App\Exception\CityNotFoundException;

/**
 * Хранить данные в удобном формате
 */
class Presenter
{
    /**
     * @var \App\Parser
     */
    private $parser;
    /**
     * @var bool
     */
    private $isCityCorrect = true;

    /**
     * информация о погоде
     */
    public $temp;
    public $city;
    public $cityId;
    public $description;
    public $icon;
    public $tempMin;
    public $tempMax;
    public $windSpeed;
    public $windDirection;
    public $humidity;

    /**
     * @param \App\Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;

        try {
            $data = $parser->parse();
        } catch (CityNotFoundException $e) {
            $this->isCityCorrect = false;

            return;
        }

        $this->city          = $data['name'];
        $this->cityId        = $data['id'];
        $this->temp          = $data['main']['temp'];
        $this->tempMin       = $data['main']['temp_min'];
        $this->tempMax       = $data['main']['temp_max'];
        $this->description   = $data['weather'][0]['main'];
        $this->icon          = $data['weather'][0]['icon'];
        $this->humidity      = $data['main']['humidity'];
        $this->windSpeed     = $data['wind']['speed'];
        $this->windDirection = $data['wind']['deg'];
    }

    /**
     * Можно ли получить погоду для этого города
     *
     * @return bool
     */
    public function isCityCorrect()
    {
        return $this->isCityCorrect;
    }
}
