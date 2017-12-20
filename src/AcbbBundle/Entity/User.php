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
     * @var string
     *
     * @ORM\Column(name="place_birth", type="string", length=45, nullable=false)
     */
    private $placeBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=45, nullable=false)
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
     *   @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     * })
     */
    private $photo;

    /**
     * @var \AcbbBundle\Entity\Nationality
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Nationality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nationality_id", referencedColumnName="id")
     * })
     */
    private $nationality;

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
     * @var \AcbbBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AcbbBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="family_situation", referencedColumnName="id")
     * })
     */
    private $familySituation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\Team", mappedBy="user")
     */
    private $team;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AcbbBundle\Entity\User", inversedBy="user")
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
     * Constructor
     */
    public function __construct()
    {
        $this->team = new ArrayCollection();
        $this->tutor = new ArrayCollection();
    }


}

