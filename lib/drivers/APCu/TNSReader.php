<?php
/**
 * File: TReader.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

trait TNSReader
{
    public function nsGet(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = apcu_fetch("{$lock}/{$key}", $success);

        return $success ? $ret : $default;
    }

    public function nsGetFloat(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = apcu_fetch("{$lock}/{$key}", $success);

        return $success && is_numeric($ret) ? (float)$ret : $default;
    }

    public function nsGetInt(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = apcu_fetch("{$lock}/{$key}", $success);

        return $success && is_numeric($ret) ? (int)$ret : $default;
    }

    public function nsGetString(string $ns, string $key, $default = null)
    {
        $lock = $this->_nsGetNSLock($ns);

        $ret = apcu_fetch("{$lock}/{$key}", $success);

        return $success && is_string($ret) ? $ret : $default;
    }

    public function nsExists(string $ns, string $key): bool
    {
        $lock = $this->_nsGetNSLock($ns);

        return apcu_exists("{$lock}/{$key}");
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

            $keyMaps["{$lock}/{$key}"] = $key;
        }

        $result = apcu_fetch(array_keys($keyMaps), $success);

        if ($success) {

            $ret = [];

            foreach ($keyMaps as $nsKey => $key) {

                $ret[$key] = $result[$nsKey] ?? $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        unset($keyMaps);

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

            $keyMaps["{$lock}/{$key}"] = $key;
        }

        $result = apcu_fetch(array_keys($keyMaps), $success);

        if ($success) {

            $ret = [];

            foreach ($keyMaps as $nsKey => $key) {

                $ret[$key] = isset($result[$nsKey]) ? (string)$result[$nsKey] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        unset($keyMaps);

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

            $keyMaps["{$lock}/{$key}"] = $key;
        }

        $result = apcu_fetch(array_keys($keyMaps), $success);

        if ($success) {

            $ret = [];

            foreach ($keyMaps as $nsKey => $key) {

                $ret[$key] = isset($result[$nsKey]) ? (int)$result[$nsKey] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        unset($keyMaps);

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

            $keyMaps["{$lock}/{$key}"] = $key;
        }

        $result = apcu_fetch(array_keys($keyMaps), $success);

        if ($success) {

            $ret = [];

            foreach ($keyMaps as $nsKey => $key) {

                $ret[$key] = isset($result[$nsKey]) ? (float)$result[$nsKey] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        unset($keyMaps);

        return $ret;
    }
}
