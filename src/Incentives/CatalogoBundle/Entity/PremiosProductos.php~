<?php

namespace Incentives\CatalogoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * PremiosProductos
 *
 * @ORM\Entity
 * @ORM\Table(name="PremiosProductos")
 */
class PremiosProductos
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
     * @ORM\ManyToOne(targetEntity="Premios", inversedBy="premiosproductos", cascade={"persist"})
     * @ORM\JoinColumn(name="premio_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $premio;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="premiosproductos", cascade={"persist"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

    /**
     * @var integer
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return PremiosProductos
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
     * Set premio
     *
     * @param \Incentives\CatalogoBundle\Entity\Premios $premio
     *
     * @return PremiosProductos
     */
    public function setPremio(\Incentives\CatalogoBundle\Entity\Premios $premio = null)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return \Incentives\CatalogoBundle\Entity\Premios
     */
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     *
     * @return PremiosProductos
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
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     *
     * @return PremiosProductos
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
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return PremiosProductos
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
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $estado
     *
     * @return PremiosProductos
     */
    public function setEstado(\Incentives\CatalogoBundle\Entity\EstadoCatalogo $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoCatalogo
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
