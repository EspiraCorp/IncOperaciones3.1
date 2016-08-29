<?php

namespace Incentives\RedencionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Redencionesatributos
 *
 * @ORM\Table(name="Redencionesatributos")
 * @ORM\Entity
 */
class Redencionesatributos
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
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Atributosproducto", inversedBy="redencion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="atributos_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $atributos;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Redenciones", inversedBy="atributos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="redencion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $redencion;

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
     * Set valor
     *
     * @param string $valor
     * @return Redencionesatributos
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set atributos
     *
     * @param \Incentives\CatalogoBundle\Entity\Atributosproducto $atributos
     * @return Redencionesatributos
     */
    public function setAtributos(\Incentives\CatalogoBundle\Entity\Atributosproducto $atributos = null)
    {
        $this->atributos = $atributos;
    
        return $this;
    }

    /**
     * Get atributos
     *
     * @return \Incentives\CatalogoBundle\Entity\Atributosproducto 
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    /**
     * Set redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     * @return Redencionesatributos
     */
    public function setRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion = null)
    {
        $this->redencion = $redencion;
    
        return $this;
    }

    /**
     * Get redencion
     *
     * @return \Incentives\RedencionesBundle\Entity\Redenciones 
     */
    public function getRedencion()
    {
        return $this->redencion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Redencionesatributos
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
     * @return Redencionesatributos
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
