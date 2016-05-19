<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 1/11/2016
 * Time: 4:44 PM
 */
namespace System\Command\Trades;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use System\Entity\Assets;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Helpers\Arr;

class ArchiveCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('trades:archive:open')
            ->setDescription('Archive and seal open trades');;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var $doctrine Registry
         */
        $allocate = $this->getContainer()->get('trades.archive');

        // Attach options to signals
        $allocate->archiveAllOpenTrades();
    }
}
