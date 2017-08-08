<?php
/**
 * File: ClientProvider.php
 * Created Date: 2017年8月2日 下午4:04:07
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

const SHA_CAS = 'f6660fca77144f5392de0008ca1bb1f67b22e5d1';

use \Caphe\Exception,
    \Caphe\IClient,
    \Caphe\IReader,
    \Caphe\IWriter,
    \Caphe\IClientProvider;

class ClientProvider implements IClientProvider
{
    /**
     * The connections pool.
     * @var \Redis[]
     */
    protected static $_conn_pool = [];

    public static function createClient(array $config): IClient
    {
        if ($config['server'] ?? false) {

            $conn = self::_pickConnection($config['server']);
            return new Client($conn, $conn);
        }
        elseif (isset($config['reader'], $config['writer'])) {
            
            $readConn = self::_pickConnection($config['reader']);
            $writeConn = self::_pickConnection($config['writer']);
            return new Client($readConn, $writeConn);
        }

        throw new Exception(<<<ERROR
Unrecognizable configuration for connecting.
ERROR

        , Exception::E_INVALID_CONFIG
        );
    }

    public static function createReadOnlyClient(array $config): IReader
    {
        $conn = self::_pickConnection($config);

        return new Reader($conn, null);
    }

    public static function createWriteOnlyClient(array $config): IWriter
    {
        $conn = self::_pickConnection($config);

        return new Writer(null, $conn);
    }

    public static function wrapClient($conn): IClient
    {
        return new Client($conn, $conn);
    }

    public static function wrapReadOnlyClient($conn): IReader
    {
        return new Reader($conn, null);
    }

    public static function wrapWriteOnlyClient($conn): IWriter
    {
        return new Writer(null, $conn);
    }

    protected static function _pickConnection(array &$config, bool $readOnly = false)
    {
        $serverName = "{$config['host']}:{$config['port']}";
        $ret = self::$_conn_pool[$serverName] ?? null;

        if ($ret) {

            self::_initConnection($ret);
            return $ret;
        }

        $ret = new \Redis();

        if ($config['persist'] ?? false) {

            $result = $ret->pconnect($config['host'], $config['port']);
        }
        else {

            $result = $ret->connect($config['host'], $config['port']);
        }

        if (!$result) {

            throw new Exception(
                'Failed to connect to Redis server.',
                Exception::E_CONNECT_FAILURE
            );
        }

        if ($config['password'] ?? false) {

            if (!$ret->auth($config['password'])) {

                throw new Exception(
                    'Invalid password for Redis.',
                    Exception::E_AUTH_FAILURE
                );
            }
        }

        if ($config['database'] ?? false) {

            if (!$ret->select($config['database'])) {

                throw new Exception(
                    'Failed to select database of Redis.',
                    Exception::E_INIT_FAILURE
                );
            }
        }

        self::_initConnection($ret);
        self::$_conn_pool[$serverName] = $ret;

        return $ret;
    }

    /**
     * To initialize a connection with CAS supports.
     *
     * @param \Redis $conn
     * @throws Exception
     */
    protected static function _initConnection(\Redis $conn)
    {
        if ($conn->script('EXISTS', SHA_CAS)[0]) {

            return;
        }

        $newSHA = $conn->script('load', <<<'LUA_REDIS_CAS'
local val = redis.call('get', KEYS[1])

if val == ARGV[1] then
    return redis.call('set', KEYS[1], ARGV[2])
end

return 0
LUA_REDIS_CAS
);

        if ($newSHA !== SHA_CAS) {

            throw new Exception(<<<ERROR
Failed to register CAS lua script 'cause the SHA-1 changed into {$newSHA}.
ERROR
            , Exception::E_INIT_FAILURE);
        }
    }
}
