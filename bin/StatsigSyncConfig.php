<?php

require __DIR__ . '/../vendor/autoload.php';

use Statsig\StatsigLocalFileSpecsAdapter;

$sdk_key = getenv("STATSIG_SECRET_KEY");

$specs_adapter = new StatsigLocalFileSpecsAdapter($sdk_key, "/tmp");
$specs_adapter->syncSpecsFromNetwork();
