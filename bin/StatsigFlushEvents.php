<?php

require __DIR__ . '/../vendor/autoload.php';

use Statsig\StatsigLocalFileEventLoggingAdapter;

$sdk_key = getenv("STATSIG_SECRET_KEY");

$logging_adapter = new StatsigLocalFileEventLoggingAdapter($sdk_key, "/tmp");
$logging_adapter->sendPendingEvents();
