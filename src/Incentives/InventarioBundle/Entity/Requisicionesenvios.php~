<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requisicionesenvios
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Requisicionesenvios
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
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=500, nullable=true)
     */
    private $observaciones;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ciudadNombre", type="string", length=255, nullable=true)
     */
    private $ciudadNombre;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Ciudad", inversedBy="redencionenvio")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id", nullable=true)
     */
    protected $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=500, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="barrio", type="string", length=255, nullable=true)
     */
    private $barrio;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="departamentoNombre", type="string", length=255, nullable=true)
     */
    private $departamentoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreContacto", type="string", length=255, nullable=true)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="documentoContacto", type="string", length=255, nullable=true)
     */
    private $documentoContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudadContacto", type="string", length=255, nullable=true)
     */
    private $ciudadContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionContacto", type="string", length=500, nullable=true)
     */
    private $direccionContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="barrioContacto", type="string", length=255, nullable=true)
     */
    private $barrioContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoContacto", type="string", length=255, nullable=true)
     */
    private $telefonoContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="celularContacto", type="string", length=255, nullable=true)
     */
    private $celularContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="departamentoContacto", type="string", length=255, nullable=true)
     */
    private $departamentoContacto;

      /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="requisicionesesenvios", cascade={"persist"})
     */
    protected $inventario;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\GuiaEnvio", mappedBy="redencionenvio", cascade={"persist"})
     */
    protected $guia;

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
     * Set documento
     *
     * @param string $documento
     * @return Redencionesenvios
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    
        return $this;
    }

    /**
     * Get documento
     *
     * @return string 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set ciudadNombre
     *
     * @param string $ciudadNombre
     * @return Redencionesenvios
     */
    public function setCiudadNombre($ciudadNombre)
    {
        $this->ciudadNombre = $ciudadNombre;
    
        return $this;
    }

    /**
     * Get ciudadNombre
     *
     * @return string 
     */
    public function getCiudadNombre()
    {
        return $this->ciudadNombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Redencionesenvios
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set barrio
     *
     * @param string $barrio
     * @return Redencionesenvios
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    
        return $this;
    }

    /**
     * Get barrio
     *
     * @return string 
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Redencionesenvios
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Redencionesenvios
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set departamentoNombre
     *
     * @param string $departamentoNombre
     * @return Redencionesenvios
     */
    public function setDepartamentoNombre($departamentoNombre)
    {
        $this->departamentoNombre = $departamentoNombre;
    
        return $this;
    }

    /**
     * Get departamentoNombre
     *
     * @return string 
     */
    public function getDepartamentoNombre()
    {
        return $this->departamentoNombre;
    }

    
    /**
     * Set nombreContacto
     *
     * @param string $nombreContacto
     * @return Redencionesenvios
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;
    
        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string 
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }
    

    /**
     * Set documentoContacto
     *
     * @param string $documentoContacto
     * @return Redencionesenvios
     */
    public function setDocumentoContacto($documentoContacto)
    {
        $this->documentoContacto = $documentoContacto;
    
        return $this;
    }

    /**
     * Get documentoContacto
     *
     * @return string 
     */
    public function getDocumentoContacto()
    {
        return $this->documentoContacto;
    }

     /**
     * Set ciudadContacto
     *
     * @param string $ciudadContacto
     * @return Redencionesenvios
     */
    public function setCiudadContacto($ciudadContacto)
    {
        $this->ciudadContacto = $ciudadContacto;
    
        return $this;
    }

    /**
     * Get ciudadContacto
     *
     * @return string 
     */
    public function getCiudadContacto()
    {
        return $this->ciudadContacto;
    }

    /**
     * Set direccionContacto
     *
     * @param string $direccionContacto
     * @return Redencionesenvios
     */
    public function setDireccionContacto($direccionContacto)
    {
        $this->direccionContacto = $direccionContacto;
    
        return $this;
    }

    /**
     * Get direccionContacto
     *
     * @return string 
     */
    public function getDireccionContacto()
    {
        return $this->direccionContacto;
    }

    /**
     * Set barrioContacto
     *
     * @param string $barrioContacto
     * @return Redencionesenvios
     */
    public function setBarrioContacto($barrioContacto)
    {
        $this->barrioContacto = $barrioContacto;
    
        return $this;
    }

    /**
     * Get barrioContacto
     *
     * @return string 
     */
    public function getBarrioContacto()
    {
        return $this->barrioContacto;
    }

    /**
     * Set telefonoContacto
     *
     * @param string $telefonoContacto
     * @return Redencionesenvios
     */
    public function setTelefonoContacto($telefonoContacto)
    {
        $this->telefonoContacto = $telefonoContacto;
    
        return $this;
    }

    /**
     * Get telefonoContacto
     *
     * @return string 
     */
    public function getTelefonoContacto()
    {
        return $this->telefonoContacto;
    }

    /**
     * Set celularContacto
     *
     * @param string $celularContacto
     * @return Redencionesenvios
     */
    public function setCelularContacto($celularContacto)
    {
        $this->celularContacto = $celularContacto;
    
        return $this;
    }

    /**
     * Get celularContacto
     *
     * @return string 
     */
    public function getCelularContacto()
    {
        return $this->celularContacto;
    }

    /**
     * Set departamentoContacto
     *
     * @param string $departamentoContacto
     * @return Redencionesenvios
     */
    public function setDepartamentoContacto($departamentoContacto)
    {
        $this->departamentoContacto = $departamentoContacto;
    
        return $this;
    }

    /**
     * Get departamentoContacto
     *
     * @return string 
     */
    public function getDepartamentoContacto()
    {
        return $this->departamentoContacto;
    }

    /**
     * Set ciudad
     *
     * @param \Incentives\OperacionesBundle\Entity\Ciudad $ciudad
     * @return Redencionesenvios
     */
    public function setCiudad(\Incentives\OperacionesBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;
    
        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Incentives\OperacionesBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guia = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add guia
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guia
     * @return Redencionesenvios
     */
    public function addGuia(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guia)
    {
        $this->guia[] = $guia;
    
        return $this;
    }

    /**
     * Remove guia
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guia
     */
    public function removeGuia(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guia)
    {
        $this->guia->removeElement($guia);
    }

    /**
     * Get guia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return Requisicionesenvios
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
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return Requisicionesenvios
     */
    public function addInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario)
    {
        $this->inventario[] = $inventario;
    
        return $this;
    }

    /**
     * Remove inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     */
    public function removeInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario)
    {
        $this->inventario->removeElement($inventario);
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Requisicionesenvios
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
     * @return Requisicionesenvios
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
     * Set nombre
     *
     * @param string $nombre
     * @return Requisicionesenvios
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return Requisicionesenvios
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}