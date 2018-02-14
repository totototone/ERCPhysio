<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hypotheses
 *
 * @ORM\Table(name="hypotheses", indexes={@ORM\Index(name="FK_hypotheses_id_cas_clinique", columns={"id_cas_clinique"})})
 * @ORM\Entity
 */
class Hypotheses
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="hypothese", type="text", length=65535, nullable=true)
     */
    private $hypothese;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\Entity\CasClinique
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CasClinique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cas_clinique", referencedColumnName="id")
     * })
     */
    private $idCasClinique;



    /**
     * @return string|null
     */
    public function getHypothese()
    {
        return $this->hypothese;
    }

    /**
     * @param string|null $hypothese
     *
     * @return self
     */
    public function setHypothese($hypothese)
    {
        $this->hypothese = $hypothese;

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
}
