<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Exception;

use Hyperf\Server\Exception\ServerException;
use ITModa\Framework\Constants\ErrorCode;

class CommonException extends ServerException
{
    public function __construct(int $code = 0, string $message = null, \Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
            if (! $message && class_exists(\App\Constants\AppErrCode::class)) {
                $message = \App\Constants\AppErrCode::getMessage($code);
            }
        }
        parent::__construct($message, $code, $previous);
    }
}
