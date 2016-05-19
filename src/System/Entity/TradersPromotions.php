<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradersPromotions
 *
 * @ORM\Table(name="traders_promotions", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"}), @ORM\Index(name="trader_id", columns={"trader_id"})})
 * @ORM\Entity
 */
class TradersPromotions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="merchant_id", type="integer", nullable=false)
     */
    private $merchantId;

    /**
     * @var integer
     *
     * @ORM\Column(name="trader_id", type="integer", nullable=true)
     */
    private $traderId;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion_code", type="string", length=160, nullable=false)
     */
    private $promotionCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;



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
     * Set merchantId
     *
     * @param integer $merchantId
     *
     * @return TradersPromotions
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * Get merchantId
     *
     * @return integer
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * Set traderId
     *
     * @param integer $traderId
     *
     * @return TradersPromotions
     */
    public function setTraderId($traderId)
    {
        $this->traderId = $traderId;

        return $this;
    }

    /**
     * Get traderId
     *
     * @return integer
     */
    public function getTraderId()
    {
        return $this->traderId;
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
}
