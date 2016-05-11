<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantsSignals
 *
 * @ORM\Table(name="merchants_signals", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"}), @ORM\Index(name="merchant_id_2", columns={"merchant_id"}), @ORM\Index(name="merchant_option_id", columns={"merchant_option_id"})})
 * @ORM\Entity
 */
class MerchantsSignals
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
     * @ORM\Column(name="merchant_option_id", type="integer", nullable=false)
     */
    private $merchantOptionId;

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
     * @var \Merchants
     *
     * @ORM\ManyToOne(targetEntity="Merchants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_id", referencedColumnName="id")
     * })
     */
    private $merchant;



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
}
