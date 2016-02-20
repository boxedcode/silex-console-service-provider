<?php

namespace BoxedCode\Silex\Console;

use Knp\Console\Application as ConsoleApplication;
use Knp\Console\ConsoleEvent;
use Knp\Console\ConsoleEvents;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ConsoleServiceProvider
 *
 * @package BoxedCode\Silex\Console
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['console'] = function () use ($app) {
            $application = new ConsoleApplication(
                $app,
                $app['console.project_directory'],
                $app['console.name'],
                $app['console.version']
            );

            $app['dispatcher']->dispatch(ConsoleEvents::INIT, new ConsoleEvent($application));

            return $application;
        };
    }
}
