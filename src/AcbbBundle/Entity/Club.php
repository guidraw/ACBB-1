<?php

namespace AcbbBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club", indexes={@ORM\Index(name="fk_club_address1_idx", columns={"address_id"}), @ORM\Index(name="fk_club_media1_idx", columns={"logo_club_id"})})
 * @ORM\Entity
 */
class Club
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=85, nullable=false)
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
     * @var \AcbbBundle\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;

    /**
     * @var \AcbbBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="logo_club_id", referencedColumnName="id")
     * })
     */
    private $logoClub;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Media", mappedBy="club")
     */
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
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
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return Media
     */
    public function getLogoClub()
    {
        return $this->logoClub;
    }

    /**
     * @param Media $logoClub
     */
    public function setLogoClub($logoClub)
    {
        $this->logoClub = $logoClub;
    }

    /**
     * Add media
     *
     * @param Media $media
     *
     * @return Club
     */
    public function addMedia(Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param Media $media
     */
    public function removeMedia(Media $media)
    {
        $this->medias->removeElement($media);
    }

}
