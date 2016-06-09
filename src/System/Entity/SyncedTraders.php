<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SyncedTraders
 *
 * @ORM\Table(name="synced_traders", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\SyncedTraders")
 */
class SyncedTraders
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="origin_id", type="integer", nullable=false)
     */
    private $originId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="synced_date", type="datetime", nullable=false)
     */
    private $syncedDate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="balance", type="integer", nullable=false)
     */
    private $balance = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="promoted", type="integer", nullable=false)
     */
    private $promoted = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ftd_date", type="datetime", nullable=false)
     */
    private $ftdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=false)
     */
    private $registrationDate;

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
     * Set originId
     *
     * @param integer $originId
     *
     * @return SyncedTraders
     */
    public function setOriginId($originId)
    {
        $this->originId = $originId;

        return $this;
    }

    /**
     * Get originId
     *
     * @return integer
     */
    public function getOriginId()
    {
        return $this->originId;
    }

    /**
     * Set syncedDate
     *
     * @param \DateTime $syncedDate
     *
     * @return SyncedTraders
     */
    public function setSyncedDate($syncedDate)
    {
        $this->syncedDate = $syncedDate;

        return $this;
    }

    /**
     * Get syncedDate
     *
     * @return \DateTime
     */
    public function getSyncedDate()
    {
        return $this->syncedDate;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return SyncedTraders
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set promoted
     *
     * @param integer $promoted
     *
     * @return SyncedTraders
     */
    public function setPromoted($promoted)
    {
        $this->promoted = $promoted;

        return $this;
    }

    /**
     * Get promoted
     *
     * @return integer
     */
    public function getPromoted()
    {
        return $this->promoted;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SyncedTraders
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ftdDate
     *
     * @param \DateTime $ftdDate
     *
     * @return SyncedTraders
     */
    public function setFtdDate($ftdDate)
    {
        $this->ftdDate = $ftdDate;

        return $this;
    }

    /**
     * Get ftdDate
     *
     * @return \DateTime
     */
    public function getFtdDate()
    {
        return $this->ftdDate;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     *
     * @return SyncedTraders
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set merchant
     *
     * @param \System\Entity\Merchants $merchant
     *
     * @return SyncedTraders
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
