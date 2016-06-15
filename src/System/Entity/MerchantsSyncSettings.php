<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantsSyncSettings
 *
 * @ORM\Table(name="merchants_sync_settings", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\MerchantsSyncSettings")
 */
class MerchantsSyncSettings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_sync_date", type="datetime", nullable=false)
     */
    private $lastSyncDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="sync_interval", type="integer", nullable=false)
     */
    private $syncInterval = '45000';

    /**
     * @var integer
     *
     * @ORM\Column(name="live_sync_interval", type="integer", nullable=false)
     */
    private $liveSyncInterval = '15';

    /**
     * @var \Merchants
     *
     * @ORM\ManyToOne(targetEntity="Merchants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_id", referencedColumnName="id")
     * })
     */
    private $merchant;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastSyncDate
     *
     * @param \DateTime $lastSyncDate
     *
     * @return MerchantsSyncSettings
     */
    public function setLastSyncDate($lastSyncDate)
    {
        $this->lastSyncDate = $lastSyncDate;

        return $this;
    }

    /**
     * Get lastSyncDate
     *
     * @return \DateTime
     */
    public function getLastSyncDate()
    {
        return $this->lastSyncDate;
    }

    /**
     * Set syncInterval
     *
     * @param integer $syncInterval
     *
     * @return MerchantsSyncSettings
     */
    public function setSyncInterval($syncInterval)
    {
        $this->syncInterval = $syncInterval;

        return $this;
    }

    /**
     * Get syncInterval
     *
     * @return integer
     */
    public function getSyncInterval()
    {
        return $this->syncInterval;
    }

    /**
     * Set liveSyncInterval
     *
     * @param integer $liveSyncInterval
     *
     * @return MerchantsSyncSettings
     */
    public function setLiveSyncInterval($liveSyncInterval)
    {
        $this->liveSyncInterval = $liveSyncInterval;

        return $this;
    }

    /**
     * Get liveSyncInterval
     *
     * @return integer
     */
    public function getLiveSyncInterval()
    {
        return $this->liveSyncInterval;
    }

    /**
     * Set merchant
     *
     * @param \System\Entity\Merchants $merchant
     *
     * @return MerchantsSyncSettings
     */
    public function setMerchant(\System\Entity\Merchants $merchant = null)
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * Get merchant
     *
     * @return \System\Entity\Merchants
     */
    public function getMerchant()
    {
        return $this->merchant;
    }
}
