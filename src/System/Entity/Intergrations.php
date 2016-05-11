<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intergrations
 *
 * @ORM\Table(name="intergrations")
 * @ORM\Entity
 */
class Intergrations
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
     * @ORM\Column(name="title", type="string", length=80, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="adapter", type="string", length=80, nullable=false)
     */
    private $adapter;



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
     * @return Intergrations
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
     * Set adapter
     *
     * @param string $adapter
     *
     * @return Intergrations
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Get adapter
     *
     * @return string
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
