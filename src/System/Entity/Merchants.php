<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Merchants
 *
 * @ORM\Table(name="merchants", indexes={@ORM\Index(name="patner_id", columns={"patner_id"}), @ORM\Index(name="adapter_id", columns={"integration_id"})})
 * @ORM\Entity
 */
class Merchants
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
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=50, nullable=false)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="api_param1", type="string", length=200, nullable=true)
     */
    private $apiParam1;

    /**
     * @var string
     *
     * @ORM\Column(name="api_param2", type="string", length=200, nullable=true)
     */
    private $apiParam2;

    /**
     * @var string
     *
     * @ORM\Column(name="api_param3", type="string", length=200, nullable=true)
     */
    private $apiParam3;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_trade_amount", type="integer", nullable=false)
     */
    private $minTradeAmount = '50';

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '1';

    /**
     * @var \System\Entity\Partners
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Partners")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="patner_id", referencedColumnName="id")
     * })
     */
    private $patner;

    /**
     * @var \System\Entity\Intergrations
     *
     * @ORM\ManyToOne(targetEntity="System\Entity\Intergrations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="integration_id", referencedColumnName="id")
     * })
     */
    private $integration;



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
     * @return Merchants
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Merchants
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set apiParam1
     *
     * @param string $apiParam1
     *
     * @return Merchants
     */
    public function setApiParam1($apiParam1)
    {
        $this->apiParam1 = $apiParam1;

        return $this;
    }

    /**
     * Get apiParam1
     *
     * @return string
     */
    public function getApiParam1()
    {
        return $this->apiParam1;
    }

    /**
     * Set apiParam2
     *
     * @param string $apiParam2
     *
     * @return Merchants
     */
    public function setApiParam2($apiParam2)
    {
        $this->apiParam2 = $apiParam2;

        return $this;
    }

    /**
     * Get apiParam2
     *
     * @return string
     */
    public function getApiParam2()
    {
        return $this->apiParam2;
    }

    /**
     * Set apiParam3
     *
     * @param string $apiParam3
     *
     * @return Merchants
     */
    public function setApiParam3($apiParam3)
    {
        $this->apiParam3 = $apiParam3;

        return $this;
    }

    /**
     * Get apiParam3
     *
     * @return string
     */
    public function getApiParam3()
    {
        return $this->apiParam3;
    }

    /**
     * Set minTradeAmount
     *
     * @param integer $minTradeAmount
     *
     * @return Merchants
     */
    public function setMinTradeAmount($minTradeAmount)
    {
        $this->minTradeAmount = $minTradeAmount;

        return $this;
    }

    /**
     * Get minTradeAmount
     *
     * @return integer
     */
    public function getMinTradeAmount()
    {
        return $this->minTradeAmount;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Merchants
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set patner
     *
     * @param \System\Entity\Partners $patner
     *
     * @return Merchants
     */
    public function setPatner(\System\Entity\Partners $patner = null)
    {
        $this->patner = $patner;

        return $this;
    }

    /**
     * Get patner
     *
     * @return \System\Entity\Partners
     */
    public function getPatner()
    {
        return $this->patner;
    }

    /**
     * Set integration
     *
     * @param \System\Entity\Intergrations $integration
     *
     * @return Merchants
     */
    public function setIntegration(\System\Entity\Intergrations $integration = null)
    {
        $this->integration = $integration;

        return $this;
    }

    /**
     * Get integration
     *
     * @return \System\Entity\Intergrations
     */
    public function getIntegration()
    {
        return $this->integration;
    }
}
