<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idiomas
 */
class Idiomas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productoidioma;

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
     * Constructor
     */
    public function __construct()
    {
        $this->productoidioma = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Idiomas
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
     * Set codigo
     *
     * @param string $codigo
     * @return Idiomas
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Add productoidioma
     *
     * @param \Incentives\OperacionesBundle\Entity\ProductoIdioma $productoidioma
     * @return Idiomas
     */
    public function addProductoidioma(\Incentives\OperacionesBundle\Entity\ProductoIdioma $productoidioma)
    {
        $this->productoidioma[] = $productoidioma;
    
        return $this;
    }

    /**
     * Remove productoidioma
     *
     * @param \Incentives\OperacionesBundle\Entity\ProductoIdioma $productoidioma
     */
    public function removeProductoidioma(\Incentives\OperacionesBundle\Entity\ProductoIdioma $productoidioma)
    {
        $this->productoidioma->removeElement($productoidioma);
    }

    /**
     * Get productoidioma
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductoidioma()
    {
        return $this->productoidioma;
    }
}
