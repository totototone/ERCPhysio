<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie", indexes={@ORM\Index(name="FK_categorie_id_champs_clinique", columns={"id_champs_clinique"})})
 * @ORM\Entity
 */
class Categorie
{
    public function __toString() {
        return $this->name;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\ChampsClinique
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ChampsClinique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_champs_clinique", referencedColumnName="id")
     * })
     */
    private $idChampsClinique;



    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return \App\Entity\ChampsClinique
     */
    public function getIdChampsClinique()
    {
        return $this->idChampsClinique;
    }

    /**
     * @param \App\Entity\ChampsClinique $idChampsClinique
     *
     * @return self
     */
    public function setIdChampsClinique(\App\Entity\ChampsClinique $idChampsClinique)
    {
        $this->idChampsClinique = $idChampsClinique;

        return $this;
    }
}
