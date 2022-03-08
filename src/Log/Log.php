<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Log;

use Hyperf\Utils\ApplicationContext;

class Log
{
    public static function get(string $name = 'app')
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Logger\LoggerFactory::class)->get($name);
    }
}
