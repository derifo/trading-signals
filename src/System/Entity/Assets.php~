<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Assets
 *
 * @ORM\Table(name="assets")
 * @ORM\Entity
 */
class Assets
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
     * @var float
     *
     * @ORM\Column(name="socket_id", type="integer", nullable=false)
     */
    private $socketId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=80, nullable=false)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $rate;

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
     * Set socketId
     *
     * @param string $socketId
     *
     * @return Assets
     */
    public function setSocketId($socketId)
    {
        $this->socketId = $socketId;

        return $this;
    }

    /**
     * Get socketId
     *
     * @return string
     */
    public function getSocketId()
    {
        return $this->socketId;
    }
    
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Assets
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
     * Set rate
     *
     * @param float $rate
     *
     * @return Assets
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }
}
