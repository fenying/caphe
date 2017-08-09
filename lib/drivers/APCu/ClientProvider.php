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
        return new Client(null, null);
    }

    public static function createReadOnlyClient(array $config): IReader
    {
        return new Reader(null, null);
    }

    public static function createWriteOnlyClient(array $config): IWriter
    {
        return new Writer(null, null);
    }

    public static function wrapClient($conn): IClient
    {
        return new Client(null, null);
    }

    public static function wrapReadOnlyClient($conn): IReader
    {
        return new Reader(null, null);
    }

    public static function wrapWriteOnlyClient($conn): IWriter
    {
        return new Writer(null, null);
    }
}
