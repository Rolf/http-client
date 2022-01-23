<?php

declare(strict_types=1);

namespace Tests\HttpClient\Http;

use Rolf\HttpClient\Exceptions\ResponseException;
use Rolf\HttpClient\Http\ResponseResolver;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;

class ResponseResolverTest extends TestCase
{
    public function testGetContent(): void
    {
        $response = new Response(
            200,
            ['content-type' => 'application/json'],
            Utils::streamFor('{"test": "test another"}')
        );

        $this->assertSame(['test' => 'test another'], ResponseResolver::getContent($response));
    }

    public function testGetContentWithoutHeaders(): void
    {
        $response = new Response(
            200,
            [],
            Utils::streamFor('{"test": "test another"}')
        );

        $this->assertSame(['test' => 'test another'], ResponseResolver::getContent($response));
    }

    public function testErrorResponse(): void
    {
        $response = new Response(
            403,
            ['content-type' => 'application/json'],
            Utils::streamFor('{"test": "test another"}')
        );

        $this->expectException(ResponseException::class);
        ResponseResolver::getContent($response);
    }

    public function testEmptyError()
    {
        $response = new Response(
            200,
            ['content-type' => 'application/json'],
            Utils::streamFor('')
        );

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Response was empty');
        ResponseResolver::getContent($response);
    }
}
