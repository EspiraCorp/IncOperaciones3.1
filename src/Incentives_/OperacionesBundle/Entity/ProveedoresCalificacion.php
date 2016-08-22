<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProveedoresCalificacion
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="ProveedoresCalificacion")
 */
class ProveedoresCalificacion
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
     * @var float
     *
     * @ORM\Column(name="calificacion", type="float", nullable=true)
     */
    private $calificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="periodo", type="string", length=255, nullable=true)
     */
    private $periodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estadoPlan", type="integer", nullable=true)
     */
    private $estadoPlan;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var text
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resultado", type="boolean", nullable=true)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="planAccion", type="string", length=255, nullable=true)
     */
    private $planAccion;

    /**
     * @var text
     *
     * @ORM\Column(name="observacionproveedor", type="text", nullable=true)
     */
    private $observacionproveedor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPlan", type="date", nullable=true)
     */
    private $fechaPlan;

    /**
     * @var text
     *
     * @ORM\Column(name="observacionfinal", type="text", nullable=true)
     */
    private $observacionfinal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var float
     *
     * @ORM\Column(name="ce", type="float", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     */
    private $ce;

    /**
     * @var float
     *
     * @ORM\Column(name="cpi", type="float", nullable=true)
     */
    private $cpi;

    /**
     * @var float
     *
     * @ORM\Column(name="bep", type="float", nullable=true)
     */
    private $bep;

    /**
     * @var float
     *
     * @ORM\Column(name="pd", type="float", nullable=true)
     */
    private $pd;

    /**
     * @var float
     *
     * @ORM\Column(name="aoc", type="float", nullable=true)
     */
    private $aoc;

    /**
     * @var float
     *
     * @ORM\Column(name="cfp", type="float", nullable=true)
     */
    private $cfp;    

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="carta", type="string", length=255, nullable=true)
     */
    private $carta;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Proveedores", inversedBy="proveedorcalificacion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $proveedor;

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
     * Set calificacion
     *
     * @param float $calificacion
     * @return ProveedoresCalificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    
        return $this;
    }

    /**
     * Get calificacion
     *
     * @return float 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ProveedoresCalificacion
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
     * @return ProveedoresCalificacion
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
     * Set resultado
     *
     * @param boolean $resultado
     * @return ProveedoresCalificacion
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    
        return $this;
    }

    /**
     * Get resultado
     *
     * @return boolean 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set planAccion
     *
     * @param string $planAccion
     * @return ProveedoresCalificacion
     */
    public function setPlanAccion($planAccion)
    {
        $this->planAccion = $planAccion;
    
        return $this;
    }

    /**
     * Get planAccion
     *
     * @return string 
     */
    public function getPlanAccion()
    {
        return $this->planAccion;
    }

    /**
     * Set observacionproveedor
     *
     * @param string $observacionproveedor
     * @return ProveedoresCalificacion
     */
    public function setObservacionproveedor($observacionproveedor)
    {
        $this->observacionproveedor = $observacionproveedor;
    
        return $this;
    }

    /**
     * Get observacionproveedor
     *
     * @return string 
     */
    public function getObservacionproveedor()
    {
        return $this->observacionproveedor;
    }

    /**
     * Set fechaPlan
     *
     * @param \DateTime $fechaPlan
     * @return ProveedoresCalificacion
     */
    public function setFechaPlan($fechaPlan)
    {
        $this->fechaPlan = $fechaPlan;
    
        return $this;
    }

    /**
     * Get fechaPlan
     *
     * @return \DateTime 
     */
    public function getFechaPlan()
    {
        return $this->fechaPlan;
    }

    /**
     * Set observacionfinal
     *
     * @param string $observacionfinal
     * @return ProveedoresCalificacion
     */
    public function setObservacionfinal($observacionfinal)
    {
        $this->observacionfinal = $observacionfinal;
    
        return $this;
    }

    /**
     * Get observacionfinal
     *
     * @return string 
     */
    public function getObservacionfinal()
    {
        return $this->observacionfinal;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return ProveedoresCalificacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ce
     *
     * @param float $ce
     * @return ProveedoresCalificacion
     */
    public function setCe($ce)
    {
        $this->ce = $ce;
    
        return $this;
    }

    /**
     * Get ce
     *
     * @return float 
     */
    public function getCe()
    {
        return $this->ce;
    }

    /**
     * Set cpi
     *
     * @param float $cpi
     * @return ProveedoresCalificacion
     */
    public function setCpi($cpi)
    {
        $this->cpi = $cpi;
    
        return $this;
    }

    /**
     * Get cpi
     *
     * @return float 
     */
    public function getCpi()
    {
        return $this->cpi;
    }

    /**
     * Set bep
     *
     * @param float $bep
     * @return ProveedoresCalificacion
     */
    public function setBep($bep)
    {
        $this->bep = $bep;
    
        return $this;
    }

    /**
     * Get bep
     *
     * @return float 
     */
    public function getBep()
    {
        return $this->bep;
    }

    /**
     * Set pd
     *
     * @param float $pd
     * @return ProveedoresCalificacion
     */
    public function setPd($pd)
    {
        $this->pd = $pd;
    
        return $this;
    }

    /**
     * Get pd
     *
     * @return float 
     */
    public function getPd()
    {
        return $this->pd;
    }

    /**
     * Set aoc
     *
     * @param float $aoc
     * @return ProveedoresCalificacion
     */
    public function setAoc($aoc)
    {
        $this->aoc = $aoc;
    
        return $this;
    }

    /**
     * Get aoc
     *
     * @return float 
     */
    public function getAoc()
    {
        return $this->aoc;
    }

    /**
     * Set cfp
     *
     * @param float $cfp
     * @return ProveedoresCalificacion
     */
    public function setCfp($cfp)
    {
        $this->cfp = $cfp;
    
        return $this;
    }

    /**
     * Get cfp
     *
     * @return float 
     */
    public function getCfp()
    {
        return $this->cfp;
    }

    /**
     * Set proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     * @return ProveedoresCalificacion
     */
    public function setProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Incentives\OperacionesBundle\Entity\Proveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return ProveedoresCalificacion
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
     * Set path
     *
     * @param string $path
     * @return ProveedoresCalificacion
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Set carta
     *
     * @param string $carta
     * @return ProveedoresCalificacion
     */
    public function setCarta($carta)
    {
        $this->carta = $carta;
    
        return $this;
    }

    /**
     * Get carta
     *
     * @return string 
     */
    public function getCarta()
    {
        return $this->carta;
    }

    /**
     * Set periodo
     *
     * @param string $periodo
     * @return ProveedoresCalificacion
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    
        return $this;
    }

    /**
     * Get periodo
     *
     * @return string 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return ProveedoresCalificacion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set estadoPlan
     *
     * @param integer $estadoPlan
     * @return ProveedoresCalificacion
     */
    public function setEstadoPlan($estadoPlan)
    {
        $this->estadoPlan = $estadoPlan;
    
        return $this;
    }

    /**
     * Get estadoPlan
     *
     * @return integer 
     */
    public function getEstadoPlan()
    {
        return $this->estadoPlan;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return ProveedoresCalificacion
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
