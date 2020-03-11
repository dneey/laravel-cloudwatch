# AWS CloudWatch Logger for Laravel

Implementation of [maxbanton AWS handler for monolog](https://github.com/maxbanton/cwh) in [Laravel](https://github.com/laravel/laravel).

## Requirements

- PHP ^7.1.3
- Laravel >=5.7

## Features

- Includes incoming request parameters on every log.
- Includes a `requestId` on every log to narrow down search to a particular request on cloudwatch.

## Installation

Install the latest version with [Composer](https://getcomposer.org/) by running

```bash
$ composer require dneey/laravel-cloudwatch
```

## Basic Usage

1. Drop this in your application's `.env` file with your correct AWS credentials.

```php
AWS_KEY=aws-key
AWS_SECRET=aws-secret
AWS_VERSION=latest
AWS_REGION=eu-west-1
```

2. Update the log channel in your .env file to `cloudwatch`.

```php
LOG_CHANNEL=cloudwatch
```

That's it! You can now log to AWS CloudWatch.

## Extra Configurations

You can choose to overide the defaults and configure your cloudwatch log group name and stream name in your .env file.

```php
CLOUD_WATCH_GROUP_NAME=project-name
CLOUD_WATCH_STREAM_NAME=rpay-v2-api
```

If not set,
the value in your `APP_NAME` will be used as the log group name and the value
of your `APP_NAME-APP_ENV`(Your application name and environment) will be used as your log stream name.

You can specify your log level eg. API, DEBUG.

```php
CLOUD_WATCH_LEVEL=API
```

You can also specify how long the logs stay in cloudwatch in days.

```php
CLOUD_WATCH_RETENTION_DAYS=30
```

## Example

```php
Log::info('Awesome! We are now logging to cloudwatch from Laravel.');
```

## AWS

For AWS IAM and policy examples, kindly visit [maxbanton AWS handler for monolog.](https://github.com/maxbanton/cwh)
