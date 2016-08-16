<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ConvocatoriasProveedores
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ConvocatoriasProveedores
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
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCarga", type="date", nullable=true)
     */
    private $fechaCarga;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="seleccionado", type="smallint", nullable=true)
     */
    private $seleccionado;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Convocatorias", inversedBy="convocatoriasproveedores", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="convocatoria_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $convocatorias;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Proveedores", inversedBy="convocatoriasproveedores", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $proveedor;

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
     * Set archivo
     *
     * @param string $archivo
     * @return ConvocatoriasProveedores
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    
        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set fechaCarga
     *
     * @param \DateTime $fechaCarga
     * @return ConvocatoriasProveedores
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;
    
        return $this;
    }

    /**
     * Get fechaCarga
     *
     * @return \DateTime 
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return ConvocatoriasProveedores
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set seleccionado
     *
     * @param integer $seleccionado
     * @return ConvocatoriasProveedores
     */
    public function setSeleccionado($seleccionado)
    {
        $this->seleccionado = $seleccionado;
    
        return $this;
    }

    /**
     * Get seleccionado
     *
     * @return integer 
     */
    public function getSeleccionado()
    {
        return $this->seleccionado;
    }

    /**
     * Set convocatorias
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias
     * @return ConvocatoriasProveedores
     */
    public function setConvocatorias(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatorias = null)
    {
        $this->convocatorias = $convocatorias;
    
        return $this;
    }

    /**
     * Get convocatorias
     *
     * @return \Incentives\OperacionesBundle\Entity\Convocatorias 
     */
    public function getConvocatorias()
    {
        return $this->convocatorias;
    }

    /**
     * Set proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     * @return ConvocatoriasProveedores
     */
    public function setProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Incentives\OperacionesBundle\Entity\Proveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     * @return ConvocatoriasProveedores
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return ConvocatoriasProveedores
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
     * @return ConvocatoriasProveedores
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