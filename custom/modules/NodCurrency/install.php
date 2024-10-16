<?php

use Espo\Core\Container;
use Espo\Core\InjectableFactory;

class Install
{
    public function run(Container $container)
    {
        $entityManager = $container->get('entityManager');

        // Create the 'Counter' entity with its fields
        $entityManager->addEntity('Counter', [
            'fields' => [
                'diskSize' => ['type' => 'float'],
                'size' => ['type' => 'float'],
                'numberOfRecords' => ['type' => 'integer'],
                'numberOfUsers' => ['type' => 'integer']
            ]
        ]);

        // Register the job
        $jobManager = $container->get('jobManager');
        $jobManager->addJob('CounterJob', 'Espo\Custom\NodCurrency\CounterJob');

        // Register the API
        $apiManager = $container->get('apiManager');
        $apiManager->addApi('CounterApi', 'Espo\Custom\NodCurrency\CounterApi');
    }
}

