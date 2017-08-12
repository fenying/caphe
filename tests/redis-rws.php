<?php
/**
 * File: redis.php
 * Created Date: 2017年5月16日 下午4:16:07
 */
declare (strict_types = 1);

namespace Test\Caphe;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use \Caphe\Driver\Redis as Driver, \Caphe\IClient;

require __DIR__ . '/partials.normal.php';
require __DIR__ . '/partials.namespace.php';
require __DIR__ . '/partials.initial.php';

class RedisRWSTest extends TestCase
{
    use TRedis_RWSClient;

    use TDriver_CleanUp;
    use TDriver_MethodRemoveAll;

    use TDriver_MethodSet;
    use TDriver_MethodSetInt;
    use TDriver_MethodSetFloat;
    use TDriver_MethodSetString;

    use TDriver_MethodAdd;
    use TDriver_MethodAddInt;
    use TDriver_MethodAddFloat;
    use TDriver_MethodAddString;

    use TDriver_NamespaceMethodSet;
    use TDriver_NamespaceMethodSetInt;
    use TDriver_NamespaceMethodSetFloat;
    use TDriver_NamespaceMethodSetString;

    use TDriver_NamespaceMethodAdd;
    use TDriver_NamespaceMethodAddInt;
    use TDriver_NamespaceMethodAddFloat;
    use TDriver_NamespaceMethodAddString;
}

trait TRedis_RWSClient {

    /**
     * @return IClient
     */
    protected function __getClient()
    {
        return Driver\ClientProvider::createClient([
            'reader' => [
                'host' => '127.0.0.1',
                'port' => 6677,
                'persist' => true
            ],
            'writer' => [
                'host' => '127.0.0.1',
                'port' => 6379,
                'persist' => true
            ]
        ]);
    }
}
