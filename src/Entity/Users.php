<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="FK_users_id_roles", columns={"id_roles"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="role", type="integer", nullable=true)
     */
    private $role;

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
     * @var \App\Entity\Roles
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_roles", referencedColumnName="id")
     * })
     */
    private $idRoles;

    /**
     * @return int|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int|null $role
     *
     * @return self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

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
     * @return \App\Entity\Roles
     */
    public function getIdRoles()
    {
        return $this->idRoles;
    }

    /**
     * @param \App\Entity\Roles $idRoles
     *
     * @return self
     */
    public function setIdRoles(\App\Entity\Roles $idRoles)
    {
        $this->idRoles = $idRoles;

        return $this;
    }
}
