<?php
/**
 * File: TWriter.php
 * Created Date: 2017年6月1日 上午11:03:16
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

trait TNSWriter
{
    public function nsAdd(
        string $ns,
        string $key,
        $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->setnx($key, serialize($val))) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsAddString(
        string $ns,
        string $key,
        string $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->setnx($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsAddInt(
        string $ns,
        string $key,
        int $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->setnx($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsAddFloat(
        string $ns,
        string $key,
        float $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->setnx($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsSet(
        string $ns,
        string $key,
        $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->set($key, serialize($val))) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsSetString(
        string $ns,
        string $key,
        string $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->set($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsSetInt(
        string $ns,
        string $key,
        int $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->set($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsSetFloat(
        string $ns,
        string $key,
        float $val,
        int $ttl = null
    ): bool
    {
        $key = "{$this->_nsGetNSLock($ns)}/{$key}";

        if ($this->_writeConn->set($key, $val)) {

            if ($ttl > 0) {

                return $this->_writeConn->expire($key, $ttl);
            }
            else {

                return true;
            }
        }

        return false;
    }

    public function nsCAS(
        string $ns,
        string $key,
        int $current,
        int $new
    ): bool
    {
        return (bool)$this->_writeConn->evalsha(
            SHA_CAS,
            [
                "{$this->_nsGetNSLock($ns)}/{$key}",
                $current,
                $new
            ],
            1
        );
    }

    public function nsIncrease(
        string $ns,
        string $key,
        int $step = 1
    ): int
    {
        $ret = $this->_writeConn->incrBy(
            "{$this->_nsGetNSLock($ns)}/{$key}",
            $step
        );

        if ($ret === false) {

            $this->_assertConnected();

            return 0;
        }

        return $ret;
    }

    public function nsDecrease(
        string $ns,
        string $key,
        int $step = 1
    ): int
    {
        $ret = $this->_writeConn->decrBy(
            "{$this->_nsGetNSLock($ns)}/{$key}",
            $step
        );

        if ($ret === false) {

            $this->_assertConnected();

            return 0;
        }

        return $ret;
    }

    public function nsRemove(string $ns, string $key): bool
    {
        return $this->_writeConn->delete(
            "{$this->_nsGetNSLock($ns)}/{$key}"
        ) ? true : false;
    }

    public function nsRemoveMulti(string $ns, array $keys): int
    {
        $lockedPrefix = $this->_nsGetNSLock($ns);

        foreach ($keys as &$key) {

            $key = "{$lockedPrefix}/{$key}";
        }

        $ret = $this->_writeConn->delete($keys);

        if ($ret === false) {

            $this->_assertConnected();

            return 0;
        }

        return $ret;
    }

    public function nsRemoveAll(string $ns): bool
    {
        return $this->_nsRemoveLock($ns);
    }
}
