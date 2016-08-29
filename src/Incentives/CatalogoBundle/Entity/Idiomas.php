<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idiomas
 *
 * @ORM\Entity
 * @ORM\Table(name="Idiomas")
 */
class Idiomas
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
     * @ORM\Column(name="codigo", type="string", length=10, nullable=true)
     */
    private $codigo;

    /**
     * @ORM\OneToMany(targetEntity="ProductoIdiomas", mappedBy="idioma", cascade={"persist"})
     * 
     */
    protected $productoidioma;

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
     * Constructor
     */
    public function __construct()
    {
        $this->productoidioma = new \Doctrine\Common\Collections\ArrayCollection();
    }
    


    /**
     * Add productoidioma
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductoIdiomas $productoidioma
     * @return Idiomas
     */
    public function addProductoidioma(\Incentives\CatalogoBundle\Entity\ProductoIdiomas $productoidioma)
    {
        $this->productoidioma[] = $productoidioma;
    
        return $this;
    }

    /**
     * Remove productoidioma
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductoIdiomas $productoidioma
     */
    public function removeProductoidioma(\Incentives\CatalogoBundle\Entity\ProductoIdiomas $productoidioma)
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

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Idiomas
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
     * @return Idiomas
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
