<?php
/**
 * File: IBaseClient.php
 * Created Date: 2017年8月2日 下午3:59:01
 */
declare (strict_types = 1);

namespace Caphe;

interface IBaseClient {

    /**
     * The constructor of Client.
     * @param any $readConn
     *      The native readable connection to cache server.
     * @param any $writeConn
     *      The native writable connection to cache server.
     */
    public function __construct($readConn, $writeConn);

    /**
     * Check if client is connected to server.
     *
     * @return bool Return true if connected, or false if not.
     */
    public function isConnected(): bool;
}
