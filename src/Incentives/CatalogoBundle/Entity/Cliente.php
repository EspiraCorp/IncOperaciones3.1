<?php

namespace Incentives\CatalogoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="Cliente")
 */
class Cliente
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
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Tipodocumento", inversedBy="cliente")
     * @ORM\JoinColumn(name="tipodocumento_id", referencedColumnName="id", nullable=true)
     */
    protected $tipodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=20)
     */
    private $numero_documento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="cliente", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

    /**
     * @ORM\OneToMany(targetEntity="Programa", mappedBy="cliente", cascade={"persist"})
     * 
     */
    protected $programa;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\BaseBundle\Entity\Usuario", mappedBy="cliente", cascade={"persist"})
     * 
     */
    protected $usuarios;

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
        $this->programa = new ArrayCollection();         
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
     * @return Cliente
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
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Cliente
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set numero_documento
     *
     * @param string $numeroDocumento
     * @return Cliente
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numero_documento = $numeroDocumento;
    
        return $this;
    }

    /**
     * Get numero_documento
     *
     * @return string 
     */
    public function getNumeroDocumento()
    {
        return $this->numero_documento;
    }

    /**
     * Set tipodocumento
     *
     * @param \Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento
     * @return Cliente
     */
    public function setTipodocumento(\Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento = null)
    {
        $this->tipodocumento = $tipodocumento;
    
        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return \Incentives\OperacionesBundle\Entity\Tipodocumento 
     */
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }

    /**
     * Add programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Cliente
     */
    public function addProgramon(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa[] = $programa;
    
        return $this;
    }

    /**
     * Remove programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     */
    public function removeProgramon(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa->removeElement($programa);
    }

    /**
     * Get programa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Add programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Cliente
     */
    public function addPrograma(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa[] = $programa;
    
        return $this;
    }

    /**
     * Remove programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     */
    public function removePrograma(\Incentives\CatalogoBundle\Entity\Programa $programa)
    {
        $this->programa->removeElement($programa);
    }

    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     * @return Cliente
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Cliente
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
     * @return Cliente
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

    /**
     * Add usuarios
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuarios
     * @return Cliente
     */
    public function addUsuario(\Incentives\BaseBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\Incentives\BaseBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
