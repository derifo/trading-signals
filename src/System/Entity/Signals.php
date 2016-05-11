<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signals
 *
 * @ORM\Table(name="signals", indexes={@ORM\Index(name="asset_id", columns={"asset_id"})})
 * @ORM\Entity
 */
class Signals
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
     * @ORM\Column(name="asset_id", type="integer", nullable=false)
     */
    private $assetId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="direction", type="boolean", nullable=false)
     */
    private $direction = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="creation_rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $creationRate;

    /**
     * @var float
     *
     * @ORM\Column(name="min_entry_rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $minEntryRate;

    /**
     * @var float
     *
     * @ORM\Column(name="max_entry_rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $maxEntryRate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="max_expires", type="datetime", nullable=false)
     */
    private $maxExpires;

    /**
     * @var integer
     *
     * @ORM\Column(name="expires_flex_before", type="integer", nullable=false)
     */
    private $expiresFlexBefore = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="expires_flex_after", type="integer", nullable=false)
     */
    private $expiresFlexAfter = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';



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
     * Set assetId
     *
     * @param integer $assetId
     *
     * @return Signals
     */
    public function setAssetId($assetId)
    {
        $this->assetId = $assetId;

        return $this;
    }

    /**
     * Get assetId
     *
     * @return integer
     */
    public function getAssetId()
    {
        return $this->assetId;
    }

    /**
     * Set direction
     *
     * @param boolean $direction
     *
     * @return Signals
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return boolean
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set creationRate
     *
     * @param float $creationRate
     *
     * @return Signals
     */
    public function setCreationRate($creationRate)
    {
        $this->creationRate = $creationRate;

        return $this;
    }

    /**
     * Get creationRate
     *
     * @return float
     */
    public function getCreationRate()
    {
        return $this->creationRate;
    }

    /**
     * Set minEntryRate
     *
     * @param float $minEntryRate
     *
     * @return Signals
     */
    public function setMinEntryRate($minEntryRate)
    {
        $this->minEntryRate = $minEntryRate;

        return $this;
    }

    /**
     * Get minEntryRate
     *
     * @return float
     */
    public function getMinEntryRate()
    {
        return $this->minEntryRate;
    }

    /**
     * Set maxEntryRate
     *
     * @param float $maxEntryRate
     *
     * @return Signals
     */
    public function setMaxEntryRate($maxEntryRate)
    {
        $this->maxEntryRate = $maxEntryRate;

        return $this;
    }

    /**
     * Get maxEntryRate
     *
     * @return float
     */
    public function getMaxEntryRate()
    {
        return $this->maxEntryRate;
    }

    /**
     * Set maxExpires
     *
     * @param \DateTime $maxExpires
     *
     * @return Signals
     */
    public function setMaxExpires($maxExpires)
    {
        $this->maxExpires = $maxExpires;

        return $this;
    }

    /**
     * Get maxExpires
     *
     * @return \DateTime
     */
    public function getMaxExpires()
    {
        return $this->maxExpires;
    }

    /**
     * Set expiresFlexBefore
     *
     * @param integer $expiresFlexBefore
     *
     * @return Signals
     */
    public function setExpiresFlexBefore($expiresFlexBefore)
    {
        $this->expiresFlexBefore = $expiresFlexBefore;

        return $this;
    }

    /**
     * Get expiresFlexBefore
     *
     * @return integer
     */
    public function getExpiresFlexBefore()
    {
        return $this->expiresFlexBefore;
    }

    /**
     * Set expiresFlexAfter
     *
     * @param integer $expiresFlexAfter
     *
     * @return Signals
     */
    public function setExpiresFlexAfter($expiresFlexAfter)
    {
        $this->expiresFlexAfter = $expiresFlexAfter;

        return $this;
    }

    /**
     * Get expiresFlexAfter
     *
     * @return integer
     */
    public function getExpiresFlexAfter()
    {
        return $this->expiresFlexAfter;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Signals
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
}
