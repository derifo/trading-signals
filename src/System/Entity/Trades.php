<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trades
 *
 * @ORM\Table(name="trades", indexes={@ORM\Index(name="binary_customer_id", columns={"trader_id"}), @ORM\Index(name="position_status_idposition_status_id", columns={"trade_status_id"}), @ORM\Index(name="position_status_id", columns={"trade_status_id"}), @ORM\Index(name="merchant_signal_id", columns={"merchant_signal_id"})})
 * @ORM\Entity
 */
class Trades
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
     * @ORM\Column(name="merchant_trade_id", type="integer", nullable=false)
     */
    private $merchantTradeId;

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
     * @var float
     *
     * @ORM\Column(name="entry_rate", type="float", precision=10, scale=0, nullable=false)
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
     * @var integer
     *
     * @ORM\Column(name="scoring", type="integer", nullable=false)
     */
    private $scoring;

    /**
     * @var integer
     *
     * @ORM\Column(name="profit", type="integer", nullable=false)
     */
    private $profit;

    /**
     * @var float
     *
     * @ORM\Column(name="payout", type="float", precision=10, scale=0, nullable=false)
     */
    private $payout = '0';

    /**
     * @var \System\Entity\TradesStatuses
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\TradesStatuses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trade_status_id", referencedColumnName="id")
     * })
     */
    private $tradeStatus;

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
     * @var \System\Entity\MerchantsSignals
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\MerchantsSignals")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_signal_id", referencedColumnName="id")
     * })
     */
    private $merchantSignal;



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
     * Set merchantTradeId
     *
     * @param integer $merchantTradeId
     *
     * @return Trades
     */
    public function setMerchantTradeId($merchantTradeId)
    {
        $this->merchantTradeId = $merchantTradeId;

        return $this;
    }

    /**
     * Get merchantTradeId
     *
     * @return integer
     */
    public function getMerchantTradeId()
    {
        return $this->merchantTradeId;
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
     * @param float $entryRate
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
     * @return float
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
     * Set scoring
     *
     * @param integer $scoring
     *
     * @return Trades
     */
    public function setScoring($scoring)
    {
        $this->scoring = $scoring;

        return $this;
    }

    /**
     * Get scoring
     *
     * @return integer
     */
    public function getScoring()
    {
        return $this->scoring;
    }

    /**
     * Set profit
     *
     * @param integer $profit
     *
     * @return Trades
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return integer
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set payout
     *
     * @param float $payout
     *
     * @return Trades
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * Get payout
     *
     * @return float
     */
    public function getPayout()
    {
        return $this->payout;
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

    /**
     * Set merchantSignal
     *
     * @param \System\Entity\MerchantsSignals $merchantSignal
     *
     * @return Trades
     */
    public function setMerchantSignal(\System\Entity\MerchantsSignals $merchantSignal = null)
    {
        $this->merchantSignal = $merchantSignal;

        return $this;
    }

    /**
     * Get merchantSignal
     *
     * @return \System\Entity\MerchantsSignals
     */
    public function getMerchantSignal()
    {
        return $this->merchantSignal;
    }
}
