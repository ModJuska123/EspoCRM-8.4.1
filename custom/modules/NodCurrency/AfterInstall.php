<?php

use Espo\Core\Container;
use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\Config\ConfigWriter;

class AfterInstall
{
    public function run(Container $container): void
    {
        // Gauti konfigūraciją
        $config = $container->getByClass(Config::class);
        $configWriter = $container->getByClass(InjectableFactory::class)
            ->create(ConfigWriter::class);

        // Gauti valiutų sąrašą
        $currencyList = $config->get('currencyList') ?? [];

        // Pridėti naują valiutą "NOD" jei ji dar neegzistuoja
        if (!in_array('NOD', $currencyList)) {
            $currencyList[] = 'NOD';
            $configWriter->set('currencyList', $currencyList);
        }

        // Išsaugoti pakeitimus
        $configWriter->save();
    }
}
