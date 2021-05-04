<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * @Command
 */
class FooCommand extends HyperfCommand
{
    /**
     * 执行的命令行
     *
     * @var string
     */
    protected $name = 'foo:hello';

    public function handle()
    {
        // 从 $input 获取 name 参数
        $argument = $this->input->getArgument('name') ?? 'World';
        $this->line('Hello ' . $argument, 'info');
    }

    public function configure()
    {
        parent::configure();
        $this->setHelp('Hyperf 自定义命令演示');
        $this->setDescription('Hyperf Demo Command');
        $this->addUsage('--name 演示代码');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, '这里是对这个参数的解释','hyperf']
        ];
    }
}
