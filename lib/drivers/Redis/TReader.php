<?php
/**
 * File: TReader.php
 * Created Date: 2017年6月1日 上午10:58:34
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

trait TReader
{
    public function get(string $key, $default = null)
    {
        $ret = $this->_readConn->get($key);

        if (is_string($ret)) {

            return unserialize($ret);
        }

        return $default;
    }

    public function getFloat(string $key, $default = null)
    {
        $ret = $this->_readConn->get($key);

        if (is_string($ret)) {

            return (float)$ret;
        }

        return $default;
    }

    public function getInt(string $key, $default = null)
    {
        $ret = $this->_readConn->get($key);

        if (is_string($ret)) {

            return (int)$ret;
        }

        return $default;
    }

    public function getString(string $key, $default = null)
    {
        $ret = $this->_readConn->get($key);

        if (is_string($ret)) {

            return $ret;
        }

        return $default;
    }

    public function exists(string $key): bool
    {
        return $this->_readConn->exists($key);
    }

    public function getMulti(array $keys, $default = null): array
    {
        $result = $this->_readConn->mGet($keys);

        $ret = [];

        if (is_array($result)) {

            foreach ($result as $index => $val) {

                $ret[$keys[$index]] = ($val === false) ?
                    $default : unserialize($val);
            }
        }
        else {

            $this->_assertConnected();

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiString(array $keys, string $default = null): array
    {
        $result = $this->_readConn->mGet($keys);

        $ret = [];

        if (is_array($result)) {

            foreach ($result as $index => $val) {

                $ret[$keys[$index]] = ($val === false) ?
                    $default : $val;
            }
        }
        else {

            $this->_assertConnected();

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiInt(array $keys, int $default = null): array
    {
        $result = $this->_readConn->mGet($keys);

        $ret = [];

        if (is_array($result)) {

            foreach ($result as $index => $val) {

                $ret[$keys[$index]] = ($val === false) ?
                    $default : (int)$val;
            }
        }
        else {

            $this->_assertConnected();

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiFloat(array $keys, float $default = null): array
    {
        $result = $this->_readConn->mGet($keys);

        $ret = [];

        if (is_array($result)) {

            foreach ($result as $index => $val) {

                $ret[$keys[$index]] = ($val === false) ?
                    $default : (float)$val;
            }
        }
        else {

            $this->_assertConnected();

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }
}
