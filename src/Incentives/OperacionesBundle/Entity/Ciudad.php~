<?php

namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ciudad
 *
 * @ORM\Entity
 * @ORM\Table(name="Ciudad")
 */
class Ciudad
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
     * @ORM\Column(name="dane", type="string", length=10, nullable=true)
     */
    private $dane;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=255, nullable=true)
     */
    private $latitud;


    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

     /**
     * @var text
     *
     * @ORM\Column(name="poligono", type="text", nullable=true)
     */
    private $poligono;


     /**
     * @var integer
     *
     * @ORM\Column(name="zoom", type="integer", nullable=true)
     */
    private $zoom;

     /**
     * @var integer
     *
     * @ORM\Column(name="principal", type="integer", nullable=true)
     */
    private $principal;
    
    /**
     * @ORM\OneToMany(targetEntity="Proveedores", mappedBy="ciudad")
     */
    protected $proveedores;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Participantes", mappedBy="ciudad")
     */
    protected $participante;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redencionesenvios", mappedBy="ciudad")
     */
    protected $redencionenvio;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="ciudades")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id", nullable=true)
     */
    protected $departamento; 

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
        $this->proveedores = new ArrayCollection();
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
     * @return Ciudad
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
     * Add proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedores
     * @return Ciudad
     */
    public function addProveedore(\Incentives\OperacionesBundle\Entity\Proveedores $proveedores)
    {
        $this->proveedores[] = $proveedores;
    
        return $this;
    }

    /**
     * Remove proveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedores
     */
    public function removeProveedore(\Incentives\OperacionesBundle\Entity\Proveedores $proveedores)
    {
        $this->proveedores->removeElement($proveedores);
    }

    /**
     * Get proveedores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProveedores()
    {
        return $this->proveedores;
    }
    

    /**
     * Set dane
     *
     * @param string $dane
     * @return Ciudad
     */
    public function setDane($dane)
    {
        $this->dane = $dane;
    
        return $this;
    }

    /**
     * Get dane
     *
     * @return string 
     */
    public function getDane()
    {
        return $this->dane;
    }

    /**
     * Set latitud
     *
     * @param string $latitud
     * @return Ciudad
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    
        return $this;
    }

    /**
     * Get latitud
     *
     * @return string 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     * @return Ciudad
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    
        return $this;
    }

    /**
     * Get longitud
     *
     * @return string 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set poligono
     *
     * @param string $poligono
     * @return Ciudad
     */
    public function setPoligono($poligono)
    {
        $this->poligono = $poligono;
    
        return $this;
    }

    /**
     * Get poligono
     *
     * @return string 
     */
    public function getPoligono()
    {
        return $this->poligono;
    }

    /**
     * Set zoom
     *
     * @param integer $zoom
     * @return Ciudad
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    
        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer 
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set departamento
     *
     * @param \Incentives\OperacionesBundle\Entity\Departamento $departamento
     * @return Ciudad
     */
    public function setDepartamento(\Incentives\OperacionesBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Incentives\OperacionesBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set principal
     *
     * @param integer $principal
     * @return Ciudad
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    
        return $this;
    }

    /**
     * Get principal
     *
     * @return integer 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Add participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     * @return Ciudad
     */
    public function addParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participante[] = $participante;
    
        return $this;
    }

    /**
     * Remove participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     */
    public function removeParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante)
    {
        $this->participante->removeElement($participante);
    }

    /**
     * Get participante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * Add redencionenvio
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio
     * @return Ciudad
     */
    public function addRedencionenvio(\Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio)
    {
        $this->redencionenvio[] = $redencionenvio;
    
        return $this;
    }

    /**
     * Remove redencionenvio
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio
     */
    public function removeRedencionenvio(\Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionenvio)
    {
        $this->redencionenvio->removeElement($redencionenvio);
    }

    /**
     * Get redencionenvio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedencionenvio()
    {
        return $this->redencionenvio;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Ciudad
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
     * @return Ciudad
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
