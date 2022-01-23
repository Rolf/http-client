<?php

declare(strict_types=1);

namespace Tests\HttpClient\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

abstract class TestCase extends PhpUnitTestCase
{
    abstract protected function getApiClass();

    protected function getApiMock()
    {
        $httpClient = $this->getMockBuilder(Client::class)
            ->onlyMethods(['sendRequest'])
            ->getMock();

        $httpClient->expects($this->any())
            ->method('sendRequest');

        $client = new \Rolf\HttpClient\Client();

        return $this->getMockBuilder($this->getApiClass())
            ->onlyMethods(['get', 'post', 'put'])
            ->setConstructorArgs([$client])
            ->getMock();
    }
}
