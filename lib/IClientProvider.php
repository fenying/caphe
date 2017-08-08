<?php
/**
 * File: IClientProvider.php
 * Created Date: 2017年8月2日 下午3:51:13
 */
declare (strict_types = 1);

namespace Caphe;

interface IClientProvider
{
    /**
     * Connect to a cache server and return a fully functional client.
     * @param array $config
     * @return \Caphe\IClient
     */
    public static function createClient(array $config): IClient;

    /**
     * Connect to a cache server and return a read-only client.
     * @param array $config
     * @return \Caphe\IReader
     */
    public static function createReadOnlyClient(array $config): IReader;

    /**
     * Connect to a cache server and return a write-only client.
     * @param array $config
     * @return \Caphe\IWriter
     */
    public static function createWriteOnlyClient(array $config): IWriter;

    /**
     * Wrap a connected native connection object and return a fully functional
     * client.
     * @param object $conn
     * @return \Caphe\IClient
     */
    public static function wrapClient($conn): IClient;

    /**
     * Wrap a connected native connection object and return a read-only
     * client.
     * @param object $conn
     * @return \Caphe\IReader
     */
    public static function wrapReadOnlyClient($conn): IReader;

    /**
     * Wrap a connected native connection object and return a write-only
     * client.
     * @param object $conn
     * @return \Caphe\IWriter
     */
    public static function wrapWriteOnlyClient($conn): IWriter;
}
