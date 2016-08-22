<?php

namespace Incentives\CatalogoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Catalogos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Incentives\CatalogoBundle\Entity\CatalogosRepository")
 * @ORM\Table(name="Catalogos")
 */
class Catalogos
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;
    
    /**
     * @var float
     *
     * @ORM\Column(name="valorPunto", type="float", nullable=true)
     */
    private $valorPunto;

    /**
     * @var float
     *
     * @ORM\Column(name="puntosMaximos", type="float", nullable=true)
     */
    private $puntosMaximos;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Programa", inversedBy="catalogo", cascade={"persist"})
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     */
    protected $programa;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="catalogo", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="CatalogoTipo", inversedBy="catalogo", cascade={"persist"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     */
    protected $catalogotipo;

    /**
     * @ORM\OneToMany(targetEntity="Productocatalogo", mappedBy="catalogos", cascade={"persist"})
     * 
     */
    protected $productocatalogo;
    
     /**
     * @ORM\OneToMany(targetEntity="Intervalos", mappedBy="catalogos", cascade={"persist"})
     * 
     */
    protected $intervalos;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Pais", inversedBy="catalogo")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=true)
     */
    protected $pais;

    /**
     * @ORM\OneToMany(targetEntity="ProductoCalificacion", mappedBy="catalogo", cascade={"persist"})
     * 
     */
    protected $calificacion;

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
        $this->productocatalogo = new ArrayCollection(); 
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
     * @return Catalogos
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
     * @return Catalogos
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
     * Set valorPunto
     *
     * @param integer $valorPunto
     * @return Catalogos
     */
    public function setValorPunto($valorPunto)
    {
        $this->valorPunto = $valorPunto;
    
        return $this;
    }

    /**
     * Get valorPunto
     *
     * @return integer 
     */
    public function getValorPunto()
    {
        return $this->valorPunto;
    }

    /**
     * Set puntosMaximos
     *
     * @param integer $puntosMaximos
     * @return Catalogos
     */
    public function setPuntosMaximos($puntosMaximos)
    {
        $this->puntosMaximos = $puntosMaximos;
    
        return $this;
    }

    /**
     * Get puntosMaximos
     *
     * @return integer 
     */
    public function getPuntosMaximos()
    {
        return $this->puntosMaximos;
    }

    /**
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Catalogos
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
     * Add productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     * @return Catalogos
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
     * Add calificacion
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductoCalificacion $calificacion
     * @return Catalogos
     */
    public function addCalificacion(\Incentives\CatalogoBundle\Entity\ProductoCalificacion $calificacion)
    {
        $this->calificacion[] = $calificacion;
    
        return $this;
    }

    /**
     * Remove calificacion
     *
     * @param \Incentives\CatalogoBundle\Entity\ProductoCalificacion $calificacion
     */
    public function removeCalificacion(\Incentives\CatalogoBundle\Entity\ProductoCalificacion $calificacion)
    {
        $this->calificacion->removeElement($calificacion);
    }

    /**
     * Get calificacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     * @return Catalogos
     */
    public function setEstado(\Incentives\CatalogoBundle\Entity\Estados $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\CatalogoBundle\Entity\Estados 
     */
    public function getEstado()
    {
        return $this->estado;
    }


    /**
     * Set pais
     *
     * @param \Incentives\OperacionesBundle\Entity\Pais $pais
     * @return Catalogos
     */
    public function setPais(\Incentives\OperacionesBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return \Incentives\OperacionesBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set catalogotipo
     *
     * @param \Incentives\CatalogoBundle\Entity\CatalogoTipo $catalogotipo
     * @return Catalogos
     */
    public function setCatalogotipo(\Incentives\CatalogoBundle\Entity\CatalogoTipo $catalogotipo = null)
    {
        $this->catalogotipo = $catalogotipo;
    
        return $this;
    }

    /**
     * Get catalogotipo
     *
     * @return \Incentives\CatalogoBundle\Entity\CatalogoTipo 
     */
    public function getCatalogotipo()
    {
        return $this->catalogotipo;
    }

    /**
     * Add intervalos
     *
     * @param \Incentives\CatalogoBundle\Entity\Intervalos $intervalos
     * @return Catalogos
     */
    public function addIntervalo(\Incentives\CatalogoBundle\Entity\Intervalos $intervalos)
    {
        $this->intervalos[] = $intervalos;
    
        return $this;
    }

    /**
     * Remove intervalos
     *
     * @param \Incentives\CatalogoBundle\Entity\Intervalos $intervalos
     */
    public function removeIntervalo(\Incentives\CatalogoBundle\Entity\Intervalos $intervalos)
    {
        $this->intervalos->removeElement($intervalos);
    }

    /**
     * Get intervalos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIntervalos()
    {
        return $this->intervalos;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Catalogos
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
     * @return Catalogos
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
