<?php

namespace AcbbBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team", indexes={@ORM\Index(name="fk_team_club1_idx", columns={"club_id"}), @ORM\Index(name="fk_team_category1_idx", columns={"category_id"}), @ORM\Index(name="fk_team_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Team
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
     * @var \AcbbBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \AcbbBundle\Entity\Club
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     * })
     */
    private $club;

    /**
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="team")
     * @ORM\JoinTable(name="belong",
     *   joinColumns={
     *     @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $users;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Media", inversedBy="teams")
     * @ORM\JoinTable(name="team_has_media",
     *   joinColumns={
     *     @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     *   }
     * )
     */
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    /**
     * @return Club
     */
    public function getClub()
    {
        return $this->club;
    }

    public function getUsers(){
        return $this->users;
    }

    /**
     * @param Club $club
     */
    public function setClub($club)
    {
        $this->club = $club;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias(): \Doctrine\Common\Collections\Collection
    {
        return $this->medias;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $medias
     */
    public function setMedias(\Doctrine\Common\Collections\Collection $medias)
    {
        $this->medias = $medias;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return Team
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Add media
     *
     * @param Media $media
     *
     * @return Team
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

