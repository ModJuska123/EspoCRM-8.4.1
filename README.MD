README - EspoCRM Counter Extension
This extension enhances EspoCRM by creating a new "Counter" entity that tracks database metrics. It features four custom fields: diskSize (float), size (float), numberOfRecords (integer), and numberOfUsers (integer), which gather data directly from the database.

Key functionalities include:

Scheduled Jobs: The extension registers a CounterJob that can be configured via the "Scheduled Jobs" section. This job runs at specified intervals to update the metrics.
API Integration: Users can send data to another EspoCRM instance through a REST API. API credentials (apiKey, secretKey, and destinationUrl) can be entered in the new "Osom CRM >> Counter" tab.
For setup and configuration instructions, please refer to the EspoCRM documentation.