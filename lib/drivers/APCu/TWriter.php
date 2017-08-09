<?php
/**
 * File: TWriter.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

use Caphe\Exception;

trait TWriter
{
    public function add(
        string $key,
        $val,
        int $ttl = 0
    ): bool
    {
        return apcu_add($key, $val, $ttl);
    }

    public function addString(
        string $key,
        string $val,
        int $ttl = 0
    ): bool
    {
        return apcu_add($key, $val, $ttl);
    }

    public function addInt(
        string $key,
        int $val,
        int $ttl = 0
    ): bool
    {
        return apcu_add($key, $val, $ttl);
    }

    public function addFloat(
        string $key,
        float $val,
        int $ttl = 0
    ): bool
    {
        return apcu_add($key, $val, $ttl);
    }

    public function set(
        string $key,
        $val,
        int $ttl = 0
    ): bool
    {
        return apcu_store($key, $val, $ttl);
    }

    public function setString(
        string $key,
        string $val,
        int $ttl = 0
    ): bool
    {
        return apcu_store($key, $val, $ttl);
    }

    public function setInt(
        string $key,
        int $val,
        int $ttl = 0
    ): bool
    {
        return apcu_store($key, $val, $ttl);
    }

    public function setFloat(
        string $key,
        float $val,
        int $ttl = 0
    ): bool
    {
        return apcu_store($key, $val, $ttl);
    }

    public function cas(
        string $key,
        int $current,
        int $new
    ): bool
    {
        return apcu_cas($key, $current, $new);
    }

    public function increase(string $key, int $step = 1): int
    {
        $ret = apcu_inc($key, $step, $success);
        return $success ? $ret : 0;
    }

    public function decrease(string $key, int $step = 1): int
    {
        $ret = apcu_dec($key, $step, $success);
        return $success ? $ret : 0;
    }

    public function remove(string $key): bool
    {
        return apcu_delete($key);
    }

    public function removeMulti(array $keys): int
    {
        return count($keys) - count(apcu_delete($keys));
    }

    public function removeAll(): bool
    {
        return apcu_clear_cache();
    }
}
