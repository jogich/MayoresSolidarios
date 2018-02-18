<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user_id = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=10000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxMembers", type="integer", length=255)
     */
    private $maxMembers;

    /**
     * @var integer
     *
     * @ORM\Column(name="actualMembers", type="integer", length=255)
     */
    private $actualMembers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    private $date_create;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expiration", type="datetime", nullable=true)
     */
    private $date_expiration;

    /**
     * @var integer
     *
     * @ORM\Column(name="interestedPeople", type="integer", nullable=true)
     */
    private $interestedPeople;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="project_id")
     */
    private $user_id;

    /**
     * @ORM\Column(name="users", type="simple_array", nullable=true)
     */
    private $users = array();

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Project
     */
    public function setDateCreate($dateCreate)
    {
        $this->date_create = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * Set dateExpiration
     *
     * @param \DateTime $dateExpiration
     *
     * @return Project
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->date_expiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->date_expiration;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Project
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set maxMembers
     *
     * @param integer $maxMembers
     *
     * @return Project
     */
    public function setMaxMembers($maxMembers)
    {
        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * Get maxMembers
     *
     * @return integer
     */
    public function getMaxMembers()
    {
        return $this->maxMembers;
    }

    /**
     * Set actualMembers
     *
     * @param integer $actualMembers
     *
     * @return Project
     */
    public function setActualMembers($actualMembers)
    {
        $this->actualMembers = $actualMembers;

        return $this;
    }

    /**
     * Get actualMembers
     *
     * @return integer
     */
    public function getActualMembers()
    {
        return $this->actualMembers;
    }

    /**
     * Set interestedPeople
     *
     * @param integer $interestedPeople
     *
     * @return Project
     */
    public function setInterestedPeople($interestedPeople)
    {
        $this->interestedPeople = $interestedPeople;

        return $this;
    }

    /**
     * Get interestedPeople
     *
     * @return integer
     */
    public function getInterestedPeople()
    {
        return $this->interestedPeople;
    }

    /**
     * Add userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return Project
     */
    public function addUserId(\AppBundle\Entity\User $userId)
    {
        $this->user_id[] = $userId;

        return $this;
    }

    /**
     * Remove userId
     *
     * @param \AppBundle\Entity\User $userId
     */
    public function removeUserId(\AppBundle\Entity\User $userId)
    {
        $this->user_id->removeElement($userId);
    }

    /**
     * Get userId
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set users
     *
     * @param array $users
     *
     * @return Project
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }
}
