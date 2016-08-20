<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Factura
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;
    
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
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaDetalle", mappedBy="factura", cascade={"persist"})
     * 
     */
    protected $detalle;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaProductos", mappedBy="factura", cascade={"persist"})
     * 
     */
    protected $facturaproductos;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaLogistica", mappedBy="factura", cascade={"persist"})
     * 
     */
    protected $facturalogistica;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa", inversedBy="factura",cascade={"persist"})
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     */
    protected $programa;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Pais")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=true)
     */
    protected $pais;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Periodos", inversedBy="factura",cascade={"persist"})
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id", nullable=true)
     */
    protected $periodo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rutapdf", type="string", length=255, nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $rutapdf;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfLogistica", type="string", length=255, nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pdfLogistica;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="logistica", type="boolean", nullable=true)
     */
    private $logistica;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="requisiciones", type="boolean", nullable=true)
     */
    private $requisiciones;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="premios", type="boolean", nullable=true)
     */
    private $premios;

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
     * @return Factura
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
     * Set numero
     *
     * @param string $numero
     * @return Factura
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalle = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add detalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle
     * @return Factura
     */
    public function addDetalle(\Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle)
    {
        $this->detalle[] = $detalle;
    
        return $this;
    }

    /**
     * Remove detalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle
     */
    public function removeDetalle(\Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle)
    {
        $this->detalle->removeElement($detalle);
    }

    /**
     * Get detalle
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Factura
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
    
     /** Add facturalogistica
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica
     * @return Factura
     */
    public function addFacturalogistica(\Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica)
    {
        $this->facturalogistica[] = $facturalogistica;
    
        return $this;
    }

    /**
     * Remove facturalogistica
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica
     */
    public function removeFacturalogistica(\Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica)
    {
        $this->facturalogistica->removeElement($facturalogistica);
    }

    /**
     * Get facturalogistica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturalogistica()
    {
        return $this->facturalogistica;
    }


    /**
     * Set periodo
     *
     * @param \Incentives\FacturacionBundle\Entity\Periodos $periodo
     * @return Factura
     */
    public function setPeriodo(\Incentives\FacturacionBundle\Entity\Periodos $periodo = null)
    {
        $this->periodo = $periodo;
    
        return $this;
    }

    /**
     * Get periodo
     *
     * @return \Incentives\FacturacionBundle\Entity\Periodos 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

   
    /**
     * Add facturapremios
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaPremios $facturapremios
     * @return Factura
     */
    public function addFacturapremio(\Incentives\FacturacionBundle\Entity\FacturaPremios $facturapremios)
    {
        $this->facturapremios[] = $facturapremios;
    
        return $this;
    }

    /**
     * Remove facturapremios
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaPremios $facturapremios
     */
    public function removeFacturapremio(\Incentives\FacturacionBundle\Entity\FacturaPremios $facturapremios)
    {
        $this->facturapremios->removeElement($facturapremios);
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Factura
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
     * @return Factura
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
     * Add facturaproductos
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaproductos
     * @return Factura
     */
    public function addFacturaproducto(\Incentives\FacturacionBundle\Entity\FacturaProductos $facturaproductos)
    {
        $this->facturaproductos[] = $facturaproductos;
    
        return $this;
    }

    /**
     * Remove facturaproductos
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaproductos
     */
    public function removeFacturaproducto(\Incentives\FacturacionBundle\Entity\FacturaProductos $facturaproductos)
    {
        $this->facturaproductos->removeElement($facturaproductos);
    }

    /**
     * Get facturaproductos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturaproductos()
    {
        return $this->facturaproductos;
    }

    /**
     * Set rutapdf
     *
     * @param string $rutapdf
     * @return Factura
     */
    public function setRutapdf($rutapdf)
    {
        $this->rutapdf = $rutapdf;
    
        return $this;
    }

    /**
     * Get rutapdf
     *
     * @return string 
     */
    public function getRutapdf()
    {
        return $this->rutapdf;
    }

    /**
     * Set pdfLogistica
     *
     * @param string $pdfLogistica
     * @return Factura
     */
    public function setPdfLogistica($pdfLogistica)
    {
        $this->pdfLogistica = $pdfLogistica;
    
        return $this;
    }

    /**
     * Get pdfLogistica
     *
     * @return string 
     */
    public function getPdfLogistica()
    {
        return $this->pdfLogistica;
    }

    /**
     * Set logistica
     *
     * @param boolean $logistica
     * @return Factura
     */
    public function setLogistica($logistica)
    {
        $this->logistica = $logistica;
    
        return $this;
    }

    /**
     * Get logistica
     *
     * @return boolean 
     */
    public function getLogistica()
    {
        return $this->logistica;
    }

    /**
     * Set requisiciones
     *
     * @param boolean $requisiciones
     * @return Factura
     */
    public function setRequisiciones($requisiciones)
    {
        $this->requisiciones = $requisiciones;
    
        return $this;
    }

    /**
     * Get requisiciones
     *
     * @return boolean 
     */
    public function getRequisiciones()
    {
        return $this->requisiciones;
    }

    /**
     * Set premios
     *
     * @param boolean $premios
     * @return Factura
     */
    public function setPremios($premios)
    {
        $this->premios = $premios;
    
        return $this;
    }

    /**
     * Get premios
     *
     * @return boolean 
     */
    public function getPremios()
    {
        return $this->premios;
    }
    
    /**
     * Set pais
     *
     * @param \Incentives\OperacionesBundle\Entity\Pais $pais
     * @return Factura
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Factura
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
     * @return Factura
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