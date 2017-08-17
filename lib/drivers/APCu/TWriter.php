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
        int $ttl = null
    ): bool
    {
        return apcu_add($key, $val, $ttl ?? 0);
    }

    public function addString(
        string $key,
        string $val,
        int $ttl = null
    ): bool
    {
        return apcu_add($key, $val, $ttl ?? 0);
    }

    public function addInt(
        string $key,
        int $val,
        int $ttl = null
    ): bool
    {
        return apcu_add($key, $val, $ttl ?? 0);
    }

    public function addFloat(
        string $key,
        float $val,
        int $ttl = null
    ): bool
    {
        return apcu_add($key, $val, $ttl ?? 0);
    }

    public function setMulti(
        array $items,
        int $ttl = null
    ): bool
    {
        return count(apcu_store($items, null, $ttl ?? 0)) === 0;
    }

    public function setMultiString(
        array $items,
        int $ttl = null
    ): bool
    {
        return count(apcu_store($items, null, $ttl ?? 0)) === 0;
    }

    public function setMultiFloat(
        array $items,
        int $ttl = null
    ): bool
    {
        return count(apcu_store($items, null, $ttl ?? 0)) === 0;
    }

    public function setMultiInt(
        array $items,
        int $ttl = null
    ): bool
    {
        return count(apcu_store($items, null, $ttl ?? 0)) === 0;
    }

    public function set(
        string $key,
        $val,
        int $ttl = null
    ): bool
    {
        return apcu_store($key, $val, $ttl ?? 0);
    }

    public function setString(
        string $key,
        string $val,
        int $ttl = null
    ): bool
    {
        return apcu_store($key, $val, $ttl ?? 0);
    }

    public function setInt(
        string $key,
        int $val,
        int $ttl = null
    ): bool
    {
        return apcu_store($key, $val, $ttl ?? 0);
    }

    public function setFloat(
        string $key,
        float $val,
        int $ttl = null
    ): bool
    {
        return apcu_store($key, $val, $ttl ?? 0);
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
