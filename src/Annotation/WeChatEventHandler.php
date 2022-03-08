<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 微信回调事件处理器收集.
 * @Annotation
 * @Target({"CLASS"})
 */
class WeChatEventHandler extends AbstractAnnotation
{
    /**
     * @var string 事件路径，组成参数为: MsgType[/Event[/ChangeType|EventKey]]
     */
    public $eventPath = '';

    /**
     * @var int 注册顺序
     */
    public $sort = 99;
}
