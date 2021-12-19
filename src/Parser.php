<?php

namespace App;

use App\Exception\CityNotFoundException;

/**
 * Получает данные о погоде
 */
class Parser
{
    /**
     * Приватный ключ для доступа к АПИ @var string
     */
    private $appId = 'fc5a93273d538a1ea38cd3aa2849a58f';
    /**
     * Ссылка для получения данных @var string
     */
    private $url = 'https://api.openweathermap.org/data/2.5/weather?units=metric';
    /**
     * Название города @var string
     */
    private $city;

    /**
     * @param string $city Название города, для которого нужно узнать погоду
     */
    public function __construct(string $city)
    {
        $this->city = $city;
    }

    /**
     * Получить данные
     *
     * @return array
     */
    public function parse(): array
    {
        $url  = $this->url . "&q={$this->city}" . "&appid={$this->appId}";
        $data = json_decode($this->simpleParser($url), 1);

        if ((int)$data['cod'] === 404 || (int)$data['cod'] === 400) {
            throw new CityNotFoundException('City Not Found');
        }

        return $data;
    }

    /**
     * Получить данные из АПИ
     *
     * @param string $url
     *
     * @return string
     */
    private function simpleParser(string $url): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
}
