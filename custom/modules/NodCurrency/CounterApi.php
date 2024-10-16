<?php

namespace Espo\Custom\NodCurrency;

use Espo\Core\Utils\Error;

class CounterApi
{
    public function getCounterData($params)
    {
        // Implement the logic to retrieve and return counter data
        // Example logic (modify according to your needs):
        
        // Assuming $params['id'] is the ID of the Counter entity
        $counter = $this->getEntityManager()->get('Counter', $params['id']);
        
        if (!$counter) {
            throw new Error('Counter not found', 404);
        }

        return [
            'diskSize' => $counter->get('diskSize'),
            'size' => $counter->get('size'),
            'numberOfRecords' => $counter->get('numberOfRecords'),
            'numberOfUsers' => $counter->get('numberOfUsers')
        ];
    }
}
