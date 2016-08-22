<?php

namespace Incentives\BaseBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Entity
 * @ORM\Table(name="Grupo")
 */
class Grupo extends Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="grupos")
     */
    private $usuarios;

    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="grupos")
     * @ORM\JoinTable(name="menu_grupo",
     *     joinColumns={@ORM\JoinColumn(name="menu_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="grupo_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
     
    private $menus;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Grupo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Grupo
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add users
     *
     * @param \Acme\UserBundle\Entity\User $users
     * @return Grupo
     */
    public function addUser(\Acme\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Acme\UserBundle\Entity\User $users
     */
    public function removeUser(\Acme\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add usuarios
     *
     * @param \Incentives\BaseBundle\Entity\User $usuarios
     * @return Grupo
     */
    public function addUsuario(\Incentives\BaseBundle\Entity\User $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Incentives\BaseBundle\Entity\User $usuarios
     */
    public function removeUsuario(\Incentives\BaseBundle\Entity\User $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add menus
     *
     * @param \Incentives\BaseBundle\Entity\Menu $menus
     * @return Grupo
     */
    public function addMenu(\Incentives\BaseBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;
    
        return $this;
    }

    /**
     * Remove menus
     *
     * @param \Incentives\BaseBundle\Entity\Menu $menus
     */
    public function removeMenu(\Incentives\BaseBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }
}
