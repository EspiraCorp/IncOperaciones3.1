<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrdenesProducto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrdenesProductoHistorico
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
     * @var integer
     *
     * @ORM\Column(name="cantidadrecibida", type="integer", nullable=true)
     */
    private $cantidadrecibida;

    /**
     * @var bigint
     *
     * @ORM\Column(name="valorunidad", type="bigint", nullable=true)
     */
    private $valorunidad;

    /**
     * @var bigint
     *
     * @ORM\Column(name="valortotal", type="bigint", nullable=true)
     */
    private $valortotal;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\GuiaEnvio", mappedBy="ordenProducto", cascade={"persist"})
     * 
     */
    protected $guiaEnvio;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="ordenesproducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="OrdenesCompra", inversedBy="ordenesProducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenesCompra_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenesCompra;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", mappedBy="ordenesProducto")
     */
    protected $redenciones;
    
     /**
     * 
     * @ORM\ManyToOne(targetEntity="OrdenesProducto", inversedBy="ordenesproductohistorico", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordencompra_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenproducto;
    
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
        $this->redenciones = new ArrayCollection();
        $this->guiaEnvio = new ArrayCollection();
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return OrdenesProducto
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
     * Set cantidadrecibida
     *
     * @param integer $cantidadrecibida
     * @return OrdenesProducto
     */
    public function setCantidadrecibida($cantidadrecibida)
    {
        $this->cantidadrecibida = $cantidadrecibida;
    
        return $this;
    }

    /**
     * Get cantidadrecibida
     *
     * @return integer 
     */
    public function getCantidadrecibida()
    {
        return $this->cantidadrecibida;
    }

    /**
     * Set valorunidad
     *
     * @param integer $valorunidad
     * @return OrdenesProducto
     */
    public function setValorunidad($valorunidad)
    {
        $this->valorunidad = $valorunidad;
    
        return $this;
    }

    /**
     * Get valorunidad
     *
     * @return integer 
     */
    public function getValorunidad()
    {
        return $this->valorunidad;
    }

    /**
     * Set valortotal
     *
     * @param integer $valortotal
     * @return OrdenesProducto
     */
    public function setValortotal($valortotal)
    {
        $this->valortotal = $valortotal;
    
        return $this;
    }

    /**
     * Get valortotal
     *
     * @return integer 
     */
    public function getValortotal()
    {
        return $this->valortotal;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return OrdenesProducto
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
     * Set ordenesCompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra
     * @return OrdenesProducto
     */
    public function setOrdenesCompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra = null)
    {
        $this->ordenesCompra = $ordenesCompra;
    
        return $this;
    }

    /**
     * Get ordenesCompra
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesCompra 
     */
    public function getOrdenesCompra()
    {
        return $this->ordenesCompra;
    }

    /**
     * Add guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     * @return OrdenesProducto
     */
    public function addGuiaEnvio(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio)
    {
        $this->guiaEnvio[] = $guiaEnvio;
    
        return $this;
    }

    /**
     * Remove guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     */
    public function removeGuiaEnvio(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio)
    {
        $this->guiaEnvio->removeElement($guiaEnvio);
    }

    /**
     * Get guiaEnvio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuiaEnvio()
    {
        return $this->guiaEnvio;
    }

    /**
     * Add redenciones
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redenciones
     * @return OrdenesProducto
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

    /**
     * Set ordenproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto
     * @return OrdenesProductoHistorico
     */
    public function setOrdenproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto = null)
    {
        $this->ordenproducto = $ordenproducto;
    
        return $this;
    }

    /**
     * Get ordenproducto
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesProducto 
     */
    public function getOrdenproducto()
    {
        return $this->ordenproducto;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return OrdenesProductoHistorico
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return OrdenesProductoHistorico
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
}