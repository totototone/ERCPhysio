<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions", indexes={@ORM\Index(name="FK_questions_id_test", columns={"id_test"})})
 * @ORM\Entity
 */
class Questions
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="question", type="text", length=65535, nullable=true)
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\Test
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Test")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_test", referencedColumnName="id")
     * })
     */
    private $idTest;



    /**
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string|null $question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

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
     * @return \App\Entity\Test
     */
    public function getIdTest()
    {
        return $this->idTest;
    }

    /**
     * @param \App\Entity\Test $idTest
     *
     * @return self
     */
    public function setIdTest(\App\Entity\Test $idTest)
    {
        $this->idTest = $idTest;

        return $this;
    }
}
