<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework;

use ITModa\Framework\Exception\Handler\AuthExceptionHandler;
use ITModa\Framework\Exception\Handler\CommonExceptionHandler;
use ITModa\Framework\Exception\Handler\GuzzleRequestExceptionHandler;
use ITModa\Framework\Exception\Handler\ValidationExceptionHandler;
use ITModa\Framework\Middleware\CorsMiddleware;
use ITModa\Framework\Middleware\ResponseMiddleware;

class ConfigProvider
{
    public function __invoke(): array
    {
        $serviceMap = $this->serviceMap();

        return [
            'dependencies' => array_merge($serviceMap, [
            ]),
            'exceptions' => [
                'handler' => [
                    'http' => [
                        CommonExceptionHandler::class,
                        GuzzleRequestExceptionHandler::class,
                        ValidationExceptionHandler::class,
                        AuthExceptionHandler::class,
                    ],
                ],
            ],
            'middlewares' => [
                'http' => [
                    CorsMiddleware::class,
                    ResponseMiddleware::class,
                ],
            ],
            'commands' => [
            ],
            'listeners' => [
                \Hyperf\ExceptionHandler\Listener\ErrorExceptionHandler::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id'          => 'framework',
                    'description' => 'framework配置',
                    'source'      => __DIR__ . '/../publish/framework.php',
                    'destination' => BASE_PATH . '/config/autoload/framework.php',
                ],
                [
                    'id'          => 'dependencies',
                    'description' => '依赖配置',
                    'source'      => __DIR__ . '/../publish/dependencies.php',
                    'destination' => BASE_PATH . '/config/autoload/dependencies.php',
                ],
            ],
        ];
    }

    /**
     * 模型服务与契约的依赖配置.
     * @param string $path 契约与服务的相对路径
     * @return array 依赖数据
     */
    protected function serviceMap(string $path = 'app'): array
    {
        $services    = readFileName(BASE_PATH . '/' . $path . '/Service');
        $spacePrefix = ucfirst($path);

        $dependencies = [];
        foreach ($services as $service) {
            $dependencies[$spacePrefix . '\\Contract\\' . $service . 'Interface'] = $spacePrefix . '\\Service\\' . $service;
        }

        return $dependencies;
    }
}
