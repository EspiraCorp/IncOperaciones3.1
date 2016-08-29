<?php

namespace Incentives\RedencionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Participantesestado
 *
 * @ORM\Table(name="Participantesestado")
 * @ORM\Entity
 */
class Participantesestado
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
     * @ORM\OneToMany(targetEntity="Participantes", mappedBy="participanteestado")
     */
    protected $participante;

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
        $this->participante = new ArrayCollection();
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
     * @return Participantesestado
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
     * Add participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     * @return Participantesestado
     */
    public function addParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participante[] = $participante;
    
        return $this;
    }

    /**
     * Remove participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     */
    public function removeParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participante->removeElement($participante);
    }

    /**
     * Get participante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Participantesestado
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
     * @return Participantesestado
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