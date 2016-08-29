<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConvocatoriasEstado
 *
 * @ORM\Table(name="ConvocatoriasEstado")
 * @ORM\Entity
 */
class ConvocatoriasEstado
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
     * @ORM\Column(name="nombre", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Convocatorias", mappedBy="estado", cascade={"persist", "remove"})
     * 
     */
    protected $convocatorias;

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
        $this->convocatorias = new ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ConvocatoriasEstado
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
        $this->convocatorias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add convocatorias
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias
     * @return ConvocatoriasEstado
     */
    public function addConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias)
    {
        $this->convocatorias[] = $convocatorias;
    
        return $this;
    }

    /**
     * Remove convocatorias
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias
     */
    public function removeConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias)
    {
        $this->convocatorias->removeElement($convocatorias);
    }

    /**
     * Get convocatorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConvocatorias()
    {
        return $this->convocatorias;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return ConvocatoriasEstado
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
     * @return ConvocatoriasEstado
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
