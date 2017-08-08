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
     * But only method getString can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the new item
     * @param string $val       The value of the new item.
     * @param int|null $ttl     The TTL of the new item
     *
     * @return bool
     *   Return true if the new item is created, or return false if the item
     *   already exists.
     */
    public function addString(string $key, string $val, int $ttl = null): bool;

    /**
     * To create a new item as an integer.
     *
     * The value must be integer so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getInt can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the new item
     * @param int $val          The value of the new item.
     * @param int|null $ttl     The TTL of the new item
     *
     * @return bool
     *   Return true if the new item is created, or return false if the item
     *   already exists.
     */
    public function addInt(string $key, int $val, int $ttl = null): bool;

    /**
     * To create a new item as an float value.
     *
     * The value must be float so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getFloat can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the new item
     * @param float $val        The value of the new item.
     * @param int|null $ttl     The TTL of the new item
     *
     * @return bool
     *   Return true if the new item is created, or return false if the item
     *   already exists.
     */
    public function addFloat(string $key, float $val, int $ttl = null): bool;

    /**
     * To set the value of an item.
     *
     * The value of item will be serialized by PHP, before being stored
     * into cache.
     *
     * Thus only methods get and getMulti can read this item properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the target item
     * @param mixed $val        The value of the target item.
     * @param int|null $ttl     The TTL of the target item
     *
     * @return bool
     *   Return true if the value of item is written successfully, or return
     *   false.
     */
    public function set(string $key, $val, int $ttl = null): bool;

    /**
     * To set the value of an item as a raw string.
     *
     * The value must be string so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getString can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the target item
     * @param string $val       The value of the target item.
     * @param int|null $ttl     The TTL of the target item
     *
     * @return bool
     *   Return true if the value of item is written successfully, or return
     *   false.
     */
    public function setString(string $key, string $val, int $ttl = null): bool;

    /**
     * To set the value of an item as an integer.
     *
     * The value must be integer so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getInt can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the target item
     * @param int $val          The value of the target item.
     * @param int|null $ttl     The TTL of the target item
     *
     * @return bool
     *   Return true if the value of item is written successfully, or return
     *   false.
     */
    public function setInt(string $key, int $val, int $ttl = null): bool;

    /**
     * To set the value of an item as an float value.
     *
     * The value must be float so it will be written into cache directly,
     * without being serialized.
     *
     * But only method getFloat can read it properly.
     *
     * When the argument $ttl is set, the ttl of item will be set.
     *
     * @param string $key       The key of the target item
     * @param float $val        The value of the target item.
     * @param int|null $ttl     The TTL of the target item
     *
     * @return bool
     *   Return true if the value of item is written successfully, or return
     *   false.
     */
    public function setFloat(string $key, float $val, int $ttl = null): bool;

    /**
     * Check and set an item as an integer.
     *
     * This method will check the item before setting it. Only if current
     * value matches the expected value, it will be changed into the new
     * value.
     *
     * NOTICE: This method can only work with an integer item.
     *
     * @param string $key   The key of the target item
     * @param int $current  The current value of the target item.
     * @param int $new      The new value of the target item.
     *
     * @return bool
     *   Return true if the new value of item is written successfully, or
     *   return false.
     */
    public function cas(string $key, int $current, int $new): bool;

    /**
     * Increase an item by specific steps.
     *
     * The item to be increased must be created by methods such as addInt,
     * setInt, addFloat and setFloat, because only numeric item can be
     * increased.
     *
     * @param string $key   The key of the target item
     * @param int $step     How much to increase.
     *
     * @throws \Caphe\Exception  Only if connection is dead.
     *
     * @return int
     *  Return the new value of the item after increased.
     */
    public function increase(string $key, int $step = 1): int;

    /**
     * Decrease an item by specific steps.
     *
     * The item to be decreased must be created by methods such as addInt,
     * setInt, addFloat and setFloat, because only numeric item can be
     * decreased.
     *
     * @param string $key   The key of the target item
     * @param int $step     How much to decrease.
     *
     * @throws \Caphe\Exception  Only if connection is dead.
     *
     * @return int
     *  Return the new value of the item after decreased.
     */
    public function decrease(string $key, int $step = 1): int;

    /**
     * Remove an item specified by key.
     *
     * @param string $key   The key of the target item
     *
     * @return bool
     *  Return true if the item is deleted.
     */
    public function remove(string $key): bool;

    /**
     * Remove multi-items specified by keys.
     *
     * @param string[] $key The key of the target items
     *
     * @throws \Caphe\Exception  Only if connection is dead.
     *
     * @return int
     *  Return the number items deleted.
     */
    public function removeMulti(array $key): int;

    /**
     * Remove multi-items specified by keys.
     *
     * @throws \Caphe\Exception  Only if connection is dead.
     *
     * @return bool
     *  This method always returns true.
     */
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
