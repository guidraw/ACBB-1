<?php

namespace AcbbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 */
class Status
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AcbbBundle\Entity\Category
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="status")
     */
    private $category;

    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="News", mappedBy="status")
     */
    private $news;

    /**
     * @var \AcbbBundle\Entity\User
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="familySituation")
     */
    private $familySituations;

    public function __construct() {
        $this->category = new ArrayCollection();
        $this->familySituations = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}

