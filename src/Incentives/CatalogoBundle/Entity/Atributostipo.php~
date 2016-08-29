<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atributostipo
 *
 * @ORM\Entity
 * @ORM\Table(name="Atributostipo")
 */
class Atributostipo
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
     * @ORM\OneToMany(targetEntity="Atributosproducto", mappedBy="tipo", cascade={"persist"})
     * 
     */
    protected $atributos;

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
     * @return Atributostipo
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
        $this->atributos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add atributos
     *
     * @param \Incentives\CatalogoBundle\Entity\Atributosproducto $atributos
     * @return Atributostipo
     */
    public function addAtributo(\Incentives\CatalogoBundle\Entity\Atributosproducto $atributos)
    {
        $this->atributos[] = $atributos;
    
        return $this;
    }

    /**
     * Remove atributos
     *
     * @param \Incentives\CatalogoBundle\Entity\Atributosproducto $atributos
     */
    public function removeAtributo(\Incentives\CatalogoBundle\Entity\Atributosproducto $atributos)
    {
        $this->atributos->removeElement($atributos);
    }

    /**
     * Get atributos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Atributostipo
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
     * @return Atributostipo
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
