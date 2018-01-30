<?php

namespace AcbbBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="fk_media_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Media
{
    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Album", inversedBy="media")
     * @ORM\JoinTable(name="media_album",
     *   joinColumns={
     *     @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     *   }
     * )
     */
    private $albums;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Club", inversedBy="media")
     * @ORM\JoinTable(name="media_club",
     *   joinColumns={
     *     @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     *   }
     * )
     */
    private $clubs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Match", inversedBy="media")
     * @ORM\JoinTable(name="media_match",
     *   joinColumns={
     *     @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     *   }
     * )
     */
    private $matches;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Team", mappedBy="media")
     */
    private $teams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->clubs = new ArrayCollection();
        $this->matches = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * Add album
     *
     * @param Album $album
     *
     * @return Media
     */
    public function addAlbum(Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param Album $album
     */
    public function removeAlbum(Album $album)
    {
        $this->albums->removeElement($album);
    }

    /**
     * Add club
     *
     * @param Club $club
     *
     * @return Media
     */
    public function addClub(Club $club)
    {
        $this->clubs[] = $club;

        return $this;
    }

    /**
     * Remove club
     *
     * @param Club $club
     */
    public function removeClub(Club $club)
    {
        $this->clubs->removeElement($club);
    }

    /**
     * Add matches
     *
     * @param Match $match
     *
     * @return Media
     */
    public function addMatch(Match $match)
    {
        $this->matches[] = $match;

        return $this;
    }

    /**
     * Remove match
     *
     * @param Match $match
     */
    public function removeMatch(Match $match)
    {
        $this->matches->removeElement($match);
    }

    /**
     * Add team
     *
     * @param Team $team
     *
     * @return Media
     */
    public function addTeam(Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param Team $team
     */
    public function removeTeam(Team $team)
    {
        $this->teams->removeElement($team);
    }

}
