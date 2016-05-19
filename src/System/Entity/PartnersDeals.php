<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PartnersDeals
 *
 * @ORM\Table(name="partners_deals", indexes={@ORM\Index(name="partner_id", columns={"partner_id"}), @ORM\Index(name="deal_id", columns={"deal_id"})})
 * @ORM\Entity
 */
class PartnersDeals
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
     * @ORM\Column(name="deal_expires", type="datetime", nullable=true)
     */
    private $dealExpires;

    /**
     * @var \System\Entity\Partners
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Partners")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="partner_id", referencedColumnName="id")
     * })
     */
    private $partner;

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
     * Set dealExpires
     *
     * @param \DateTime $dealExpires
     *
     * @return PartnersDeals
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
     * Set partner
     *
     * @param \System\Entity\Partners $partner
     *
     * @return PartnersDeals
     */
    public function setPartner(\System\Entity\Partners $partner = null)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \System\Entity\Partners
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Set deal
     *
     * @param \System\Entity\Deals $deal
     *
     * @return PartnersDeals
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
