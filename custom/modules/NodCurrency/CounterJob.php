namespace Espo\Custom\NodCurrency;

use Espo\Core\Job\AbstractJob;

class CounterJob extends AbstractJob
{
    public function run($container)
    {
        // Gauti duomenis apie įrašus, vartotojus ir diską
        $entityManager = $container->get('entityManager');
        $recordCount = $entityManager->getCount('YourEntityName'); // Pakeiskite su savo entitetu
        $userCount = $entityManager->getCount('User');
        $diskSize = disk_free_space("/") / (1024 * 1024); // Pavyzdys - erdvė diske MB
        
        // Gauti CRM dydį
        $dbSize = $this->getDatabaseSize($container);

        // Sukurkite naują Counter įrašą
        $counterData = [
            'diskSize' => $diskSize,
            'size' => $dbSize,  // Pridėkite gautą CRM dydį
            'numberOfRecords' => $recordCount,
            'numberOfUsers' => $userCount,
        ];

        $entityManager->create('Counter', $counterData);
    }

    protected function getDatabaseSize($container)
    {
        // Gauti duomenų bazės ryšį
        $dbConnection = $container->get('db');
        $databaseName = $dbConnection->getDatabase(); // Gauti dabartinę duomenų bazę

        // SQL užklausa gauti duomenų bazės dydį
        $query = "SELECT SUM(data_length + index_length) AS size
                  FROM information_schema.TABLES
                  WHERE table_schema = :database";

        $result = $dbConnection->execute($query, ['database' => $databaseName]);

        return isset($result[0]['size']) ? $result[0]['size'] / (1024 * 1024) : 0; // Grąžinti dydį MB
    }
}
