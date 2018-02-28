<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions", indexes={@ORM\Index(name="FK_questions_id_test_video", columns={"id_test_video"})})
 * @ORM\Entity
 */
class Questions
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var int|null
     *
     * @ORM\Column(name="stop", type="integer", nullable=true)
     */
    private $stop;

    /**
     * @var string|null
     *
     * @ORM\Column(name="question", type="text", length=65535, nullable=true)
     */
    private $question;

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
     * @var \App\Entity\TestVideo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TestVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_test_video", referencedColumnName="id")
     * })
     */
    private $idTestVideo;



    /**
     * @return int|null
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param int|null $stop
     *
     * @return self
     */
    public function setStop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

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
     * @return \App\Entity\TestVideo
     */
    public function getIdTestVideo()
    {
        return $this->idTestVideo;
    }

    /**
     * @param \App\Entity\TestVideo $idTestVideo
     *
     * @return self
     */
    public function setIdTestVideo(\App\Entity\TestVideo $idTestVideo)
    {
        $this->idTestVideo = $idTestVideo;

        return $this;
    }
}
