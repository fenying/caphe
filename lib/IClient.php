<?php
/**
 * File: IConnection.php
 * Created Date: 2017年6月1日 上午11:42:21
 */
declare (strict_types = 1);

namespace Caphe;

interface IClient extends IReader, IWriter {

    /**
     * Get the reader from current connection.
     * @return \Caphe\IReader
     */
    public function getReader();

    /**
     * Get the writer from current connection.
     * @return \Caphe\IWriter
     */
    public function getWriter();
}
