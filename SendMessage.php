<?php

require_once __DIR__ . '/vendor/autoload.php';



define("RABBITMQ_HOST", "192.168.1.28");
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USERNAME", "admin");
define("RABBITMQ_PASSWORD", "admin");
define("RABBITMQ_QUEUE_NAME", "task_queue");

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(RABBITMQ_HOST, RABBITMQ_PORT, RABBITMQ_USERNAME, RABBITMQ_PASSWORD);
$channel = $connection->channel();

$channel->queue_declare('QueueMSG', false, false, false, false);

for ($x = 0; $x <= 10; $x++) {

    $msg = new AMQPMessage('Hello World! ' . $x);
    $channel->basic_publish($msg, '', 'QueueMSG');
}

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();

?>