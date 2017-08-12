<?php

declare (strict_types = 1);

namespace Test\Caphe;

use \Caphe\IClient;

/**
 * Trait TDriver_MethodRemoveAll
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodRemoveAll {

    public function testMethodRemoveAll() {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->removeAll()
        );
    }
}

/**
 * Trait TDriver_MethodSet
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodSet {

    public function dp_for_MethodSetWithoutExpires() {

        return [
            ["SetWithoutExpires/a", 1],
            ["SetWithoutExpires/b", 1.3],
            ["SetWithoutExpires/c", 'hello'],
            ["SetWithoutExpires/d", ['test' => 33]],
            ["SetWithoutExpires/d", '123'],
            ["SetWithoutExpires/e", false]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetWithoutExpires
     * @param string $key
     * @param $value
     */
    public function testMethodSetWithoutExpires(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->set($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->get($key)
        );
    }

    public function dp_for_MethodSetWithExpires() {

        return [
            ["SetWithExpires/a", 1, 2],
            ["SetWithExpires/b", 1.3, 2],
            ["SetWithExpires/c", 'hello', 3],
            ["SetWithExpires/d", ['test' => 33], 4],
            ["SetWithExpires/d", '123', 3],
            ["SetWithExpires/e", false, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testMethodSetWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->set($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->get($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->get($key)
        );
    }
}

/**
 * Trait TDriver_MethodSetInt
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodSetInt {

    public function dp_for_MethodSetIntWithoutExpires() {

        return [
            ["SetIntWithoutExpires/a", 1],
            ["SetIntWithoutExpires/b", 3123131321],
            ["SetIntWithoutExpires/c", 4213],
            ["SetIntWithoutExpires/d", 44123],
            ["SetIntWithoutExpires/d", 41233],
            ["SetIntWithoutExpires/e", 44444]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetIntWithoutExpires
     * @param string $key
     * @param $value
     */
    public function testMethodSetIntWithoutExpires(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setInt($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );
    }

    public function dp_for_MethodSetIntWithExpires() {

        return [
            ["SetIntWithExpires/a", 1, 2],
            ["SetIntWithExpires/b", 2, 2],
            ["SetIntWithExpires/c", 3, 3],
            ["SetIntWithExpires/d", 41232131, 4],
            ["SetIntWithExpires/d", 53214124, 3],
            ["SetIntWithExpires/e", 3123131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetIntWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testMethodSetIntWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setInt($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getInt($key)
        );
    }
}

/**
 * Trait TDriver_MethodSetFloat
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodSetFloat {

    public function dp_for_MethodSetFloatWithoutExpires() {

        return [
            ["SetFloatWithoutExpires/a", 1.21313],
            ["SetFloatWithoutExpires/b", 312313.1321],
            ["SetFloatWithoutExpires/c", 42.13],
            ["SetFloatWithoutExpires/d", 441.23],
            ["SetFloatWithoutExpires/d", 41.233],
            ["SetFloatWithoutExpires/e", 4444.4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetFloatWithoutExpires
     * @param string $key
     * @param $value
     */
    public function testMethodSetFloatWithoutExpires(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setFloat($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );
    }

    public function dp_for_MethodSetFloatWithExpires() {

        return [
            ["SetFloatWithExpires/a", 1.3, 2],
            ["SetFloatWithExpires/b", 2.5, 2],
            ["SetFloatWithExpires/c", 3.2131, 3],
            ["SetFloatWithExpires/d", 4131.5, 4],
            ["SetFloatWithExpires/d", 5321.321, 3],
            ["SetFloatWithExpires/e", 312.3131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetFloatWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testMethodSetFloatWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setFloat($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getFloat($key)
        );
    }
}

/**
 * Trait TDriver_MethodSetString
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodSetString {

    public function dp_for_MethodSetStringWithoutExpires() {

        return [
            ["SetStringWithoutExpires/a", '1.21313'],
            ["SetStringWithoutExpires/b", '312313.1321'],
            ["SetStringWithoutExpires/c", '42.13'],
            ["SetStringWithoutExpires/d", '441.23'],
            ["SetStringWithoutExpires/d", '41.233'],
            ["SetStringWithoutExpires/e", '']
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetStringWithoutExpires
     * @param string $key
     * @param $value
     */
    public function testMethodSetStringWithoutExpires(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setString($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getString($key)
        );
    }

    public function dp_for_MethodSetStringWithExpires() {

        return [
            ["SetStringWithExpires/a", '1.3', 2],
            ["SetStringWithExpires/b", '2.5', 2],
            ["SetStringWithExpires/c", '3.2131', 3],
            ["SetStringWithExpires/d", '4131.5', 4],
            ["SetStringWithExpires/d", '5321.321', 3],
            ["SetStringWithExpires/e", '', 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodSetStringWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testMethodSetStringWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->setString($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getString($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getString($key)
        );
    }
}

/**
 * Trait TDriver_MethodAdd
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodAdd {

    public function dp_for_MethodAddWithoutExpires() {

        return [
            ["AddWithoutExpires/a", 1],
            ["AddWithoutExpires/b", 1.3],
            ["AddWithoutExpires/c", 'hello'],
            ["AddWithoutExpires/d", ['test' => 33]],
            ["AddWithoutExpires/e", false]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testMethodAddWithoutExpiresAndKeyNotExists(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->add($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->get($key)
        );
    }

    /**
     * @dataProvider dp_for_MethodAddWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodAddWithoutExpiresAndKeyNotExists
     */
    public function testMethodAddWithoutExpiresAndKeyExistsShouldFail(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->add($key, $value)
        );
    }

    public function dp_for_MethodAddWithExpires() {

        return [
            ["AddWithExpires/a", 1, 2],
            ["AddWithExpires/b", 1.3, 2],
            ["AddWithExpires/c", 'hello', 3],
            ["AddWithExpires/d", ['test' => 33], 4],
            ["AddWithExpires/e", false, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testMethodAddWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->add($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->get($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->get($key)
        );
    }
}

/**
 * Trait TDriver_MethodAddInt
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodAddInt {

    public function dp_for_MethodAddIntWithoutExpires() {

        return [
            ["AddIntWithoutExpires/a", 1],
            ["AddIntWithoutExpires/b", 3123131321],
            ["AddIntWithoutExpires/c", 4213],
            ["AddIntWithoutExpires/d", 44123],
            ["AddIntWithoutExpires/e", 44444]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddIntWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testMethodAddIntWithoutExpiresAndKeyNotExists(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addInt($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );
    }

    /**
     * @dataProvider dp_for_MethodAddIntWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodAddIntWithoutExpiresAndKeyNotExists
     */
    public function testMethodAddIntWithoutExpiresAndKeyExistsShouldFail(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->add($key, $value)
        );
    }

    public function dp_for_MethodAddIntWithExpires() {

        return [
            ["AddIntWithExpires/a", 1, 2],
            ["AddIntWithExpires/b", 2, 2],
            ["AddIntWithExpires/c", 3, 3],
            ["AddIntWithExpires/d", 41232131, 4],
            ["AddIntWithExpires/e", 3123131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddIntWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testMethodAddIntWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addInt($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getInt($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getInt($key)
        );
    }
}

/**
 * Trait TDriver_MethodAddFloat
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodAddFloat {

    public function dp_for_MethodAddFloatWithoutExpires() {

        return [
            ["AddFloatWithoutExpires/a", 1.21313],
            ["AddFloatWithoutExpires/b", 312313.1321],
            ["AddFloatWithoutExpires/c", 42.13],
            ["AddFloatWithoutExpires/d", 441.23],
            ["AddFloatWithoutExpires/e", 4444.4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddFloatWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testMethodAddFloatWithoutExpiresAndKeyNotExists(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addFloat($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );
    }

    /**
     * @dataProvider dp_for_MethodAddFloatWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodAddFloatWithoutExpiresAndKeyNotExists
     */
    public function testMethodAddFloatWithoutExpiresAndKeyExistsShouldFail(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->addFloat($key, $value)
        );
    }

    public function dp_for_MethodAddFloatWithExpires() {

        return [
            ["AddFloatWithExpires/a", 1.3, 2],
            ["AddFloatWithExpires/b", 2.5, 2],
            ["AddFloatWithExpires/c", 3.2131, 3],
            ["AddFloatWithExpires/d", 4131.5, 4],
            ["AddFloatWithExpires/e", 312.3131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddFloatWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testMethodAddFloatWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addFloat($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getFloat($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getFloat($key)
        );
    }
}

/**
 * Trait TDriver_MethodAddString
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_MethodAddString {

    public function dp_for_MethodAddStringWithoutExpires() {

        return [
            ["AddStringWithoutExpires/a", '1.21313'],
            ["AddStringWithoutExpires/b", '312313.1321'],
            ["AddStringWithoutExpires/c", '42.13'],
            ["AddStringWithoutExpires/d", '441.23'],
            ["AddStringWithoutExpires/e", '']
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddStringWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testMethodAddStringWithoutExpiresAndKeyNotExists(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addString($key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->getString($key)
        );
    }

    /**
     * @dataProvider dp_for_MethodAddStringWithoutExpires
     * @param string $key
     * @param $value
     * @depends testMethodAddStringWithoutExpiresAndKeyNotExists
     */
    public function testMethodAddStringWithoutExpiresAndKeyExistsShouldFail(string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->addString($key, $value)
        );
    }

    public function dp_for_MethodAddStringWithExpires() {

        return [
            ["AddStringWithExpires/a", '1.3', 2],
            ["AddStringWithExpires/b", '2.5', 2],
            ["AddStringWithExpires/c", '3.2131', 3],
            ["AddStringWithExpires/d", '4131.5', 4],
            ["AddStringWithExpires/e", '', 4]
        ];
    }

    /**
     * @dataProvider dp_for_MethodAddStringWithExpires
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testMethodAddStringWithExpires(string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->addString($key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->getString($key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->getString($key)
        );
    }
}
