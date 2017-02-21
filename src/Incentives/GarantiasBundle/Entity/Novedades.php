<?php

namespace Incentives\GarantiasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Novedades
 *
 * @ORM\Entity
 * @ORM\Table(name="Novedades")
 */
class Novedades
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=500, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacionaccion", type="string", length=500, nullable=true)
     */
    private $observacionaccion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="solucion", type="string", length=1500, nullable=true)
     */
    private $solucion;


    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", inversedBy="novedad")
     * @ORM\JoinColumn(name="redencion_id", referencedColumnName="id", nullable=true)
     */
    protected $redencion;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Novedadesestado", inversedBy="novedad")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Novedadestipo")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     */
    protected $tipo;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="NovedadesDevolucionTipo", inversedBy="novedad")
     * @ORM\JoinColumn(name="devolucionTipo_id", referencedColumnName="id", nullable=true)
     */
    protected $devolucionTipo;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Novedadesaccion", inversedBy="novedad")
     * @ORM\JoinColumn(name="accion_id", referencedColumnName="id", nullable=true)
     */
    protected $accion;

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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Novedades
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Novedades
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set redencion
     *
     * @param \Incentives\GarantiasBundle\Entity\Redenciones $redencion
     * @return Novedades
     */
    public function setRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion = null)
    {
        $this->redencion = $redencion;
    
        return $this;
    }

    /**
     * Get redencion
     *
     * @return \Incentives\GarantiasBundle\Entity\Redenciones 
     */
    public function getRedencion()
    {
        return $this->redencion;
    }

    /**
     * Set estado
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedadesestado $estado
     * @return Novedades
     */
    public function setEstado(\Incentives\GarantiasBundle\Entity\Novedadesestado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\GarantiasBundle\Entity\Novedadesestado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipo
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedadestipo $tipo
     * @return Novedades
     */
    public function setTipo(\Incentives\GarantiasBundle\Entity\Novedadestipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Incentives\GarantiasBundle\Entity\Novedadestipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set observacionaccion
     *
     * @param string $observacionaccion
     * @return Novedades
     */
    public function setObservacionaccion($observacionaccion)
    {
        $this->observacionaccion = $observacionaccion;
    
        return $this;
    }

    /**
     * Get observacionaccion
     *
     * @return string 
     */
    public function getObservacionaccion()
    {
        return $this->observacionaccion;
    }

    /**
     * Set accion
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedadesaccion $accion
     * @return Novedades
     */
    public function setAccion(\Incentives\GarantiasBundle\Entity\Novedadesaccion $accion = null)
    {
        $this->accion = $accion;
    
        return $this;
    }

    /**
     * Get accion
     *
     * @return \Incentives\GarantiasBundle\Entity\Novedadesaccion 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Novedades
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
     * @return Novedades
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
     * Set solucion
     *
     * @param string $solucion
     * @return Novedades
     */
    public function setSolucion($solucion)
    {
        $this->solucion = $solucion;
    
        return $this;
    }

    /**
     * Get solucion
     *
     * @return string 
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * Set devolucionTipo
     *
     * @param \Incentives\GarantiasBundle\Entity\NovedadesDevolucionTipo $devolucionTipo
     * @return Novedades
     */
    public function setDevolucionTipo(\Incentives\GarantiasBundle\Entity\NovedadesDevolucionTipo $devolucionTipo = null)
    {
        $this->devolucionTipo = $devolucionTipo;
    
        return $this;
    }

    /**
     * Get devolucionTipo
     *
     * @return \Incentives\GarantiasBundle\Entity\NovedadesDevolucionTipo 
     */
    public function getDevolucionTipo()
    {
        return $this->devolucionTipo;
    }
}
