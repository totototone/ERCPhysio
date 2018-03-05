<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestVideo
 *
 * @ORM\Table(name="test_video")
 * @ORM\Entity
 */
class TestVideo
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="scenarios_name", type="string", length=50, nullable=true)
     */
    private $scenariosName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="video", type="string", length=50, nullable=true)
     */
    private $video;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_souscategorie", referencedColumnName="id")
     * })
     */
    private $idSousCategorie;




 

    /**
     * @return string|null
     */
    public function getScenariosName()
    {
        return $this->scenariosName;
    }

    /**
     * @param string|null $scenariosName
     *
     * @return self
     */
    public function setScenariosName($scenariosName)
    {
        $this->scenariosName = $scenariosName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string|null $video
     *
     * @return self
     */
    public function setVideo($video)
    {
        $this->video = $video;

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
     * @return mixed
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }

    /**
     * @param mixed $idSousCategorie
     *
     * @return self
     */
    public function setIdSousCategorie($idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;

        return $this;
    }
}
