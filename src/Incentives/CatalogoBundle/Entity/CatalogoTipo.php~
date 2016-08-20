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
class CatalogoTipo
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Catalogos", mappedBy="catalogotipo")
     */
    protected $catalogo;

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
     * Add catalogos
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogos
     * @return EstadoCatalogo
     */
    public function addCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogos)
    {
        $this->catalogos[] = $catalogos;
    
        return $this;
    }

    /**
     * Remove catalogos
     *
     * @param \Incentives\CatalogoBundle\Entity\Catalogos $catalogos
     */
    public function removeCatalogo(\Incentives\CatalogoBundle\Entity\Catalogos $catalogos)
    {
        $this->catalogos->removeElement($catalogos);
    }

    /**
     * Get catalogos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCatalogos()
    {
        return $this->catalogos;
    }


    /**
     * Get catalogo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCatalogo()
    {
        return $this->catalogo;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return CatalogoTipo
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
     * @return CatalogoTipo
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