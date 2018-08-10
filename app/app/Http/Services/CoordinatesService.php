<?php

namespace App\Http\Services;

use function MongoDB\BSON\toJSON;
use Yandex\Geo\Api;

/**
 * Определяет координаты по адресу
 * Class CoordinatesService
 *
 * @package \App\Http\Services
 */
class CoordinatesService
{
    /**
     * Выдает координаты по заданному адресу
     * @param $address
     *
     * @return string
     * @throws \Yandex\Geo\Exception
     * @throws \Yandex\Geo\Exception\CurlError
     * @throws \Yandex\Geo\Exception\ServerError
     */
    public static function getCoordinates($address)
    {
        $api = new Api();
        $api->setQuery($address);

        $response = $api->setLimit(1)
            ->setLang(Api::LANG_RU)
            ->load()
            ->getResponse();

        return json_encode([
            $response->getFirst()->getLatitude(),
            $response->getFirst()->getLongitude(),
        ]);
    }
}
