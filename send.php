<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPConnection('192.168.1.16', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('publish', false, true, false, false);
$msg = new AMQPMessage('Hello World!');
$channel->basic_publish($msg, '', 'publish');
echo " [x] Sent 'Hello World!'\n";
$channel->close();
$connection->close();
?>
