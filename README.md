# AWS CloudWatch Logger for Laravel

Implementation of [maxbanton] AWS handler for monolog](https://github.com/maxbanton/cwh) in [Laravel](https://github.com/laravel/laravel).

## Requirements

- PHP ^7.1.3
- Laravel >=5.7

## Features

- Automatically include incoming request parameters on every log.
- Included a "requestId" on every log to make it easier to search through logs of a request on cloudwatch.

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
```

2. Update the log channel in your .env file to `cloudwatch`.

```php
LOG_CHANNEL=cloudwatch
```

That's it! You can now log to AWS CloudWatch.

## Example

```php
Log::info('Awesome! We are now logging to cloudwatch.');
```

## AWS

For AWS IAM and policy examples, kindly visit [maxbanton AWS handler for monolog.](https://github.com/maxbanton/cwh)
