<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Areas
 *
 * @ORM\Entity
 * @ORM\Table(name="Areas")
 */
class Areas
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\Presupuestos", mappedBy="area", cascade={"persist"})
     * 
     */
    protected $presupuestos;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaDetalle", mappedBy="area", cascade={"persist"})
     * 
     */
    protected $detalle;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Areas
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
     * @return Areas
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
     * Constructor
     */
    public function __construct()
    {
        $this->presupuestos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add presupuestos
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuestos
     * @return Areas
     */
    public function addPresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuestos)
    {
        $this->presupuestos[] = $presupuestos;
    
        return $this;
    }

    /**
     * Remove presupuestos
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuestos
     */
    public function removePresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuestos)
    {
        $this->presupuestos->removeElement($presupuestos);
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
     * Add detalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle
     * @return Areas
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Areas
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
     * @return Areas
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