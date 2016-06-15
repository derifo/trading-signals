<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradersPromotions
 *
 * @ORM\Table(name="traders_promotions", indexes={@ORM\Index(name="trader_id", columns={"merchant_trader_id"}), @ORM\Index(name="deal_id", columns={"deal_id"})})
 * @ORM\Entity
 */
class TradersPromotions
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
     * @ORM\Column(name="promotion_code", type="string", length=160, nullable=false)
     */
    private $promotionCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="used", type="boolean", nullable=false)
     */
    private $used = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

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
     * @var \MerchantsTraders
     *
     * @ORM\ManyToOne(targetEntity="MerchantsTraders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_trader_id", referencedColumnName="id")
     * })
     */
    private $merchantTrader;



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
     * Set promotionCode
     *
     * @param string $promotionCode
     *
     * @return TradersPromotions
     */
    public function setPromotionCode($promotionCode)
    {
        $this->promotionCode = $promotionCode;

        return $this;
    }

    /**
     * Get promotionCode
     *
     * @return string
     */
    public function getPromotionCode()
    {
        return $this->promotionCode;
    }

    /**
     * Set used
     *
     * @param boolean $used
     *
     * @return TradersPromotions
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return boolean
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TradersPromotions
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set deal
     *
     * @param \System\Entity\Deals $deal
     *
     * @return TradersPromotions
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

    /**
     * Set merchantTrader
     *
     * @param \System\Entity\MerchantsTraders $merchantTrader
     *
     * @return TradersPromotions
     */
    public function setMerchantTrader(\System\Entity\MerchantsTraders $merchantTrader = null)
    {
        $this->merchantTrader = $merchantTrader;

        return $this;
    }

    /**
     * Get merchantTrader
     *
     * @return \System\Entity\MerchantsTraders
     */
    public function getMerchantTrader()
    {
        return $this->merchantTrader;
    }
}
