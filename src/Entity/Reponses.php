<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponses
 *
 * @ORM\Table(name="reponses", indexes={@ORM\Index(name="FK_reponses_id_questions", columns={"id_questions"}), @ORM\Index(name="FK_reponses_right_choice", columns={"right_choice"})})
 * @ORM\Entity
 */
class Reponses
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="reponse", type="text", length=65535, nullable=true)
     */
    private $reponse;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\Questions
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Questions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_questions", referencedColumnName="id")
     * })
     */
    private $idQuestions;

    /**
     * @var \App\Entity\TestValidation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TestValidation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="right_choice", referencedColumnName="right_choice")
     * })
     */
    private $rightChoice;



    /**
     * @return string|null
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param string|null $reponse
     *
     * @return self
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
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
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \App\Entity\Questions
     */
    public function getIdQuestions()
    {
        return $this->idQuestions;
    }

    /**
     * @param \App\Entity\Questions $idQuestions
     *
     * @return self
     */
    public function setIdQuestions(\App\Entity\Questions $idQuestions)
    {
        $this->idQuestions = $idQuestions;

        return $this;
    }

    /**
     * @return \App\Entity\TestValidation
     */
    public function getRightChoice()
    {
        return $this->rightChoice;
    }

    /**
     * @param \App\Entity\TestValidation $rightChoice
     *
     * @return self
     */
    public function setRightChoice(\App\Entity\TestValidation $rightChoice)
    {
        $this->rightChoice = $rightChoice;

        return $this;
    }
}
