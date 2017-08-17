<?php
/**
 * File: IReader.php
 * Created Date: 2017年6月1日 上午10:51:28
 */
declare (strict_types = 1);

namespace Caphe;

interface IReader extends IBaseClient
{
    /**
     * Get an item as an integer value, from cache.
     *
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function getInt(string $key, $default = null);

    /**
     * Get an item as a float value, from cache.
     *
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function getFloat(string $key, $default = null);

    /**
     * Get an item as a string value, from cache.
     *
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function getString(string $key, $default = null);

    /**
     * Get an item as a PHP value, from cache.
     *
     * It means that the value is serialized by PHP before being stored
     * into cache. Thus it will be unserialized into a PHP value.
     *
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function get(string $key, $default = null);

    /**
     * To check if an item exists in cache.
     *
     * @param string $key       The key of item to get
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * Get values of multi-items into an array of PHP value, from cache.
     *
     * This is the multi-get edition of method get.
     *
     * @param array $keys       The keys of items to get
     * @param mixed $default    The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function getMulti(array $keys, $default = null): array;

    /**
     * Get values of multi-string-items into an array of PHP value, from
     * cache.
     *
     * This is the multi-get edition of method get.
     *
     * @param array $keys       The keys of items to get
     * @param string $default   The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function getMultiString(
        array $keys,
        string $default = null
    ): array;

    /**
     * Get values of multi-integer-items into an array of PHP value, from
     * cache.
     *
     * This is the multi-get edition of method get.
     *
     * @param array $keys       The keys of items to get
     * @param int $default      The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function getMultiInt(array $keys, int $default = null): array;

    /**
     * Get values of multi-float-items into an array of PHP value, from cache.
     *
     * This is the multi-get edition of method get.
     *
     * @param array $keys       The keys of items to get
     * @param float $default    The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function getMultiFloat(array $keys, float $default = null): array;

    /**
     * Get an item as an integer value, from a cache namespace.
     * 
     * @param string $ns        The namespace of item
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function nsGetInt(string $ns, string $key, $default = null);

    /**
     * Get an item as a float value, from a cache namespace.
     *
     * @param string $ns        The namespace of item
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function nsGetFloat(string $ns, string $key, $default = null);

    /**
     * Get an item as a string value, from a cache namespace.
     *
     * @param string $ns        The namespace of item
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function nsGetString(string $ns, string $key, $default = null);

    /**
     * Get an item as a PHP value, from a cache namespace.
     *
     * It means that the value is serialized by PHP before being stored
     * into cache. Thus it will be unserialized into a PHP value.
     *
     * @param string $ns        The namespace of item
     * @param string $key       The key of item to get
     * @param mixed $default    The default value if item not found
     */
    public function nsGet(string $ns, string $key, $default = null);

    /**
     * To check if an item exists in a cache namespace.
     *
     * @param string $ns        The namespace of item
     * @param string $key       The key of item to get
     * @return bool
     */
    public function nsExists(string $ns, string $key): bool;

    /**
     * Get values of multi-items into an array of PHP value, from a cache
     * namespace.
     *
     * This is the multi-get edition of method nsGet.
     *
     * @param string $ns        The namespace of item
     * @param array $keys       The keys of items to get
     * @param mixed $default    The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function nsGetMulti(
        string $ns,
        array $keys,
        $default = null
    ): array;

    /**
     * Get values of multi-string-items into an array of PHP value, from a
     * cache namespace.
     *
     * This is the multi-get edition of method get.
     *
     * @param string $ns        The namespace of item
     * @param array $keys       The keys of items to get
     * @param string $default   The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function nsGetMultiString(
        string $ns,
        array $keys,
        string $default = null
    ): array;

    /**
     * Get values of multi-integer-items into an array of PHP value, from a
     * cache namespace.
     *
     * This is the multi-get edition of method get.
     *
     * @param string $ns        The namespace of item
     * @param array $keys       The keys of items to get
     * @param int $default      The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function nsGetMultiInt(
        string $ns,
        array $keys,
        int $default = null
    ): array;

    /**
     * Get values of multi-float-items into an array of PHP value, from a
     * cache namespace.
     *
     * This is the multi-get edition of method get.
     *
     * @param string $ns        The namespace of item
     * @param array $keys       The keys of items to get
     * @param float $default    The default value of every item if any an
     *                          item not found
     * @return array
     */
    public function nsGetMultiFloat(
        string $ns,
        array $keys,
        float $default = null
    ): array;

}
