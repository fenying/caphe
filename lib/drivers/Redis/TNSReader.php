<?php
/**
 * File: TReader.php
 * Created Date: 2017年6月1日 上午10:58:34
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

trait TNSReader
{
    public function nsGet(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = $this->_readConn->get("{$lock}/{$key}");

        if (is_string($ret)) {

            return unserialize($ret);
        }

        return $default;
    }

    public function nsGetFloat(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = $this->_readConn->get("{$lock}/{$key}");

        if (is_string($ret)) {

            return (float)$ret;
        }

        return $default;
    }

    public function nsGetInt(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = $this->_readConn->get("{$lock}/{$key}");

        if (is_string($ret)) {

            return (int)$ret;
        }

        return $default;
    }

    public function nsGetString(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = $this->_readConn->get("{$lock}/{$key}");

        if (is_string($ret)) {

            return $ret;
        }

        return $default;
    }

    public function nsExists(string $ns, string $key): bool
    {
        $lock = $this->_nsGetNSLock($ns);

        return $this->_readConn->exists("{$lock}/{$key}");
    }

    public function nsGetMulti(
        string $ns,
        array $keys,
        $default = null
    ): array
    {
        $lock = $this->_nsGetNSLock($ns);

        $keyMaps = [];

        foreach ($keys as $key) {

            $keyMaps[] = "{$lock}/{$key}";
        }

        $result = $this->_readConn->mGet($keyMaps);

        unset($keyMaps);

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

    public function nsGetMultiString(
        string $ns,
        array $keys,
        string $default = null
    ): array
    {
        $lock = $this->_nsGetNSLock($ns);

        $keyMaps = [];

        foreach ($keys as $key) {

            $keyMaps[] = "{$lock}/{$key}";
        }

        $result = $this->_readConn->mGet($keyMaps);

        unset($keyMaps);

        $ret = [];

        if (is_array($result)) {

            foreach ($result as $index => $val) {

                $ret[$keys[$index]] = ($val === false) ?
                    $default : (string)$val;
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

    public function nsGetMultiInt(
        string $ns,
        array $keys,
        int $default = null
    ): array
    {
        $lock = $this->_nsGetNSLock($ns);

        $keyMaps = [];

        foreach ($keys as $key) {

            $keyMaps[] = "{$lock}/{$key}";
        }

        $result = $this->_readConn->mGet($keyMaps);

        unset($keyMaps);

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

    public function nsGetMultiFloat(
        string $ns,
        array $keys,
        float $default = null
    ): array
    {
        $lock = $this->_nsGetNSLock($ns);

        $keyMaps = [];

        foreach ($keys as $key) {

            $keyMaps[] = "{$lock}/{$key}";
        }

        $result = $this->_readConn->mGet($keyMaps);

        unset($keyMaps);

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
