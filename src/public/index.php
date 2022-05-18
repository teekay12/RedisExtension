<?php

require 'RedisProvider.php';
use  Teekay12\RedisExtension\RedisProvider;

$options = [
    'host' => "172.25.0.1",
    'port' => 6379,
    'enable_calling_class' => false,
    'connection_timeout' => 1
];

$redis = RedisProvider::create($options);
$redis_instance = $redis->getRedisConnection();
$redis_instance->set("key1", "value01");
echo $redis_instance->get("key1");

$redis->close();
