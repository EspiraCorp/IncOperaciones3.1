<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FacturaDetalle
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FacturaDetalle
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
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="valorUnitario", type="float", nullable=true)
     */
    private $valorUnitario;

    /**
     * @var float
     *
     * @ORM\Column(name="valorTotal", type="float", nullable=true)
     */
    private $valorTotal;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Factura", inversedBy="detalle",cascade={"persist"})
     * @ORM\JoinColumn(name="factura_id", referencedColumnName="id", nullable=true)
     */
    protected $factura;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Tipocostos", inversedBy="detalle",cascade={"persist"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     */
    protected $tipo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Areas", inversedBy="detalle",cascade={"persist"})
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=true)
     */
    protected $area;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", inversedBy="facturaciondetalle", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="redencion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $redencion;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return FacturaDetalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FacturaDetalle
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set valorUnitario
     *
     * @param float $valorUnitario
     * @return FacturaDetalle
     */
    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;
    
        return $this;
    }

    /**
     * Get valorUnitario
     *
     * @return float 
     */
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    /**
     * Set valorTotal
     *
     * @param float $valorTotal
     * @return FacturaDetalle
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;
    
        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return float 
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set factura
     *
     * @param \Incentives\FacturacionBundle\Entity\Factura $factura
     * @return FacturaDetalle
     */
    public function setFactura(\Incentives\FacturacionBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return \Incentives\FacturacionBundle\Entity\Factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set tipo
     *
     * @param \Incentives\FacturacionBundle\Entity\Tipocostos $tipo
     * @return FacturaDetalle
     */
    public function setTipo(\Incentives\FacturacionBundle\Entity\Tipocostos $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Incentives\FacturacionBundle\Entity\Tipocostos 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set area
     *
     * @param \Incentives\FacturacionBundle\Entity\Areas $area
     * @return FacturaDetalle
     */
    public function setArea(\Incentives\FacturacionBundle\Entity\Areas $area = null)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area
     *
     * @return \Incentives\FacturacionBundle\Entity\Areas 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     * @return FacturaDetalle
     */
    public function setRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion = null)
    {
        $this->redencion = $redencion;
    
        return $this;
    }

    /**
     * Get redencion
     *
     * @return \Incentives\RedencionesBundle\Entity\Redenciones 
     */
    public function getRedencion()
    {
        return $this->redencion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return FacturaDetalle
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
     * @return FacturaDetalle
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