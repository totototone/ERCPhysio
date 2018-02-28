<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestValidation
 *
 * @ORM\Table(name="test_validation", indexes={@ORM\Index(name="FK_test_validation_id", columns={"id"})})
 * @ORM\Entity
 */
class TestValidation
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="good_com", type="text", length=65535, nullable=true)
     */
    private $goodCom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bad_com", type="text", length=65535, nullable=true)
     */
    private $badCom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prev", type="integer", nullable=true)
     */
    private $prev;

    /**
     * @var int
     *
     * @ORM\Column(name="right_choice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rightChoice;

    /**
     * @var \App\Entity\Reponses
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Reponses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;



    /**
     * @return string|null
     */
    public function getGoodCom()
    {
        return $this->goodCom;
    }

    /**
     * @param string|null $goodCom
     *
     * @return self
     */
    public function setGoodCom($goodCom)
    {
        $this->goodCom = $goodCom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBadCom()
    {
        return $this->badCom;
    }

    /**
     * @param string|null $badCom
     *
     * @return self
     */
    public function setBadCom($badCom)
    {
        $this->badCom = $badCom;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @param int|null $prev
     *
     * @return self
     */
    public function setPrev($prev)
    {
        $this->prev = $prev;

        return $this;
    }

    /**
     * @return int
     */
    public function getRightChoice()
    {
        return $this->rightChoice;
    }

    /**
     * @param int $rightChoice
     *
     * @return self
     */
    public function setRightChoice($rightChoice)
    {
        $this->rightChoice = $rightChoice;

        return $this;
    }

    /**
     * @return \App\Entity\Reponses
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \App\Entity\Reponses $id
     *
     * @return self
     */
    public function setId(\App\Entity\Reponses $id)
    {
        $this->id = $id;

        return $this;
    }
}
