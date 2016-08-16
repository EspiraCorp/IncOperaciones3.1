<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pais
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="Pais")
 */
class Pais
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
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=255, nullable=true)
     */
    private $latitud;


    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

     /**
     * @var text
     *
     * @ORM\Column(name="poligono", type="text", nullable=true)
     */
    private $poligono;


     /**
     * @var integer
     *
     * @ORM\Column(name="zoom", type="integer", nullable=true)
     */
    private $zoom;

    /**
     * @ORM\OneToMany(targetEntity="Departamento", mappedBy="pais")
     */
    protected $departamentos;
    
    /**
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="pais")
     */
    protected $proveedores;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\Catalogos", mappedBy="pais")
     */
    protected $catalogo;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesCompra", mappedBy="pais")
     */
    protected $ordencompra;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Planilla", mappedBy="pais")
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
        $this->departamentos = new ArrayCollection();
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
     * @return Ciudad
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
     * @return Ciudad
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
     * Set latitud
     *
     * @param string $latitud
     * @return Pais
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    
        return $this;
    }

    /**
     * Get latitud
     *
     * @return string 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     * @return Pais
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    
        return $this;
    }

    /**
     * Get longitud
     *
     * @return string 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set poligono
     *
     * @param string $poligono
     * @return Pais
     */
    public function setPoligono($poligono)
    {
        $this->poligono = $poligono;
    
        return $this;
    }

    /**
     * Get poligono
     *
     * @return string 
     */
    public function getPoligono()
    {
        return $this->poligono;
    }

    /**
     * Set zoom
     *
     * @param integer $zoom
     * @return Pais
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    
        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer 
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Add departamentos
     *
     * @param \Incentives\OperacionesBundle\Entity\Departamento $departamentos
     * @return Pais
     */
    public function addDepartamento(\Incentives\OperacionesBundle\Entity\Departamento $departamentos)
    {
        $this->departamentos[] = $departamentos;
    
        return $this;
    }

    /**
     * Remove departamentos
     *
     * @param \Incentives\OperacionesBundle\Entity\Departamento $departamentos
     */
    public function removeDepartamento(\Incentives\OperacionesBundle\Entity\Departamento $departamentos)
    {
        $this->departamentos->removeElement($departamentos);
    }

    /**
     * Get departamentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartamentos()
    {
        return $this->departamentos;
    }



    

    /**
     * Add catalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogo
     * @return Pais
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
     * Add ordencompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra
     * @return Pais
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
     * @return Pais
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
     * @return Pais
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
     * @return Pais
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
