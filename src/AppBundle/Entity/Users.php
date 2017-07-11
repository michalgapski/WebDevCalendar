<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class Users
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
     * @ORM\Column(name="name", type="string", length=100)
     *
     *
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="workStart", type="integer")
     * @ORM\OneToMany(targetEntity="DateAndTime", mappedBy="userName")
     *  @Assert\NotBlank()
     */
    private $workStart;

    /**
     * @var int
     *
     * @ORM\Column(name="workEnd", type="integer")
     *
     *  @Assert\NotBlank()
     */
    private $workEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="timeZone", type="string", length=200)
     *
     *  @Assert\NotBlank()
     */
    private $timeZone;


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
     * Set name
     *
     * @param string $name
     *
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set workStart
     *
     * @param int $workStart
     *
     * @return Users
     */
    public function setWorkStart($workStart)
    {
        $this->workStart = $workStart;

        return $this;
    }

    /**
     * Get workStart
     *
     * @return int
     */
    public function getWorkStart()
    {
        return $this->workStart;
    }

    /**
     * Set workEnd
     *
     * @param int $workEnd
     *
     * @return Users
     */
    public function setWorkEnd($workEnd)
    {
        $this->workEnd = $workEnd;

        return $this;
    }

    /**
     * Get workEnd
     *
     * @return int
     */
    public function getWorkEnd()
    {
        return $this->workEnd;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     *
     * @return Users
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->name;
    }
}
