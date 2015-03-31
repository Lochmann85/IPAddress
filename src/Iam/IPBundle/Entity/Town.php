<?php

namespace Iam\IPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Town
 */
class Town
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Iam\IPBundle\Entity\Country
     */
    private $country;


    /**
     * Set name
     *
     * @param string $name
     * @return Town
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
     * Set country
     *
     * @param \Iam\IPBundle\Entity\Country $country
     * @return Town
     */
    public function setCountry(\Iam\IPBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Iam\IPBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
