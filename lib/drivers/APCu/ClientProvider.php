<?php
/**
 * File: ClientProvider.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

use \Caphe\Exception,
    \Caphe\IClient,
    \Caphe\IReader,
    \Caphe\IWriter,
    \Caphe\IClientProvider;

class ClientProvider implements IClientProvider
{
    public static function createClient(array $config): IClient
    {
        if ($config['forceCLI'] ?? false) {

            self::__fixTimeForCLI(true);
        }
        else {

            self::__fixTimeForCLI();
        }

        return new Client(null, null);
    }

    public static function createReadOnlyClient(array $config): IReader
    {
        if ($config['forceCLI'] ?? false) {

            self::__fixTimeForCLI(true);
        }
        else {

            self::__fixTimeForCLI();
        }

        return new Reader(null, null);
    }

    public static function createWriteOnlyClient(array $config): IWriter
    {
        if ($config['forceCLI'] ?? false) {

            self::__fixTimeForCLI(true);
        }
        else {

            self::__fixTimeForCLI();
        }

        return new Writer(null, null);
    }

    public static function wrapClient($conn): IClient
    {
        self::__fixTimeForCLI();
        return new Client(null, null);
    }

    public static function wrapReadOnlyClient($conn): IReader
    {
        self::__fixTimeForCLI();
        return new Reader(null, null);
    }

    public static function wrapWriteOnlyClient($conn): IWriter
    {
        self::__fixTimeForCLI();
        return new Writer(null, null);
    }

    protected static function __fixTimeForCLI(bool $force = false)
    {
        if (!isset($_POST) || $force) {

            ini_set(
                'apc.use_request_time',
                '0'
            );
        }
    }
}
