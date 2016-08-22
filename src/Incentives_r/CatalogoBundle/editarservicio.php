<?
include ('../include/db_functions.php');
include ("../include/inc_generador.php");

$opc = $_REQUEST['opc']; 
$id_cliente= $_REQUEST['id_cliente'];
$id_servicio= $_REQUEST['id_servicio'];

$prev= $_REQUEST['prev'];

//echo $opc;

if ($opc=="del"){
	$serveliminar= $_REQUEST['cant_servseldel']; 
	$sep="-";
	$dato = split($sep,$serveliminar);
	$total = count($dato);

	for($i=1;$i<=($total-1);$i++){
		//print $i;
		//echo ($dato[1]);
		$tabla = 'servicios';
		$campos = array('id_servicio');
		$datos = array($dato[$i]);
		$mensaje = "Servicio eliminado";		
		$msg = borrarDatos ($tabla, $campos, $datos, $mensaje);
	}
}
if ($opc=="edit"){
	$nombre = $_REQUEST['txtnombre']; 
	$descripcion= $_REQUEST['txtdescripcion'];
	$tabla = 'servicios';
	$campos = array('nombre','descripcion');
	$datos = array($nombre,$descripcion);
	$mensaje = "servicio editado satisfactoriamente.";
	$msg =  editarDatos($tabla, $campos, $datos, 'id_servicio', $id_servicio, $mensaje);
	//enviaFormulario('editarservicio.php');
}

$servicios = getTabla ('servicios');

?>
<html>
<link href="../styles/estilos.css" rel="stylesheet" type="text/css">
<body>
<script language="javascript">
function servSelecElim(servselec,nom,desc)
{
	f = document.form1;
	sep = "-";
	var dat = f.cant_servseldel.value.split(sep); 	
	var ok = true;
	for(var j=1;j<dat.length;j++)
	{
		if (dat[j]==servselec)
		{ok=false;}
	}
	if(ok){
		f.cant_servseldel.value = f.cant_servseldel.value + "-" + servselec;}		
	else{
		f.cant_servseldel.value = f.cant_servseldel.value.replace((sep+servselec),"");
	}		
    //alert(f.cant_servseldel.value);	
	f.id_servicio.value = servselec;
	f.txtnombre.value = nom;
	f.txtdescripcion.value = desc;
}	

function accion(opc)
{
	f = document.form1;
	f.opc.value=opc;
}

</script>
<html>
<link href="../styles/estilos.css" rel="stylesheet" type="text/css">
<form action="editarservicio.php" name= "form1" method="get" >
	<input name="opc" type="hidden" id="opc">		
	<table width="80%" height="263" border="0" align="center" class="formtable"><!--Tabla Eliminar servicios-->
	  <tr>
		<td width="46%" valign="top" >
			<table width="100%" border="0" align="center" class="formtable">    
			  <tr>
				<td height="28" colspan="2" class="subTabla"><div align="center">ELIMINAR SERVICIOS </div></td>
			  </tr>      
			 <tr>
				<td width="73%" class="textoMenu"><div align="center">Servicio</div></td>
				<td width="27%" class="textoMenu"><div align="center">Sel.</div></td>
			  </tr>
			  <? for($i=0; $i<count($servicios); $i++){	  ?>
			  <tr>
				<td class="smallText"><?=$servicios[$i]['nombre']?></td>
				<td class="smallText"><div align="center">
				<input type="checkbox" class="smallBlueText" name="serv_<?=$i?>" value="<?=$servicios[$i]['id_servicio']?>" onchange='servSelecElim(<?=$servicios[$i]['id_servicio']?>,"<?=$servicios[$i]['nombre']?>","<?=$servicios[$i]['descripcion']?>")' >				
				  </div></td>
		  	  </tr>
			  	<? }//fin for servicios?>  		  
				<tr>
					<td colspan="3"><div align="center">
					  <input type="submit" class="contenidoTabla" value="Eliminar" name="Eliminar" onclick='accion("del")'>
					  <!--'accion("del")' -->
					  <input name="cant_servseldel" type="hidden" id="cant_servseldel" value="0">
					  <label></label>
					</div></td>
				</tr>		  
			</table>
		</td>

		<td width="54%" valign="top" ><!--TablaEdicion-->
			<table width="100%" border="0" align="center" class="formtable">    
				<tr>
					<td height="28" colspan="2" class="subTabla"><div align="center">EDITAR SERVICIO </div></td>
				</tr>		
				<tr>
					<td class="textoMenu"><div id='divId'>Nombre *</div></td>
					<td class="contenidoTabla">
					<div id="divId2">
					  <input name="txtnombre" type="text" class="smallText" id="txtnombre" size="70" maxlength="50">
					</div></td>
				</tr>
				<tr>
					<td class="textoMenu"><div id='divId'>Descripcion *</div></td>
					<td class="contenidoTabla">
					  <div id="divId2">
						<input name="txtdescripcion" type="text" class="smallText" id="txtdescripcion" size="70" maxlength="50">
					  </div></td>
				</tr> 
				<tr>
					<td colspan="3"><div align="center">
					  <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
					  <input type="hidden" name="prev" value="<?=$prev?>">
					  <input name="id_servicio" type="hidden" id="id_servicio">
					  <input type="submit" class="contenidoTabla" value="Salvar" name="Salvar" onclick='accion("edit")'>
					</div></td>
				</tr>									
			</table>
						<?	if($prev == "cliente"){ 
					if(isset($_REQUEST['id_cliente'])){
						$link = "../clientes/setClientes.php?op=edit&id_cliente=".$_REQUEST['id_cliente'];
					}else{
						$link = "../clientes/setClientes.php?op=new";
					}
				}
				
				?>
			<table width="127" border="0" align="center">
				  <tr>
					  <td width="121"><div align="center"><a href="<?=$link?>"><img src="../imagenes/24x24/001_60_2.gif" border="0" alt="Regresar a Clientes"></a></div></td>
				  </tr>
				  <tr>
					  <td class="smallBlueText"><div align="center">REGRESAR A CLIENTE</div></td>
				  </tr>
			</table>
		</td>
	  </tr>
  </table>
</form>
</body>
</html>
