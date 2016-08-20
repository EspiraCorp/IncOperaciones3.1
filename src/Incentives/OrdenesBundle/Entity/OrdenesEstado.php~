<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrdenesEstado
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrdenesEstado
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
     * @ORM\OneToMany(targetEntity="OrdenesCompra", mappedBy="ordenesEstado")
     */
    protected $ordenesCompra;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\Solicitud", mappedBy="estado")
     */
    protected $solicitud;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $ordenesproducto;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\SolicitudesBundle\Entity\CotizacionProducto", mappedBy="estado", cascade={"persist"})
     * 
     */
    protected $cotizacionproducto;

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
        $this->ordenesCompra = new ArrayCollection();
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
     * @return OrdenesEstado
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
     * Add ordenesCompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra
     * @return OrdenesEstado
     */
    public function addOrdenesCompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra)
    {
        $this->ordenesCompra[] = $ordenesCompra;
    
        return $this;
    }

    /**
     * Remove ordenesCompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra
     */
    public function removeOrdenesCompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra)
    {
        $this->ordenesCompra->removeElement($ordenesCompra);
    }

    /**
     * Get ordenesCompra
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesCompra()
    {
        return $this->ordenesCompra;
    }

    /**
     * Add solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return OrdenesEstado
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
     * Add ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     * @return OrdenesEstado
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
     * Add cotizacionproducto
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionproducto
     * @return OrdenesEstado
     */
    public function addCotizacionproducto(\Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionproducto)
    {
        $this->cotizacionproducto[] = $cotizacionproducto;
    
        return $this;
    }

    /**
     * Remove cotizacionproducto
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionproducto
     */
    public function removeCotizacionproducto(\Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionproducto)
    {
        $this->cotizacionproducto->removeElement($cotizacionproducto);
    }

    /**
     * Get cotizacionproducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCotizacionproducto()
    {
        return $this->cotizacionproducto;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return OrdenesEstado
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
     * @return OrdenesEstado
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