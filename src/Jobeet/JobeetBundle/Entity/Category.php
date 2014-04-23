<?php

namespace Jobeet\JobeetBundle\Entity;

/**
 * Category
 */
class Category
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $affiliate;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->affiliate = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string   $name
     * @return Category
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
     * Get categoryId
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($categoryId)
    {
        $this->id = $categoryId;
    }

    /**
     * Add affiliate
     *
     * @param  \Jobeet\JobeetBundle\Entity\Affiliate $affiliate
     * @return Category
     */
    public function addAffiliate(\Jobeet\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliate[] = $affiliate;

        return $this;
    }

    /**
     * Remove affiliate
     *
     * @param \Jobeet\JobeetBundle\Entity\Affiliate $affiliate
     */
    public function removeAffiliate(\Jobeet\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliate->removeElement($affiliate);
    }

    /**
     * Get affiliate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffiliate()
    {
        return $this->affiliate;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
