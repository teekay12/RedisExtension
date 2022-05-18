# RedisExtension

This is a simple PHP Class which extends PHPRedis Class which receives redis configuration options on instantiation and connect automatically

#To Install

Step 1
Run composer require teekay12/redis_extension to install,

Step 2
Run docker compose up to set up the development environment

Import the class, see example below

<pre>
require 'RedisProvider.php';
use Teekay12\RedisExtension\RedisProvider;
</pre>

once the step above is completed, you can go ahead with your configuration options

<pre>
    $options = [
        'host' => "172.25.0.1",
        'port' => 6379,
        'enable_calling_class' => false,
        'connection_timeout' => 1
        'auth' => [
            'username' => 'value',
            'password' => 'value'
        ]
    ];
</pre>

Web server IP & port : 172.25.0.1:6379

To connect simply call the RedisProvider class create method and pass the options array

<pre>RedisProvider::create($options)</pre>

this will create an object which you can use to set variables.

Happy Coding !!!
