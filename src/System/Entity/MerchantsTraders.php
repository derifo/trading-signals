<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantsTraders
 *
 * @ORM\Table(name="merchants_traders", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"}), @ORM\Index(name="country_id", columns={"country_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\MerchantsTraders")
 */
class MerchantsTraders
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
     * @var integer
     *
     * @ORM\Column(name="origin_id", type="integer", nullable=false)
     */
    private $originId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="balance", type="integer", nullable=false)
     */
    private $balance;

    /**
     * @var integer
     *
     * @ORM\Column(name="promoted", type="integer", nullable=false)
     */
    private $promoted = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ftd_date", type="datetime", nullable=true)
     */
    private $ftdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=false)
     */
    private $registrationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="synced_date", type="datetime", nullable=false)
     */
    private $syncedDate = 'CURRENT_TIMESTAMP';

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
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

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
     * @return MerchantsTraders
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
     * Set name
     *
     * @param string $name
     *
     * @return MerchantsTraders
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
     * Set balance
     *
     * @param integer $balance
     *
     * @return MerchantsTraders
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
     * @return MerchantsTraders
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
     * Set ftdDate
     *
     * @param \DateTime $ftdDate
     *
     * @return MerchantsTraders
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
     * @return MerchantsTraders
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
     * Set syncedDate
     *
     * @param \DateTime $syncedDate
     *
     * @return MerchantsTraders
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
     * Set merchant
     *
     * @param \System\Entity\Merchants $merchant
     *
     * @return MerchantsTraders
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

    /**
     * Set country
     *
     * @param \System\Entity\Countries $country
     *
     * @return MerchantsTraders
     */
    public function setCountry(\System\Entity\Countries $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \System\Entity\Countries
     */
    public function getCountry()
    {
        return $this->country;
    }
}
