<?php

namespace Spaceport\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GruntCommand extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('grunt')
            ->addArgument(
                'commandArgs',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'Your Grunt command, for instance: "build" or "start"'
            )
            ->setDescription('Run grunt commands')
        ;
    }

    protected function doExecute(InputInterface $input, OutputInterface $output)
    {
        $output->setVerbosity(OutputInterface::VERBOSITY_VERY_VERBOSE);
        $command = $input->getArgument('commandArgs');
        $this->runCommand('docker exec $(docker-compose ps -q node) /usr/local/bin/grunt --allow-root ' . implode(" ", $command));
    }
}
