<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Vespolina\DefaultStoreBundle\ProcessScenario\Setup\SetupCLIProcess;

class SetupCommand extends ContainerAwareCommand
{
    protected $input;
    protected $country;
    protected $output;
    protected $state;
    protected $type;

    protected function configure()
    {
        $this
            ->setName('vespolina:store-setup')
            ->setDescription('Setup a Vespolina store')
            ->addOption('country', null, InputOption::VALUE_OPTIONAL, 'Country', 'US')
            ->addOption('state', null, InputOption::VALUE_OPTIONAL, 'State', 'SC')
            ->addOption('type', null, InputOption::VALUE_OPTIONAL, 'Store type', 'beverages')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processContext = array();

        // Prepare the context before passing it on to the process steps
        foreach ($input->getOptions() as $key => $value) {
            $processContext[$key] = $value;
        }

        $setupProcess = new SetupCLIProcess($this->getContainer(), $processContext);
        $setupProcess->init();
        $setupProcess->execute();

        $output->writeln('Finished setup');
    }
}
