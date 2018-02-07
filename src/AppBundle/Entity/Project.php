<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="Project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="necessaryBudget", type="integer", length=255)
     */
    private $necessaryBudget;

    /**
     * @var int
     *
     * @ORM\Column(name="budgetObtained", type="integer")
     */
    private $budgetObtained;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirationDate", type="datetimetz", nullable=true)
     */
    private $expirationDate;


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
     * Set address
     *
     * @param string $address
     *
     * @return Project
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set necessaryBudget
     *
     * @param string $necessaryBudget
     *
     * @return Project
     */
    public function setNecessaryBudget($necessaryBudget)
    {
        $this->necessaryBudget = $necessaryBudget;

        return $this;
    }

    /**
     * Get necessaryBudget
     *
     * @return string
     */
    public function getNecessaryBudget()
    {
        return $this->necessaryBudget;
    }

    /**
     * Set budgetObtained
     *
     * @param integer $budgetObtained
     *
     * @return Project
     */
    public function setBudgetObtained($budgetObtained)
    {
        $this->budgetObtained = $budgetObtained;

        return $this;
    }

    /**
     * Get budgetObtained
     *
     * @return integer
     */
    public function getBudgetObtained()
    {
        return $this->budgetObtained;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Project
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }
}
