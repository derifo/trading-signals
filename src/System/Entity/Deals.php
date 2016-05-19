<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deals
 *
 * @ORM\Table(name="deals", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Deals
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="activation_cost", type="integer", nullable=false)
     */
    private $activationCost;

    /**
     * @var integer
     *
     * @ORM\Column(name="signal_cost", type="integer", nullable=false)
     */
    private $signalCost;

    /**
     * @var integer
     *
     * @ORM\Column(name="monthly_fee", type="integer", nullable=false)
     */
    private $monthlyFee;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;



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
     * Set title
     *
     * @param string $title
     *
     * @return Deals
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set activationCost
     *
     * @param integer $activationCost
     *
     * @return Deals
     */
    public function setActivationCost($activationCost)
    {
        $this->activationCost = $activationCost;

        return $this;
    }

    /**
     * Get activationCost
     *
     * @return integer
     */
    public function getActivationCost()
    {
        return $this->activationCost;
    }

    /**
     * Set signalCost
     *
     * @param integer $signalCost
     *
     * @return Deals
     */
    public function setSignalCost($signalCost)
    {
        $this->signalCost = $signalCost;

        return $this;
    }

    /**
     * Get signalCost
     *
     * @return integer
     */
    public function getSignalCost()
    {
        return $this->signalCost;
    }

    /**
     * Set monthlyFee
     *
     * @param integer $monthlyFee
     *
     * @return Deals
     */
    public function setMonthlyFee($monthlyFee)
    {
        $this->monthlyFee = $monthlyFee;

        return $this;
    }

    /**
     * Get monthlyFee
     *
     * @return integer
     */
    public function getMonthlyFee()
    {
        return $this->monthlyFee;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Deals
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }
}
