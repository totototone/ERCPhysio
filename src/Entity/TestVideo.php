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
     * @ORM\Column(name="scenarios_name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="video", type="string", length=50, nullable=true)
     */
    private $video;

    /**
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
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Video
     *
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }
 
    /**
     * Set the value of Video
     *
     * @param mixed video
     *
     * @return self
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Id Sous Categorie
     *
     * @return mixed
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }

    /**
     * Set the value of Id Sous Categorie
     *
     * @param mixed idSousCategorie
     *
     * @return self
     */
    public function setIdSousCategorie($idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;

        return $this;
    }

}
