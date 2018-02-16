<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/autoload.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hola mundo</h1>
</body>
</html>