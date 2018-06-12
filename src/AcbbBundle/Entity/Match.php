<?php

namespace AcbbBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="match", indexes={@ORM\Index(name="fk_match_season1_idx", columns={"season_id"}), @ORM\Index(name="fk_match_category1_idx", columns={"category_id"}), @ORM\Index(name="fk_match_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_match_team1_idx", columns={"team1"}), @ORM\Index(name="fk_match_team2_idx", columns={"team2"}), @ORM\Index(name="fk_match_address1_idx", columns={"address_id"})})
 * @ORM\Entity
 */
class Match
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_team1", type="integer", nullable=false)
     */
    private $scoreTeam1;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_team2", type="integer", nullable=false)
     */
    private $scoreTeam2;

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
     * @var \AcbbBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \AcbbBundle\Entity\Season
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Season")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     * })
     */
    private $season;

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
     * @var \AcbbBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team1", referencedColumnName="id")
     * })
     */
    private $team1;

    /**
     * @var \AcbbBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team2", referencedColumnName="id")
     * })
     */
    private $team2;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Media", mappedBy="match")
     */
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->date = "12/07/2018";
        $this->id = 1;
        $this->address = "paris 16";
        $this->team1 = "te FILA";
        $this->team2 = "te LAFI";
        $this->season = "mars";
        $this->category = "Championnat";
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
    public function getScoreTeam1()
    {
        return $this->scoreTeam1;
    }

    /**
     * @param int $scoreTeam1
     */
    public function setScoreTeam1($scoreTeam1)
    {
        $this->scoreTeam1 = $scoreTeam1;
    }

    /**
     * @return int
     */
    public function getScoreTeam2()
    {
        return $this->scoreTeam2;
    }

    /**
     * @param int $scoreTeam2
     */
    public function setScoreTeam2($scoreTeam2)
    {
        $this->scoreTeam2 = $scoreTeam2;
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
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
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
     * @return Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * @param Team $team1
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
    }

    /**
     * @return Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @param Team $team2
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
    }

    /**
     * Add media
     *
     * @param Media $media
     *
     * @return Match
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

