<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventarioGuia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class InventarioGuia
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
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\Inventario", inversedBy="inventarioguia")
     * @ORM\JoinColumn(name="inventario_id", referencedColumnName="id", nullable=true)
     */
    protected $inventario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\GuiaEnvio", inversedBy="inventarioguia")
     * @ORM\JoinColumn(name="guia_id", referencedColumnName="id", nullable=true)
     */
    protected $guia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrega", type="datetime", nullable=true)
     */
    private $fechaEntrega;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $usuario;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\CierreEstado")
     * @ORM\JoinColumn(name="cierreEstado_id", referencedColumnName="id", nullable=true)
     */
    protected $cierreEstado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

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
     * Set inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return InventarioGuia
     */
    public function setInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario = null)
    {
        $this->inventario = $inventario;
    
        return $this;
    }

    /**
     * Get inventario
     *
     * @return \Incentives\InventarioBundle\Entity\Inventario 
     */
    public function getInventario()
    {
        return $this->inventario;
    }

    /**
     * Set guia
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guia
     * @return InventarioGuia
     */
    public function setGuia(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guia = null)
    {
        $this->guia = $guia;
    
        return $this;
    }

    /**
     * Get guia
     *
     * @return \Incentives\RedencionesBundle\Entity\GuiaEnvio 
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return InventarioGuia
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return InventarioGuia
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;
    
        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return InventarioGuia
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

    /**
     * Set cierreEstado
     *
     * @param \Incentives\InventarioBundle\Entity\CierreEstado $cierreEstado
     * @return InventarioGuia
     */
    public function setCierreEstado(\Incentives\InventarioBundle\Entity\CierreEstado $cierreEstado = null)
    {
        $this->cierreEstado = $cierreEstado;
    
        return $this;
    }

    /**
     * Get cierreEstado
     *
     * @return \Incentives\InventarioBundle\Entity\CierreEstado 
     */
    public function getCierreEstado()
    {
        return $this->cierreEstado;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return InventarioGuia
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }
}