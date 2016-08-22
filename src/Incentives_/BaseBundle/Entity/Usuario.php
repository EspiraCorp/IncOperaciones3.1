<?php
// src/Incentives/BaseBundle/Entity/User.php
namespace Incentives\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Incentives\BaseBundle\Entity\Usuario;

/**
 * Incentives\BaseBundle\Entity\User
 *
 * @ORM\Table(name="Usuarios")
 * @ORM\Entity(repositoryClass="Incentives\BaseBundle\Entity\UserRepository")
 */
class Usuario implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="usuarios", cascade={"persist", "remove"})
     *
     */
    private $grupos;

     /**
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Proveedores", inversedBy="usuarios", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", nullable=true)
     *
     */
    private $proveedor;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Cliente", inversedBy="usuarios", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=true)
     *
     */
    private $cliente;
    

    /**
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\SolicitudesAsignar", mappedBy="responsable")
     * 
     */
    protected $solicitudasignar;

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->grupos = new ArrayCollection();
        $this->proveedor = new ArrayCollection();
        $this->proveedorhistorico = new ArrayCollection();
        $this->proveedorcalificacion = new ArrayCollection();
        $this->ordenhistorico = new ArrayCollection();
        $this->convocatoriashistorico = new ArrayCollection();
        $this->ordenproductohistorico = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->grupos->toArray();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        return $this->id === $user->getId();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        if(isset($password) && $password!=""){
            $this->password = sha1($password.'{'.$this->salt.'}');
        }

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }



    /**
     * Set grupos
     *
     * @param \Incentives\BaseBundle\Entity\Grupo $grupos
     * @return Usuario
     */
    public function setGrupos(\Incentives\BaseBundle\Entity\Grupo $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }
    
    /**
     * Add grupos
     *
     * @param \Incentives\BaseBundle\Entity\Grupo $grupos
     * @return Usuario
     */
    public function addGrupo(\Incentives\BaseBundle\Entity\Grupo $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \Incentives\BaseBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\Incentives\BaseBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     * @return Usuario
     */
    public function setProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Incentives\OperacionesBundle\Entity\Proveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
    
    /**
     * Add solicitudasignar
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $solicitudasignar
     * @return Usuario
     */
    public function addSolicitudasignar(\Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $solicitudasignar)
    {
        $this->solicitudasignar[] = $solicitudasignar;
    
        return $this;
    }

    /**
     * Remove solicitudasignar
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $solicitudasignar
     */
    public function removeSolicitudasignar(\Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $solicitudasignar)
    {
        $this->solicitudasignar->removeElement($solicitudasignar);
    }

    /**
     * Get solicitudasignar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudasignar()
    {
        return $this->solicitudasignar;
    }

    /**
     * Set cliente
     *
     * @param \Incentives\CatalogoBundle\Entity\Cliente $cliente
     * @return Usuario
     */
    public function setCliente(\Incentives\CatalogoBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Incentives\CatalogoBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}