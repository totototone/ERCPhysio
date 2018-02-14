<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestSpe
 *
 * @ORM\Table(name="test_spe", indexes={@ORM\Index(name="FK_test_spe_id_categorie", columns={"id_categorie"})})
 * @ORM\Entity
 */
class TestSpe
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=true)
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
     * @var \App\Entity\Categorie
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id")
     * })
     */
    private $idCategorie;



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
     * @return \App\Entity\Categorie
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * @param \App\Entity\Categorie $idCategorie
     *
     * @return self
     */
    public function setIdCategorie(\App\Entity\Categorie $idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
