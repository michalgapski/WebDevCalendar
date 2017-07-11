<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateAndTime
 *
 * @ORM\Table(name="date_and_time")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DateAndTimeRepository")
 */
class DateAndTime
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="name")
     * @ORM\JoinColumn(name="name", referencedColumnName="userName")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="hour", type="integer")
     */
    private $hour;

    /**
     * @var string
     *
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $userName;


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
     * Set date
     *
     * @param string $date
     *
     * @return DateAndTime
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hour
     *
     * @param integer $hour
     *
     * @return DateAndTime
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return int
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return DateAndTime
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }
    public function __toString() {
        return $this->userName;
    }
}
