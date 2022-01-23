<?php

declare(strict_types=1);

namespace Rolf\HttpClient\Api;

class Comments extends AbstractApi
{
    /**
     * Получение всех комментариев
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        return $this->get('comments');
    }

    /**
     * Создание комментария
     *
     * @param string $name
     * @param string $text
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $name, string $text): array
    {
        return $this->post('comments', [
            'name' => $name,
            'text' => $text,
        ]);
    }

    /**
     * Обновление комментария
     *
     * @param int $id
     * @param string $name
     * @param string $text
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(int $id, string $name, string $text): array
    {
        return $this->put('comments/'.$id, [
            'name' => $name,
            'text' => $text,
        ]);
    }
}
