<?php

namespace App\File;

use App\Parser;
use App\Presenter;

/**
 * Сохраняет данные в файле json
 * Для JSON первыми по порядку должны быть поля:
 *      Дата
 *      Температура
 *      Направление ветра
 */
class JsonFile extends File
{
    /**
     * Загрузить файл
     *
     * @param \App\Parser $parser
     */
    public function save(Parser $parser)
    {
        $data     = $this->getDataAsString($parser);
        $filename = "jsonFile" . date('Y-m-d') . ".json";

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: " . strlen($data));
        header("Content-Disposition: attachment; filename={$filename}");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");

        echo $data;
    }

    /**
     * Получить данные в виде строки
     *
     * @param \App\Parser $parser
     *
     * @return string
     */
    public function getDataAsString(Parser $parser): string
    {
        $presenter = new Presenter($parser);

        if (!$presenter->isCityCorrect()) {
            return json_encode(['error' => 'Choose correct city']);
        }

        $data = [
            'date'          => date('Y-m-d'),
            'temp'          => $presenter->temp,
            'windDirection' => $presenter->windDirection,
            'windSpeed'     => $presenter->windSpeed,
            'city'          => $presenter->city,
            'cityId'        => $presenter->cityId,
        ];

        $data = json_encode($data);

        return $data;
    }
}
