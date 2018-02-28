<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CasTest
 *
 * @ORM\Table(name="cas_test", indexes={@ORM\Index(name="FK_cas_test_id_cas_clinique", columns={"id_cas_clinique"}), @ORM\Index(name="FK_cas_test_id_test_spe", columns={"id_test_spe"}), @ORM\Index(name="FK_cas_test_id_sous_categorie", columns={"id_sous_categorie"}), @ORM\Index(name="IDX_D849B905BF396750", columns={"id"})})
 * @ORM\Entity
 */
class CasTest
{
    public function __toString() {
        return $this->name;
    }

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
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\TestVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idTestVideo;

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
     * @var \App\Entity\SousCategorie
     *
     * 
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="App\Entity\SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sous_categorie", referencedColumnName="id")
     * })
     */
    private $idSousCategorie;

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
     * @return \App\Entity\SousCategorie
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }

    /**
     * @param \App\Entity\SousCategorie $idSousCategorie
     *
     * @return self
     */
    public function setIdSousCategorie(\App\Entity\SousCategorie $idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;

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
}
