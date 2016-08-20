<?php

namespace Incentives\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="Menu")
 */
class Menu
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
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="icono", type="string", length=255)
     */
    private $icono;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="menus")
     */
    private $grupos;
    
    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="padre", cascade={"persist"})
     * 
     */
    protected $opciones;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="opciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id")
     * 
     */
    protected $padre;
    

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->estado = 1;
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
     * @return Menu
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
     * Set link
     *
     * @param string $link
     * @return Menu
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set icono
     *
     * @param string $icono
     * @return Menu
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    
        return $this;
    }

    /**
     * Get icono
     *
     * @return string 
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Menu
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add grupos
     *
     * @param \Incentives\BaseBundle\Entity\Grupo $grupos
     * @return Menu
     */
    public function addGrupo(\Incentives\BaseBundle\Entity\Grupo $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \Incentives\BaseBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\Incentives\BaseBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }


    /**
     * Set orden
     *
     * @param integer $orden
     * @return Menu
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Menu
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add opciones
     *
     * @param \Incentives\BaseBundle\Entity\Menu $opciones
     * @return Menu
     */
    public function addOpcione(\Incentives\BaseBundle\Entity\Menu $opciones)
    {
        $this->opciones[] = $opciones;
    
        return $this;
    }

    /**
     * Remove opciones
     *
     * @param \Incentives\BaseBundle\Entity\Menu $opciones
     */
    public function removeOpcione(\Incentives\BaseBundle\Entity\Menu $opciones)
    {
        $this->opciones->removeElement($opciones);
    }

    /**
     * Get opciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set padre
     *
     * @param \Incentives\BaseBundle\Entity\Menu $padre
     * @return Menu
     */
    public function setPadre(\Incentives\BaseBundle\Entity\Menu $padre = null)
    {
        $this->padre = $padre;
    
        return $this;
    }

    /**
     * Get padre
     *
     * @return \Incentives\BaseBundle\Entity\Menu 
     */
    public function getPadre()
    {
        return $this->padre;
    }
}
