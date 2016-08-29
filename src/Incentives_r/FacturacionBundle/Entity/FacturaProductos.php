<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FacturaProductos
 *
 * @ORM\Entity
 * @ORM\Table(name="FacturaProductos")
 */
class FacturaProductos
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
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="facturaproductos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

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
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Factura", inversedBy="facturaproductos",cascade={"persist"})
     * @ORM\JoinColumn(name="factura_id", referencedColumnName="id", nullable=true)
     */
    protected $factura;
    
     /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", mappedBy="facturaProducto", cascade={"persist"})
     */
    protected $redenciones;

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
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return FacturaPremios
     */
    public function setProducto(\Incentives\CatalogoBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Incentives\CatalogoBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->redenciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return FacturaProductos
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
     * @return FacturaProductos
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
     * Add redenciones
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redenciones
     * @return FacturaProductos
     */
    public function addRedencione(\Incentives\RedencionesBundle\Entity\Redenciones $redenciones)
    {
        $this->redenciones[] = $redenciones;
    
        return $this;
    }

    /**
     * Remove redenciones
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redenciones
     */
    public function removeRedencione(\Incentives\RedencionesBundle\Entity\Redenciones $redenciones)
    {
        $this->redenciones->removeElement($redenciones);
    }

    /**
     * Get redenciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedenciones()
    {
        return $this->redenciones;
    }
}