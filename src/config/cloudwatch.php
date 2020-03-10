<?php

$extra = [
    
    'log_requests' => env('LOG_REQUEST_PARAMS', true),
    
    'log_requests_except' => env('LOG_REQUESTS_EXCEPT', 'password, password_confirmation'),
];


return [
    'cloudwatch' => [
        
        'driver' => 'custom',
        
        'via' => \Dneey\CloudWatch\CloudWatchLoggerFactory::class,
        
        'sdk' => [
            
            'region' => env('AWS_REGION', 'us-west-1'),
            
            'version' => env('AWS_VERSION', 'latest'),
            
            'credentials' => [
                
                'key' => env('AWS_KEY'),
                
                'secret' => env('AWS_SECRET'),
                
            ],
        ],
        
        'stream_name' => env('CLOUD_WATCH_STREAM_NAME', env('APP_NAME')),
        
        'group_name' => env('CLOUD_WATCH_GROUP_NAME', env('APP_NAME') . '-' . env('APP_ENV')),
        
        'retention' => env('CLOUD_WATCH_RETENTION_DAYS', 14),
        
        'level' => env('CLOUD_WATCH_LEVEL', 'api'),
        
        'batch' => env('CLOUD_WATCH_BATCH_SIZE', '10000'),
        
        $extra,
    ],
];
