<?php
/**
 * File: Reader.php
 * Created Date: 2017-08-09 11:16:23
 */
declare (strict_types = 1);

namespace Caphe\Driver\APCu;

class Reader extends IBaseClient implements \Caphe\IReader
{
    use TReader;
    use TNSReader;
}
