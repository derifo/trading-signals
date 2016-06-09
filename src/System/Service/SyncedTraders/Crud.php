<?php
/**
 * Created by PhpStorm.
 * User: roee
 * Date: 15/05/2016
 * Time: 11:33
 */

namespace System\Service\SyncedTraders;

use Doctrine\Bundle\DoctrineBundle\Registry;
use System\Entity\Merchants;
use System\Entity\MerchantsSignals;
use System\Entity\Signals;
use System\Entity\Traders;
use System\Entity\Trades;
use System\Helpers\Arr;
use System\Helpers\Date;
use System\Service\BaseCrud;
use System\Service\Integration\AdaptersContainer;

class Crud extends BaseCrud {

    const ENTITY = 'System:SyncedTraders';
}