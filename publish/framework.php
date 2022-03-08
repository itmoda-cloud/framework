<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
return [
    // ITModa\Framework\Middleware\JwtAuthMiddleware jwt路由验证白名单
    'auth_white_routes' => [
        '/user/auth', '/weWork/callback',
    ],

    // ITModa\Framework\Middleware\ResponseMiddleware 原生响应格式的路由
    'response_raw_routes' => [
        '/weWork/callback',
    ],

    'wework' => [
        'config' => [
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file'  => BASE_PATH . '/runtime/logs/wechat.log',
            ],
        ],
        'default' => [
            'provider' => 'app',
        ],
        'providers' => [
            'app' => [
                'name'    => \ITModa\Framework\Provider\WeWork\AppProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 ITModa\Framework\Contract\WeWork\AppConfigurable 接口
            ],
            'user' => [
                'name'    => \ITModa\Framework\Provider\WeWork\UserProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 ITModa\Framework\Contract\WeWork\UserConfigurable 接口
            ],
            'externalContact' => [
                'name'    => \ITModa\Framework\Provider\WeWork\ExternalContactProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 ITModa\Framework\Contract\WeWork\ExternalContactConfigurable 接口
            ],
            'agent' => [
                'name'    => \ITModa\Framework\Provider\WeWork\AgentProvider::class,
                'service' => App\Model\Corp::class, //  需要实现 ITModa\Framework\Contract\WeWork\AgentConfigurable 接口
            ],
        ],
    ],
];
