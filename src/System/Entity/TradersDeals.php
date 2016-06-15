<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradersDeals
 *
 * @ORM\Table(name="traders_deals", indexes={@ORM\Index(name="trader_id", columns={"trader_id"}), @ORM\Index(name="deal_id", columns={"deal_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\TradersDeals")
 */
class TradersDeals
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
     * @ORM\Column(name="deal_started", type="datetime", nullable=true)
     */
    private $dealStarted = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deal_expires", type="datetime", nullable=false)
     */
    private $dealExpires;

    /**
     * @var \Traders
     *
     * @ORM\ManyToOne(targetEntity="Traders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trader_id", referencedColumnName="id")
     * })
     */
    private $trader;

    /**
     * @var \Traders
     *
     * @ORM\ManyToOne(targetEntity="TradersDealsStatuses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trader_deal_status_id", referencedColumnName="id")
     * })
     */
    private $traderDealStatus;

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
     * Set dealStarted
     *
     * @param \DateTime $dealStarted
     *
     * @return TradersDeals
     */
    public function setDealStarted($dealStarted)
    {
        $this->dealStarted = $dealStarted;

        return $this;
    }

    /**
     * Get dealStarted
     *
     * @return \DateTime
     */
    public function getDealStarted()
    {
        return $this->dealStarted;
    }

    /**
     * Set dealExpires
     *
     * @param \DateTime $dealExpires
     *
     * @return TradersDeals
     */
    public function setDealExpires($dealExpires)
    {
        $this->dealExpires = $dealExpires;

        return $this;
    }

    /**
     * Get dealExpires
     *
     * @return \DateTime
     */
    public function getDealExpires()
    {
        return $this->dealExpires;
    }

    /**
     * Set trader
     *
     * @param \System\Entity\Traders $trader
     *
     * @return TradersDeals
     */
    public function setTrader(\System\Entity\Traders $trader = null)
    {
        $this->trader = $trader;

        return $this;
    }

    /**
     * Get trader
     *
     * @return \System\Entity\Traders
     */
    public function getTrader()
    {
        return $this->trader;
    }

    /**
     * Set deal
     *
     * @param \System\Entity\Deals $deal
     *
     * @return TradersDeals
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
     * Set trader deal status
     *
     * @param \System\Entity\Traders $trader
     *
     * @return TradersDeals
     */
    public function setTraderDealStatus(\System\Entity\TradersDealsStatuses $traderDealStatus = null)
    {
        $this->traderDealStatus = $traderDealStatus;

        return $this;
    }

    /**
     * Get trader
     *
     * @return \System\Entity\Traders
     */
    public function getTraderDealStatus()
    {
        return $this->traderDealStatus;
    }
}
