<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tipodocumento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tipodocumento
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="tipodocumento")
     */
    protected $proveedores;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\Cliente", mappedBy="tipodocumento")
     */
    protected $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Courier", mappedBy="tipodocumento")
     */
    protected $courier;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Participantes", mappedBy="tipodocumento")
     */
    protected $participantes;

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

    public function __construct()
    {
        $this->proveedores = new ArrayCollection();
        $this->cliente = new ArrayCollection();
        $this->participantes = new ArrayCollection();
        $this->courier = new ArrayCollection();
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
     * @return Tipodocumento
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
     * @return Tipodocumento
     */
    public function addProveedore(\Incentives\OperacionesBundle\Entity\Proveedores $proveedores)
    {
        $this->proveedores[] = $proveedores;
    
        return $this;
    }

    /**
     * Remove proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedores
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
     * Add cliente
     *
     * @param \Incentives\CatalogoBundle\Entity\Cliente $cliente
     * @return Tipodocumento
     */
    public function addCliente(\Incentives\CatalogoBundle\Entity\Cliente $cliente)
    {
        $this->cliente[] = $cliente;
    
        return $this;
    }

    /**
     * Remove cliente
     *
     * @param \Incentives\CatalogoBundle\Entity\Cliente $cliente
     */
    public function removeCliente(\Incentives\CatalogoBundle\Entity\Cliente $cliente)
    {
        $this->cliente->removeElement($cliente);
    }

    /**
     * Get cliente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add courier
     *
     * @param \Incentives\InventarioBundle\Entity\Courier $courier
     * @return Tipodocumento
     */
    public function addCourier(\Incentives\InventarioBundle\Entity\Courier $courier)
    {
        $this->courier[] = $courier;
    
        return $this;
    }

    /**
     * Remove courier
     *
     * @param \Incentives\InventarioBundle\Entity\Courier $courier
     */
    public function removeCourier(\Incentives\InventarioBundle\Entity\Courier $courier)
    {
        $this->courier->removeElement($courier);
    }

    /**
     * Get courier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * Add participantes
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participantes
     * @return Tipodocumento
     */
    public function addParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participantes)
    {
        $this->participantes[] = $participantes;
    
        return $this;
    }

    /**
     * Remove participantes
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participantes
     */
    public function removeParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participantes)
    {
        $this->participantes->removeElement($participantes);
    }

    /**
     * Get participantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Tipodocumento
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
     * @return Tipodocumento
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