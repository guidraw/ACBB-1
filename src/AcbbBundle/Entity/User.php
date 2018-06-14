<?php

namespace AcbbBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="fk_user_address1_idx", columns={"address_id"}), @ORM\Index(name="fk_user_media1_idx", columns={"photo_id"}), @ORM\Index(name="fk_user_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_user_nationality1_idx", columns={"nationality_id"}), @ORM\Index(name="fk_user_status2_idx", columns={"family_situation"})})
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var date
     *
     * @ORM\Column(name="date_birth", type="date", nullable=false)
     */
    private $dateBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=20,nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=45,nullable=true)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="job_phone", type="string", length=20, nullable=true)
     */
    private $jobPhone;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \AcbbBundle\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id",nullable=true)
     */
    private $address;

    /**
     * @var \AcbbBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Media")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id",nullable=true)
     */
    private $photo;

    /**
     * @var \AcbbBundle\Entity\Nationality
     *
     * @ORM\ManyToOne(targetEntity="Nationality", inversedBy="users")
     * @ORM\JoinColumn(name="nationality_id", referencedColumnName="id",nullable=true)
     */
    private $nationality;

    /**
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id",nullable=true)
     */
    private $status;

    /**
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="familySituations")
     * @ORM\JoinColumn(name="family_situation", referencedColumnName="id",nullable=true)
     */
    private $familySituation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="users")
     */
    private $team;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="tutors")
     * @ORM\JoinTable(name="user_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tutor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tutor;

    /**
     * Many Users have Many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="tutor")
     */
    private $tutors;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->tutor = new ArrayCollection();
        $this->tutors = new ArrayCollection();
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
     * @return string
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * @param string $placeBirth
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

    /**
     * @return string
     */
    public function getJobPhone()
    {
        return $this->jobPhone;
    }

    /**
     * @param string $jobPhone
     */
    public function setJobPhone($jobPhone)
    {
        $this->jobPhone = $jobPhone;
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
     * @return Media
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param Media $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return Nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param Nationality $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
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
     * @return Status
     */
    public function getFamilySituation()
    {
        return $this->familySituation;
    }

    /**
     * @param Status $familySituation
     */
    public function setFamilySituation($familySituation)
    {
        $this->familySituation = $familySituation;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $tutor
     */
    public function setTutor($tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


}

