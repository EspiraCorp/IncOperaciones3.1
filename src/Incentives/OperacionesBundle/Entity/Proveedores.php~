<?php
namespace Incentives\OperacionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Proveedores
 *
 * @ORM\Entity(repositoryClass="Incentives\OperacionesBundle\Entity\ProveedoresRepository")
 * @ORM\Table(name="Proveedores")
 * 
 */
class Proveedores
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
     * @ORM\ManyToOne(targetEntity="Tipodocumento", inversedBy="proveedores")
     * @ORM\JoinColumn(name="tipodocumento_id", referencedColumnName="id", nullable=true)
     */
    protected $tipodocumento;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="proveedores")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=true)
     */
    protected $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=30, nullable=true)
     */
    private $numero_documento;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="proveedores")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=true)
     */
    protected $pais;  

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="proveedores")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id", nullable=true)
     */
    protected $departamento;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Ciudad", inversedBy="proveedores")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id", nullable=true)
     */
    protected $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="sede_principal", type="string", length=255, nullable=true)
     */
    private $sede_principal;

	/**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="registro_camara", type="string", length=255, nullable=true)
     */
    private $registro_camara;

    /**
     * @ORM\ManyToOne(targetEntity="Regimen", inversedBy="proveedores")
     * @ORM\JoinColumn(name="regimen_id", referencedColumnName="id", nullable=true)
     */
    protected $regimen;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lineaAtencion", type="string", length=255, nullable=true)
     */
    private $lineaAtencion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sedes", type="boolean", nullable=true)
     */
    private $sedes;

    /**
     * @var text
     *
     * @ORM\Column(name="datos_sedes", type="text", nullable=true)
     */
    private $datos_sedes;

    /**
     * @var string
     *
     * @ORM\Column(name="pagina", type="string", length=255, nullable=true)
     */
    private $pagina;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=10, nullable=true)
     */
    private $codigo_postal;

    /**
     * @var string
     *
     * @ORM\Column(name="cobertura", type="text",  nullable=true)
     */
    private $cobertura;

    /**
     * @var text
     *
     * @ORM\Column(name="condiciones_comerciales", type="text", nullable=true)
     */
    private $condiciones_comerciales;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_entrega", type="integer", nullable=true)
     */
    private $tiempo_entrega;

    /**
     * @var bigint
     *
     * @ORM\Column(name="cupo_asignado", type="bigint", nullable=true)
     */
    private $cupo_asignado;

    /**
     * @ORM\OneToMany(targetEntity="Aeconomica", mappedBy="proveedor")
     * 
     */
    protected $aeconomica;


    /**
     * @ORM\OneToMany(targetEntity="Contacto", mappedBy="proveedor")
     * 
     */
    protected $contactos;


    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesCompra", mappedBy="proveedor")
     * 
     */
    protected $ordenescompra;
    
    /**
     * @ORM\OneToMany(targetEntity="Archivos", mappedBy="proveedor")
     * 
     */
    protected $archivo;

    /**
     * @ORM\OneToMany(targetEntity="Catalogo", mappedBy="proveedor")
     * 
     */
    protected $catalogo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Estados", inversedBy="proveedor", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\ProveedoresArea")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=true)
     */
    protected $proveedorarea;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\BaseBundle\Entity\Usuario", mappedBy="proveedor")
     * 
     */
    protected $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores", mappedBy="proveedor")
     * 
     */
    protected $convocatoriasproveedores;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OperacionesBundle\Entity\ProveedoresCalificacion", mappedBy="proveedor")
     * 
     */
    protected $proveedorcalificacion;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="ProveedoresTipo", inversedBy="proveedores", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $proveedortipo;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="ProveedoresClasificacion")
     * @ORM\JoinColumn(name="clasificacion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $proveedorclasificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\CatalogoBundle\Entity\Productoprecio", mappedBy="proveedor")
     * 
     */
    protected $productoprecio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="directo", type="boolean", nullable=true)
     */
    private $directo;

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
        $this->categoria='1';
        $this->sedes=false;
        $this->fecha = new \DateTime("now");
        $this->contactos = new ArrayCollection();
        $this->aeconomica = new ArrayCollection();
        $this->archivo = new ArrayCollection();
        $this->catalogo = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
        $this->convocatoriasproveedores = new ArrayCollection();
        $this->ordenescompra = new ArrayCollection();
        $this->proveedorcalificacion = new ArrayCollection();
        $this->productoprecio = new ArrayCollection();
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
     * @return Proveedores
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
     * Set numero_documento
     *
     * @param string $numeroDocumento
     * @return Proveedores
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
     * Set sede_principal
     *
     * @param string $sedePrincipal
     * @return Proveedores
     */
    public function setSedePrincipal($sedePrincipal)
    {
        $this->sede_principal = $sedePrincipal;
    
        return $this;
    }

    /**
     * Get sede_principal
     *
     * @return string 
     */
    public function getSedePrincipal()
    {
        return $this->sede_principal;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Proveedores
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
     * Set correo
     *
     * @param string $correo
     * @return Proveedores
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
     * Set registro_camara
     *
     * @param string $registroCamara
     * @return Proveedores
     */
    public function setRegistroCamara($registroCamara)
    {
        $this->registro_camara = $registroCamara;
    
        return $this;
    }

    /**
     * Get registro_camara
     *
     * @return string 
     */
    public function getRegistroCamara()
    {
        return $this->registro_camara;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Proveedores
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
     * Set sedes
     *
     * @param boolean $sedes
     * @return Proveedores
     */
    public function setSedes($sedes)
    {
        $this->sedes = $sedes;
    
        return $this;
    }

    /**
     * Get sedes
     *
     * @return boolean 
     */
    public function getSedes()
    {
        return $this->sedes;
    }

    /**
     * Set datos_sedes
     *
     * @param string $datosSedes
     * @return Proveedores
     */
    public function setDatosSedes($datosSedes)
    {
        $this->datos_sedes = $datosSedes;
    
        return $this;
    }

    /**
     * Get datos_sedes
     *
     * @return string 
     */
    public function getDatosSedes()
    {
        return $this->datos_sedes;
    }

    /**
     * Set pagina
     *
     * @param string $pagina
     * @return Proveedores
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;
    
        return $this;
    }

    /**
     * Get pagina
     *
     * @return string 
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set codigo_postal
     *
     * @param string $codigoPostal
     * @return Proveedores
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigo_postal = $codigoPostal;
    
        return $this;
    }

    /**
     * Get codigo_postal
     *
     * @return string 
     */
    public function getCodigoPostal()
    {
        return $this->codigo_postal;
    }

    /**
     * Set cobertura
     *
     * @param string $cobertura
     * @return Proveedores
     */
    public function setCobertura($cobertura)
    {
        $this->cobertura = $cobertura;
    
        return $this;
    }

    /**
     * Get cobertura
     *
     * @return string 
     */
    public function getCobertura()
    {
        return $this->cobertura;
    }

    /**
     * Set condiciones_comerciales
     *
     * @param string $condicionesComerciales
     * @return Proveedores
     */
    public function setCondicionesComerciales($condicionesComerciales)
    {
        $this->condiciones_comerciales = $condicionesComerciales;
    
        return $this;
    }

    /**
     * Get condiciones_comerciales
     *
     * @return string 
     */
    public function getCondicionesComerciales()
    {
        return $this->condiciones_comerciales;
    }
    
    /**
     * Set cupo_asignado
     *
     * @param integer $cupoAsignado
     * @return Proveedores
     */
    public function setCupoAsignado($cupoAsignado)
    {
        $this->cupo_asignado = $cupoAsignado;
    
        return $this;
    }

    /**
     * Get cupo_asignado
     *
     * @return integer 
     */
    public function getCupoAsignado()
    {
        return $this->cupo_asignado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Proveedores
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipodocumento
     *
     * @param \Incentives\OperacionesBundle\Entity\Tipodocumento $tipodocumento
     * @return Proveedores
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
     * Set categoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Categoria $categoria
     * @return Proveedores
     */
    public function setCategoria(\Incentives\OperacionesBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Incentives\OperacionesBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set pais
     *
     * @param \Incentives\OperacionesBundle\Entity\Pais $pais
     * @return Proveedores
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
     * Set ciudad
     *
     * @param \Incentives\OperacionesBundle\Entity\Ciudad $ciudad
     * @return Proveedores
     */
    public function setCiudad(\Incentives\OperacionesBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;
    
        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Incentives\OperacionesBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set regimen
     *
     * @param \Incentives\OperacionesBundle\Entity\Regimen $regimen
     * @return Proveedores
     */
    public function setRegimen(\Incentives\OperacionesBundle\Entity\Regimen $regimen = null)
    {
        $this->regimen = $regimen;
    
        return $this;
    }

    /**
     * Get regimen
     *
     * @return \Incentives\OperacionesBundle\Entity\Regimen 
     */
    public function getRegimen()
    {
        return $this->regimen;
    }

    /**
     * Add aeconomica
     *
     * @param \Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica
     * @return Proveedores
     */
    public function addAeconomicon(\Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica)
    {
        $this->aeconomica[] = $aeconomica;
    
        return $this;
    }

    /**
     * Remove aeconomica
     *
     * @param \Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica
     */
    public function removeAeconomicon(\Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica)
    {
        $this->aeconomica->removeElement($aeconomica);
    }

    /**
     * Get aeconomica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAeconomica()
    {
        return $this->aeconomica;
    }

    /**
     * Add contactos
     *
     * @param \Incentives\OperacionesBundle\Entity\Contacto $contactos
     * @return Proveedores
     */
    public function addContacto(\Incentives\OperacionesBundle\Entity\Contacto $contactos)
    {
        $this->contactos[] = $contactos;
    
        return $this;
    }

    /**
     * Remove contactos
     *
     * @param \Incentives\OperacionesBundle\Entity\Contacto $contactos
     */
    public function removeContacto(\Incentives\OperacionesBundle\Entity\Contacto $contactos)
    {
        $this->contactos->removeElement($contactos);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * Add archivo
     *
     * @param \Incentives\OperacionesBundle\Entity\Archivos $archivo
     * @return Proveedores
     */
    public function addArchivo(\Incentives\OperacionesBundle\Entity\Archivos $archivo)
    {
        $this->archivo[] = $archivo;
    
        return $this;
    }

    /**
     * Remove archivo
     *
     * @param \Incentives\OperacionesBundle\Entity\Archivos $archivo
     */
    public function removeArchivo(\Incentives\OperacionesBundle\Entity\Archivos $archivo)
    {
        $this->archivo->removeElement($archivo);
    }

    /**
     * Get archivo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Add catalogo
     *
     * @param \Incentives\OperacionesBundle\Entity\Catalogo $catalogo
     * @return Proveedores
     */
    public function addCatalogo(\Incentives\OperacionesBundle\Entity\Catalogo $catalogo)
    {
        $this->catalogo[] = $catalogo;
    
        return $this;
    }

    /**
     * Remove catalogo
     *
     * @param \Incentives\OperacionesBundle\Entity\Catalogo $catalogo
     */
    public function removeCatalogo(\Incentives\OperacionesBundle\Entity\Catalogo $catalogo)
    {
        $this->catalogo->removeElement($catalogo);
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
     * Add usuarios
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuarios
     * @return Proveedores
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


    /**
     * Add convocatoriasproveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores
     * @return Proveedores
     */
    public function addConvocatoriasproveedore(\Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores)
    {
        $this->convocatoriasproveedores[] = $convocatoriasproveedores;
    
        return $this;
    }

    /**
     * Remove convocatoriasproveedores
     *
     * @param \Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores
     */
    public function removeConvocatoriasproveedore(\Incentives\OperacionesBundle\Entity\ConvocatoriasProveedores $convocatoriasproveedores)
    {
        $this->convocatoriasproveedores->removeElement($convocatoriasproveedores);
    }

    /**
     * Get convocatoriasproveedores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConvocatoriasproveedores()
    {
        return $this->convocatoriasproveedores;
    }

    /**
     * Add aeconomica
     *
     * @param \Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica
     * @return Proveedores
     */
    public function addAeconomica(\Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica)
    {
        $this->aeconomica[] = $aeconomica;
    
        return $this;
    }

    /**
     * Remove aeconomica
     *
     * @param \Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica
     */
    public function removeAeconomica(\Incentives\OperacionesBundle\Entity\Aeconomica $aeconomica)
    {
        $this->aeconomica->removeElement($aeconomica);
    }

    /**
     * Add proveedorcalificacion
     *
     * @param \Incentives\OperacionesBundle\Entity\ProveedoresCalificacion $proveedorcalificacion
     * @return Proveedores
     */
    public function addProveedorcalificacion(\Incentives\OperacionesBundle\Entity\ProveedoresCalificacion $proveedorcalificacion)
    {
        $this->proveedorcalificacion[] = $proveedorcalificacion;
    
        return $this;
    }

    /**
     * Remove proveedorcalificacion
     *
     * @param \Incentives\OperacionesBundle\Entity\ProveedoresCalificacion $proveedorcalificacion
     */
    public function removeProveedorcalificacion(\Incentives\OperacionesBundle\Entity\ProveedoresCalificacion $proveedorcalificacion)
    {
        $this->proveedorcalificacion->removeElement($proveedorcalificacion);
    }

    /**
     * Get proveedorcalificacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProveedorcalificacion()
    {
        return $this->proveedorcalificacion;
    }

    /**
     * Set proveedortipo
     *
     * @param \Incentives\OperacionesBundle\Entity\ProveedoresTipo $proveedortipo
     * @return Proveedores
     */
    public function setProveedortipo(\Incentives\OperacionesBundle\Entity\ProveedoresTipo $proveedortipo = null)
    {
        $this->proveedortipo = $proveedortipo;
    
        return $this;
    }

    /**
     * Get proveedortipo
     *
     * @return \Incentives\OperacionesBundle\Entity\ProveedoresTipo 
     */
    public function getProveedortipo()
    {
        return $this->proveedortipo;
    }
    
    /**
     * Set proveedorarea
     *
     * @param \Incentives\OperacionesBundle\Entity\ProveedoresArea $proveedorarea
     * @return Proveedores
     */
    public function setProveedorarea(\Incentives\OperacionesBundle\Entity\ProveedoresArea $proveedorarea = null)
    {
        $this->proveedorarea = $proveedorarea;
    
        return $this;
    }

    /**
     * Get proveedorarea
     *
     * @return \Incentives\OperacionesBundle\Entity\ProveedoresArea 
     */
    public function getProveedorarea()
    {
        return $this->proveedorarea;
    }
    

    /**
     * Add productoprecio
     *
     * @param \Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio
     * @return Proveedores
     */
    public function addProductoprecio(\Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio)
    {
        $this->productoprecio[] = $productoprecio;
    
        return $this;
    }

    /**
     * Remove productoprecio
     *
     * @param \Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio
     */
    public function removeProductoprecio(\Incentives\CatalogoBundle\Entity\Productoprecio $productoprecio)
    {
        $this->productoprecio->removeElement($productoprecio);
    }

    /**
     * Get productoprecio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductoprecio()
    {
        return $this->productoprecio;
    }

    /**
     * Set departamento
     *
     * @param \Incentives\OperacionesBundle\Entity\Departamento $departamento
     * @return Proveedores
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
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     * @return Proveedores
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
     * Add ordenescompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenescompra
     * @return Proveedores
     */
    public function addOrdenescompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenescompra)
    {
        $this->ordenescompra[] = $ordenescompra;
    
        return $this;
    }

    /**
     * Remove ordenescompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenescompra
     */
    public function removeOrdenescompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenescompra)
    {
        $this->ordenescompra->removeElement($ordenescompra);
    }

    /**
     * Get ordenescompra
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenescompra()
    {
        return $this->ordenescompra;
    }

    /**
     * Set directo
     *
     * @param integer $directo
     * @return Proveedores
     */
    public function setDirecto($directo)
    {
        $this->directo = $directo;
    
        return $this;
    }

    /**
     * Get directo
     *
     * @return integer 
     */
    public function getDirecto()
    {
        return $this->directo;
    }
    
    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Proveedores
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
     * @return Proveedores
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
     * Set proveedorclasificacion
     *
     * @param \Incentives\OperacionesBundle\Entity\ProveedoresClasificacion $proveedorclasificacion
     * @return Proveedores
     */
    public function setProveedorclasificacion(\Incentives\OperacionesBundle\Entity\ProveedoresClasificacion $proveedorclasificacion = null)
    {
        $this->proveedorclasificacion = $proveedorclasificacion;
    
        return $this;
    }

    /**
     * Get proveedorclasificacion
     *
     * @return \Incentives\OperacionesBundle\Entity\ProveedoresClasificacion 
     */
    public function getProveedorclasificacion()
    {
        return $this->proveedorclasificacion;
    }

    /**
     * Set tiempo_entrega
     *
     * @param integer $tiempoEntrega
     * @return Proveedores
     */
    public function setTiempoEntrega($tiempoEntrega)
    {
        $this->tiempo_entrega = $tiempoEntrega;
    
        return $this;
    }

    /**
     * Get tiempo_entrega
     *
     * @return integer 
     */
    public function getTiempoEntrega()
    {
        return $this->tiempo_entrega;
    }


    /**
     * Set lineaAtencion
     *
     * @param string $lineaAtencion
     * @return Proveedores
     */
    public function setLineaAtencion($lineaAtencion)
    {
        $this->lineaAtencion = $lineaAtencion;
    
        return $this;
    }

    /**
     * Get lineaAtencion
     *
     * @return string 
     */
    public function getLineaAtencion()
    {
        return $this->lineaAtencion;
    }
}
