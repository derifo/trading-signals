<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Serializable;


/**
 * Traders
 *
 * @ORM\Table(name="traders", indexes={@ORM\Index(name="active_deal_id", columns={"active_deal_id"})})
 * @ORM\Entity(repositoryClass="System\Repository\Traders")
 */
class Traders implements UserInterface, Serializable
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=120, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var MerchantsTraders
     *
     * @ORM\ManyToOne(targetEntity="MerchantsTraders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_trader_id", referencedColumnName="id")
     * })
     */
    private $merchantTrader;

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
     * Set email
     *
     * @param string $email
     *
     * @return Traders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Traders
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Traders
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
     * Set merchantTrader
     *
     * @param \System\Entity\MerchantsTraders $merchantTrader
     *
     * @return Traders
     */
    public function setMerchantTrader(\System\Entity\MerchantsTraders $merchantTrader = null)
    {
        $this->merchantTrader = $merchantTrader;

        return $this;
    }

    /**
     * Get merchantTrader
     *
     * @return \System\Entity\MerchantsTraders
     */
    public function getMerchantTrader()
    {
        return $this->merchantTrader;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return [ 'ROLE_TRADER' ];
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {}

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }
}
