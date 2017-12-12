<?php

namespace AcbbBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    private $placeBirth;

    /**
     * @var string
     */
    private $job;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set placeBirth
     *
     * @param string $placeBirth
     *
     * @return User
     */
    public function setPlaceBirth($placeBirth)
    {
        $this->placeBirth = $placeBirth;

        return $this;
    }

    /**
     * Get placeBirth
     *
     * @return string
     */
    public function getPlaceBirth()
    {
        return $this->placeBirth;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }
}

