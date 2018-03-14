<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponses
 *
 * @ORM\Table(name="reponses")
 * @ORM\Entity
 */
class Reponse
{
    public function __toString() {
        return $this->reponse;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="reponse", type="string", length=65535, nullable=true)
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
     * @var \App\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_questions", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @ORM\Column(name="juste", type="boolean", nullable=true)
     */
    private $juste;





    /**
     * Get the value of Reponse
     *
     * @return string|null
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set the value of Reponse
     *
     * @param string|null reponse
     *
     * @return self
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return \App\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param \App\Entity\Question question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }


    /**
     * Get the value of Juste
     *
     * @return mixed
     */
    public function getJuste()
    {
        return $this->juste;
    }

    /**
     * Set the value of Juste
     *
     * @param mixed juste
     *
     * @return self
     */
    public function setJuste($juste)
    {
        $this->juste = $juste;

        return $this;
    }

}
