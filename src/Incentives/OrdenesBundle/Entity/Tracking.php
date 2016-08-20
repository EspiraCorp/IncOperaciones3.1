<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tracking
 *
 * @ORM\Table(name="Tracking")
 * @ORM\Entity
 */
class Tracking
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
     * @ORM\ManyToOne(targetEntity="OrdenesProducto", inversedBy="tracking", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenproducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenproducto;

    /**
     * @var string
     *
     * @ORM\Column(name="tracking", type="string", length=255, nullable=true)
     */
    private $tracking;

    /**
     * @var string
     *
     * @ORM\Column(name="ordenAmazon", type="string", length=255, nullable=true)
     */
    private $ordenAmazon;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta", type="string", length=255, nullable=true)
     */
    private $tarjeta;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=true)
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

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
     * Set tracking
     *
     * @param string $tracking
     * @return Tracking
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;
    
        return $this;
    }

    /**
     * Get tracking
     *
     * @return string 
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * Set ordenAmazon
     *
     * @param string $ordenAmazon
     * @return Tracking
     */
    public function setOrdenAmazon($ordenAmazon)
    {
        $this->ordenAmazon = $ordenAmazon;
    
        return $this;
    }

    /**
     * Get ordenAmazon
     *
     * @return string 
     */
    public function getOrdenAmazon()
    {
        return $this->ordenAmazon;
    }

    /**
     * Set tarjeta
     *
     * @param string $tarjeta
     * @return Tracking
     */
    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $tarjeta;
    
        return $this;
    }

    /**
     * Get tarjeta
     *
     * @return string 
     */
    public function getTarjeta()
    {
        return $this->tarjeta;
    }    

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Tracking
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
     * Set ordenproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto
     * @return Tracking
     */
    public function setOrdenproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto = null)
    {
        $this->ordenproducto = $ordenproducto;
    
        return $this;
    }

    /**
     * Get ordenproducto
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesProducto 
     */
    public function getOrdenproducto()
    {
        return $this->ordenproducto;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Tracking
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
     * @return Tracking
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
     * Set precio
     *
     * @param float $precio
     * @return Tracking
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}