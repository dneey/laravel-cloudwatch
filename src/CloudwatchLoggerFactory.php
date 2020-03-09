<?php

namespace Dneey\CloudWatch;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;

class CloudWatchLoggerFactory
{
    /**
     * Create a custom Monolog instance.
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

        // Instantiate handler (tags are optional)
        $handler = new CloudWatch($client, $groupName, $streamName, $retentionDays, 10000, $tags);

        $amazonFormatter = new LineFormatter("%channel%: %level_name%: %message% %context% %extra%", null, false, true);
        $handler->setFormatter(new JsonFormatter($amazonFormatter));
        $handler->pushProcessor(new IntrospectionProcessor(Logger::API, ["Illuminate\\"]));
        $handler->pushProcessor(new WebProcessor());
        $handler->pushProcessor(function ($entry) {
            $entry['extra']['requestId'] = @$_SESSION['requestId'];
            return $entry;
        });

        // Create a log channel
        $logger = new Logger($name);
        // Set handler
        $logger->pushHandler($handler);

        return $logger;
    }
}
