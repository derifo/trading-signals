<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradersSubscriptions
 *
 * @ORM\Table(name="traders_subscriptions", indexes={@ORM\Index(name="trader_id", columns={"trader_id"}), @ORM\Index(name="deal_id", columns={"deal_id"})})
 * @ORM\Entity
 */
class TradersSubscriptions
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
     * @var \DateTime
     *
     * @ORM\Column(name="subscription_started", type="datetime", nullable=true)
     */
    private $subscriptionStarted = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="subscription_expires", type="datetime", nullable=false)
     */
    private $subscriptionExpires;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';

    /**
     * @var \System\Entity\Traders
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Traders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trader_id", referencedColumnName="id")
     * })
     */
    private $trader;

    /**
     * @var \System\Entity\Deals
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Deals")
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
     * Set subscriptionStarted
     *
     * @param \DateTime $subscriptionStarted
     *
     * @return TradersSubscriptions
     */
    public function setSubscriptionStarted($subscriptionStarted)
    {
        $this->subscriptionStarted = $subscriptionStarted;

        return $this;
    }

    /**
     * Get subscriptionStarted
     *
     * @return \DateTime
     */
    public function getSubscriptionStarted()
    {
        return $this->subscriptionStarted;
    }

    /**
     * Set subscriptionExpires
     *
     * @param \DateTime $subscriptionExpires
     *
     * @return TradersSubscriptions
     */
    public function setSubscriptionExpires($subscriptionExpires)
    {
        $this->subscriptionExpires = $subscriptionExpires;

        return $this;
    }

    /**
     * Get subscriptionExpires
     *
     * @return \DateTime
     */
    public function getSubscriptionExpires()
    {
        return $this->subscriptionExpires;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return TradersSubscriptions
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set trader
     *
     * @param \System\Entity\Traders $trader
     *
     * @return TradersSubscriptions
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
     * @return TradersSubscriptions
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
