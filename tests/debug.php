#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Caphe\Driver\Redis as Cache;

/**
 * Execute Redis client methods and print the results.
 *
 * @param \Caphe\IClient $client
 * @param string $action
 * @param array ...$args
 */
function redisExec($client, $action, ...$args) {
    echo $action,
    '(',
    substr(json_encode($args), 1, -1),
    ') => ';
    var_dump(call_user_func_array([$client, $action], $args));
}

try {

    $conn = Cache\ClientProvider::createClient([
        'reader' => [
            'port' => 6677,
            'host' => '127.0.0.1',
            'persist' => false
        ],
        'writer' => [
            'port' => 6379,
            'host' => '127.0.0.1',
            'persist' => false
        ]
    ]);

    redisExec($conn, 'removeAll');
    redisExec($conn, 'set', 'a', 'fff');
    redisExec($conn, 'add', 'a', 'ccc');
    redisExec($conn, 'get', 'a');
    redisExec($conn, 'add', 'b', 'ccc');
    redisExec($conn, 'add', 'c', 'aac');

    redisExec($conn, 'getMulti', [
        'a', 'b', 'c'
    ]);

    redisExec($conn, 'remove', 'a');
    redisExec($conn, 'remove', 'b');
    redisExec($conn, 'remove', 'c');

    redisExec($conn, 'set', 'a', 1);
    redisExec($conn, 'set', 'b', 2);
    redisExec($conn, 'setInt', 'c', 3);
    redisExec($conn, 'cas', 'c', 3, 5);

    redisExec($conn, 'getInt', 'c');

    redisExec($conn, 'removeMulti', [
        'a', 'b', 'c'
    ]);

    redisExec($conn, 'nsSet', 'users', 'Angus', [
        'age' => 23
    ]);

    redisExec($conn, 'nsGet', 'users', 'Angus');

    redisExec($conn, 'nsSetInt', 'test', 'a', 3);

    redisExec($conn, 'nsGetInt', 'test', 'a');

    redisExec($conn, 'nsIncrease', 'test', 'a');

    redisExec($conn, 'nsGetInt', 'test', 'a');

    redisExec($conn, 'nsCAS', 'test', 'a', 4, 15);

    redisExec($conn, 'nsGetInt', 'test', 'a');

    redisExec($conn, 'nsDecrease', 'test', 'a');

    redisExec($conn, 'nsGetInt', 'test', 'a');

}
catch (\Exception $e) {

    if ($conn && !$conn->isConnected()) {

        echo 'Lose the connection to redis.', PHP_EOL;
    }
}
