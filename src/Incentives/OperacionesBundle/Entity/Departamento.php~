<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="Departamento")
 * @ORM\Entity
 */
class Departamento
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
     * @ORM\OneToMany(targetEntity="Ciudad", mappedBy="departamento")
     */
    protected $ciudades;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="departamentos")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=true)
     */
    protected $pais;  

    /**
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="departamento")
     */
    protected $proveedores;

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
        $this->ciudades = new ArrayCollection();
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
     * @return Departamento
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
     * Set latitud
     *
     * @param string $latitud
     * @return Departamento
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
     * @return Departamento
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
     * @return Departamento
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
     * @return Departamento
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
     * Add ciudades
     *
     * @param \Incentives\OperacionesBundle\Entity\Ciudad $ciudades
     * @return Departamento
     */
    public function addCiudade(\Incentives\OperacionesBundle\Entity\Ciudad $ciudades)
    {
        $this->ciudades[] = $ciudades;
    
        return $this;
    }

    /**
     * Remove ciudades
     *
     * @param \Incentives\OperacionesBundle\Entity\Ciudad $ciudades
     */
    public function removeCiudade(\Incentives\OperacionesBundle\Entity\Ciudad $ciudades)
    {
        $this->ciudades->removeElement($ciudades);
    }

    /**
     * Get ciudades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCiudades()
    {
        return $this->ciudades;
    }

    /**
     * Set pais
     *
     * @param \Incentives\OperacionesBundle\Entity\Pais $pais
     * @return Departamento
     */
    public function setPais(\Incentives\OperacionesBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return \Incentives\OperacionesBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedores
     * @return Departamento
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Departamento
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
     * @return Departamento
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
