<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantsDeals
 *
 * @ORM\Table(name="merchants_deals", indexes={@ORM\Index(name="deal_id", columns={"deal_id"}), @ORM\Index(name="merchant_id", columns={"merchant_id"})})
 * @ORM\Entity
 */
class MerchantsDeals
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
     * @ORM\Column(name="repeat_limit", type="integer", nullable=true)
     */
    private $repeatLimit;

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
     * @var \Deals
     *
     * @ORM\ManyToOne(targetEntity="Deals")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deal_id", referencedColumnName="id")
     * })
     */
    private $deal;



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
     * Set repeatLimit
     *
     * @param integer $repeatLimit
     *
     * @return MerchantsDeals
     */
    public function setRepeatLimit($repeatLimit)
    {
        $this->repeatLimit = $repeatLimit;

        return $this;
    }

    /**
     * Get repeatLimit
     *
     * @return integer
     */
    public function getRepeatLimit()
    {
        return $this->repeatLimit;
    }

    /**
     * Set merchant
     *
     * @param \System\Entity\Merchants $merchant
     *
     * @return MerchantsDeals
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
     * Set deal
     *
     * @param \System\Entity\Deals $deal
     *
     * @return MerchantsDeals
     */
    public function setDeal(\System\Entity\Deals $deal = null)
    {
        $this->deal = $deal;

        return $this;
    }

    /**
     * Get deal
     *
     * @return \System\Entity\Deals
     */
    public function getDeal()
    {
        return $this->deal;
    }
}
