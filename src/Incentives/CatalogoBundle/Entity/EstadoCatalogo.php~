<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EstadoCatalogo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EstadoCatalogo
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
     * @ORM\OneToMany(targetEntity="Productocatalogo", mappedBy="estado")
     */
    protected $productocatalogo;

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
        $this->catalogos = new ArrayCollection();
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
     * @return EstadoCatalogo
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
     * Add productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     * @return EstadoCatalogo
     */
    public function addProductocatalogo(\Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo)
    {
        $this->productocatalogo[] = $productocatalogo;
    
        return $this;
    }

    /**
     * Remove productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     */
    public function removeProductocatalogo(\Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo)
    {
        $this->productocatalogo->removeElement($productocatalogo);
    }

    /**
     * Get productocatalogo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductocatalogo()
    {
        return $this->productocatalogo;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return EstadoCatalogo
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
     * @return EstadoCatalogo
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