<?php
/**
 * File: IBaseClient.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

use \Caphe\Exception;

abstract class IBaseClient implements \Caphe\IBaseClient
{
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

        $lock = apcu_fetch($lockKey, $success);

        if ($success) {

            return $this->_nsLocks[$ns] = $lock;
        }

        $lock = $ns . '/' . time() . microtime(true);

        if (!apcu_add(
            $lockKey,
            $lock
        )) {

            $lockRead = apcu_fetch($lockKey, $success);

            if ($success) {

                return $this->_nsLocks[$ns] = $lockRead;
            }

            // Ignore error here.
        }

        return $this->_nsLocks[$ns] = $lock;
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
        return apcu_delete("__ns_lock/{$ns}");
    }

    public function __construct($readConn, $writeConn)
    {
        $this->_nsLocks = [];
    }

    public function isConnected(): bool
    {
        return function_exists(
            'apcu_fetch'
        );
    }
}
