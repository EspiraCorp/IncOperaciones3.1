<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categoria
 *
 * @ORM\Entity
 * @ORM\Table(name="Categoria")
 */
class Categoria
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
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="categoria")
     */
    protected $proveedores;
    
    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=10, nullable=true)
     */
    private $abreviatura;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\Producto", mappedBy="categoria")
     */
    protected $producto;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\Productocatalogo", mappedBy="categoria")
     */
    protected $productocatalogo;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesCompra", mappedBy="categoria")
     */
    protected $ordencompra;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Planilla", mappedBy="categoria")
     */
    protected $planilla;

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
     * @return Categoria
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
     * @return Categoria
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
     * Add producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return Categoria
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
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return Categoria
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    
        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Add productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     * @return Categoria
     */
    public function addProductocatalogo(\Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo)
    {
        $this->productocatalogo[] = $productocatalogo;
    
        return $this;
    }

    /**
     * Remove productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     */
    public function removeProductocatalogo(\Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo)
    {
        $this->productocatalogo->removeElement($productocatalogo);
    }

    /**
     * Get productocatalogo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductocatalogo()
    {
        return $this->productocatalogo;
    }

    /**
     * Add ordencompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra
     * @return Categoria
     */
    public function addOrdencompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra)
    {
        $this->ordencompra[] = $ordencompra;
    
        return $this;
    }

    /**
     * Remove ordencompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra
     */
    public function removeOrdencompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra)
    {
        $this->ordencompra->removeElement($ordencompra);
    }

    /**
     * Get ordencompra
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdencompra()
    {
        return $this->ordencompra;
    }

    /**
     * Add planilla
     *
     * @param \Incentives\InventarioBundle\Entity\Planilla $planilla
     * @return Categoria
     */
    public function addPlanilla(\Incentives\InventarioBundle\Entity\Planilla $planilla)
    {
        $this->planilla[] = $planilla;
    
        return $this;
    }

    /**
     * Remove planilla
     *
     * @param \Incentives\InventarioBundle\Entity\Planilla $planilla
     */
    public function removePlanilla(\Incentives\InventarioBundle\Entity\Planilla $planilla)
    {
        $this->planilla->removeElement($planilla);
    }

    /**
     * Get planilla
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanilla()
    {
        return $this->planilla;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Categoria
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
     * @return Categoria
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
