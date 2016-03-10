<?php
session_start();

date_default_timezone_set("America/Bogota");


//Defino la base URL del sitio
define("BASE_URL","http://".$_SERVER['HTTP_HOST']."/eventos/");

//Defino constante SUPER ADMIN
define("SUPERADMIN","1");

//llamo a la clase de la base de datos
include("clases/db_class.php");

//llamo a las clases necesarias
include("clases/usuarios_class.php");
include("clases/roles_class.php");
include("clases/empresas_class.php");
include("clases/menus_class.php");
include("clases/perm_rol_menu_class.php");
include("clases/estados_class.php");
include("clases/turnos_class.php");
include("clases/areas_class.php");
include("clases/puntos_chequeo_class.php");
include("clases/tipos_asignacion_class.php");
include("clases/tipos_novedad_class.php");
include("clases/rutas_class.php");
include("clases/asignaciones_class.php");
include("clases/alertas_class.php");
include("clases/novedades_class.php");

include("clases/zonas_class.php");
include("clases/tipo_asistentes_class.php");
include("clases/identificacion_class.php");
include("clases/asistentes_class.php");
include("clases/eventos_class.php");

//Push notification
/*include("GCMPushMessage.php");
define(GOOGLE_API_KEY, 'AIzaSyAcbSCoBJ-IS59QKfNxQtERAjYyT_L3DNM');
$gcm = new GCMPushMessage(GOOGLE_API_KEY);*/
//Fin declaracion

//llamo una instancia de la clases de BD
$db=New BDConexion();

//Defino en constante el nombre de la Base de datos a utilizar
define("DB_NAME","nativoap_eventos");

//Intento conectar con la Base de datos
if ($db->conect(DB_NAME)!="")
{
	echo "Error en la Conexion con Base de Datos: ";
	die();
}

if (isset($_GET['modulo']))
{
	if($_GET['modulo']=="logout")
	{
		session_destroy();
		header("Location: ".BASE_URL);
		die();
	}
	else if($_GET['modulo']=="ajax")
	{
		include("ajax/".$_GET['accion']);
		die();
	}
	else if($_GET['modulo']=="export_to_pdf")
	{
		include("export_to_pdf/".$_GET['accion']);
		die();
	}
	else if($_GET['modulo']=="export_to_excel")
	{
		include("export_to_excel/".$_GET['accion']);
		die();
	}
	else if($_GET['modulo']=="upload")
	{
		include("upload/".$_GET['accion']);
		die();
	}
}

$msjErrorLogin="";
if (isset($_POST['usuario']))
{
	//Creo una instancia de la clase Usuarios
	$objeto_usuario=New Usuarios();

	$objeto_usuario->setLogin($_POST['usuario']);

	$objeto_usuario->setPassword_movil($_POST['password']);

	if ($objeto_usuario->login())
	{
		$_SESSION['usuario']=$objeto_usuario->getLogin();
		$_SESSION['id_usuario']=$objeto_usuario->getId();
		$_SESSION['usuario_numero']=$objeto_usuario->getUsuario_numero();
	}
	else
	{
		$msjErrorLogin="Usuario y/o Contrase&ntilde;a incorrecta";

	}		
}

if (isset($_SESSION['usuario']))
{
	//Creo una instancia de la clase Usuarios
	$oUsuario=New Usuarios($_SESSION['id_usuario']);
	$oRol=New Roles("",$oUsuario->getRol_numero());
	$oMenu=New Menus();
	$oSubMenu=New Menus();
	$aWhere=array();
	$objPermiso=New Perm_rol_menu();

	if ($oUsuario->getRol_numero()==SUPERADMIN)
	{
		$oEmpresa=New Empresas();
	
	}
	else
	{
		$oEmpresa=New Empresas("",$oUsuario->getEmpresa_numero());
	}

	$aWhere['estado_registro']=1;
	$aWhere['idpadre']=0;

	$aMenus=$oMenu->buscar($aWhere);
	unset($aWhere);

	$aWhere['estado_registro']=1;
	$aWhere['idpadre<>']=0;

	$aSubMenus=$oMenu->buscar($aWhere);

	if ($oUsuario->getRol_numero()!=SUPERADMIN)
	{
		unset($aWhere);
		$aWhere['rol_numero']=$oUsuario->getRol_numero();
		
		$aPermisos=$objPermiso->buscar($aWhere);
	}
	else
	{
		$aPermisos=array();
	}

	$profile_small = @fopen($oUsuario->getImagen(), "r");
		   	
			
	if ($profile_small)
	{
		$logo=$oUsuario->getImagen();
		fclose($profile_small);
	}
	else 
	{
		$profile_small = @fopen($oEmpresa->getLogo_empresa(), "r");
   		if ($profile_small)
		{
			$logo=$oEmpresa->getLogo_empresa();
			fclose($profile_small);
		}
		else
		{
			$logo=BASE_URL."/img/gestion.png";
		}
	}
}

include("head.php");


if (isset($_GET['modulo']) && isset($_SESSION['usuario']))
{

	$accion="";

	if (isset($_GET['accion']))
	{
		$accion=$_GET['accion'];
	}
	
	$directorio="modulos/".$_GET['modulo'];
	
	include("menu.php");
	include($directorio."/index.php");
	
}
else
{

	if (isset($_SESSION['usuario']))
	{
		include("menu.php");
		include("welcome.php");
	}
	else
	{
		include("login.php");
	}
}


include("foot.php");




?>