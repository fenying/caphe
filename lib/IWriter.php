<?php
/**
 * File: IWriter.php
 * Created Date: 2017年6月1日 上午10:52:15
 */
declare (strict_types = 1);

namespace Caphe;

interface IWriter extends IBaseClient
{
    /**
     * To create a new item.
     *
     * The value of item will be serialized by PHP, before being stored
     * into cache.
     *
     * Thus only methods get and getMulti can read this item properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the new item
     * @param mixed $val        The value of the new item.
     * @param int|null $ttl     The TTL of the new item
     *
     * @return bool
     *   Return true if the new item is created, or return false if the item
     *   already exists.
     */
    public function add(string $key, $val, int $ttl = null): bool;

    /**
     * To create a new item as a raw string.
     *
     * The value must be string so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getString can. read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the new item
     * @param mixed $val        The value of the new item.
     * @param int|null $ttl     The TTL of the new item
     *
     * @return bool
     *   Return true if the new item is created, or return false if the item
     *   already exists.
     */
    public function addString(string $key, string $val, int $ttl = null): bool;

    public function addInt(string $key, int $val, int $ttl = null): bool;

    public function addFloat(string $key, float $val, int $ttl = null): bool;

    public function set(string $key, $val, int $ttl = null): bool;

    public function setString(string $key, string $val, int $ttl = null): bool;

    public function setInt(string $key, int $val, int $ttl = null): bool;

    public function setFloat(string $key, float $val, int $ttl = null): bool;

    public function cas(string $key, int $current, int $new): bool;

    public function increase(string $key, int $step = 1): int;

    public function decrease(string $key, int $step = 1): int;

    public function remove(string $key): bool;

    public function removeMulti(array $key): int;

    public function removeAll(): bool;

    public function nsAdd(string $ns, string $key, $val, int $ttl = null): bool;

    public function nsAddString(string $ns, string $key, string $val, int $ttl = null): bool;

    public function nsAddInt(string $ns, string $key, int $val, int $ttl = null): bool;

    public function nsAddFloat(string $ns, string $key, float $val, int $ttl = null): bool;

    public function nsSet(string $ns, string $key, $val, int $ttl = null): bool;

    public function nsSetString(string $ns, string $key, string $val, int $ttl = null): bool;

    public function nsSetInt(string $ns, string $key, int $val, int $ttl = null): bool;

    public function nsSetFloat(string $ns, string $key, float $val, int $ttl = null): bool;

    public function nsCAS(string $ns, string $key, int $current, int $new): bool;

    public function nsIncrease(string $ns, string $key, int $step = 1): int;

    public function nsDecrease(string $ns, string $key, int $step = 1): int;

    public function nsRemove(string $ns, string $key): bool;

    public function nsRemoveMulti(string $ns, array $key): int;

    public function nsRemoveAll(string $ns): bool;
}
