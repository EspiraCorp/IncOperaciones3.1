<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="Solicitud")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Solicitud
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
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;
    
     /**
     * @var string
     *
     * @ORM\Column(name="ordenDespacho", type="string", length=255, nullable=true)
     */
    private $ordenDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="mantis", type="string", length=255, nullable=true)
     */
    private $mantis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OperacionesBundle\Entity\Convocatorias", mappedBy="solicitud", cascade={"persist"})
     * 
     */
    protected $convocatoria;
    
    /**
     * @ORM\OneToMany(targetEntity="Cotizacion", mappedBy="solicitud", cascade={"persist"})
     * 
     */
    protected $cotizacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesCompra", mappedBy="solicitud", cascade={"persist"})
     * 
     */
    protected $ordencompra;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Planilla", mappedBy="solicitud", cascade={"persist"})
     * 
     */
    protected $planilla;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="SolicitudTipo", inversedBy="solicitud", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $tipo;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Prioridad")
     * @ORM\JoinColumn(name="prioridad_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $prioridad;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa", inversedBy="solicitud", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $programa;   
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\SolicitudesEstado", inversedBy="solicitud", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $estado;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\SolicitudesAsignar", mappedBy="solicitud", cascade={"persist"})
     * 
     */
    protected $asignar;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="solicitante_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $solicitante;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacionesSolicitante", type="string", length=500, nullable=true)
     */
    private $observacionesSolicitante;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacionesOperaciones", type="string", length=500, nullable=true)
     */
    private $observacionesOperaciones;

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
     * Constructor
     */
    public function __construct()
    {
        $this->convocatoria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cotizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->asginar = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Solicitud
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     * @return Solicitud
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    
        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }
    
    /**
     * Set ordenDespacho
     *
     * @param string $ordenDespacho
     * @return Solicitud
     */
    public function setOrdenDespacho($ordenDespacho)
    {
        $this->ordenDespacho = $ordenDespacho;
    
        return $this;
    }

    /**
     * Get ordenDespacho
     *
     * @return string 
     */
    public function getOrdenDespacho()
    {
        return $this->ordenDespacho;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Solicitud
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set mantis
     *
     * @param string $mantis
     * @return Solicitud
     */
    public function setMantis($mantis)
    {
        $this->mantis = $mantis;
    
        return $this;
    }

    /**
     * Get mantis
     *
     * @return string 
     */
    public function getMantis()
    {
        return $this->mantis;
    }

    /**
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     * @return Solicitud
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;
    
        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime 
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Solicitud
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
     * Add convocatoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria
     * @return Solicitud
     */
    public function addConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria)
    {
        $this->convocatoria[] = $convocatoria;
    
        return $this;
    }

    /**
     * Remove convocatoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria
     */
    public function removeConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria)
    {
        $this->convocatoria->removeElement($convocatoria);
    }

    /**
     * Get convocatoria
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConvocatoria()
    {
        return $this->convocatoria;
    }

    /**
     * Add cotizacion
     *
     * @param \Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion
     * @return Solicitud
     */
    public function addCotizacion(\Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion)
    {
        $this->cotizacion[] = $cotizacion;
    
        return $this;
    }

    /**
     * Remove cotizacion
     *
     * @param \Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion
     */
    public function removeCotizacion(\Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion)
    {
        $this->cotizacion->removeElement($cotizacion);
    }

    /**
     * Get cotizacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCotizacion()
    {
        return $this->cotizacion;
    }

    /**
     * Add ordencompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra
     * @return Solicitud
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
     * Set tipo
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudTipo $tipo
     * @return Solicitud
     */
    public function setTipo(\Incentives\SolicitudesBundle\Entity\SolicitudTipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Incentives\SolicitudesBundle\Entity\SolicitudTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set prioridad
     *
     * @param \Incentives\SolicitudesBundle\Entity\Prioridad $prioridad
     * @return Solicitud
     */
    public function setPrioridad(\Incentives\SolicitudesBundle\Entity\Prioridad $prioridad = null)
    {
        $this->prioridad = $prioridad;
    
        return $this;
    }

    /**
     * Get prioridad
     *
     * @return \Incentives\SolicitudesBundle\Entity\Prioridad 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Solicitud
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
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return Solicitud
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
     * Add asignar
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $asignar
     * @return Solicitud
     */
    public function addAsignar(\Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $asignar)
    {
        $this->asignar[] = $asignar;
    
        return $this;
    }

    /**
     * Remove asignar
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $asignar
     */
    public function removeAsignar(\Incentives\SolicitudesBundle\Entity\SolicitudesAsignar $asignar)
    {
        $this->asignar->removeElement($asignar);
    }

    /**
     * Get asignar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsignar()
    {
        return $this->asignar;
    }

    /**
     * Set solicitante
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $solicitante
     * @return Solicitud
     */
    public function setSolicitante(\Incentives\BaseBundle\Entity\Usuario $solicitante = null)
    {
        $this->solicitante = $solicitante;
    
        return $this;
    }

    /**
     * Get solicitante
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Add planilla
     *
     * @param \Incentives\InventarioBundle\Entity\Planilla $planilla
     * @return Solicitud
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
     * Set observacionesSolicitante
     *
     * @param string $observacionesSolicitante
     * @return Solicitud
     */
    public function setObservacionesSolicitante($observacionesSolicitante)
    {
        $this->observacionesSolicitante = $observacionesSolicitante;
    
        return $this;
    }

    /**
     * Get observacionesSolicitante
     *
     * @return string 
     */
    public function getObservacionesSolicitante()
    {
        return $this->observacionesSolicitante;
    }

    /**
     * Set observacionesOperaciones
     *
     * @param string $observacionesOperaciones
     * @return Solicitud
     */
    public function setObservacionesOperaciones($observacionesOperaciones)
    {
        $this->observacionesOperaciones = $observacionesOperaciones;
    
        return $this;
    }

    /**
     * Get observacionesOperaciones
     *
     * @return string 
     */
    public function getObservacionesOperaciones()
    {
        return $this->observacionesOperaciones;
    }

    /**
     * Set estado
     *
     * @param \Incentives\SolicitudesBundle\Entity\SolicitudesEstado $estado
     * @return Solicitud
     */
    public function setEstado(\Incentives\SolicitudesBundle\Entity\SolicitudesEstado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\SolicitudesBundle\Entity\SolicitudesEstado 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}