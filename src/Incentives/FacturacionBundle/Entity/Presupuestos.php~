<?php

namespace Incentives\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuestos
 *
 * @ORM\Entity
 * @ORM\Table(name="Presupuestos")
 */
class Presupuestos
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
     * @var integer
     *
     * @ORM\Column(name="valor", type="bigint", nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensual", type="bigint", nullable=true)
     */
    private $mensual;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion",  type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa", inversedBy="presupuestos",cascade={"persist"})
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     */
    protected $programa;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Areas", inversedBy="presupuestos",cascade={"persist"})
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=true)
     */
    protected $area;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\Tipocostos", inversedBy="presupuesto",cascade={"persist"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     */
    protected $tipo;

     /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\Presupuestoshistorico", mappedBy="presupuesto", cascade={"persist"})
     * 
     */
    protected $historico;

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
     * @param integer $valor
     * @return Presupuestos
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
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Presupuestos
     */
    public function setPrograma(\Incentives\CatalogoBundle\Entity\Programa $programa = null)
    {
        $this->programa = $programa;
    
        return $this;
    }

    /**
     * Get programa
     *
     * @return \Incentives\CatalogoBundle\Entity\Programa 
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Set area
     *
     * @param \Incentives\FacturacionBundle\Entity\Areas $area
     * @return Presupuestos
     */
    public function setArea(\Incentives\FacturacionBundle\Entity\Areas $area = null)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area
     *
     * @return \Incentives\FacturacionBundle\Entity\Areas 
     */
    public function getArea()
    {
        return $this->area;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historico = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add historico
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestoshistorico $historico
     * @return Presupuestos
     */
    public function addHistorico(\Incentives\FacturacionBundle\Entity\Presupuestoshistorico $historico)
    {
        $this->historico[] = $historico;
    
        return $this;
    }

    /**
     * Remove historico
     *
     * @param \Incentives\FacturacionBundle\Entity\Presupuestoshistorico $historico
     */
    public function removeHistorico(\Incentives\FacturacionBundle\Entity\Presupuestoshistorico $historico)
    {
        $this->historico->removeElement($historico);
    }

    /**
     * Get historico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistorico()
    {
        return $this->historico;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Presupuestos
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
     * Set mensual
     *
     * @param integer $mensual
     * @return Presupuestos
     */
    public function setMensual($mensual)
    {
        $this->mensual = $mensual;
    
        return $this;
    }

    /**
     * Get mensual
     *
     * @return integer 
     */
    public function getMensual()
    {
        return $this->mensual;
    }

    /**
     * Set tipo
     *
     * @param \Incentives\FacturacionBundle\Entity\Tipocostos $tipo
     * @return Presupuestos
     */
    public function setTipo(\Incentives\FacturacionBundle\Entity\Tipocostos $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Incentives\FacturacionBundle\Entity\Tipocostos 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Presupuestos
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
     * @return Presupuestos
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
