<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions", indexes={@ORM\Index(name="FK_questions_id_test_video", columns={"id_test_video"})})
 * @ORM\Entity
 */
class Question
{
    public function __toString() {
        return $this->question;
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
     * @ORM\Column(name="question", type="string", length=510, nullable=true)
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
     * @var \App\Entity\TestVideo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TestVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_test_video", referencedColumnName="id")
     * })
     */
    private $testVideo;



    /**
     * Get the value of Stop
     *
     * @return int|null
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * Set the value of Stop
     *
     * @param int|null stop
     *
     * @return self
     */
    public function setStop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param string|null question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

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
     * Get the value of Test Video
     *
     * @return \App\Entity\TestVideo
     */
    public function getTestVideo()
    {
        return $this->testVideo;
    }

    /**
     * Set the value of Test Video
     *
     * @param \App\Entity\TestVideo testVideo
     *
     * @return self
     */
    public function setTestVideo($testVideo)
    {
        $this->testVideo = $testVideo;

        return $this;
    }

}
