<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use ITModa\Framework\Constants\ErrorCode;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();

        /** @var \Hyperf\Validation\ValidationException $throwable */
        $falseMsg = $throwable->validator->errors()->first();

        ## 格式化输出
        $data = responseDataFormat(ErrorCode::INVALID_PARAMS, $falseMsg);

        $dataStream = new SwooleStream(json_encode($data, JSON_UNESCAPED_UNICODE));

        return $response->withAddedHeader('Content-Type', 'application/json;charset=utf-8')
            ->withStatus($throwable->status)
            ->withBody($dataStream);
    }

    public function isValid(Throwable $throwable): bool
    {
        $validateException = \Hyperf\Validation\ValidationException::class;
        if (class_exists($validateException) && $throwable instanceof $validateException) {
            return true;
        }
        return false;
    }
}
