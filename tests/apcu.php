<?php
/**
 * File: apcu.php
 * Created Date: 2017-08-09 17:51:23
 */
declare (strict_types = 1);

namespace Test\Caphe;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use \Caphe\Driver\APCu as Driver;

/**
 * For CLI settings.
 */
ini_set(
    'apc.use_request_time',
    '0'
);

class APCuTest extends TestCase
{
    /**
     * @return \Caphe\IClient
     */
    protected function __getClient()
    {
        return Driver\ClientProvider::createClient([]);
    }

    use APCuTestSetAndGet;
    use APCuTestSetAndGetWithNamespace;
    use APCuTestSetAndGetWithExpires;

    use APCuTestSetAndGetInt;
    use APCuTestSetAndGetIntWithNamespace;
    use APCuTestSetAndGetIntWithExpires;

    use APCuTestSetAndGetFloat;
    use APCuTestSetAndGetFloatWithNamespace;
    use APCuTestSetAndGetFloatWithExpires;

    use APCuTestExists;
    use APCuTestExistsWithNamespace;

    use APCuTestDelete;
    use APCuTestDeleteWithNamespace;
}

/**
 * Test for Reader::get and Writer::set
 */
trait APCuTestSetAndGet
{
    public function data_Set(): array
    {
        return [
            ['hello', 'hello'],
            ['hi', 321],
            ['nono', ['a']],
            ['test', 5.1]
        ];
    }

    /**
     * @dataProvider data_Set
     */
    public function testSet(string $key, $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->set($key, $value)
        );
    }

    /**
     * @dataProvider data_Set
     * @depends testSet
     */
    public function testGet(string $key, $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            $value,
            $connection->get($key)
        );
    }
}

/**
 * Test for Reader::getInt and Writer::setInt, with expires parameter.
 */
trait APCuTestSetAndGetWithExpires
{
    public function data_SetWithExpires(): array
    {
        return [
            ['any/exp/1', 'a123', 1],
            ['any/exp/2', 321, 2],
            ['any/exp/4', [5.5555], 4]
        ];
    }

    /**
     * @dataProvider data_SetWithExpires
     */
    public function testSetWithExpires(
        string $key,
        $value,
        int $expires
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->set(
                $key,
                $value,
                $expires
            )
        );

        sleep(intval($expires / 2));

        $this->assertEquals(
            $value,
            $connection->get($key)
        );

        sleep(intval(round($expires / 2 + 1)));

        $this->assertEquals(
            null,
            $connection->get($key, null)
        );
    }
}

/**
 * Test for Reader::nsGet and Writer::nsGet
 */
trait APCuTestSetAndGetWithNamespace
{
    public function data_SetAndGetWithNamespace(): array
    {
        return [
            ['test', 'a', 'hello'],
            ['test', 'b', 321],
            ['test', 'c', ['a']],
            ['test', 'd', 5.1]
        ];
    }

    /**
     * @dataProvider data_SetAndGetWithNamespace
     */
    public function testSetWithNamespace(string $ns, string $key, $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSet(
                $ns,
                $key,
                $value
            )
        );
    }

    /**
     * @dataProvider data_SetAndGetWithNamespace
     * @depends testSetWithNamespace
     */
    public function testGetWithNamespace(string $ns, string $key, $value)
    {
        $this->assertEquals(
            $value,
            $this->__getClient()->nsGet($ns, $key)
        );
    }
}

/**
 * Test for Reader::getInt and Writer::setInt, with expires parameter.
 */
trait APCuTestSetAndGetIntWithExpires
{
    public function data_SetAndGetIntWithExpires(): array
    {
        return [
            ['int/exp/1', 123, 1],
            ['int/exp/2', 321, 2],
            ['int/exp/4', 5555, 4]
        ];
    }

    /**
     * @dataProvider data_SetAndGetIntWithExpires
     */
    public function testSetAndGetIntWithExpires(
        string $key,
        int $value,
        int $expires
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setInt(
                $key,
                $value,
                $expires
            )
        );

        sleep(intval($expires / 2));

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );

        sleep(intval(round($expires / 2 + 1)));

        $this->assertEquals(
            null,
            $connection->getInt($key, null)
        );
    }
}

trait APCuTestSetAndGetInt
{
    public function data_SetInt(): array
    {
        return [
            ['int/a', 123],
            ['int/b', 321],
            ['int/c', 5555],
            ['int/d', 0]
        ];
    }

    /**
     * @dataProvider data_SetInt
     */
    public function testSetInt(string $key, int $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setInt($key, $value)
        );
    }

    /**
     * @dataProvider data_SetInt
     * @depends testSetInt
     */
    public function testGetInt(string $key, int $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );
    }
}

trait APCuTestSetAndGetIntWithNamespace
{
    public function data_SetIntWithNamespace(): array
    {
        return [
            ['test', 'hello', 123],
            ['test', 'hi', 321],
            ['test', 'nono', 5555],
            ['test', 'test', 0]
        ];
    }

    /**
     * @dataProvider data_SetIntWithNamespace
     */
    public function testSetIntWithNamespace(
        string $ns,
        string $key,
        int $value
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetInt(
                $ns,
                $key,
                $value
            )
        );
    }

    /**
     * @dataProvider data_SetIntWithNamespace
     * @depends testSetIntWithNamespace
     */
    public function testGetIntWithNamespace(
        string $ns,
        string $key,
        int $value
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            $value,
            $connection->nsGetInt($ns, $key)
        );
    }
}

trait APCuTestSetAndGetFloat
{
    public function data_SetFloat(): array
    {
        return [
            ['float/a', 123.5],
            ['float/b', 321.5],
            ['float/c', 5555.5],
            ['float/d', 0.5]
        ];
    }

    /**
     * @dataProvider data_SetFloat
     */
    public function testSetFloat(string $key, float $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setFloat($key, $value)
        );
    }

    /**
     * @dataProvider data_SetFloat
     * @depends testSetFloat
     */
    public function testGetFloat(string $key, float $value)
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );
    }
}

trait APCuTestSetAndGetFloatWithNamespace
{
    public function data_SetFloatWithNamespace(): array
    {
        return [
            ['test', 'float/a', 123.5],
            ['test', 'float/b', 321.5],
            ['test', 'float/c', 5555.5],
            ['test', 'float/d', 0.5]
        ];
    }

    /**
     * @dataProvider data_SetFloatWithNamespace
     */
    public function testSetFloatWithNamespace(
        string $ns,
        string $key,
        float $value
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetFloat(
                $ns,
                $key,
                $value
            )
        );
    }

    /**
     * @dataProvider data_SetFloatWithNamespace
     * @depends testSetFloatWithNamespace
     */
    public function testGetFloatWithNamespace(
        string $ns,
        string $key,
        float $value
    )
    {
        $connection = $this->__getClient();

        $this->assertEquals(
            $value,
            $connection->nsGetFloat($ns, $key)
        );
    }
}

trait APCuTestSetAndGetFloatWithExpires
{
    public function data_SetFloatWithExpires(): array
    {
        return [
            ['float/exp/1', 123.5, 1],
            ['float/exp/2', 321.123, 2],
            ['float/exp/4', 5555.44, 4]
        ];
    }

    /**
     * @dataProvider data_SetFloatWithExpires
     */
    public function testSetFloatWithExpires(
        string $key,
        int $value,
        int $expires
    )
    {
        $connection = $this->__getClient();

        $connection->setFloat($key, $value, $expires);

        sleep(intval($expires / 2));

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );

        sleep(intval(round($expires / 2 + 1)));

        $this->assertEquals(
            null,
            $connection->getFloat($key, null)
        );
    }
}

trait APCuTestExists
{
    public function data_Exists(): array
    {
        return [
            ['int/a'],
            ['int/b'],
            ['int/c'],
            ['int/d']
        ];
    }

    /**
     * @dataProvider data_Exists
     * @depends testSetInt
     */
    public function testExists(string $key)
    {
        $this->assertEquals(
            true,
            $this->__getClient()->exists($key)
        );
    }
}

trait APCuTestExistsWithNamespace
{
    public function data_ExistsWithNamespace(): array
    {
        return [
            ['test', 'hello'],
            ['test', 'hi'],
            ['test', 'nono'],
            ['test', 'test']
        ];
    }

    /**
     * @dataProvider data_ExistsWithNamespace
     * @depends testSetIntWithNamespace
     */
    public function testExistsWithNamespace(string $ns, string $key)
    {
        $this->assertEquals(
            true,
            $this->__getClient()->nsExists($ns, $key)
        );
    }
}

trait APCuTestDelete
{
    public function data_Delete(): array
    {
        return [
            ['hello'],
            ['hi'],
            ['nono'],
            ['test']
        ];
    }

    /**
     * @dataProvider data_Delete
     * @depends testGet
     */
    public function testDelete(string $key)
    {
        $this->assertEquals(
            true,
            $this->__getClient()->remove($key)
        );
    }
}

trait APCuTestDeleteWithNamespace
{
    public function data_NsDelete(): array
    {
        return [
            ['test', 'hello'],
            ['test', 'hi'],
            ['test', 'nono'],
            ['test', 'test']
        ];
    }

    /**
     * @dataProvider data_NsDelete
     * @depends testGetIntWithNamespace
     */
    public function testNsDelete(string $ns, string $key)
    {
        $this->assertEquals(
            true,
            $this->__getClient()->nsRemove($ns, $key)
        );
    }
}
