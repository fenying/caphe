<?php
/**
 * File: Reader.php
 * Created Date: 2017年6月1日 上午11:09:11
 */
declare (strict_types = 1);

namespace Caphe\Driver\Redis;

class Reader extends IBaseClient implements \Caphe\IReader
{
    use TReader;
    use TNSReader;
}
