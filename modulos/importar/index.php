<?php

?>
<div class="bloquear" style="position:absolute;z-index:2010;height:100%;width:100%;background-color:#000;top:0px;left:0px;opacity:0.6;text-align:center;">
    <div class="spiner-example" style="position:relative;top:40%;">
                                <div class="sk-spinner sk-spinner-fading-circle">
                                    <div class="sk-circle1 sk-circle"></div>
                                    <div class="sk-circle2 sk-circle"></div>
                                    <div class="sk-circle3 sk-circle"></div>
                                    <div class="sk-circle4 sk-circle"></div>
                                    <div class="sk-circle5 sk-circle"></div>
                                    <div class="sk-circle6 sk-circle"></div>
                                    <div class="sk-circle7 sk-circle"></div>
                                    <div class="sk-circle8 sk-circle"></div>
                                    <div class="sk-circle9 sk-circle"></div>
                                    <div class="sk-circle10 sk-circle"></div>
                                    <div class="sk-circle11 sk-circle"></div>
                                    <div class="sk-circle12 sk-circle"></div>
                                </div>
                                <span style="font-size:24px;font-weight:bold;">Cargando....</span>
                            </div>
    
</div>
<?php
ini_set('max_execution_time','200000');
set_time_limit(200000);
ini_set('upload_max_filesize', '10M');

$aMsj=array();
$next=0;
$uploadErrors = array(
        '0'=>'No hay error, el archivo cargado con exito',
        '1'=>'El archivo subido excede el tama&ntilde;o del archivo de carga m&aacute;ximo permitido de 10M.',
        '2'=>'El archivo subido excede la directiva MAX_FILE_SIZE que se especific&oacute; en el formulario HTML',
        '3'=>'El archivo subido se ha subido s&oacute;lo parcialmente',
        '4'=>'Sin archivo fue subido',
        '6'=>'Falta una carpeta temporal'
    );
$empresa_numero="1";

$objEvento = New Eventos();

$aWhere2['estado']=1;
if ($oUsuario->getRol_numero()!=SUPERADMIN)
{
    $aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
}
$Eventos=$objEvento->buscar($aWhere2);

$objIdentificacion=New Identificaciones();
$oUsuario=New Usuarios($_SESSION['id_usuario']);

if ($oUsuario->getRol_numero()!="3")
{
    $empresa_numero=$oUsuario->getEmpresa_numero();
}
if (isset($_FILES))
{
    if (@$_FILES['archivo']["name"]!="")
    {
        $aExt=explode(".",$_FILES['archivo']["name"]);
        $ext=end($aExt);
        //$ext=end(explode(".",$_FILES['archivo']["name"]));
        //$ext=="csv" ||
        if ( $ext=="xls" || $ext=="xlsx") 
        {
            $archivo=$_SERVER['DOCUMENT_ROOT']."/eventos/upload/upload.".$ext;
            if (move_uploaded_file($_FILES['archivo']["tmp_name"],$archivo))
            {
                $next=1;

                require_once 'library/PhpExcel/PHPExcel/IOFactory.php';
                $objPHPExcel = PHPExcel_IOFactory::load($archivo);
                $j=0;
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    if ($j>0)
                        break;
                    $worksheetTitle     = $worksheet->getTitle();
                    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    $nrColumns = ord($highestColumn) - 64;
                    $letters=range('A',$highestColumn);
                    $fields=array();
                    //var_dump($letters);
                    
                    //var_dump($fields);
                    // echo "<br>The worksheet ".$worksheetTitle." has ";
                    // echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
                    // echo ' and ' . $highestRow . ' row.';
                    // echo '<br>Data: <table border="1"><tr>';
                     for ($row = 1; $row <= 1; ++ $row) {
                        // echo '<tr>';
                         for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            
                            $letters[$col]=$letters[$col]." - ".$val;
                            // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                            // echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
                         }
                        // echo '</tr>';
                     }

                     for ($i=0;$i<$nrColumns;$i++)
                        {
                            $fields[]=$letters[$i];
                        }
                    // echo '</table>';
                    $j++;
                }
            }
            else
            {
                $aMsj['error']="Se produjo un error al subir archivo: ".$uploadErrors[$_FILES['archivo']['error']];
            }
        }
        else if ($ext=="txt")
        {
            $archivo=$_SERVER['DOCUMENT_ROOT']."/eventos/upload/upload.".$ext;
            if (move_uploaded_file($_FILES['archivo']["tmp_name"],$archivo))
            {
                $next=1; 
                $file = fopen($archivo, "r") or exit("No se puede leer archivo!");
                //Output a line of the file until the end is reached
                // while(!feof($file))
                // {
                $fila1=fgets($file);

                // }
                fclose($file);

                $columnas=explode("|",$fila1);
                for ($i=0;$i<count($columnas);$i++)
                {
                    $fields[]=$i."-".$columnas[$i];
                }
            }
            else
            {
                $aMsj['error']="Se produjo un error al subir archivo: ".$uploadErrors[$_FILES['archivo']['error']];
            } 
        }
        else
        {
            $aMsj['error']="Se produjo un error extension de archivo incorrecto, por favor seleccionar archivo .xls , .xlsx o .txt";
        }
    }
    else
    {
        //$aMsj['error']="Error no ha seleccionado archivo a importar";
        
    }
}
if (isset($_POST['name_archivo']))
{
    $next=2;
    $accion="ASISTENTES";

    if (strtoupper($accion)=="ASISTENTES")
    {
        $objeto=New ASISTENTES();                                       
        $array_field=array("nombre","apellido","telefono","email","documento","color","tipo","zona","codigo_barra");
    }

 

	
	$aExt=explode(".",$_POST['name_archivo']);
    $ext=end($aExt);
    
    if ( $ext=="xls" || $ext=="xlsx") 
    {
		
    require_once 'library/PhpExcel/PHPExcel/IOFactory.php';
    $objPHPExcel = PHPExcel_IOFactory::load($_POST['name_archivo']);
    $j=0;
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		
        if ($j>0)
            break;
        $worksheetTitle     = $worksheet->getTitle();
        $highestRow         = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;
        $letters=range('A',$highestColumn);
        $fields=array();
        for ($row = 1; $row <= 1; ++ $row) {
            // echo '<tr>';
             for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                
                $letters[$col]=$letters[$col]." - ".$val;
                // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                // echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
             }
            // echo '</tr>';
         }

         for ($i=0;$i<$nrColumns;$i++)
        {
            $fields[]=$letters[$i];
        }
        //var_dump($letters);
        //var_dump($fields);
        // echo "<br>The worksheet ".$worksheetTitle." has ";
        // echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
        //echo ' and ' . $highestRow . ' row.';
        // echo '<br>Data: <table border="1"><tr>';
        $array_campo=array();
        $array_valor=array();
        $aWhere=array();
        $filaini=1;
        if (isset($_POST['encabezado']))
        {
            $filaini=2;
        }
        
        for ($row = $filaini; $row <= $highestRow; ++ $row) {
            unset($array_campo);
            unset($array_valor);
            $ccnit="";
            $continuar=true;

          
            // echo '<tr>';
            
            foreach($array_field as $field)
                {
                
                

            for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                $colLetter=$letters[$col];
                    if ($colLetter==$_POST[$field])
                    {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        
                        
                        if (strtoupper($accion)=="ASISTENTES" && $continuar)
                        {
                            if ($field=="nombre")
                            {
                                if (trim($val)=="")
                                {
                                    $continuar=false;
                                    break;
                                }
                                /*$objTipASISTENTES=New Tipo_ASISTENTES();
                                unset($aWhere);
                                $aWhere['nivel']="1";
                                $aWhere['descripcion']=$val;
                                $aTipASISTENTES=$objTipASISTENTES->buscar($aWhere);
                                if ($aTipASISTENTES)*/
                                //{
                                    $array_campo[]=$field;
                                    $array_valor[]=$val;
                                //}
                                

                            }
                            else if ($field=="apellido")
                            {
                                

                                $array_campo[]=$field;
                                $array_valor[]=$val;

                               

                            }
                            else if ($field=="telefono")
                            {
                                $array_campo[]=$field;
                                $array_valor[]=$val;
                                

                            }
                            else if ($field=="email")
                            {
                                $array_campo[]=$field;
                                $array_valor[]=$val;
                                

                            }
                            else if ($field=="documento")
                            {
                                $array_campo[]=$field;
                                $array_valor[]=$val;
                                
                            }
                            else if ($field=="color")
                            {
                                $objIdentificacion=New Identificaciones();
                                unset($aWhere);
                                $aWhere['color']="'".strtolower($val)."'";
                                $aIdentificaciones=$objIdentificacion->buscar($aWhere);
                                if (count($aIdentificaciones)>0)
                                {
                                    $array_campo[]="id_identificacion";
                                    $array_valor[]=$aIdentificaciones[0]->getId();
                                }else{
                                     $array_campo[]="id_identificacion";
                                    $array_valor[]="1";
                                }
                                

                            }
                            else if ($field=="codigo_barra")
                            {
                                $array_campo[]=$field;
                                $array_valor[]=$val;
                                

                            }
                            /*else 
                            {
                                $array_campo[]=$field;
                                $array_valor[]=$val;
                            }*/
                        }



                
                    }
                }
                // $cell = $worksheet->getCellByColumnAndRow($col, $row);
                // $val = $cell->getValue();
                // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                // echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
            }
            
         //echo count($array_campo)."- Aca se recorren las filas";
          if (count($array_campo)>0) {
                $resultado+=$objeto->importar($array_campo,$array_valor,$empresa_numero, $_POST['select_evento']);
            }  
        }
  
      
        
        // echo '</table>';
        $j++;
    }
	}
	
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Importar <?php echo $accion;?></h2>
        <ol class="breadcrumb">
            <li><a>Importar</a></li>
            <li class="active"><strong><?php echo $accion;?></strong></li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">


                                    
                            <?php if($accion == 'productos' || $accion == 'listasporproducto' || $accion == 'bodegasporproducto' || $accion == 'bodegasporusuario'):?>
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li <?if($accion == 'productos'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/productos/&m=<?=$_REQUEST['m']?>#tab-1"><strong>Productos</strong></a></li>
                                    <li <?if($accion == 'listasporproducto'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/listasporproducto/&m=<?=$_REQUEST['m']?>#tab-2"><strong>Listas por Producto</strong></a></a></li>
                                    <li <?if($accion == 'bodegasporproducto'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/bodegasporproducto/&m=<?=$_REQUEST['m']?>#tab-3"><strong>Bodegas por Producto</strong></a></a></li>
                                    <li <?if($accion == 'bodegasporusuario'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/bodegasporusuario/&m=<?=$_REQUEST['m']?>#tab-4"><strong>Bodegas por Usuario</strong></a></a></li>
                                </ul>
                            <?php elseif($accion == 'parrillas' || $accion == 'productosparrilla'):?>
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li <?if($accion == 'parrillas'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/parrillas/&m=<?=@$_REQUEST['m']?>#tab-1"><strong>Parrillas</strong></a></li>
                                    <li <?if($accion == 'productosparrilla'):?>class="active"<?endif;?>><a data-toggle="tabs" href="<?=BASE_URL?>importar/productosparrilla/&m=<?=@$_REQUEST['m']?>#tab-2"><strong>Productos por Parrilla</strong></a></a></li>
                                </ul>
                            <?php else:
                                    $accion="ASISTENTES";?>
                                    <h5>Importador</h5>
                            <?php endif?>
                            </div>
                     
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">

                                <div class="ibox-content" style="15px px 0px 0px">

                                    <div class="col-md-12">
                                    <?php
                                        if (isset($aMsj['error']))
                                        {
                                            ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <p><?php echo $aMsj['error'];?></p>
                                                </div>
                                            <?php
                                        }
                                        if (isset($aMsj['success']))
                                        {
                                            ?>
                                                <div class="alert alert-success" role="alert">
                                                    <p><?php echo $aMsj['success'];?></p>
                                                </div>
                                            <?php
                                        
                                        }
                                        if (isset($entidadNoEncontrada) && count($entidadNoEncontrada) > 0)
                                        {
                                            ?>
                                            <div class="alert alert-danger" role="alert">

                                            <?php foreach ($entidadNoEncontrada as $entidad => $values) {?>
                                                    <ul><?=$entidad?> no enontrada/s:
                                                        <?php foreach ($values as $value):?>
                                                         <li><?=$value?></li>
                                                        <?php endforeach;?>
                                                    </ul>
                                            <?}?>
                                                
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <input type="hidden" name="next_step" value="<?=$next;?>">
                                    <form id="formArchivo" action="" method="post" enctype="multipart/form-data">
                                            <input type="file"  name="archivo" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/plain" class="form-control" onchange="SetNameFile()" style="display:none" />
                                            <input name="evento" id="evento" type="hidden" value="<?=$_POST['evento'];?>">
                                    </form>                       
                                    <form id="form" action="" class="wizard-big" method="post">
                                        <input type="hidden" name="name_archivo" value="<?=@$archivo;?>">
                                            <h1>Archivo</h1>
                                            <fieldset>
                                                <h2>Subir Archivo</h2>
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="form-group">
                            <div class="col-lg-6">
                                    <label class="col-lg-3 control-label">Evento:</label>
                                    <select class="form-control m-b" name="select_evento" id="select_evento" onchange="fnSelectEvento();">
                                        
                                       <?php

                                        if (count($Eventos)>0)
                                        {
                                            foreach($Eventos as $objeto)
                                            {
                                               
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($_POST['evento']))?($_POST['evento']==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?> </option>
                                        
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </select>  
                                </div>
                               
                         
                                                        <div class="form-group">
                                                            <label>Archivo *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-primary" onclick="SelectFile()"><i class="fa fa-upload"></i></button>
                                                                </span>
                                                                <input type="text" id="nombre_archivo" value="<?=(isset($_FILES))?@$_FILES['archivo']["name"]:'';?>" class="form-control required" readonly="readonly" />
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="alert alert-danger" role="alert">
                                                            <span>
                                                                <?php 
                                                                if (strtoupper($accion)=="CLIENTES")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>NIT O CEDULA|RAZON SOCIAL|DIRECCION|USUARIO
                                                                        </b>
                                                                        EL FORMATO CORRECTO PARA CARGAR USUARIOS Y LISTA DE PRECIO ES POR EJ: '1;2;3' CON SEPARADOR <b>;</b>.-
                                                                </small>
                                                                <?php
                                                                }
                                                                ?>
                                                                <?php 
                                                                if (strtoupper($accion)=="ASISTENTES")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>NOMBRE, APELLIDO, CODIGO BARRA, COLOR
                                                                        </b>
                                                                        
                                                                
                                                                </small>
                                                                <?php
                                                                }
                                                                if (strtoupper($accion)=="PRODUCTOS")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>NOMBRE|CODIGO|ESTADO</b>
                                                                </small>
                                                                <?php
                                                                }
                                                                if (strtoupper($accion)=="LISTASPORPRODUCTO")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>LISTA|PRODUCTO|VALOR</b>
                                                                </small>
                                                                <?php
                                                                }
                                                                if (strtoupper($accion)=="BODEGASPORPRODUCTO")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>BODEGA|PRODUCTO|DISPONIBLE</b>
                                                                </small>
                                                                <?php
                                                                }
                                                                if (strtoupper($accion)=="BODEGASPORUSUARIO")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>BODEGA|USUARIO</b>
                                                                </small>
                                                                <?php
                                                                }
                                                                if (strtoupper($accion)=="USUARIOS")
                                                                {
                                                                ?>
                                                                <small style="font-size:7pt; text-align:justify;">* LOS CAMPOS OBLIGATORIO PARA EL ARCHIVO A IMPORTAR SON:<br>
                                                                       <b>CODIGO|NOMBRE|ROL</b>
                                                                </small>
                                                                <?php
                                                                }
                                                                ?>
                                                                <br>
                                                                <small style="font-size:7pt; text-align:justify;">
                                                                    * LOS ARCHIVOS EN FORMATO .TXT DEBEN ESTAR SEPARADA LAS COLUMNAS POR <b>|</b>.-
                                                                </small>
                                                            </span>
                                                        </div>
                                                     </div>
                                                    <div class="col-lg-4">
                                                        <div class="text-center">
                                                            <div style="margin-top: 20px">
                                                                <i class="fa fa-cloud-upload" style="font-size: 180px;color: #e5e5e5 "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>
                                            <h1>Configurar</h1>
                                            <fieldset style="overflow-y:auto;">
                                                <h2>Informaci&oacute;n <?php echo ucfirst($accion);?></h2>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="m-t">
                                                            <input type='checkbox' id='drop-remove' class="i-checks" name="encabezado" checked /> 
                                                            <label for='drop-remove'>Incluye fila con encabezado</label>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php if (strtoupper($accion)=="CLIENTES"){?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Nit *</label>
                                                            <select class="form-control required"  name="ccnit">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Raz&oacute;n Social *</label>
                                                            <select class="form-control required" name="razon_social">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Direcci&oacute;n *</label>
                                                            <select class="form-control required" name="direccion">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tel&eacute;fono </label>
                                                            <select class="form-control" name="telefono">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Celular </label>
                                                            <select class="form-control" name="celular">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Ciudad </label>
                                                            <select class="form-control" name="ciudad">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Pa&iacute;s </label>
                                                            <select class="form-control" name="pais">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Departamento </label>
                                                            <select class="form-control" name="departamento">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Email </label>
                                                            <select class="form-control" name="email">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Estado Registro </label>
                                                            <select class="form-control" name="estado_registro">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Sector </label>
                                                            <select class="form-control" name="sector">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Usuario N&uacute;mero *</label>
                                                            <select class="form-control required" name="usuario_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Imagen </label>
                                                            <select class="form-control" name="imagen">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Sitio Web </label>
                                                            <select class="form-control" name="sitio_web">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Latitud </label>
                                                            <select class="form-control" name="latitud">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Longitud </label>
                                                            <select class="form-control" name="longitud">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Firma </label>
                                                            <select class="form-control" name="firma">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Cupo </label>
                                                            <select class="form-control" name="cupo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Contacto </label>
                                                            <select class="form-control" name="contacto">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Cargo Contacto </label>
                                                            <select class="form-control" name="cargo_contacto">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Zona </label>
                                                            <select class="form-control" name="zona">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tipo Cliente </label>
                                                            <select class="form-control" name="tipcliente_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Lista Precio</label>
                                                            <select class="form-control"  name="lpcliente">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if (strtoupper($accion)=="ASISTENTES"){?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Nombre</label>
                                                            <select class="form-control"  name="nombre">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Apellido</label>
                                                            <select class="form-control required" name="apellido">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Telefono</label>
                                                            <select class="form-control " name="telefono">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <select class="form-control " name="email">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Documento</label>
                                                            <select class="form-control" name="documento">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Color</label>
                                                            <select class="form-control" name="color">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Tipo</label>
                                                            <select class="form-control required" name="tipo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Zona</label>
                                                            <select class="form-control required" name="zona">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CODIGO BARRA</label>
                                                            <select class="form-control" name="codigo_barra">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>"><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                   
                                                   
                                                </div>
                                               
                                                <?php } ?>
                                                <?php if (strtoupper($accion) == "LISTASPORPRODUCTO") {?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Lista *</label>
                                                            <select class="form-control required" name="lista_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'lista_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Producto *</label>
                                                            <select class="form-control required" name="producto_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'producto_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Valor *</label>
                                                            <select class="form-control required"  name="valor">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'valor')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>

                                                <?php if (strtoupper($accion) == "BODEGASPORPRODUCTO") {?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Bodega *</label>
                                                            <select class="form-control required"  name="bodega_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'bodega_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Producto *</label>
                                                            <select class="form-control required"  name="producto_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'producto_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Disponible *</label>
                                                            <select class="form-control required"  name="disponible">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'disponible')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>
                                                <?php if (strtoupper($accion) == "BODEGASPORUSUARIO") {?>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Bodega *</label>
                                                            <select class="form-control required"  name="bodega_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'bodega_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Usuario *</label>
                                                            <select class="form-control required"  name="usuario_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'usuario_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php }?>
                                                <?php if (strtoupper($accion) == "PRODUCTOS"){?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Nombre *</label>
                                                            <select class="form-control required"  name="nombre">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'nombre')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Usuario</label>
                                                            <select class="form-control"  name="usuario_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'usuario_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Codigo *</label>
                                                            <select class="form-control required"  name="producto_codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'producto_codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Estado*</label>
                                                            <select class="form-control required"  name="estado_registro">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'estado_registro')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Marca</label>
                                                            <select class="form-control "  name="marca_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'marca_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Familia</label>
                                                            <select class="form-control "  name="familia_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'familia_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Linea</label>
                                                            <select class="form-control "  name="linea_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'linea_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Presentacion</label>
                                                            <select class="form-control "  name="presentacion_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'presentacion_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Unidad de medida</label>
                                                            <select class="form-control "  name="unidad_medida">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'unidad_medida')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Medidas</label>
                                                            <select class="form-control "  name="medidas">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'medidas')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Uso</label>
                                                            <select class="form-control "  name="uso">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'uso')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Categoria</label>
                                                            <select class="form-control "  name="categoria">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'categoria')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>I.V.A.</label>
                                                            <select class="form-control "  name="iva">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'iva')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Tipo producto</label>
                                                            <select class="form-control "  name="tipo_producto">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'tipo_producto')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Promocion</label>
                                                            <select class="form-control "  name="promocion">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'promocion')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Precio base</label>
                                                            <select class="form-control "  name="precio_base">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'precio_base')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?}?>

                                                <?php if (strtoupper($accion) == "USUARIOS") {?>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Codigo *</label>
                                                            <select class="form-control required"  name="codigo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'codigo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Nombre *</label>
                                                            <select class="form-control required"  name="nombre">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'nombre')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Rol *</label>
                                                            <select class="form-control required"  name="rol_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'rol_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Estado</label>
                                                            <select class="form-control "  name="estado_registro">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'estado_registro')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Tel&eacute;fono</label>
                                                            <select class="form-control "  name="telefono">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'telefono')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <select class="form-control "  name="email">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'email')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Imagen</label>
                                                            <select class="form-control "  name="imagen">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'imagen')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Director</label>
                                                            <select class="form-control "  name="director_usuario">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'director_usuario')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Imei</label>
                                                            <select class="form-control "  name="imei">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'imei')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Login</label>
                                                            <select class="form-control "  name="login">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'login')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
    
                                            <?php }?>

                                            <?php if (strtoupper($accion) == "PARRILLAS"){?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Nombre *</label>
                                                            <select class="form-control required"  name="nombre">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'nombre')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Ciclo de venta</label>
                                                            <select class="form-control"  name="ciclo_venta">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'ciclo_venta')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Período</label>
                                                            <select class="form-control required"  name="periodo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'periodo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Fecha Inicio</label>
                                                            <select class="form-control required"  name="fecha_inicio">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'fecha_inicio')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Fecha Fin</label>
                                                            <select class="form-control "  name="fecha_fin">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'fecha_fin')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Dias hábiles</label>
                                                            <select class="form-control "  name="dias_habiles">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'dias_habiles')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Descripción</label>
                                                            <select class="form-control "  name="descripcion">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'descripcion')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <?}?>
                                                <?php if (strtoupper($accion) == "PRODUCTOSPARRILLA") {?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Parrilla *</label>
                                                            <select class="form-control required" name="id_parilla">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'id_parilla')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Tipo Producto *</label>
                                                            <select class="form-control required" name="id_tipo_producto">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'id_tipo_producto')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Producto *</label>
                                                            <select class="form-control required"  name="prdo_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'prdo_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Marca *</label>
                                                            <select class="form-control required"  name="id_marca">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'id_marca')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Porcentaje de tiempo</label>
                                                            <select class="form-control required"  name="porcentaje_tiempo">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'porcentaje_tiempo')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Comentario</label>
                                                            <select class="form-control required"  name="comentario">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'comentario')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Sector</label>
                                                            <select class="form-control required"  name="id_sector">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'id_sector')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Lisa de precio</label>
                                                            <select class="form-control required"  name="lstpre_numero">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'lstpre_numero')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Orden</label>
                                                            <select class="form-control required"  name="orden">
                                                                <option value="">Seleccionar Columna</option>
                                                                <?php
                                                                    foreach($fields as $value)
                                                                    {
                                                                        ?>
                                                                        <option value="<?=$value?>" <?if(strpos($value,'orden')):?>selected<?endif;?>><?=$value?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <?php } ?>   
                                            </fieldset>
                                            <h1>Final</h1>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-success" role="alert">
                                                            <p><?php echo $resultado;?> registros actualizados.-</p>
                                                        </div>
                                                        <!-- <div class="alert alert-danger" role="alert">
                                                            <p> registros que no se actualizaron</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>