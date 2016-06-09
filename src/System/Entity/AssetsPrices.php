<?php

namespace System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssetsPrices
 *
 * @ORM\Table(name="assets_prices", uniqueConstraints={@ORM\UniqueConstraint(name="asset_id_2", columns={"asset_id", "last_tick"})}, indexes={@ORM\Index(name="asset_id", columns={"asset_id"})})
 * @ORM\Entity
 */
class AssetsPrices
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
     * @var float
     *
     * @ORM\Column(name="high", type="float", precision=10, scale=0, nullable=false)
     */
    private $high;

    /**
     * @var float
     *
     * @ORM\Column(name="low", type="float", precision=10, scale=0, nullable=false)
     */
    private $low;

    /**
     * @var float
     *
     * @ORM\Column(name="open", type="float", precision=10, scale=0, nullable=false)
     */
    private $open;

    /**
     * @var float
     *
     * @ORM\Column(name="close", type="float", precision=10, scale=0, nullable=false)
     */
    private $close;

    /**
     * @var float
     *
     * @ORM\Column(name="live", type="float", precision=10, scale=0, nullable=false)
     */
    private $live;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_tick", type="datetime", nullable=false)
     */
    private $lastTick;

    /**
     * @var \Assets
     *
     * @ORM\ManyToOne(targetEntity="Assets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     * })
     */
    private $asset;



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
     * Set high
     *
     * @param float $high
     *
     * @return AssetsPrices
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Set low
     *
     * @param float $low
     *
     * @return AssetsPrices
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * Get low
     *
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Set open
     *
     * @param float $open
     *
     * @return AssetsPrices
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return float
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set close
     *
     * @param float $close
     *
     * @return AssetsPrices
     */
    public function setClose($close)
    {
        $this->close = $close;

        return $this;
    }

    /**
     * Get close
     *
     * @return float
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Set live
     *
     * @param float $live
     *
     * @return AssetsPrices
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return float
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Set lastTick
     *
     * @param \DateTime $lastTick
     *
     * @return AssetsPrices
     */
    public function setLastTick($lastTick)
    {
        $this->lastTick = $lastTick;

        return $this;
    }

    /**
     * Get lastTick
     *
     * @return \DateTime
     */
    public function getLastTick()
    {
        return $this->lastTick;
    }

    /**
     * Set asset
     *
     * @param \System\Entity\Assets $asset
     *
     * @return AssetsPrices
     */
    public function setAsset(\System\Entity\Assets $asset = null)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset
     *
     * @return \System\Entity\Assets
     */
    public function getAsset()
    {
        return $this->asset;
    }
}
