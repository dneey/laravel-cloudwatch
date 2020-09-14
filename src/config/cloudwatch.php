<?php

return [
    'cloudwatch' => [

        'name' => 'cloudwatch',

        'driver' => 'custom',

        'via' => \Dneey\CloudWatch\CloudWatchLoggerFactory::class,

        /*
         * Your amazon cloudwatch credentials.
         */
        'sdk' => [

            'region' => env('AWS_DEFAULT_REGION', 'us-west-1'),

            'version' => env('AWS_VERSION', 'latest'),

            'credentials' => [

                'key' => env('AWS_ACCESS_KEY_ID'),

                'secret' => env('AWS_SECRET_ACCESS_KEY'),

            ],
        ],
        /*
         * The 'stream_name' for amazon cloudwatch.
         * It is defaulted to the application name.
         */
        'stream_name' => env('AWS_CLOUD_WATCH_STREAM_NAME', env('APP_NAME')),

        /*
         * The 'group_name' for amazon cloudwatch.
         * It is defaulted to the application name and environment.
         */
        'group_name' => env('AWS_CLOUD_WATCH_GROUP_NAME', env('APP_NAME') . '-' . env('APP_ENV')),

        /*
         * The 'retention' refers to duration to keep logs in days.
         * It is 14 by default set to null to make it indefinite.
         */
        'retention' => env('AWS_CLOUD_WATCH_RETENTION_DAYS', 14),

        /*
         * The 'level' refers to the log level to log. It is api by default.
         *
         * options: API, DEBUG, INFO, ERROR, CRITICAL
         */
        'level' => env('AWS_CLOUD_WATCH_LEVEL', 'API'),

        'batch' => env('AWS_CLOUD_WATCH_BATCH_SIZE', '10000'),

        /*
         * Set 'log_requests' to false to prevent it from logging your requests
         * This is defaulted to true
         * options: tru,false
         */
        'log_requests' => env('LOG_REQUEST_PARAMS', true),

        /*
         * Set 'log_requests_except' to a string of fields/params to be ignored in a log
         * The defaults are  'password' and 'password_confirmation'
         *
         * Eg: LOG_REQUESTS_EXCEPT='password, password_confirmation, pin, etc'
         */
        'log_requests_except' => array_map('trim', explode(',', env('LOG_REQUESTS_EXCEPT', 'password, password_confirmation'))),
    ],
];
