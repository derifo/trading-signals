<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradersSubscriptions
 *
 * @ORM\Table(name="traders_subscriptions", indexes={@ORM\Index(name="trader_id", columns={"trader_id"})})
 * @ORM\Entity
 */
class TradersSubscriptions
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
     * @ORM\Column(name="subscription_date", type="datetime", nullable=true)
     */
    private $subscriptionDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="subscription_expires", type="datetime", nullable=false)
     */
    private $subscriptionExpires;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subscriptionDate
     *
     * @param \DateTime $subscriptionDate
     *
     * @return TradersSubscriptions
     */
    public function setSubscriptionDate($subscriptionDate)
    {
        $this->subscriptionDate = $subscriptionDate;

        return $this;
    }

    /**
     * Get subscriptionDate
     *
     * @return \DateTime
     */
    public function getSubscriptionDate()
    {
        return $this->subscriptionDate;
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
}
