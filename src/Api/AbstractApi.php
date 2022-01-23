<?php

declare(strict_types=1);

namespace Rolf\HttpClient\Api;

use Rolf\HttpClient\Client;
use Rolf\HttpClient\Http\ResponseResolver;

abstract class AbstractApi
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Получение данных через метод GET
     *
     * @param string $uri
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get(string $uri, array $params = []): array
    {
        $response = $this->client->getHttpClient()->get($uri, array_merge([
            'query' => $params,
        ], $this->client->getHttpClientOptions()));

        return ResponseResolver::getContent($response);
    }

    /**
     * Отправка запроса через POST
     *
     * @param string $uri
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post(string $uri, array $params = []): array
    {
        $response = $this->client->getHttpClient()->post($uri, array_merge([
            'form_params' => $params,
        ], $this->client->getHttpClientOptions()));

        return ResponseResolver::getContent($response);
    }

    /**
     * Отправка запроса через PUT
     *
     * @param string $uri
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function put(string $uri, array $params = []): array
    {
        $response = $this->client->getHttpClient()->put($uri, array_merge([
            'body' => $params,
        ], $this->client->getHttpClientOptions()));

        return ResponseResolver::getContent($response);
    }
}
