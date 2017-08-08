<?php
/**
 * File: Writer.php
 * Created Date: 2017年6月1日 上午11:12:32
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

class Writer extends IBaseClient implements \Caphe\IWriter
{
    use TNSWriter;
    use TWriter;
}