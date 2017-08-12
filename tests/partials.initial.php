<?php

declare (strict_types = 1);

namespace Test\Caphe;

use \Caphe\IClient;

/**
 * Trait TDriver_CleanUp
 * @package Test\Caphe
 * @method IClient __getClient();
 */
trait TDriver_CleanUp {

    /**
     * @beforeClass
     */
    public function flushCacheBeforeStart() {

        $connection = $this->__getClient();

        $this->assertEquals(
            true,
            $connection->removeAll()
        );
    }
}
