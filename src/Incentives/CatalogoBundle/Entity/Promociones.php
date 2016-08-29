<?php

namespace Incentives\CatalogoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promociones
 *
 * @ORM\Entity
 * @ORM\Table(name="Promociones")
 */
class Promociones
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
     * @ORM\ManyToOne(targetEntity="Premios", inversedBy="promocion")
     * @ORM\JoinColumn(name="premio_id", referencedColumnName="id", nullable=true)
     */
    protected $premio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="puntos", type="integer", nullable=true)
     */
    private $puntos;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="redimidos", type="integer", nullable=true)
     */
    private $redimidos;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="disponibles", type="integer", nullable=true)
     */
    private $disponibles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="programa", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", mappedBy="promocion")
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
     *
     * @return Promociones
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Promociones
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
     * Set puntos
     *
     * @param integer $puntos
     *
     * @return Promociones
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
     * Set redimidos
     *
     * @param integer $redimidos
     *
     * @return Promociones
     */
    public function setRedimidos($redimidos)
    {
        $this->redimidos = $redimidos;

        return $this;
    }

    /**
     * Get redimidos
     *
     * @return integer
     */
    public function getRedimidos()
    {
        return $this->redimidos;
    }

    /**
     * Set disponibles
     *
     * @param integer $disponibles
     *
     * @return Promociones
     */
    public function setDisponibles($disponibles)
    {
        $this->disponibles = $disponibles;

        return $this;
    }

    /**
     * Get disponibles
     *
     * @return integer
     */
    public function getDisponibles()
    {
        return $this->disponibles;
    }

    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     *
     * @return Promociones
     */
    public function setEstado(\Incentives\CatalogoBundle\Entity\Estados $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\CatalogoBundle\Entity\Estados
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Promociones
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
     *
     * @return Promociones
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
     * Set premio
     *
     * @param \Incentives\CatalogoBundle\Entity\Premios $premio
     *
     * @return Promociones
     */
    public function setPremio(\Incentives\CatalogoBundle\Entity\Premios $premio = null)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return \Incentives\CatalogoBundle\Entity\Premios
     */
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Promociones
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Add redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     *
     * @return Promociones
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Promociones
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Promociones
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
}
