<?php

declare(strict_types=1);

namespace Tests\HttpClient\Api;

use Rolf\HttpClient\Api\Comments;

class CommentsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetAllComments(): void
    {
        $expectedData = $this->getAllCommentsData();

        $api = $this->getAllCommentsRequestMock('comments', $expectedData);

        $this->assertEquals($expectedData, $api->all());
    }

    /**
     * @test
     */
    public function shouldCreateComment(): void
    {
        $expectedData = ['id' => 1, 'name' => 'Статья 1', 'text' => 'Текст статьи'];

        $api = $this->getApiMock();

        $api->method('post')
            ->with('comments', ['name' => 'Статья 1', 'text' => 'Текст статьи'])
            ->will($this->returnValue($expectedData));

        $this->assertEquals($expectedData, $api->create('Статья 1', 'Текст статьи'));
    }

    /**
     * @test
     */
    public function shouldUpdateComment(): void
    {
        $expectedData = ['id' => 1, 'name' => 'Обновленный заголовок', 'text' => 'Обновленный текст'];

        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('put')
            ->with('comments/1', ['name' => 'Обновленный заголовок', 'text' => 'Обновленный текст'])
            ->will($this->returnValue($expectedData));

        $this->assertEquals($expectedData, $api->update(1, 'Обновленный заголовок', 'Обновленный текст'));
    }

    public function getAllCommentsRequestMock(string $url, array $expectedData)
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with($url)
            ->will($this->returnValue($expectedData));

        return $api;
    }

    public function getAllCommentsData(): array
    {
        return [
            ['id' => 1, 'name' => 'Статья 1', 'text' => 'Текст статьи'],
            ['id' => 2, 'name' => 'Статья 2', 'text' => 'Текст статьи'],
        ];
    }

    protected function getApiClass()
    {
        return Comments::class;
    }
}
