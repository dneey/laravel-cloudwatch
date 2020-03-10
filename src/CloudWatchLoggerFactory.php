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
        // @session_start;
        $_SESSION['requestId'] = uniqid('', true);
        $sdkParams = $config["sdk"];
        $tags = $config["tags"] ?? [];
        $name = $config["name"] ?? 'cloudwatch';

        // Instantiate AWS SDK CloudWatch Logs Client
        $client = new CloudWatchLogsClient($sdkParams);

        // Log group name, will be created if none
        $groupName = $config['group_name'];

        // Log stream name, will be created if none
        $streamName = $config['stream_name'];

        // Days to keep logs, 14 by default. Set to `null` to allow indefinite retention.
        $retentionDays = $config["retention"];

        $batch = $config["batch"];

        $extra = $config["extra"];

        // Instantiate handler (tags are optional)
        $handler = new CloudWatch($client, $groupName, $streamName, $retentionDays, $batch, $tags);
        $handler->setFormatter(new JsonFormatter());
        $handler->pushProcessor(new IntrospectionProcessor(Logger::API, ["Illuminate\\"]));
        $handler->pushProcessor(new WebProcessor());
        $handler->pushProcessor(function ($entry) use ($extra) {
            $entry['extra']['requestId'] = @$_SESSION['requestId'];
            $entry['extra']['request'] = $extra['log_requests'] ? app('Illuminate\Http\Request')->except($extra['log_requests_except']) : [];
            return $entry;
        });

        // Create a log channel
        $logger = new Logger($name);
        // Set handler
        $logger->pushHandler($handler);

        return $logger;
    }
}
