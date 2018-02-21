# corephp-log

An easy log system for php webapps

## Basic use

```php
use CorePHP\Log\Logger;
use CorePHP\Log\Handlers\FileHandler;
use CorePHP\Log\Formatters\WebFormatter;
use CorePHP\Log\Handlers\StdoutHandler;

$logger = new Logger('TEST');
$formatter = new WebFormatter();

$handler = new FileHandler(__DIR__ . '/logger.log');
$handler1 = new StdoutHandler(true);
$handler->setFormatt($formatter);
$handler1->setFormatt($formatter);

$logger->addHandler($handler);
$logger->addHandler($handler1);

$logger->error('Mensaje random');
```
