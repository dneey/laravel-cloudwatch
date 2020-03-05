<?php

namespace Dneey\Cloudwatch;

use Illuminate\Support\ServiceProvider;

class CloudwatchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        config(['logging.channel' => config('cloudwatch')]);
    }
    public function register()
    {
    }
}
