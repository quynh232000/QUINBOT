<?php
namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PythonEngineService
{
    public function dispatchToPython($taskName, $args = [], $kwargs = [])
    {
        $taskId = (string) Str::uuid();
        $queueName = config('app.celery_queue', 'celery');

        // 1. Cấu trúc BODY: Đây là phần thực thi của task
        $body = [
            $args,           // List các tham số (positional args)
            (object) $kwargs,     // Kwargs (named args)
            [
                'callbacks' => null,
                'errbacks'  => null,
                'chain'     => null,
                'chord'     => null
            ]
        ];

        // 2. Cấu trúc PAYLOAD: Phải đúng format của Celery Protocol v2
        $payload = [
            'body'             => base64_encode(json_encode($body)),
            'content-encoding' => 'utf-8',
            'content-type'     => 'application/json',
            'headers'          => [
                'id'         => $taskId,
                'task'       => $taskName,
                'lang'       => 'py',
                'root_id'    => $taskId,
                'parent_id'  => null,
                'group'      => null,
                'meth'       => null,
                'shadow'     => null,
                'eta'        => null,
                'expires'    => null,
                'retries'    => 0,
                'timelimit'  => [null, null],
                'origin'     => 'gen' . getmypid() . '@' . gethostname(),
            ],
            'properties' => [
                'correlation_id' => $taskId,
                'delivery_mode'  => 2,
                'delivery_info'  => [
                    'exchange'    => '',
                    // 'routing_key' => $queueName,
                    'routing_key' => config('app.celery_queue', 'celery'),
                ],
                'priority'       => 0,
                'body_encoding'  => 'base64',
                'delivery_tag'   => (string) Str::uuid(),
            ]
        ];

        // 3. QUAN TRỌNG: Sử dụng kết nối Redis không có Prefix
        // Mặc định Laravel thêm 'laravel_database_' vào key, Celery sẽ không thấy key này.
        // Ta dùng connection('default') hoặc gọi trực tiếp mã lệnh không qua Facade nếu có prefix
        Redis::connection()->client()->lpush($queueName, json_encode($payload));

        return $taskId;
    }
}