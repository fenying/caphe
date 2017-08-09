<?php
/**
 * File: Writer.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

class Writer extends IBaseClient implements \Caphe\IWriter
{
    use TNSWriter;
    use TWriter;
}