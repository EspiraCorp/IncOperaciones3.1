<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProveedoresTipo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProveedoresTipo
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="proveedortipo")
     * 
     */
    protected $proveedores;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proveedores = new ArrayCollection();
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
     * @return ProveedoresTipo
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
     * Add proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedores
     * @return ProveedoresTipo
     */
    public function addProveedore(\Incentives\OperacionesBundle\Entity\Proveedores $proveedores)
    {
        $this->proveedores[] = $proveedores;
    
        return $this;
    }

    /**
     * Remove proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedor $proveedores
     */
    public function removeProveedore(\Incentives\OperacionesBundle\Entity\Proveedores $proveedores)
    {
        $this->proveedores->removeElement($proveedores);
    }

    /**
     * Get proveedores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProveedores()
    {
        return $this->proveedores;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return ProveedoresTipo
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return ProveedoresTipo
     */
    public function setUsuario(\Incentives\BaseBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}