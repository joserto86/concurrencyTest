<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\ElementMessage;

class ConcurrencyTestCommand extends Command
{
    protected static $defaultName = 'concurrency:test';
    protected static $defaultDescription = 'Add a short description for your command';

    protected $bus;

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct(MessageBusInterface $bus, $name = null)
    {
        parent::__construct($name);
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $data = [
            [
                'name' => 'primero',
                'fid' => 'aabb',
                'fno' => 'aaa'
            ], [
                'name' => 'segundo',
                'fid' => 'aacc',
                'fno' => 'aaa'
            ], [
                'name' => 'tercero',
                'fid' => 'aadd',
                'fno' => 'aaa'
            ], [
                'name' => 'cuarto',
                'fid' => 'aabb',
                'fno' => 'aaa'
            ], [
                'name' => 'quinto',
                'fid' => 'aaee',
                'fno' => 'aaa'
            ], [
                'name' => 'sexto',
                'fid' => 'aaff',
                'fno' => 'aaa'
            ], [
                'name' => 'septimo',
                'fid' => 'aaee',
                'fno' => 'aaa'
            ]
        ];

        foreach ($data as $item) {

            $this->bus->dispatch(new ElementMessage(
               $item['name'],
               $item['fid'],
               $item['fno']
            ));
        }


        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
