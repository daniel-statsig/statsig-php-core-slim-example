<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Statsig\Statsig;
use Statsig\StatsigUserBuilder;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $statsig = $this->get(Statsig::class);

        $user = StatsigUserBuilder::withUserID('my_user')->build();
        $experiment = $statsig->getExperiment($user, 'an_experiment');

        $value = $experiment->get("a_string", "My Fallback Value");
        $reason = $experiment->details['reason'];

        $formatted_value = sprintf(
            "an_experiment.a_string: %s (%s)",
            $value,
            $reason
        );
        $response->getBody()->write($formatted_value);
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
