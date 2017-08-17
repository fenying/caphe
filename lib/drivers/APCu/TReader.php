<?php
/**
 * File: TReader.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

trait TReader
{
    public function get(string $key, $default = null)
    {
        $ret = apcu_fetch($key, $success);

        return $success ? $ret : $default;
    }

    public function getFloat(string $key, $default = null)
    {
        $ret = apcu_fetch($key, $success);

        return $success && is_numeric($ret) ? (float)$ret : $default;
    }

    public function getInt(string $key, $default = null)
    {
        $ret = apcu_fetch($key, $success);

        return $success && is_numeric($ret) ? (int)$ret : $default;
    }

    public function getString(string $key, $default = null)
    {
        $ret = apcu_fetch($key, $success);

        return $success ? (string)$ret : $default;
    }

    public function exists(string $key): bool
    {
        return apcu_exists($key);
    }

    public function getMulti(array $keys, $default = null): array
    {
        $result = apcu_fetch($keys, $success);

        if ($success) {

            $ret = [];

            foreach ($keys as $key) {

                $ret[$key] = $result[$key] ?? $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiString(array $keys, string $default = null): array
    {
        $result = apcu_fetch($keys, $success);

        if ($success) {

            $ret = [];

            foreach ($keys as $key) {

                $ret[$key] = isset($result[$key]) ? (string)$result[$key] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiFloat(array $keys, float $default = null): array
    {
        $result = apcu_fetch($keys, $success);

        if ($success) {

            $ret = [];

            foreach ($keys as $key) {

                $ret[$key] = isset($result[$key]) ? (float)$result[$key] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }

    public function getMultiInt(array $keys, int $default = null): array
    {
        $result = apcu_fetch($keys, $success);

        if ($success) {

            $ret = [];

            foreach ($keys as $key) {

                $ret[$key] = isset($result[$key]) ? (int)$result[$key] : $default;
            }
        }
        else {

            foreach ($keys as $key) {

                $ret[$key] = $default;
            }
        }

        return $ret;
    }
}
