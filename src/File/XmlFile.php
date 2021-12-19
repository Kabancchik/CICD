<?php

namespace App\File;

use App\Parser;
use App\Presenter;
use DOMDocument;

/**
 * Сохраняет файлы в XML
 * Для XML:
 *      Дата
 *      Скорость ветра
 *      Температура
 */
class XmlFile extends File
{
    /**
     * Загрузить файл
     *
     * @param \App\Parser $parser
     */
    public function save(Parser $parser)
    {
        $data = $this->getDataAsString($parser);
        $filename = "xmlFile" . date('Y-m-d'). ".xml";

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

        $dom     = new DomDocument('1.0');
        $weather = $dom->appendChild($dom->createElement('weather'));

        if (!$presenter->isCityCorrect()) {
            $weather->appendChild($dom->createElement('error', 'Choose correct city'));

            return $dom->saveXML();
        }

        $date          = $weather->appendChild($dom->createElement('date'));
        $windSpeed     = $weather->appendChild($dom->createElement('wind_speed'));
        $temp          = $weather->appendChild($dom->createElement('temp'));
        $windSpeedAttr = $dom->createAttribute('unit');
        $tempAttr      = $dom->createAttribute('unit');
        $city          = $weather->appendChild($dom->createElement('city'));
        $cityId        = $weather->appendChild($dom->createElement('city_id'));

        $windSpeedAttr->value = 'km/h';
        $tempAttr->value      = 'celsius';

        $date->appendChild($dom->createTextNode(date('Y-m-d')));
        $windSpeed->appendChild($dom->createTextNode($presenter->windSpeed));
        $windSpeed->appendChild($windSpeedAttr);
        $temp->appendChild($dom->createTextNode($presenter->temp));
        $temp->appendChild($tempAttr);
        $city->appendChild($dom->createTextNode($presenter->city));
        $cityId->appendChild($dom->createTextNode($presenter->cityId));

        $dom->formatOutput = true;

        // save XML as string
        return $dom->saveXML();
    }
}
