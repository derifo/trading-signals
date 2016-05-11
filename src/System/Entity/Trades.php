<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trades
 *
 * @ORM\Table(name="trades", indexes={@ORM\Index(name="binary_customer_id", columns={"trader_id"}), @ORM\Index(name="position_status_idposition_status_id", columns={"trade_status_id"}), @ORM\Index(name="position_status_id", columns={"trade_status_id"})})
 * @ORM\Entity
 */
class Trades
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
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="entry_rate", type="integer", nullable=false)
     */
    private $entryRate;

    /**
     * @var integer
     *
     * @ORM\Column(name="close_rate", type="integer", nullable=true)
     */
    private $closeRate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="buy_date", type="datetime", nullable=false)
     */
    private $buyDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiry_date", type="datetime", nullable=false)
     */
    private $expiryDate;

    /**
     * @var \TradesStatuses
     *
     * @ORM\ManyToOne(targetEntity="TradesStatuses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trade_status_id", referencedColumnName="id")
     * })
     */
    private $tradeStatus;

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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Trades
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Trades
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
     * Set entryRate
     *
     * @param integer $entryRate
     *
     * @return Trades
     */
    public function setEntryRate($entryRate)
    {
        $this->entryRate = $entryRate;

        return $this;
    }

    /**
     * Get entryRate
     *
     * @return integer
     */
    public function getEntryRate()
    {
        return $this->entryRate;
    }

    /**
     * Set closeRate
     *
     * @param integer $closeRate
     *
     * @return Trades
     */
    public function setCloseRate($closeRate)
    {
        $this->closeRate = $closeRate;

        return $this;
    }

    /**
     * Get closeRate
     *
     * @return integer
     */
    public function getCloseRate()
    {
        return $this->closeRate;
    }

    /**
     * Set buyDate
     *
     * @param \DateTime $buyDate
     *
     * @return Trades
     */
    public function setBuyDate($buyDate)
    {
        $this->buyDate = $buyDate;

        return $this;
    }

    /**
     * Get buyDate
     *
     * @return \DateTime
     */
    public function getBuyDate()
    {
        return $this->buyDate;
    }

    /**
     * Set expiryDate
     *
     * @param \DateTime $expiryDate
     *
     * @return Trades
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return \DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set tradeStatus
     *
     * @param \System\Entity\TradesStatuses $tradeStatus
     *
     * @return Trades
     */
    public function setTradeStatus(\System\Entity\TradesStatuses $tradeStatus = null)
    {
        $this->tradeStatus = $tradeStatus;

        return $this;
    }

    /**
     * Get tradeStatus
     *
     * @return \System\Entity\TradesStatuses
     */
    public function getTradeStatus()
    {
        return $this->tradeStatus;
    }

    /**
     * Set trader
     *
     * @param \System\Entity\Traders $trader
     *
     * @return Trades
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
