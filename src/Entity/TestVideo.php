<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * TestVideo
 *
 * @ORM\Table(name="test_video")
 * @ORM\Entity
 * @Vich\Uploadable
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
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @Vich\UploadableField(mapping="videos", fileNameProperty="video", size="videoSize")
     * @var File
     */
    private $videoFile;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $videoSize;


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
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;




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

    public function setVideoFile(File $video = null)
    {
        $this->videoFile = $video;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($video) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }



    /**
     * Get the value of Video File
     *
     * @return File
     */
    public function getVideoFile()
    {
        return $this->videoFile;
    }

    /**
     * Get the value of Updated At
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of Updated At
     *
     * @param \DateTime updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    /**
     * Get the value of Video Size
     *
     * @return integer
     */
    public function getVideoSize()
    {
        return $this->videoSize;
    }

    /**
     * Set the value of Video Size
     *
     * @param integer videoSize
     *
     * @return self
     */
    public function setVideoSize($videoSize)
    {
        $this->videoSize = $videoSize;

        return $this;
    }

}
