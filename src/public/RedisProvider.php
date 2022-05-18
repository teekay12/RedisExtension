<?php 

declare(strict_types = 1);

namespace Teekay12\RedisExtension;
use \Redis;

class RedisProvider extends Redis {
    private string $host;
    private int $auth;
    private string $username;
    private string $password;
    private int $port;
    private float $connection_timeout;
    private string $prefix;
    private object $redis_instance;

    private static object $obj;

    private final function __construct(array $options){
        $this->host = $options['host'] ?? '127.0.0.1';
        $this->port = $options['port'] ?? 6379;

        if($options['enable_calling_class']) $this->prefix = $this->get_calling_class();

        $this->username = $options['auth'][0] ?? "";
        $this->password = $options['auth'][1] ?? "";
        $this->connection_timeout = $options['connection_timeout'] ?? 1;

        $this->redis_instance = $this->connectToRedis();
    }

    public static function create($options) : object 
    {
        if(!isset(self::$obj)){
            self::$obj = new RedisProvider($options); 
        }

        return self::$obj;
    }

    private function connectToRedis() : object 
    {
        if(!empty($this->username) && !empty($this->password)){
            $this->connect($this->host, $this->port, 
                            $this->connection_timeout, NULL, 100, 0, 
                            ['auth' => [$this->username, $this->password]]);
        }else{
            $this->connect($this->host, $this->port, $this->connection_timeout, NULL, 100);
        }

        if(isset($this->prefix)) $this->setOption(Redis::OPT_PREFIX, $this->prefix.":");

        return $this;
    }

    private function get_calling_class() : string {
        $trace = debug_backtrace();
        $class = $trace[1]['class'];
        for ( $i=1; $i<count( $trace ); $i++ ) {
            if ( isset( $trace[$i] ) )
                 if ( $class != $trace[$i]['class'] )
                     return $trace[$i]['class'];
        }
    }

    public function getRedisConnection() : object{
        return $this->redis_instance;
    }
}