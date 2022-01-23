<?php

declare(strict_types=1);

namespace Rolf\HttpClient;

use Rolf\HttpClient\Api\Comments;
use GuzzleHttp\Client as ClientGuzzle;

/**
 * Клиент для работы с API
 */
class Client
{
    private array $httpClientOptions = [];

    /**
     * Работа с комментариями
     * @return Comments
     */
    public function comments(): Comments
    {
        return new Comments($this);
    }

    /**
     * @return ClientGuzzle
     */
    public function getHttpClient(): ClientGuzzle
    {
        return new ClientGuzzle();
    }

    /**
     * @return array
     */
    public function getHttpClientOptions(): array
    {
        return $this->httpClientOptions;
    }

    /**
     * @param array $httpClientOptions
     * @return self
     */
    public function setHttpClientOptions(array $httpClientOptions): self
    {
        $this->httpClientOptions = $httpClientOptions;
        return $this;
    }
}
