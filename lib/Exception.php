<?php
/**
 * File: CapheException.php
 * Created Date: 2017年6月1日 下午12:03:52
 */
declare (strict_types = 1);

namespace Caphe;

class Exception extends \Exception
{
    const E_CONNECT_FAILURE = 0x0001;
    const E_AUTH_FAILURE = 0x0002;
    const E_INIT_FAILURE = 0x0003;
    const E_OP_FAILURE = 0x0004;
    const E_PROTOCOL_FAILURE = 0x0005;
    const E_INVALID_CONFIG = 0x0006;
}
