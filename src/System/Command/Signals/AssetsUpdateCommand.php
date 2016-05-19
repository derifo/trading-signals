<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 1/11/2016
 * Time: 4:44 PM
 */
namespace System\Command\Signals;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use System\Entity\Assets;
use System\Helpers\Arr;

class AssetsUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('signals:assets:update')
            ->setDescription('Update assets rates');;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');

        $merchant = $doctrine
            ->getRepository('System:Merchants')
            ->find(1);

        $assets = $this->getContainer()->get('adapters.container')
            ->getAdapter($merchant)
            ->getAssets();

        $em = $doctrine->getManager();

        foreach(Arr::get($assets, 'assets', []) as $api_asset)
        {
            $rate = round($api_asset['rate'], 2);

            if ($rate)
            {
                /**
                 * @var $asset Assets
                 */
                $asset = $doctrine->getRepository('System:Assets')->findOneBy([ 'socketId' => $api_asset['id'] ]);

                if ( ! $asset)
                {
                    $asset = new Assets();
                }

                $asset
                    ->setSocketId(Arr::get($api_asset, 'id'))
                    ->setRate(round($api_asset['rate'], 2))
                    ->setTitle($api_asset['name']);

                $em->persist($asset);
            }
        }

        $em->flush();
    }
}
