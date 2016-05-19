<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantsSignals
 *
 * @ORM\Table(name="merchants_signals", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"}), @ORM\Index(name="merchant_id_2", columns={"merchant_id"}), @ORM\Index(name="merchant_option_id", columns={"merchant_option_id"}), @ORM\Index(name="signal_id", columns={"signal_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\MerchantsSignals")
 */
class MerchantsSignals
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
     * @ORM\Column(name="merchant_option_id", type="integer", nullable=false)
     */
    private $merchantOptionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", nullable=false)
     */
    private $expires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \System\Entity\Merchants
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Merchants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_id", referencedColumnName="id")
     * })
     */
    private $merchant;

    /**
     * @var \System\Entity\Signals
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Signals")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="signal_id", referencedColumnName="id")
     * })
     */
    private $signal;



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
     * Set merchantOptionId
     *
     * @param integer $merchantOptionId
     *
     * @return MerchantsSignals
     */
    public function setMerchantOptionId($merchantOptionId)
    {
        $this->merchantOptionId = $merchantOptionId;

        return $this;
    }

    /**
     * Get merchantOptionId
     *
     * @return integer
     */
    public function getMerchantOptionId()
    {
        return $this->merchantOptionId;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return MerchantsSignals
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
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return MerchantsSignals
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return MerchantsSignals
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
     * Set merchant
     *
     * @param \System\Entity\Merchants $merchant
     *
     * @return MerchantsSignals
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
     * Set signal
     *
     * @param \System\Entity\Signals $signal
     *
     * @return MerchantsSignals
     */
    public function setSignal(\System\Entity\Signals $signal = null)
    {
        $this->signal = $signal;

        return $this;
    }

    /**
     * Get signal
     *
     * @return \System\Entity\Signals
     */
    public function getSignal()
    {
        return $this->signal;
    }
}
