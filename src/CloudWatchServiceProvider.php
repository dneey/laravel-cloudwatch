<?php

namespace Dneey\CloudWatch;

use Illuminate\Support\ServiceProvider;

class CloudWatchServiceProvider extends ServiceProvider
{
    public function boot()
    { }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/cloudwatch',
            'logging.channels'
        );
    }
}
