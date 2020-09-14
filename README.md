# AWS CloudWatch Logger for Laravel

Implementation of [maxbanton AWS handler for monolog](https://github.com/maxbanton/cwh) in [Laravel](https://github.com/laravel/laravel).

## Requirements

- PHP ^7.2.0
- Laravel ^6.0

## Features

- Includes incoming request parameters on every log.
- Includes a `requestId` on every log to narrow down search results to a particular request's lifecycle.

## Installation

Install the latest version with [Composer](https://getcomposer.org/) by running

```bash
$ composer require dneey/laravel-cloudwatch
```

## Basic Usage

Drop this in your application's `.env` file with your correct AWS credentials.

```php
LOG_CHANNEL=cloudwatch

AWS_ACCESS_KEY_ID=aws-key
AWS_SECRET_ACCESS_KEY=aws-secret
AWS_DEFAULT_REGION=aws-region
```

That's it!

```php
Log::info('You are now logging to cloudwatch');
```

## Extra Configurations

- You can configure your cloudwatch `log group name` and `stream name` in your .env file. If not set, the value of your `APP_NAME` will be used as the log group name and the value of your `APP_NAME` and `APP_ENV` will be used as your log stream name.

```php
CLOUD_WATCH_GROUP_NAME=project-name
CLOUD_WATCH_STREAM_NAME=project-name-env
```

- Set log level eg. INFO,CRITICAL,DEBUG,API etc.

```php
CLOUD_WATCH_LEVEL=INFO
```

- Set log retention period cloudwatch in days. The default is `14` days.

```php
CLOUD_WATCH_RETENTION_DAYS=14
```

- By default all request params will be logged except passwords and password confirmations. To change this, set `LOG_REQUEST_PARAMS` to false in the .env file.

```php
LOG_REQUEST_PARAMS=false
```

- You can ignore any request parameter by adding a `LOG_REQUESTS_EXCEPT` entry to your .env file. The value should contain a comma separated string of fields to exclude from your logs.

```php
LOG_REQUESTS_EXCEPT="password, password_confirmation, image"
```

## Example

```php
Log::info('Awesome! You are now logging to cloudwatch from Laravel.');
```

## AWS

For AWS IAM and policy examples, kindly visit [maxbanton AWS handler for monolog.](https://github.com/maxbanton/cwh)
