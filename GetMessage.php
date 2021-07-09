<?php

require_once __DIR__ . '/vendor/autoload.php';
define("RABBITMQ_HOST", "192.168.1.28");
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USERNAME", "admin");
define("RABBITMQ_PASSWORD", "admin");
define("RABBITMQ_QUEUE_NAME", "task_queue");

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(RABBITMQ_HOST, RABBITMQ_PORT, RABBITMQ_USERNAME, RABBITMQ_PASSWORD);
$channel = $connection->channel();

$channel->queue_declare('QueueMSG', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('QueueMSG', '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>