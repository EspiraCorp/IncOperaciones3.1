<?php

namespace Incentives\CatalogoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productocatalogo
 *
 * @ORM\Entity
 * @ORM\Table(name="Productocatalogo")
 */
class Productocatalogo
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
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos", type="integer", nullable=true)
     */
    private $puntos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actualizacion", type="boolean", nullable=true)
     */
    private $actualizacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="agotado", type="boolean", nullable=true)
     */
    private $agotado;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="productocatalogo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Catalogos", inversedBy="productocatalogo", cascade={"persist"})
     * @ORM\JoinColumn(name="catalogos_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $catalogos;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Categoria", inversedBy="productocatalogo")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=true)
     */
    protected $categoria;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", mappedBy="productocatalogo")
     */
    protected $redencion;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico", mappedBy="productocatalogo")
     */
    protected $productocatalogoHistorico;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntosTemporal", type="integer", nullable=true)
     */
    private $puntosTemporal;
    
     /**
     * @var float
     *
     * @ORM\Column(name="precioTemporal", type="float", nullable=true)
     */
    private $precioTemporal;
    
     /**
     * @var float
     *
     * @ORM\Column(name="incrementoTemporal", type="float", nullable=true)
     */
    private $incrementoTemporal;
    
    /**
     * @var float
     *
     * @ORM\Column(name="logisticaTemporal", type="float", nullable=true)
     */
    private $logisticaTemporal;


     /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=true)
     */
    private $precio;
    
     /**
     * @var float
     *
     * @ORM\Column(name="incremento", type="float", nullable=true)
     */
    private $incremento;
    
    /**
     * @var float
     *
     * @ORM\Column(name="logistica", type="float", nullable=true)
     */
    private $logistica;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo", inversedBy="productocatalogo", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoAprobacion")
     * @ORM\JoinColumn(name="estadoAprobacion_id", referencedColumnName="id", nullable=true)
     */
    protected $estadoAprobacion;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo")
     * @ORM\JoinColumn(name="aproboOperaciones_id", referencedColumnName="id", nullable=true)
     */
    protected $aproboOperaciones;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="operaciones_id", referencedColumnName="id", nullable=true)
     */
    protected $operacionesUsuario;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo")
     * @ORM\JoinColumn(name="aproboComercial_id", referencedColumnName="id", nullable=true)
     */
    protected $aproboComercial;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="comercial_id", referencedColumnName="id", nullable=true)
     */
    protected $comercialUsuario;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo")
     * @ORM\JoinColumn(name="aproboDirector_id", referencedColumnName="id", nullable=true)
     */
    protected $aproboDirector;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="director_id", referencedColumnName="id", nullable=true)
     */
    protected $directorUsuario;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EstadoCatalogo")
     * @ORM\JoinColumn(name="aproboCliente_id", referencedColumnName="id", nullable=true)
     */
    protected $aproboCliente;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=true)
     */
    protected $clienteUsuario;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInactivacion", type="datetime", nullable=true)
     */
    private $fechaInactivacion;

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
        $this->redencion = new ArrayCollection();
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
     * Set activo
     *
     * @param boolean $activo
     * @return Productocatalogo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     * @return Productocatalogo
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    
        return $this;
    }

    /**
     * Get puntos
     *
     * @return integer 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set actualizacion
     *
     * @param boolean $actualizacion
     * @return Productocatalogo
     */
    public function setActualizacion($actualizacion)
    {
        $this->actualizacion = $actualizacion;
    
        return $this;
    }

    /**
     * Get actualizacion
     *
     * @return boolean 
     */
    public function getActualizacion()
    {
        return $this->actualizacion;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return Productocatalogo
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
     * Set catalogos
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogos
     * @return Productocatalogo
     */
    public function setCatalogos(\Incentives\CatalogoBundle\Entity\Catalogos $catalogos = null)
    {
        $this->catalogos = $catalogos;
    
        return $this;
    }

    /**
     * Get catalogos
     *
     * @return \Incentives\CatalogoBundle\Entity\Catalogos 
     */
    public function getCatalogos()
    {
        return $this->catalogos;
    }

    /**
     * Add redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     * @return Productocatalogo
     */
    public function addRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion)
    {
        $this->redencion[] = $redencion;
    
        return $this;
    }

    /**
     * Remove redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     */
    public function removeRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion)
    {
        $this->redencion->removeElement($redencion);
    }

    /**
     * Get redencion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedencion()
    {
        return $this->redencion;
    }


    /**
     * Set precio
     *
     * @param float $precio
     * @return Productocatalogo
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set incremento
     *
     * @param float $incremento
     * @return Productocatalogo
     */
    public function setIncremento($incremento)
    {
        $this->incremento = $incremento;
    
        return $this;
    }

    /**
     * Get incremento
     *
     * @return float 
     */
    public function getIncremento()
    {
        return $this->incremento;
    }

    /**
     * Set logistica
     *
     * @param float $logistica
     * @return Productocatalogo
     */
    public function setLogistica($logistica)
    {
        $this->logistica = $logistica;
    
        return $this;
    }

    /**
     * Get logistica
     *
     * @return float 
     */
    public function getLogistica()
    {
        return $this->logistica;
    }

    /**
     * Set categoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Categoria $categoria
     * @return Productocatalogo
     */
    public function setCategoria(\Incentives\OperacionesBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Incentives\OperacionesBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $estado
     * @return Productocatalogo
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

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Productocatalogo
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
     * Set aproboOperaciones
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboOperaciones
     * @return Productocatalogo
     */
    public function setAproboOperaciones(\Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboOperaciones = null)
    {
        $this->aproboOperaciones = $aproboOperaciones;
    
        return $this;
    }

    /**
     * Get aproboOperaciones
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoCatalogo 
     */
    public function getAproboOperaciones()
    {
        return $this->aproboOperaciones;
    }

    /**
     * Set operacionesUsuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $operacionesUsuario
     * @return Productocatalogo
     */
    public function setOperacionesUsuario(\Incentives\BaseBundle\Entity\Usuario $operacionesUsuario = null)
    {
        $this->operacionesUsuario = $operacionesUsuario;
    
        return $this;
    }

    /**
     * Get operacionesUsuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getOperacionesUsuario()
    {
        return $this->operacionesUsuario;
    }

    /**
     * Set aproboComercial
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboComercial
     * @return Productocatalogo
     */
    public function setAproboComercial(\Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboComercial = null)
    {
        $this->aproboComercial = $aproboComercial;
    
        return $this;
    }

    /**
     * Get aproboComercial
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoCatalogo 
     */
    public function getAproboComercial()
    {
        return $this->aproboComercial;
    }

    /**
     * Set comercialUsuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $comercialUsuario
     * @return Productocatalogo
     */
    public function setComercialUsuario(\Incentives\BaseBundle\Entity\Usuario $comercialUsuario = null)
    {
        $this->comercialUsuario = $comercialUsuario;
    
        return $this;
    }

    /**
     * Get comercialUsuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getComercialUsuario()
    {
        return $this->comercialUsuario;
    }

    /**
     * Set aproboDirector
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboDirector
     * @return Productocatalogo
     */
    public function setAproboDirector(\Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboDirector = null)
    {
        $this->aproboDirector = $aproboDirector;
    
        return $this;
    }

    /**
     * Get aproboDirector
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoCatalogo 
     */
    public function getAproboDirector()
    {
        return $this->aproboDirector;
    }

    /**
     * Set directorUsuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $directorUsuario
     * @return Productocatalogo
     */
    public function setDirectorUsuario(\Incentives\BaseBundle\Entity\Usuario $directorUsuario = null)
    {
        $this->directorUsuario = $directorUsuario;
    
        return $this;
    }

    /**
     * Get directorUsuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getDirectorUsuario()
    {
        return $this->directorUsuario;
    }

    /**
     * Set aproboCliente
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboCliente
     * @return Productocatalogo
     */
    public function setAproboCliente(\Incentives\CatalogoBundle\Entity\EstadoCatalogo $aproboCliente = null)
    {
        $this->aproboCliente = $aproboCliente;
    
        return $this;
    }

    /**
     * Get aproboCliente
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoCatalogo 
     */
    public function getAproboCliente()
    {
        return $this->aproboCliente;
    }

    /**
     * Set clienteUsuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $clienteUsuario
     * @return Productocatalogo
     */
    public function setClienteUsuario(\Incentives\BaseBundle\Entity\Usuario $clienteUsuario = null)
    {
        $this->clienteUsuario = $clienteUsuario;
    
        return $this;
    }

    /**
     * Get clienteUsuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getClienteUsuario()
    {
        return $this->clienteUsuario;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return Productocatalogo
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
     * Set puntosTemporal
     *
     * @param integer $puntosTemporal
     * @return Productocatalogo
     */
    public function setPuntosTemporal($puntosTemporal)
    {
        $this->puntosTemporal = $puntosTemporal;
    
        return $this;
    }

    /**
     * Get puntosTemporal
     *
     * @return integer 
     */
    public function getPuntosTemporal()
    {
        return $this->puntosTemporal;
    }

    /**
     * Set precioTemporal
     *
     * @param float $precioTemporal
     * @return Productocatalogo
     */
    public function setPrecioTemporal($precioTemporal)
    {
        $this->precioTemporal = $precioTemporal;
    
        return $this;
    }

    /**
     * Get precioTemporal
     *
     * @return float 
     */
    public function getPrecioTemporal()
    {
        return $this->precioTemporal;
    }

    /**
     * Set incrementoTemporal
     *
     * @param float $incrementoTemporal
     * @return Productocatalogo
     */
    public function setIncrementoTemporal($incrementoTemporal)
    {
        $this->incrementoTemporal = $incrementoTemporal;
    
        return $this;
    }

    /**
     * Get incrementoTemporal
     *
     * @return float 
     */
    public function getIncrementoTemporal()
    {
        return $this->incrementoTemporal;
    }

    /**
     * Set logisticaTemporal
     *
     * @param float $logisticaTemporal
     * @return Productocatalogo
     */
    public function setLogisticaTemporal($logisticaTemporal)
    {
        $this->logisticaTemporal = $logisticaTemporal;
    
        return $this;
    }

    /**
     * Get logisticaTemporal
     *
     * @return float 
     */
    public function getLogisticaTemporal()
    {
        return $this->logisticaTemporal;
    }

    /**
     * Set agotado
     *
     * @param boolean $agotado
     * @return Productocatalogo
     */
    public function setAgotado($agotado)
    {
        $this->agotado = $agotado;
    
        return $this;
    }

    /**
     * Get agotado
     *
     * @return boolean 
     */
    public function getAgotado()
    {
        return $this->agotado;
    }


    /**
     * Add productocatalogoHistorico
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico $productocatalogoHistorico
     * @return Productocatalogo
     */
    public function addProductocatalogoHistorico(\Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico $productocatalogoHistorico)
    {
        $this->productocatalogoHistorico[] = $productocatalogoHistorico;
    
        return $this;
    }

    /**
     * Remove productocatalogoHistorico
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico $productocatalogoHistorico
     */
    public function removeProductocatalogoHistorico(\Incentives\CatalogoBundle\Entity\ProductocatalogoHistorico $productocatalogoHistorico)
    {
        $this->productocatalogoHistorico->removeElement($productocatalogoHistorico);
    }

    /**
     * Get productocatalogoHistorico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductocatalogoHistorico()
    {
        return $this->productocatalogoHistorico;
    }

    /**
     * Set estadoAprobacion
     *
     * @param \Incentives\CatalogoBundle\Entity\EstadoAprobacion $estadoAprobacion
     * @return Productocatalogo
     */
    public function setEstadoAprobacion(\Incentives\CatalogoBundle\Entity\EstadoAprobacion $estadoAprobacion = null)
    {
        $this->estadoAprobacion = $estadoAprobacion;
    
        return $this;
    }

    /**
     * Get estadoAprobacion
     *
     * @return \Incentives\CatalogoBundle\Entity\EstadoAprobacion 
     */
    public function getEstadoAprobacion()
    {
        return $this->estadoAprobacion;
    }

    /**
     * Set fechaInactivacion
     *
     * @param \DateTime $fechaInactivacion
     * @return Productocatalogo
     */
    public function setFechaInactivacion($fechaInactivacion)
    {
        $this->fechaInactivacion = $fechaInactivacion;
    
        return $this;
    }

    /**
     * Get fechaInactivacion
     *
     * @return \DateTime 
     */
    public function getFechaInactivacion()
    {
        return $this->fechaInactivacion;
    }
}
