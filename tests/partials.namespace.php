<?php

declare (strict_types = 1);

namespace Test\Caphe;

use \Caphe\IClient;

/**
 * Trait TDriver_NamespaceMethodSet
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodSet {

    public function dp_for_NamespaceMethodSetWithoutExpires() {

        return [
            ["SetWithoutExpires", "a", 1],
            ["SetWithoutExpires", "b", 1.3],
            ["SetWithoutExpires", "c", 'hello'],
            ["SetWithoutExpires", "d", ['test' => 33]],
            ["SetWithoutExpires", "d", '123'],
            ["SetWithoutExpires", "e", false]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     */
    public function testNamespaceMethodSetWithoutExpires(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSet($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGet($ns, $key)
        );
    }

    public function dp_for_NamespaceMethodSetWithExpires() {

        return [
            ["SetWithExpires", "a", 1, 2],
            ["SetWithExpires", "b", 1.3, 2],
            ["SetWithExpires", "c", 'hello', 3],
            ["SetWithExpires", "d", ['test' => 33], 4],
            ["SetWithExpires", "d", '123', 3],
            ["SetWithExpires", "e", false, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testNamespaceMethodSetWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSet($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGet($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGet($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodSetInt
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodSetInt {

    public function dp_for_NamespaceMethodSetIntWithoutExpires() {

        return [
            ["SetIntWithoutExpires", "a", 1],
            ["SetIntWithoutExpires", "b", 3123131321],
            ["SetIntWithoutExpires", "c", 4213],
            ["SetIntWithoutExpires", "d", 44123],
            ["SetIntWithoutExpires", "d", 41233],
            ["SetIntWithoutExpires", "e", 44444]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetIntWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     */
    public function testNamespaceMethodSetIntWithoutExpires(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetInt($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetInt($ns, $key)
        );
    }

    public function dp_for_NamespaceMethodSetIntWithExpires() {

        return [
            ["SetIntWithExpires", "a", 1, 2],
            ["SetIntWithExpires", "b", 2, 2],
            ["SetIntWithExpires", "c", 3, 3],
            ["SetIntWithExpires", "d", 41232131, 4],
            ["SetIntWithExpires", "d", 53214124, 3],
            ["SetIntWithExpires", "e", 3123131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetIntWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testNamespaceMethodSetIntWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetInt($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetInt($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetInt($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodSetFloat
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodSetFloat {

    public function dp_for_NamespaceMethodSetFloatWithoutExpires() {

        return [
            ["SetFloatWithoutExpires", "a", 1.21313],
            ["SetFloatWithoutExpires", "b", 312313.1321],
            ["SetFloatWithoutExpires", "c", 42.13],
            ["SetFloatWithoutExpires", "d", 441.23],
            ["SetFloatWithoutExpires", "d", 41.233],
            ["SetFloatWithoutExpires", "e", 4444.4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetFloatWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     */
    public function testNamespaceMethodSetFloatWithoutExpires(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetFloat($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetFloat($ns, $key)
        );
    }

    public function dp_for_NamespaceMethodSetFloatWithExpires() {

        return [
            ["SetFloatWithExpires", "a", 1.3, 2],
            ["SetFloatWithExpires", "b", 2.5, 2],
            ["SetFloatWithExpires", "c", 3.2131, 3],
            ["SetFloatWithExpires", "d", 4131.5, 4],
            ["SetFloatWithExpires", "d", 5321.321, 3],
            ["SetFloatWithExpires", "e", 312.3131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetFloatWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testNamespaceMethodSetFloatWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetFloat($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetFloat($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetFloat($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodSetString
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodSetString {

    public function dp_for_NamespaceMethodSetStringWithoutExpires() {

        return [
            ["SetStringWithoutExpires", "a", '1.21313'],
            ["SetStringWithoutExpires", "b", '312313.1321'],
            ["SetStringWithoutExpires", "c", '42.13'],
            ["SetStringWithoutExpires", "d", '441.23'],
            ["SetStringWithoutExpires", "d", '41.233'],
            ["SetStringWithoutExpires", "e", '']
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetStringWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     */
    public function testNamespaceMethodSetStringWithoutExpires(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetString($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetString($ns, $key)
        );
    }

    public function dp_for_NamespaceMethodSetStringWithExpires() {

        return [
            ["SetStringWithExpires", "a", '1.3', 2],
            ["SetStringWithExpires", "b", '2.5', 2],
            ["SetStringWithExpires", "c", '3.2131', 3],
            ["SetStringWithExpires", "d", '4131.5', 4],
            ["SetStringWithExpires", "d", '5321.321', 3],
            ["SetStringWithExpires", "e", '', 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodSetStringWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     */
    public function testNamespaceMethodSetStringWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsSetString($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetString($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetString($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodAdd
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodAdd {

    public function dp_for_NamespaceMethodAddWithoutExpires() {

        return [
            ["AddWithoutExpires", "a", 1],
            ["AddWithoutExpires", "b", 1.3],
            ["AddWithoutExpires", "c", 'hello'],
            ["AddWithoutExpires", "d", ['test' => 33]],
            ["AddWithoutExpires", "e", false]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddWithoutExpiresAndKeyNotExists(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAdd($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGet($ns, $key)
        );
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testNamespaceMethodAddWithoutExpiresAndKeyNotExists
     */
    public function testNamespaceMethodAddWithoutExpiresAndKeyExistsShouldFail(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->nsAdd($ns, $key, $value)
        );
    }

    public function dp_for_NamespaceMethodAddWithExpires() {

        return [
            ["AddWithExpires", "a", 1, 2],
            ["AddWithExpires", "b", 1.3, 2],
            ["AddWithExpires", "c", 'hello', 3],
            ["AddWithExpires", "d", ['test' => 33], 4],
            ["AddWithExpires", "e", false, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAdd($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGet($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGet($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodAddInt
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodAddInt {

    public function dp_for_NamespaceMethodAddIntWithoutExpires() {

        return [
            ["AddIntWithoutExpires", "a", 1],
            ["AddIntWithoutExpires", "b", 3123131321],
            ["AddIntWithoutExpires", "c", 4213],
            ["AddIntWithoutExpires", "d", 44123],
            ["AddIntWithoutExpires", "e", 44444]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddIntWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddIntWithoutExpiresAndKeyNotExists(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddInt($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetInt($ns, $key)
        );
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddIntWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testNamespaceMethodAddIntWithoutExpiresAndKeyNotExists
     */
    public function testNamespaceMethodAddIntWithoutExpiresAndKeyExistsShouldFail(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->nsAdd($ns, $key, $value)
        );
    }

    public function dp_for_NamespaceMethodAddIntWithExpires() {

        return [
            ["AddIntWithExpires", "a", 1, 2],
            ["AddIntWithExpires", "b", 2, 2],
            ["AddIntWithExpires", "c", 3, 3],
            ["AddIntWithExpires", "d", 41232131, 4],
            ["AddIntWithExpires", "e", 3123131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddIntWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddIntWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddInt($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetInt($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetInt($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodAddFloat
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodAddFloat {

    public function dp_for_NamespaceMethodAddFloatWithoutExpires() {

        return [
            ["AddFloatWithoutExpires", "a", 1.21313],
            ["AddFloatWithoutExpires", "b", 312313.1321],
            ["AddFloatWithoutExpires", "c", 42.13],
            ["AddFloatWithoutExpires", "d", 441.23],
            ["AddFloatWithoutExpires", "e", 4444.4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddFloatWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddFloatWithoutExpiresAndKeyNotExists(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddFloat($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetFloat($ns, $key)
        );
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddFloatWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testNamespaceMethodAddFloatWithoutExpiresAndKeyNotExists
     */
    public function testNamespaceMethodAddFloatWithoutExpiresAndKeyExistsShouldFail(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->nsAddFloat($ns, $key, $value)
        );
    }

    public function dp_for_NamespaceMethodAddFloatWithExpires() {

        return [
            ["AddFloatWithExpires", "a", 1.3, 2],
            ["AddFloatWithExpires", "b", 2.5, 2],
            ["AddFloatWithExpires", "c", 3.2131, 3],
            ["AddFloatWithExpires", "d", 4131.5, 4],
            ["AddFloatWithExpires", "e", 312.3131, 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddFloatWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddFloatWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddFloat($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetFloat($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetFloat($ns, $key)
        );
    }
}

/**
 * Trait TDriver_NamespaceMethodAddString
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_NamespaceMethodAddString {

    public function dp_for_NamespaceMethodAddStringWithoutExpires() {

        return [
            ["AddStringWithoutExpires", "a", '1.21313'],
            ["AddStringWithoutExpires", "b", '312313.1321'],
            ["AddStringWithoutExpires", "c", '42.13'],
            ["AddStringWithoutExpires", "d", '441.23'],
            ["AddStringWithoutExpires", "e", '']
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddStringWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddStringWithoutExpiresAndKeyNotExists(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddString($ns, $key, $value)
        );

        $this->assertEquals(
            $value,
            $connection->nsGetString($ns, $key)
        );
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddStringWithoutExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @depends testNamespaceMethodAddStringWithoutExpiresAndKeyNotExists
     */
    public function testNamespaceMethodAddStringWithoutExpiresAndKeyExistsShouldFail(string $ns, string $key, $value) {

        $connection = $this->__getClient();

        $this->assertEquals(
            false,
            $connection->nsAddString($ns, $key, $value)
        );
    }

    public function dp_for_NamespaceMethodAddStringWithExpires() {

        return [
            ["AddStringWithExpires", "a", '1.3', 2],
            ["AddStringWithExpires", "b", '2.5', 2],
            ["AddStringWithExpires", "c", '3.2131', 3],
            ["AddStringWithExpires", "d", '4131.5', 4],
            ["AddStringWithExpires", "e", '', 4]
        ];
    }

    /**
     * @dataProvider dp_for_NamespaceMethodAddStringWithExpires
     * @param string $ns
     * @param string $key
     * @param $value
     * @param int $expires
     * @depends testMethodRemoveAll
     */
    public function testNamespaceMethodAddStringWithExpires(string $ns, string $key, $value, int $expires) {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->nsAddString($ns, $key, $value, $expires)
        );

        usleep(intval($expires * 500000));

        $this->assertEquals(
            $value,
            $connection->nsGetString($ns, $key)
        );

        usleep(intval($expires * 500000) + 1000000);

        $this->assertEquals(
            null,
            $connection->nsGetString($ns, $key)
        );
    }
}
