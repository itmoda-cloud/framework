<?php

declare(strict_types=1);
/**
 * This file is part of ITModa.
 * @link     https://itmodar.com
 * @document https://doc.itmodar.com
 * @contact  group@itmodar.com
 * @license  https://git.itmodar.com/itmoda-cloud/itmoda/blob/master/LICENSE
 */
namespace ITModa\Framework\Command;

use Swoole\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @\Hyperf\Command\Annotation\Command()
 */
class StopServer extends Command
{
    public function __construct()
    {
        parent::__construct('server:stop');
    }

    protected function configure()
    {
        $this->setDescription('Stop itmoda servers.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $pidFile = BASE_PATH . '/runtime/hyperf.pid';
        $pid = file_exists($pidFile) ? intval(file_get_contents($pidFile)) : false;
        if (!$pid) {
            $io->note('itmoda server pid is invalid.');
            return -1;
        }

        if (!Process::kill($pid, SIG_DFL)) {
            $io->note('itmoda server process does not exist.');
            return -1;
        }

        if (!Process::kill($pid, SIGTERM)) {
            $io->error('itmoda server stop error.');
            return -1;
        }

        $io->success('itmoda server stop success.');
        return 0;
    }

}
