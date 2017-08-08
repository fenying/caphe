<?php
/**
 * File: IBaseClient.php
 * Created Date: 2017年8月2日 下午4:42:08
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

use \Caphe\Exception;

abstract class IBaseClient implements \Caphe\IBaseClient
{
    /**
     * The readable connection to Redis server.
     * @var \Redis
     */
    protected $_readConn;

    /**
     * The writable connection to Redis server.
     * @var \Redis
     */
    protected $_writeConn;

    protected $_nsLocks;

    /**
     * Get the lock for a namespace.
     *
     * @param string $ns Namespace of items
     * @return string
     * @throws Exception
     */
    protected function _nsGetNSLock(string $ns): string
    {
        if ($this->_nsLocks[$ns] ?? false) {

            return $this->_nsLocks[$ns];
        }

        $lockKey = "__ns_lock/{$ns}";

        $this->_writeConn->pipeline();
        $this->_writeConn->setnx(
            $lockKey,
            $ns . '/' . time() . microtime(true)
        );
        $this->_writeConn->get($lockKey);
        $result = $this->_writeConn->exec();

        if ($result === false) {

            throw new Exception(
                'Failed to fetch namespace lock due to an unknown error.',
                Exception::E_PROTOCOL_FAILURE
            );
        }

        return $this->_nsLocks[$ns] = $result[1];
    }

    /**
     * Remove the lock of a namespace to force flushing it.
     *
     * @param string $ns Namespace of items
     * @return bool
     */
    protected function _nsRemoveLock(string $ns): bool
    {
        unset($this->_nsLocks[$ns]);
        return $this->_writeConn->delete("__ns_lock/{$ns}") ? true : false;
    }

    public function __construct($readConn, $writeConn)
    {
        $this->_readConn = $readConn;
        $this->_writeConn = $writeConn;
        $this->_nsLocks = [];
    }

    public function isConnected(): bool
    {
        if ($this->_readConn === null && $this->_writeConn === null) {

            return false;
        }

        $connected = false;

        if ($this->_readConn) {

            $connected = $this->_readConn->ping() === 'PONG';
        }

        if ($this->_writeConn) {

            $connected = $this->_writeConn->ping() === 'PONG';
        }

        return $connected;
    }

    /**
     * Assert if connection to Redis server is available.
     *
     * Throw an exception if connection is killed.
     */
    protected function _assertConnected()
    {
        if (!$this->isConnected()) {

            throw new Exception(

                'Lose connection to Redis server.',
                Exception::E_CONNECT_FAILURE
            );
        }
    }
}
