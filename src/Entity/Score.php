<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score", indexes={@ORM\Index(name="FK_score_id_test_video", columns={"id_test_video"}), @ORM\Index(name="FK_score_id_cas_clinique", columns={"id_cas_clinique"}), @ORM\Index(name="FK_score_id_test_spe", columns={"id_test_spe"}), @ORM\Index(name="IDX_32993751BF396750", columns={"id"})})
 * @ORM\Entity
 */
class Score
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var float|null
     *
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=true)
     */
    private $score;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\Users
     *
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \App\Entity\CasClinique
     *
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\CasClinique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cas_clinique", referencedColumnName="id")
     * })
     */
    private $idCasClinique;

    /**
     * @var \App\Entity\TestSpe
     *
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\TestSpe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_test_spe", referencedColumnName="id")
     * })
     */
    private $idTestSpe;

    /**
     * @var \App\Entity\TestVideo
     *
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\TestVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_test_video", referencedColumnName="id")
     * })
     */
    private $idTestVideo;    

    /**
     * @return float|null
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float|null $score
     *
     * @return self
     */
    public function setScore($score)
    {
        $this->score = $score;

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
     * @return \App\Entity\Users
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \App\Entity\Users $idUser
     *
     * @return self
     */
    public function setIdUser(\App\Entity\Users $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return \App\Entity\CasClinique
     */
    public function getIdCasClinique()
    {
        return $this->idCasClinique;
    }

    /**
     * @param \App\Entity\CasClinique $idCasClinique
     *
     * @return self
     */
    public function setIdCasClinique(\App\Entity\CasClinique $idCasClinique)
    {
        $this->idCasClinique = $idCasClinique;

        return $this;
    }

    /**
     * @return \App\Entity\TestSpe
     */
    public function getIdTestSpe()
    {
        return $this->idTestSpe;
    }

    /**
     * @param \App\Entity\TestSpe $idTestSpe
     *
     * @return self
     */
    public function setIdTestSpe(\App\Entity\TestSpe $idTestSpe)
    {
        $this->idTestSpe = $idTestSpe;

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
