<?php

declare(strict_types=1);

namespace Rolf\HttpClient\Http;

use Rolf\HttpClient\Exceptions\ResponseException;
use GuzzleHttp\Psr7\Response;

class ResponseResolver
{
    /**
     * Метод формирования ответа
     *
     * @param Response $response
     * @return array
     * @throws ResponseException
     */
    public static function getContent(Response $response): array
    {
        if ($response->getStatusCode() !== 200) {
            throw new ResponseException($response->getBody()->getContents());
        }

        $content = $response->getBody()->getContents();

        if (empty($content)) {
            throw new ResponseException('Response was empty');
        }

        return json_decode($content, true);
    }
}
