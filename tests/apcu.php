<?php
/**
 * File: apcu.php
 * Created Date: 2017-08-09 17:51:23
 */
declare (strict_types = 1);

namespace Test\Caphe;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use \Caphe\Driver\APCu as Driver, \Caphe\IClient;

require __DIR__ . '/partials.normal.php';
require __DIR__ . '/partials.namespace.php';
require __DIR__ . '/partials.initial.php';

ini_set('apc.use_request_time', '0');

class APCuTest extends TestCase
{
    use TACPu_FullClient;

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

trait TACPu_FullClient {

    /**
     * @return IClient
     */
    protected function __getClient()
    {
        return Driver\ClientProvider::createClient([
            'forceCLI' => true
        ]);
    }
}
