<?php

return [
    'cloudwatch' => [
        'driver' => 'custom',
        'via' => \App\Services\Logging\CloudWatchLoggerFactory::class,
        'sdk' => [
            'region' => env('AWS_REGION', 'us-west-1'),
            'version' => env('AWS_VERSION', 'latest'),
            'credentials' => [
                'key' => env('AWS_KEY'),
                'secret' => env('AWS_SECRET'),
            ],
        ],
        'stream_name' => env('CLOUD_WATCH_STREAM_NAME', env('APP_NAME')),
        'group_name' => env('CLOUD_WATCH_GROUP_NAME', env('APP_NAME') . '-' . config('APP_ENV')),
        'retention' => env('CLOUD_WATCH_RETENTION_DAYS', 14),
        'level' => env('CLOUD_WATCH_LEVEL', 'api'),
    ]];
