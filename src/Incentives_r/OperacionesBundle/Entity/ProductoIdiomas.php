<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoIdiomas
 */
class ProductoIdiomas
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
    private $descripcion;

    /**
     * @var \Incentives\OperacionesBundle\Entity\Producto
     */
    private $producto;

    /**
     * @var \Incentives\OperacionesBundle\Entity\Producto
     */
    private $idioma;

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
     * @return ProductoIdiomas
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
     * @return ProductoIdiomas
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
     * Set producto
     *
     * @param \Incentives\OperacionesBundle\Entity\Producto $producto
     * @return ProductoIdiomas
     */
    public function setProducto(\Incentives\OperacionesBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Incentives\OperacionesBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set idioma
     *
     * @param \Incentives\OperacionesBundle\Entity\Producto $idioma
     * @return ProductoIdiomas
     */
    public function setIdioma(\Incentives\OperacionesBundle\Entity\Producto $idioma = null)
    {
        $this->idioma = $idioma;
    
        return $this;
    }

    /**
     * Get idioma
     *
     * @return \Incentives\OperacionesBundle\Entity\Producto 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }
}
