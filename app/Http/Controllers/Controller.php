<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Базовый контроллер для всех API-контроллеров.
 * Содержит общую логику, включая форматирование ответов JSON.
 */
abstract class Controller
{
    /**
     * Унифицированный JSON-ответ API.
     *
     * Возвращает структуру:
     * [
     *   'success' => bool,
     *   'data'    => mixed|null,
     *   'meta'    => array|null
     * ]
     *
     * @param mixed|null $data  Данные, которые нужно вернуть в ответе
     * @param int $status       HTTP статус (200, 201, 422 и т. д.)
     * @param array $meta       Дополнительные метаданные (пагинация, фильтры и т.д.)
     *
     * @return JsonResponse     Ответ в стандартизированном формате
     */
    protected function jsonResponse(mixed $data = null, int $status = 200, array $meta = []): JsonResponse
    {
        $response = ['success' => $status < 400];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }
}
