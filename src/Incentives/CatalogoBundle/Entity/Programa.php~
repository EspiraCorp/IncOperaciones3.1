<?php

namespace Incentives\CatalogoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programa
 *
 * @ORM\Entity
 * @ORM\Table(name="Programa")
 */
class Programa
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainicio", type="date", nullable=true)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafin", type="date", nullable=true)
     */
    private $fechafin;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="programa", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="logistica", type="float", nullable=true)
     */
    private $logistica;

    /**
     * @var boolean
     *
     * @ORM\Column(name="iva", type="boolean", nullable=true)
     */
    private $iva;

    /**
     * @var integer
     *
     * @ORM\Column(name="diasentrega", type="integer", nullable=true)
     */
    private $diasentrega;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="programa",cascade={"persist"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=true)
     */
    protected $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Catalogos", mappedBy="programa", cascade={"persist"})
     * 
     */
    protected $catalogo;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", mappedBy="programa", cascade={"persist"})
     * 
     */
    protected $ordenesproducto;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\Presupuestos", mappedBy="programa", cascade={"persist"})
     * 
     */
    protected $presupuestos;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\Factura", mappedBy="programa", cascade={"persist"})
     * 
     */
    protected $factura;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\Solicitud", mappedBy="programa", cascade={"persist"})
     * 
     */
    protected $solicitud;
    
     /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Participantes", mappedBy="programa")
     * 
     */
    protected $participantes;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="CentroCostos", cascade={"persist"})
     * @ORM\JoinColumn(name="centroCostos_id", referencedColumnName="id", nullable=true)
     */
    protected $centroCostos;

    /**
     * @var string
     *
     * @ORM\Column(name="apiKey", type="string", length=255, nullable=true)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="apiSecret", type="string", length=255, nullable=true)
     */
    private $apiSecret;

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
        $this->catalogos = new ArrayCollection(); 
        $this->participantes = new ArrayCollection();    
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
     * @return Programa
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
     * @return Programa
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
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Programa
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     *
     * @return Programa
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set logistica
     *
     * @param float $logistica
     *
     * @return Programa
     */
    public function setLogistica($logistica)
    {
        $this->logistica = $logistica;

        return $this;
    }

    /**
     * Get logistica
     *
     * @return float
     */
    public function getLogistica()
    {
        return $this->logistica;
    }

    /**
     * Set iva
     *
     * @param boolean $iva
     *
     * @return Programa
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return boolean
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set diasentrega
     *
     * @param integer $diasentrega
     *
     * @return Programa
     */
    public function setDiasentrega($diasentrega)
    {
        $this->diasentrega = $diasentrega;

        return $this;
    }

    /**
     * Get diasentrega
     *
     * @return integer
     */
    public function getDiasentrega()
    {
        return $this->diasentrega;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Programa
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
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     *
     * @return Programa
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
     * Set cliente
     *
     * @param \Incentives\CatalogoBundle\Entity\Cliente $cliente
     *
     * @return Programa
     */
    public function setCliente(\Incentives\CatalogoBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Incentives\CatalogoBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add catalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogo
     *
     * @return Programa
     */
    public function addCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogo)
    {
        $this->catalogo[] = $catalogo;

        return $this;
    }

    /**
     * Remove catalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogo
     */
    public function removeCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogo)
    {
        $this->catalogo->removeElement($catalogo);
    }

    /**
     * Get catalogo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatalogo()
    {
        return $this->catalogo;
    }

    /**
     * Add ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     *
     * @return Programa
     */
    public function addOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->ordenesproducto[] = $ordenesproducto;

        return $this;
    }

    /**
     * Remove ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     */
    public function removeOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->ordenesproducto->removeElement($ordenesproducto);
    }

    /**
     * Get ordenesproducto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdenesproducto()
    {
        return $this->ordenesproducto;
    }

    /**
     * Add presupuesto
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto
     *
     * @return Programa
     */
    public function addPresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto)
    {
        $this->presupuestos[] = $presupuesto;

        return $this;
    }

    /**
     * Remove presupuesto
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto
     */
    public function removePresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto)
    {
        $this->presupuestos->removeElement($presupuesto);
    }

    /**
     * Get presupuestos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresupuestos()
    {
        return $this->presupuestos;
    }

    /**
     * Add factura
     *
     * @param \Incentives\FacturacionBundle\Entity\Factura $factura
     *
     * @return Programa
     */
    public function addFactura(\Incentives\FacturacionBundle\Entity\Factura $factura)
    {
        $this->factura[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \Incentives\FacturacionBundle\Entity\Factura $factura
     */
    public function removeFactura(\Incentives\FacturacionBundle\Entity\Factura $factura)
    {
        $this->factura->removeElement($factura);
    }

    /**
     * Get factura
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Add solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     *
     * @return Programa
     */
    public function addSolicitud(\Incentives\SolicitudesBundle\Entity\Solicitud $solicitud)
    {
        $this->solicitud[] = $solicitud;

        return $this;
    }

    /**
     * Remove solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     */
    public function removeSolicitud(\Incentives\SolicitudesBundle\Entity\Solicitud $solicitud)
    {
        $this->solicitud->removeElement($solicitud);
    }

    /**
     * Get solicitud
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Add participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     *
     * @return Programa
     */
    public function addParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participantes[] = $participante;

        return $this;
    }

    /**
     * Remove participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     */
    public function removeParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participantes->removeElement($participante);
    }

    /**
     * Get participantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set centroCostos
     *
     * @param \Incentives\CatalogoBundle\Entity\CentroCostos $centroCostos
     *
     * @return Programa
     */
    public function setCentroCostos(\Incentives\CatalogoBundle\Entity\CentroCostos $centroCostos = null)
    {
        $this->centroCostos = $centroCostos;

        return $this;
    }

    /**
     * Get centroCostos
     *
     * @return \Incentives\CatalogoBundle\Entity\CentroCostos
     */
    public function getCentroCostos()
    {
        return $this->centroCostos;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     *
     * @return Programa
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
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return Programa
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set apiSecret
     *
     * @param string $apiSecret
     *
     * @return Programa
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * Get apiSecret
     *
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }
}
