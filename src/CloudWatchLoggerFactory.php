<?php

namespace Dneey\CloudWatch;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;

class CloudWatchLoggerFactory
{
    /**
     * Custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $requestId = uniqid('', true) . rand(1000, 9999);
        $client = new CloudWatchLogsClient($config["sdk"]);
        $handler = new CloudWatch(
            $client,
            $config['group_name'],
            $config['stream_name'],
            $config["retention"],
            $config["batch"],
            $config["tags"] ?? []
        );
        $handler->setFormatter(new JsonFormatter());
        $handler->pushProcessor(new IntrospectionProcessor($config['level'], ["Illuminate\\"]));
        $handler->pushProcessor(new WebProcessor());
        $handler->pushProcessor(function ($entry) use ($config, $requestId) {
            $entry['extra']['requestId'] = $requestId;
            $entry['extra']['requestBody'] = $config['log_requests'] ? app('Illuminate\Http\Request')->except($config['log_requests_except']) : [];
            return $entry;
        });
        $logger = new Logger($config["name"]);
        $logger->pushHandler($handler);

        return $logger;
    }
}
