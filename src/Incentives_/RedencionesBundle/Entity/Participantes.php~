<?php

namespace Incentives\RedencionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Participantes
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Participantes
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
     * @var integer
     *
     * @ORM\Column(name="participante", type="integer", nullable=true)
     */
    private $participante;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Tipodocumento", inversedBy="participantes")
     * @ORM\JoinColumn(name="tipodocumento_id", referencedColumnName="id", nullable=true)
     */
    protected $tipodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa", inversedBy="participantes")
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     */
    protected $programa;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Participantesestado", inversedBy="participante")
     * @ORM\JoinColumn(name="participanteestado_id", referencedColumnName="id", nullable=true)
     */
    protected $participanteestado;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Ciudad", inversedBy="participante")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id", nullable=true)
     */
    protected $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudadNombre", type="string", length=255, nullable=true)
     */
    private $ciudadNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

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
     * @ORM\Column(name="correo", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="barrio", type="string", length=255, nullable=true)
     */
    private $barrio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="llave", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @ORM\OneToMany(targetEntity="Redenciones", mappedBy="participante")
     */
    protected $redencion;

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
        $this->fechaCreacion = new \DateTime("now");
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
     * @return Participantes
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
     * @return Participantes
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
     * Set direccion
     *
     * @param string $direccion
     * @return Participantes
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
     * Set telefono
     *
     * @param string $telefono
     * @return Participantes
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
     * @return Participantes
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
     * Set barrio
     *
     * @param string $barrio
     * @return Participantes
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Participantes
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Participantes
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
     * Set llave
     *
     * @param string $llave
     * @return Participantes
     */
    public function setLlave($llave)
    {
        $this->llave = $llave;
    
        return $this;
    }

    /**
     * Get llave
     *
     * @return string 
     */
    public function getLlave()
    {
        return $this->llave;
    }

    /**
     * Set tipodocumento
     *
     * @param \Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento
     * @return Participantes
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
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Participantes
     */
    public function setPrograma(\Incentives\CatalogoBundle\Entity\Programa $programa = null)
    {
        $this->programa = $programa;
    
        return $this;
    }

    /**
     * Get programa
     *
     * @return \Incentives\CatalogoBundle\Entity\Programa 
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Set participanteestado
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantesestado $participanteestado
     * @return Participantes
     */
    public function setParticipanteestado(\Incentives\RedencionesBundle\Entity\Participantesestado $participanteestado = null)
    {
        $this->participanteestado = $participanteestado;
    
        return $this;
    }

    /**
     * Get participanteestado
     *
     * @return \Incentives\RedencionesBundle\Entity\Participantesestado 
     */
    public function getParticipanteestado()
    {
        return $this->participanteestado;
    }

    /**
     * Set ciudad
     *
     * @param \Incentives\OperacionesBundle\Entity\Ciudad $ciudad
     * @return Participantes
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
     * Add redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     * @return Participantes
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
     * Set ciudadNombre
     *
     * @param string $ciudadNombre
     * @return Participantes
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
     * Set correo
     *
     * @param string $correo
     * @return Participantes
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
     * Set participante
     *
     * @param string $participante
     * @return Participantes
     */
    public function setParticipante($participante)
    {
        $this->participante = $participante;
    
        return $this;
    }

    /**
     * Get participante
     *
     * @return string 
     */
    public function getParticipante()
    {
        return $this->participante;
    }
   

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Participantes
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
     * @return Participantes
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