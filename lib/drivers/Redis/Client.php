<?php
/**
 * File: Client.php
 * Created Date: 2017年8月2日 下午4:07:06
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

class Client extends IBaseClient implements \Caphe\IClient
{
    use TReader;
    use TNSReader;
    use TWriter;
    use TNSWriter;

    /**
     * Get the writer from current connection.
     * @return \Caphe\IReader
     */
    public function getReader()
    {
        return ClientProvider::wrapReadOnlyClient($this->_readConn);
    }

    /**
     * Get the writer from current connection.
     * @return \Caphe\IWriter
     */
    public function getWriter()
    {
        return ClientProvider::wrapWriteOnlyClient($this->_writeConn);
    }
}
