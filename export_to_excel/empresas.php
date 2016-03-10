<?php
require_once 'library/PhpExcel/PHPExcel.php';

//Creo instancia de la clase de Empresas
$objEmpresas=New Empresas();

//Creo instancia de la clase de roles
$objEstados=New Estados();

//Creo instancia de la clase de usuarios
$objUsuario=New Usuarios();

$aOrWhere=array();
$aWhere=array();
if ($_POST['usuarionumero']!="")
{
	$aWhere['usuario_numero']=$_POST['usuarionumero'];
	$oUsuarios=$objUsuario->buscar($aWhere);

	$oUsuario=$oUsuarios[0];

unset($aWhere);
if ($oUsuario->getRol_numero()!="3")
	{
		$empresanumero=$oUsuario->getEmpresa_numero();
		
		$aWhere['empresa_numero']=$empresanumero;
	
	}
}
	
	$aWhere['estado_registro<>']='3';
		

if (isset($_POST['busqueda']))
{
	if ($_POST['busqueda']!="")
	{
		$aOrWhere['nombre_empresa::text ilike']=$_POST['busqueda'];
		$aOrWhere['documento::text ilike']=$_POST['busqueda'];
		$aOrWhere['contacto::text ilike']=$_POST['busqueda'];
		$aOrWhere['telefono::text ilike']=$_POST['busqueda'];
		$aOrWhere['email::text ilike']=$_POST['busqueda'];
	}
}

if (isset($_POST['identificadores']))
{
	if ($_POST['identificadores']!="")
	{
		$inId="(".$_POST['identificadores'].")";
		
		$aWhere['id IN']=$inId;
	}
}

$aEmpresa=$objEmpresas->buscar($aWhere,$aOrWhere);


$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("NativoApps")
	->setLastModifiedBy("NativoApps")
	->setTitle("Exportacion")
	->setSubject("Exportacion")
	->setDescription("Exportaciones")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Excel");

$objPHPExcel->getSheetCount();

$positionInExcel=0;//esto es para que ponga la nueva pestaña al principio

$objPHPExcel->createSheet($positionInExcel);//creamos la pestaña
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//$datos_exportacion=mysqli_fetch_array($rsDetalle);
// Renombrar Hoja
$title = "Exportar Empresa";
$objPHPExcel->getActiveSheet()->setTitle(substr($title, 0, 20));

$styleArray = array(
    'font' => array(
        'bold' => true
    )
);

if ($logo!="")
{
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// 	$objDrawing->setName('Logo');
// 	$objDrawing->setDescription('Logo');
// 	$objDrawing->setPath($logo);  //setOffsetY has no effect
// 	$objDrawing->setCoordinates('A1');
// 	$objDrawing->setWidth(100); // logo width
// 	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
}
$objPHPExcel->getActiveSheet()->setCellValue('G2', "LISTADO EMPRESAS");
$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);

// Agregar Informacion encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue('A7', 'NOMBRE EMPRESA')
	->setCellValue('B7', 'TIPO DOCUMENTO')
	->setCellValue('C7', 'DOCUMENTO')
	->setCellValue('D7', 'CONTACTO')
	->setCellValue('E7', 'TELEFONO')
	->setCellValue('F7', 'EMAIL')
	->setCellValue('G7', 'ESTADO');
	// ->setCellValue('E7', 'FECHA_ULTIMA_ACT');

$objPHPExcel->getActiveSheet()->getStyle('A7:AB7')->applyFromArray($styleArray);

$row=8;

if ($aEmpresa)
{
	if (count($aEmpresa)>0)
	{
		foreach($aEmpresa as $objeto)
		{
			$estado="";
			
            
			if ($objeto->getEstado_registro()!="")
			{
				unset($aWhere);
				$aWhere['estado_registro']=$objeto->getEstado_registro();
				$aEstados=$objEstados->buscar($aWhere);
				if (count($aEstados)>0)
					$estado=$aEstados[0]->getDescripcion();
			}

			
                    					
			$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$row, $objeto->getNombre_empresa())
				->setCellValue('B'.$row, $objeto->getTipo_documento())
				->setCellValue('C'.$row, $objeto->getDocumento())
				->setCellValue('D'.$row, $objeto->getContacto())
				->setCellValue('E'.$row, $objeto->getTelefono())
				->setCellValue('F'.$row, $objeto->getEmail())
				->setCellValue('G'.$row, $estado);
				// ->setCellValue('E'.$row, $objeto->getFecha_ultima_act());

			$row++;
		}
	}
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="EMPRESAS_'.date('Y-m-d').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>