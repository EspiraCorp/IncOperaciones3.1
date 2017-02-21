<?php

namespace Incentives\RedencionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuiaEnvio
 *
 * @ORM\Table(name="GuiaEnvio")
 * @ORM\Entity
 */
class GuiaEnvio
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
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", inversedBy="guiaEnvio", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenProducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenProducto;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\Courier", inversedBy="guiaEnvio", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="courier_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $courier;

    /**
     * @var string
     *
     * @ORM\Column(name="guia", type="string", length=255, nullable=true)
     */
    private $guia;

    /**
     * @var string
     *
     * @ORM\Column(name="operador", type="string", length=255, nullable=true)
     */
    private $operador;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="bigint", nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\DespachoGuia", mappedBy="guia", cascade={"persist"})
     * 
     */
    protected $despachoguia;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="\Incentives\FacturacionBundle\Entity\FacturaLogistica", inversedBy="guias", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="facturaLogistica_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $facturalogistica;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\Redencionesenvios", inversedBy="guia", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="redencionenvio_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $redencionenvio;


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
        $this->estado='1';
        $this->fecha = new \DateTime("now");
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
     * Set guia
     *
     * @param string $guia
     *
     * @return GuiaEnvio
     */
    public function setGuia($guia)
    {
        $this->guia = $guia;

        return $this;
    }

    /**
     * Get guia
     *
     * @return string
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set operador
     *
     * @param string $operador
     *
     * @return GuiaEnvio
     */
    public function setOperador($operador)
    {
        $this->operador = $operador;

        return $this;
    }

    /**
     * Get operador
     *
     * @return string
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * Set valor
     *
     * @param integer $valor
     *
     * @return GuiaEnvio
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return GuiaEnvio
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return GuiaEnvio
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return GuiaEnvio
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
     * Set ordenProducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenProducto
     *
     * @return GuiaEnvio
     */
    public function setOrdenProducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenProducto = null)
    {
        $this->ordenProducto = $ordenProducto;

        return $this;
    }

    /**
     * Get ordenProducto
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesProducto
     */
    public function getOrdenProducto()
    {
        return $this->ordenProducto;
    }

    /**
     * Set courier
     *
     * @param \Incentives\InventarioBundle\Entity\Courier $courier
     *
     * @return GuiaEnvio
     */
    public function setCourier(\Incentives\InventarioBundle\Entity\Courier $courier = null)
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * Get courier
     *
     * @return \Incentives\InventarioBundle\Entity\Courier
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * Set facturalogistica
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica
     *
     * @return GuiaEnvio
     */
    public function setFacturalogistica(\Incentives\FacturacionBundle\Entity\FacturaLogistica $facturalogistica = null)
    {
        $this->facturalogistica = $facturalogistica;

        return $this;
    }

    /**
     * Get facturalogistica
     *
     * @return \Incentives\FacturacionBundle\Entity\FacturaLogistica
     */
    public function getFacturalogistica()
    {
        return $this->facturalogistica;
    }

    /**
     * Set redencionenvio
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio
     *
     * @return GuiaEnvio
     */
    public function setRedencionenvio(\Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio = null)
    {
        $this->redencionenvio = $redencionenvio;

        return $this;
    }

    /**
     * Get redencionenvio
     *
     * @return \Incentives\RedencionesBundle\Entity\Redencionesenvios
     */
    public function getRedencionenvio()
    {
        return $this->redencionenvio;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     *
     * @return GuiaEnvio
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
     * Add despachoguium
     *
     * @param \Incentives\InventarioBundle\Entity\DespachoGuia $despachoguium
     *
     * @return GuiaEnvio
     */
    public function addDespachoguium(\Incentives\InventarioBundle\Entity\DespachoGuia $despachoguium)
    {
        $this->despachoguia[] = $despachoguium;

        return $this;
    }

    /**
     * Remove despachoguium
     *
     * @param \Incentives\InventarioBundle\Entity\DespachoGuia $despachoguium
     */
    public function removeDespachoguium(\Incentives\InventarioBundle\Entity\DespachoGuia $despachoguium)
    {
        $this->despachoguia->removeElement($despachoguium);
    }

    /**
     * Get despachoguia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDespachoguia()
    {
        return $this->despachoguia;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return GuiaEnvio
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
}
