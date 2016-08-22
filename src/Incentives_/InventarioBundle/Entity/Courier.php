<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Courier
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Courier
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
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=true)
     */
    private $correo;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\GuiaEnvio", mappedBy="courier", cascade={"persist"})
     * 
     */
    protected $guiaEnvio;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Tipodocumento", inversedBy="courier")
     * @ORM\JoinColumn(name="tipodocumento_id", referencedColumnName="id", nullable=true)
     */
    protected $tipodocumento;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Courier
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
     * Set documento
     *
     * @param string $documento
     * @return Courier
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
     * Set telefono
     *
     * @param string $telefono
     * @return Courier
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
     * Set direccion
     *
     * @param string $direccion
     * @return Courier
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
     * Set correo
     *
     * @param string $correo
     * @return Courier
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set tipodocumento
     *
     * @param \Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento
     * @return Courier
     */
    public function setTipodocumento(\Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento = null)
    {
        $this->tipodocumento = $tipodocumento;
    
        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return \Incentives\OperacionesBundle\Entity\Tipodocumento 
     */
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Courier
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     * @return Courier
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Courier
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
     * @return Courier
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