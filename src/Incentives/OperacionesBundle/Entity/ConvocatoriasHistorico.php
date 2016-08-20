<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Convocatorias
 *
 * @ORM\Table(name="ConvocatoriasHistorico")
 * @ORM\Entity
 */
class ConvocatoriasHistorico
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
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

     /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fechaFin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores", mappedBy="convocatorias", cascade={"persist", "remove"})
     * 
     */
    protected $convocatoriasproveedores;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="convocatoria", cascade={"persist"})
     * 
     */
    protected $inventario;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="ConvocatoriasEstado", inversedBy="convocatorias", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $estado;
    
     /**
     * 
     * @ORM\ManyToOne(targetEntity="Convocatorias", inversedBy="convocatoriashistorico", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="convocatoria_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $convocatoria;

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
        $this->convocatoriasproveedores = new ArrayCollection();
        $this->inventario = new ArrayCollection();
        $this->estado='1';
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
     * Set titulo
     *
     * @param string $titulo
     * @return Convocatorias
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Convocatorias
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Convocatorias
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
     * @return Convocatorias
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

    /**
     * Add convocatoriasproveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores
     * @return Convocatorias
     */
    public function addConvocatoriasproveedore(\Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores)
    {
        $this->convocatoriasproveedores[] = $convocatoriasproveedores;
    
        return $this;
    }

    /**
     * Remove convocatoriasproveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores
     */
    public function removeConvocatoriasproveedore(\Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores)
    {
        $this->convocatoriasproveedores->removeElement($convocatoriasproveedores);
    }

    /**
     * Get convocatoriasproveedores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConvocatoriasproveedores()
    {
        return $this->convocatoriasproveedores;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     * @return Convocatorias
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
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return Convocatorias
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
     * Get inventario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInventario()
    {
        return $this->inventario;
    }

    /**
     * Set estado
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatoriasestado $estado
     * @return Convocatorias
     */
    public function setEstado(\Incentives\OperacionesBundle\Entity\Convocatoriasestado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\OperacionesBundle\Entity\Convocatoriasestado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     * @return Convocatorias
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set convocatoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria
     * @return ConvocatoriasHistorico
     */
    public function setConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria = null)
    {
        $this->convocatoria = $convocatoria;
    
        return $this;
    }

    /**
     * Get convocatoria
     *
     * @return \Incentives\OperacionesBundle\Entity\Convocatorias 
     */
    public function getConvocatoria()
    {
        return $this->convocatoria;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return ConvocatoriasHistorico
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return ConvocatoriasHistorico
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
}