<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estados
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="Estados")
 */
class Estados
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Programa", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $programa;

    /**
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $producto;

    /**
     * @ORM\OneToMany(targetEntity="Productoprecio", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $productoprecio;

    /**
     * @ORM\OneToMany(targetEntity="Atributosproducto", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $atributos;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OperacionesBundle\Entity\Proveedores", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $proveedor;

    /**
     * @ORM\OneToMany(targetEntity="Catalogos", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $catalogo;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $ordenesproducto;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\SolicitudesAsignar", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $solicitudasignar;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Estados
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
     * Constructor
     */
    public function __construct()
    {
        $this->catalogo = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add catalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogo
     * @return Estados
     */
    public function addCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogo)
    {
        $this->catalogo[] = $catalogo;
    
        return $this;
    }

    /**
     * Remove catalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogo
     */
    public function removeCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogo)
    {
        $this->catalogo->removeElement($catalogo);
    }

    /**
     * Get catalogo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCatalogo()
    {
        return $this->catalogo;
    }

    /**
     * Add producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return Estados
     */
    public function addProducto(\Incentives\CatalogoBundle\Entity\Producto $producto)
    {
        $this->producto[] = $producto;
    
        return $this;
    }

    /**
     * Remove producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     */
    public function removeProducto(\Incentives\CatalogoBundle\Entity\Producto $producto)
    {
        $this->producto->removeElement($producto);
    }

    /**
     * Get producto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Add productoprecio
     *
     * @param \Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio
     * @return Estados
     */
    public function addProductoprecio(\Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio)
    {
        $this->productoprecio[] = $productoprecio;
    
        return $this;
    }

    /**
     * Remove productoprecio
     *
     * @param \Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio
     */
    public function removeProductoprecio(\Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio)
    {
        $this->productoprecio->removeElement($productoprecio);
    }

    /**
     * Get productoprecio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductoprecio()
    {
        return $this->productoprecio;
    }

    /**
     * Add atributos
     *
     * @param \Incentives\CatalogoBundle\Entity\Atributosproducto $atributos
     * @return Estados
     */
    public function addAtributo(\Incentives\CatalogoBundle\Entity\Atributosproducto $atributos)
    {
        $this->atributos[] = $atributos;
    
        return $this;
    }

    /**
     * Remove atributos
     *
     * @param \Incentives\CatalogoBundle\Entity\Atributosproducto $atributos
     */
    public function removeAtributo(\Incentives\CatalogoBundle\Entity\Atributosproducto $atributos)
    {
        $this->atributos->removeElement($atributos);
    }

    /**
     * Get atributos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    /**
     * Add cliente
     *
     * @param \Incentives\CatalogoBundle\Entity\Cliente $cliente
     * @return Estados
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
     * Add programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Estados
     */
    public function addPrograma(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa[] = $programa;
    
        return $this;
    }

    /**
     * Remove programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     */
    public function removePrograma(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa->removeElement($programa);
    }

    /**
     * Get programa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrograma()
    {
        return $this->programa;
    }



    /**
     * Add proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     * @return Estados
     */
    public function addProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor)
    {
        $this->proveedor[] = $proveedor;
    
        return $this;
    }

    /**
     * Remove proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     */
    public function removeProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor)
    {
        $this->proveedor->removeElement($proveedor);
    }

    /**
     * Get proveedor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Add Ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     * @return Estados
     */
    public function addOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->Ordenesproducto[] = $ordenesproducto;
    
        return $this;
    }

    /**
     * Remove Ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     */
    public function removeOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->Ordenesproducto->removeElement($ordenesproducto);
    }

    /**
     * Get Ordenesproducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesproducto()
    {
        return $this->Ordenesproducto;
    }



    /**
     * Add solicitudasignar
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $solicitudasignar
     * @return Estados
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Estados
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
     * @return Estados
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
