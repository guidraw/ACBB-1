<?php

namespace AcbbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membership
 *
 * @ORM\Table(name="membership", indexes={@ORM\Index(name="fk_member_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_member_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_member_season1_idx", columns={"season_id"}), @ORM\Index(name="fk_adherent_insurance1_idx", columns={"insurance_id"}), @ORM\Index(name="fk_membership_tariff1_idx", columns={"price_id"}), @ORM\Index(name="fk_membership_status1_idx", columns={"email_status"}), @ORM\Index(name="fk_membership_status2_idx", columns={"phone_status"})})
 * @ORM\Entity
 */
class Membership
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=100, nullable=false)
     */
    private $comment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emergency", type="boolean", nullable=false)
     */
    private $emergency;

    /**
     * @var string
     *
     * @ORM\Column(name="medicament_allergy", type="string", length=200, nullable=true)
     */
    private $medicamentAllergy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antidoping", type="boolean", nullable=false)
     */
    private $antidoping;

    /**
     * @var boolean
     *
     * @ORM\Column(name="trip", type="boolean", nullable=false)
     */
    private $trip;

    /**
     * @var boolean
     *
     * @ORM\Column(name="image_right", type="boolean", nullable=false)
     */
    private $imageRight;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rules", type="boolean", nullable=false)
     */
    private $rules;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AcbbBundle\Entity\Insurance
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Insurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="insurance_id", referencedColumnName="id")
     * })
     */
    private $insurance;

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
     * @var \AcbbBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email_status", referencedColumnName="id")
     * })
     */
    private $emailStatus;

    /**
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="phone_status", referencedColumnName="id")
     * })
     */
    private $phoneStatus;

    /**
     * @var \AcbbBundle\Entity\Price
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     * })
     */
    private $price;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return bool
     */
    public function isEmergency()
    {
        return $this->emergency;
    }

    /**
     * @param bool $emergency
     */
    public function setEmergency($emergency)
    {
        $this->emergency = $emergency;
    }

    /**
     * @return string
     */
    public function getMedicamentAllergy()
    {
        return $this->medicamentAllergy;
    }

    /**
     * @param string $medicamentAllergy
     */
    public function setMedicamentAllergy($medicamentAllergy)
    {
        $this->medicamentAllergy = $medicamentAllergy;
    }

    /**
     * @return bool
     */
    public function isAntidoping()
    {
        return $this->antidoping;
    }

    /**
     * @param bool $antidoping
     */
    public function setAntidoping($antidoping)
    {
        $this->antidoping = $antidoping;
    }

    /**
     * @return bool
     */
    public function isTrip()
    {
        return $this->trip;
    }

    /**
     * @param bool $trip
     */
    public function setTrip($trip)
    {
        $this->trip = $trip;
    }

    /**
     * @return bool
     */
    public function isImageRight()
    {
        return $this->imageRight;
    }

    /**
     * @param bool $imageRight
     */
    public function setImageRight($imageRight)
    {
        $this->imageRight = $imageRight;
    }

    /**
     * @return bool
     */
    public function isRules()
    {
        return $this->rules;
    }

    /**
     * @param bool $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
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
     * @return Insurance
     */
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * @param Insurance $insurance
     */
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Status
     */
    public function getEmailStatus()
    {
        return $this->emailStatus;
    }

    /**
     * @param Status $emailStatus
     */
    public function setEmailStatus($emailStatus)
    {
        $this->emailStatus = $emailStatus;
    }

    /**
     * @return Status
     */
    public function getPhoneStatus()
    {
        return $this->phoneStatus;
    }

    /**
     * @param Status $phoneStatus
     */
    public function setPhoneStatus($phoneStatus)
    {
        $this->phoneStatus = $phoneStatus;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Price $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}

