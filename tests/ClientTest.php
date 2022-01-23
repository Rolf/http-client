<?php

declare(strict_types=1);

namespace Tests\HttpClient;

use Rolf\HttpClient\Client;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateClassClient()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(\GuzzleHttp\Client::class, $client->getHttpClient());
    }
}
