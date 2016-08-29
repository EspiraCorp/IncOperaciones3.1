<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipocostos
 *
 * @ORM\Entity
 * @ORM\Table(name="Tipocostos")
 */
class Tipocostos
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
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaDetalle", mappedBy="tipo", cascade={"persist"})
     * 
     */
    protected $detalle;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\Presupuestos", mappedBy="tipo", cascade={"persist"})
     * 
     */
    protected $presupuesto;

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
     * @return Tipocostos
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
     * Constructor
     */
    public function __construct()
    {
        $this->detalle = new \Doctrine\Common\Collections\ArrayCollection();
        $this->presupuesto = new ArrayCollection();
    }
    
    /**
     * Add detalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $detalle
     * @return Tipocostos
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
     * Add presupuesto
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto
     * @return Tipocostos
     */
    public function addPresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto)
    {
        $this->presupuesto[] = $presupuesto;
    
        return $this;
    }

    /**
     * Remove presupuesto
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto
     */
    public function removePresupuesto(\Incentives\FacturacionBundle\Entity\Presupuestos $presupuesto)
    {
        $this->presupuesto->removeElement($presupuesto);
    }

    /**
     * Get presupuesto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Tipocostos
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
     * @return Tipocostos
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
