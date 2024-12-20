<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Statsig\Statsig;
use Statsig\StatsigOptions;
use Statsig\StatsigLocalFileEventLoggingAdapter;
use Statsig\StatsigLocalFileSpecsAdapter;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        Statsig::class => function (ContainerInterface $c) {
            $sdk_key = getenv("STATSIG_SECRET_KEY");

            $options = new StatsigOptions(
                null,
                null,
                new StatsigLocalFileSpecsAdapter($sdk_key, "/tmp"),
                new StatsigLocalFileEventLoggingAdapter($sdk_key, "/tmp")
            );

            $statsig = new Statsig($sdk_key, $options);
            $statsig->initialize();
            return $statsig;
        },
    ]);
};
