<?php

namespace Iam\IPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voucher
 */
class Voucher
{
    /**
     * @var string
     */
    private $descriptionCompact;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Iam\IPBundle\Entity\Town
     */
    private $town;


    /**
     * Set descriptionCompact
     *
     * @param string $descriptionCompact
     * @return Voucher
     */
    public function setDescriptionCompact($descriptionCompact)
    {
        $this->descriptionCompact = $descriptionCompact;

        return $this;
    }

    /**
     * Get descriptionCompact
     *
     * @return string 
     */
    public function getDescriptionCompact()
    {
        return $this->descriptionCompact;
    }

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
     * Set town
     *
     * @param \Iam\IPBundle\Entity\Town $town
     * @return Voucher
     */
    public function setTown(\Iam\IPBundle\Entity\Town $town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \Iam\IPBundle\Entity\Town 
     */
    public function getTown()
    {
        return $this->town;
    }
}
