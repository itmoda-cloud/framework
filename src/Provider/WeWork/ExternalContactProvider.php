<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Provider\WeWork;

use ITModa\Framework\Contract\WeWork\ExternalContactConfigurable;

class ExternalContactProvider extends AbstractProvider
{
    /**
     * @var ExternalContactConfigurable
     */
    protected $service;

    /**
     * @return array app配置
     */
    protected function config(?string $wxCorpId = null, ?array $agentId = null): array
    {
        return $this->service->externalContactConfig($wxCorpId, $agentId);
    }
}
