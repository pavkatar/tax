<?php

namespace CommerceGuys\Tax;

use CommerceGuys\Zone\ZoneInterface;

class TaxType implements TaxTypeInterface
{
    /**
     * The tax type id.
     *
     * @var string
     */
    protected $id;

    /**
     * The tax type name.
     *
     * @var string
     */
    protected $name;

    /**
     * Whether the tax type is compound.
     *
     * @var boolean
     */
    protected $compound;

    /**
     * The tax type rounding mode.
     *
     * @var integer
     */
    protected $roundingMode;

    /**
     * The tax type zone.
     *
     * @var ZoneInterface
     */
    protected $zone;

    /**
     * The tax rates.
     *
     * @var TaxRate[]
     */
    protected $rates;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isCompound()
    {
        return !empty($this->compound);
    }

    /**
     * {@inheritdoc}
     */
    public function setCompound($compound)
    {
        $this->compound = $compound;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoundingMode()
    {
        return $this->roundingMode;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoundingMode($roundingMode)
    {
        $this->roundingMode = $roundingMode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * {@inheritdoc}
     */
    public function setZone(ZoneInterface $zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * {@inheritdoc}
     */
    public function setRates($rates)
    {
        $this->rates = $rates;

        return $this;
    }
}