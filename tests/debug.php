#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Caphe\Driver\APCu as Cache;

/**
 * Execute Redis client methods and print the results.
 *
 * @param \Caphe\IClient $client
 * @param string $action
 * @param array ...$args
 */
function cacheExec($client, $action, ...$args) {
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

    cacheExec($conn, 'removeAll');
    cacheExec($conn, 'set', 'a', 'fff');
    cacheExec($conn, 'add', 'a', 'ccc');
    cacheExec($conn, 'get', 'a');
    cacheExec($conn, 'add', 'b', 'ccc');
    cacheExec($conn, 'add', 'c', 'aac');

    cacheExec($conn, 'getMulti', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'setMulti', [
        'a' => 123,
        'b' => 'hello',
        'c' => true
    ]);

    cacheExec($conn, 'getMulti', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'setMultiString', [
        'a' => '123',
        'b' => 'hello',
        'c' => 'true'
    ]);

    cacheExec($conn, 'getMultiString', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'setMultiInt', [
        'a' => 5,
        'b' => 1,
        'c' => 4
    ]);

    cacheExec($conn, 'getMultiInt', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'setMultiFloat', [
        'a' => 5.6,
        'b' => 1.5,
        'c' => 4.9
    ]);

    cacheExec($conn, 'getMultiFloat', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'getMultiInt', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'remove', 'a');
    cacheExec($conn, 'remove', 'b');
    cacheExec($conn, 'remove', 'c');

    cacheExec($conn, 'set', 'a', 1);
    cacheExec($conn, 'set', 'b', 2);
    cacheExec($conn, 'setInt', 'c', 3);
    cacheExec($conn, 'cas', 'c', 3, 5);

    cacheExec($conn, 'getInt', 'c');

    cacheExec($conn, 'removeMulti', [
        'a', 'b', 'c'
    ]);

    cacheExec($conn, 'nsSet', 'users', 'Angus', [
        'age' => 23
    ]);

    cacheExec($conn, 'nsGet', 'users', 'Angus');

    cacheExec($conn, 'nsSetInt', 'test', 'a', 3);

    cacheExec($conn, 'nsGetInt', 'test', 'a');

    cacheExec($conn, 'nsIncrease', 'test', 'a');

    cacheExec($conn, 'nsGetInt', 'test', 'a');

    cacheExec($conn, 'nsCAS', 'test', 'a', 4, 15);

    cacheExec($conn, 'nsGetInt', 'test', 'a');

    cacheExec($conn, 'nsDecrease', 'test', 'a');

    cacheExec($conn, 'nsGetInt', 'test', 'a');

}
catch (\Exception $e) {

    if ($conn && !$conn->isConnected()) {

        echo 'Lose the connection to redis.', PHP_EOL;
    }
}
