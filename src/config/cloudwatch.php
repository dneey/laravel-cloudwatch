<?php

return [
    'cloudwatch' => [
        'driver' => 'custom',
        'via' => \App\Services\Logging\CloudWatchLoggerFactory::class,
        'sdk' => [
            'region' => env('AWS_CLOUD_WATCH_REGION', 'us-west-1'),
            'version' => env('AWS_CLOUD_WATCH_VERSION', 'latest'),
            'credentials' => [
                'key' => env('AWS_CLOUD_WATCH_KEY_ID'),
                'secret' => env('AWS_CLOUD_WATCH_SECRET'),
            ],
        ],
        'stream_name' => env('AWS_CLOUD_WATCH_STREAM_NAME', env('APP_NAME') . '-' . config('APP_ENV')),
        'group_name' => env('AWS_CLOUD_WATCH_GROUP_NAME', 'rpay'),
        'retention' => env('AWS_CLOUD_WATCH_RETENTION_DAYS', 3),
        'level' => env('AWS_CLOUD_WATCH_LEVEL', 'api'),
    ]];
