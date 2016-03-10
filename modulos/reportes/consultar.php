<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $modulo ?></h2>
            <ol class="breadcrumb">
                <li><a>Reportes</a></li>
                <li class="active"><strong><?php echo $modulo; ?></strong></li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>	
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Reportes - <?php echo $modulo; ?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="ibox-content">
                        <form name="formularioExport" action="" method="post">
                            <input type="hidden" name="identificador" value=""/>
                            <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="pagina" value="<?=$page;?>"/>
                            <input type="hidden" name="search" value=""/>
                            <input type="hidden" name="searchestado" value="<?php echo (isset($_POST['searchestado']))?$_POST['searchestado']:'';?>"/>
                            <input type="hidden" name="searchusuario" value="<?=(isset($_POST['searchusuario']))?$_POST['searchusuario']:'';?>"/>
                            <input type="hidden" name="searchfechadesde" value="<?php echo (!empty($_POST['searchfechadesde'])) ? $_POST['searchfechadesde'] : '' ?>"/>
                            <input type="hidden" name="searchfechahasta" value="<?php echo (!empty($_POST['searchfechahasta'])) ? $_POST['searchfechahasta'] : '' ?>"/>
                            <input type="hidden" name="searchtiempodesde" value="<?php echo (!empty($_POST['searchtiempodesde'])) ? $_POST['searchtiempodesde'] : '' ?>"/>
                            <input type="hidden" name="searchtiempohasta" value="<?php echo (!empty($_POST['searchtiempohasta'])) ? $_POST['searchtiempohasta'] : '' ?>"/>
                            <input type="hidden" name="usuarionumero" value="<?=$usuarionumero;?>"/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                        </form>
						<form name="formulario" action="" method="post">
							<input type="hidden" name="identificador" value=""/>
						    <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="pagina" value="<?=$page;?>"/>
                            <input type="hidden" name="search" value=""/>
                            <input type="hidden" name="searchestado" value="<?php echo (isset($_POST['searchestado']))?$_POST['searchestado']:'';?>"/>
                            <input type="hidden" name="searchusuario" value="<?=(isset($_POST['searchusuario']))?$_POST['searchusuario']:'';?>"/>
                            <input type="hidden" name="searchfechadesde" value="<?php echo (!empty($_POST['searchfechadesde'])) ? $_POST['searchfechadesde'] : '' ?>"/>
                            <input type="hidden" name="searchfechahasta" value="<?php echo (!empty($_POST['searchfechahasta'])) ? $_POST['searchfechahasta'] : '' ?>"/>
                            <input type="hidden" name="searchtiempodesde" value="<?php echo (!empty($_POST['searchtiempodesde'])) ? $_POST['searchtiempodesde'] : '' ?>"/>
                            <input type="hidden" name="searchtiempohasta" value="<?php echo (!empty($_POST['searchtiempohasta'])) ? $_POST['searchtiempohasta'] : '' ?>"/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>

                        </form>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				         
				            </div>
						</div>
                        <div class="btn-group">
                                    <a onclick="exportarXLS('tiempo_demora');" href="javascript:void(0);" class="btn btn-primary ">
                                        Exportar Excel
                                    </a>
                                    <!-- <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false" name="btnExport">Exportar <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:void(0);" onclick="exportarXLS('usuarios');" name="btnXLS" >EXCEL</a></li>
                                    </ul>    --> 
                                </div>
						<div class="row alerta_editar">
							<div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar la asignacion que desea modificar</span>
                            </div>
						</div>
						<div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
							<div class="alert alert-success " >
                                <span id="mensaje_editar">Asignacion <b><?=(isset($_POST['asunto']))?$_POST['asunto']:'';?></b> se guardo correctamente</span>
                            </div>
						</div>
                        <div class="col-lg-12">
                            <label class="col-lg-3 control-label">Estado:</label>
                        </div>
                        <div class="form-group">
                                <div class="col-lg-12">
                                    <select class="form-control m-b"  name="estado_search" id="estado_search">
                                        <option value="" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='')?'selected':'':'selected';?>>TODOS</option>
                                        <option value="4" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='4')?'selected':'':'';?>>ASIGNADO</option>
                                        <!-- <option value="2" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='2')?'selected':'':'';?>>INACTIVO</option>
                                        <option value="3" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='3')?'selected':'':'';?>>ELIMINADO</option>
                                         --><option value="5" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='5')?'selected':'':'';?>>FINALIZADA</option>
                                        
                                    </select>
                                </div>
                            </div>
                        <div class="col-lg-12">
                                <label class="col-lg-2 control-label">Camillero:</label>
                        </div>
                        <div class="form-group">
                                <div class="col-lg-12">
                                    <select data-placeholder="Seleccionar Camillero" name="usuario_search" id="usuario_search"  class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?=(isset($_POST['searchusuario']))?($_POST['searchusuario']=='')?'selected':'':'selected';?>></option>
                                        <?php
                                        $aWhere=array();
                                        if (count($Camilleros)>0)
                                        {
                                            foreach($Camilleros as $objetoC)
                                            {
                                                 ?>
                                                <option value="<?=$objetoC->getUsuario_numero();?>" <?=(isset($_POST['searchusuario']))?($_POST['searchusuario']==$objetoC->getUsuario_numero())?'selected':'':'';?>><?=$objetoC->getNombre();?></option>
                                        
                                                <?php
                                                // }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <div class="col-lg-12">
                            <label class="col-lg-12 control-label">Tiempo Desde - Hasta:</label>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="time" name="tiempo_desde_search" id="tiempo_desde_search" value="<?php echo (!empty($_POST['searchtiempodesde'])) ? $_POST['searchtiempodesde'] : '' ?>" placeholder="HH:mm" onkeyup="fnSearch(event)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="time" name="tiempo_hasta_search" id="tiempo_hasta_search" value="<?php echo (!empty($_POST['searchtiempohasta'])) ? $_POST['searchtiempohasta'] : '' ?>" placeholder="HH:mm" onkeyup="fnSearch(event)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="col-lg-12 control-label">Fecha Desde - Hasta:</label>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="date" name="fecha_desde_search" id="fecha_desde_search" value="<?php echo (!empty($_POST['searchfechadesde'])) ? $_POST['searchfechadesde'] : '' ?>" placeholder="aaaa-mm-dd" onkeyup="fnSearch(event)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="date" name="fecha_hasta_search" id="fecha_hasta_search" value="<?php echo (!empty($_POST['searchfechahasta'])) ? $_POST['searchfechahasta'] : '' ?>" placeholder="aaaa-mm-dd" onkeyup="fnSearch(event)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                                <label class="col-lg-3 control-label">Asunto:</label>
                        </div>
                               
                                <div class="input-group">
                                    <input type="text" value="<?=$search;?>" placeholder="Buscar Asignaciones " id="searchText" class="input form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary" onclick="searchAsignaciones()"> <i class="fa fa-search"></i> Buscar</button>
                                    </span>
                                </div>
                         
                        
					<div class="full-height-scroll">
                        <div class="table-responsive">
                
                            <table id="table-clientes" class="table table-striped table-hover" style="font-size:smaller;margin-bottom: 0;">
                                
                    <!-- <table class="table table-striped table-bordered table-hover dataTables-example" > -->
			            <thead>
			            <tr>
			                <th>Estado</th>
			                <th>Detalle del servicio (asignaciones)</th>
			                <th>Tiempo</th>
                            <th>Estado de avance</th>
			                <th>Ultimo Pto. Chequeo</th>
                            <th>Usuario</th>
                            <th>Recibido</th>
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aAsignaciones)
			            	{
			            		if (count($aAsignaciones)>0)
                    			{
                                    $cron=1;
                    				 $cronp=1;
                                    foreach($aAsignaciones as $objeto)
                    				{
                                        $label_type="label-primary";
                                        $estado="ACTIVO";
                                        unset($aWhere);
                                        $aWhere['estado_registro']=$objeto->getEstado_registro();
                                        $oEstado=$objEstados->buscar($aWhere);
                                        if ($objeto->getEstado_registro()==2)
                                        {
                                            $label_type="label-warning";
                                            $estado="INACTIVO";
                                        }
                                        else if ($objeto->getEstado_registro()==3)
                                        {
                                            $label_type="label-danger";
                                            $estado="ELIMINADO";
                                        }
                                        else if ($objeto->getEstado_registro()==4)
                                        {
                                            $label_type="label-info";
                                            $estado="ASIGNADO";
                                        }
                                        else if ($objeto->getEstado_registro()==5)
                                        {
                                            $label_type="label-primary";
                                            $estado="FINALIZADA";
                                        }

                                        if ($estado!="FINALIZADA") {
                                       
                                        $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
                                        $timezone="America/Bogota";
                                        $fecha2=new datetime("now",new datetimezone($timezone));
                                        $fecha2->sub( new DateInterval('PT11M') );
                                        //$fecha2 = new DateTime(Now);
                                        //var_dump($fecha2);
                                        $fecha = $fecha1->diff($fecha2);
                                        
                                        }
                                        else
                                        {
                                            $ultPtoCheck=$objeto->getUltimoPuntoChequeoM();
                                            if (count($ultPtoCheck)>0)
                                            {
                                                $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
                                                $fecha2 = new DateTime(substr($ultPtoCheck[0]['updated_at'],0,19));
                                                $fecha = $fecha1->diff($fecha2);
                                            }
                                        
                                        }
                                        $dejopasar=true;
                                        if (isset($_POST['searchtiempodesde']) && isset($_POST['searchtiempohasta']))
                                        {
                                            if ($_POST['searchtiempodesde']!='' && $_POST['searchtiempohasta']!='')
                                            {
                                                $tiempodesde=strtotime($_POST['searchtiempodesde']);
                                                $tiempohasta=strtotime($_POST['searchtiempohasta']);

                                                $duracion=strtotime($fecha->h.":".$fecha->i);
                                                // echo "desde".$tiempodesde."<br>";
                                                // echo "hasta".$tiempohasta."<br>";
                                                // echo "duracion".$duracion."<br><br>";
                                                if ($tiempodesde>$duracion || $tiempohasta<$duracion)
                                                {
                                                    $dejopasar=false;
                                                }

                                            }
                                        }
                                        if ($dejopasar){
                                        unset($aWhere);
                                        $aWhere['estado_registro']=$objeto->getEstado_registro();
                                        $Estados=$objEstados->buscar($aWhere);

                                        $empresa="";

                                        if ($objeto->getEmpresa_numero()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['empresa_numero']=$objeto->getEmpresa_numero();
                                            $aEmpresas=$objEmpresas->buscar($aWhere);
                                            if (count($aEmpresas)>0)
                                                $empresa=$aEmpresas[0]->getNombre_empresa();
                                        }

                                        $tipo="";
                                        
                                        if ($objeto->getIdtipoasignacion()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['id']=$objeto->getIdtipoasignacion();
                                            $aTipos=$objTipo->buscar($aWhere);
                                            if (count($aTipos)>0)
                                                $tipo=$aTipos[0]->getNombre();
                                        }
                                        unset($aWhere);
                                        $aWhere['usuario_numero']=$objeto->getUsuario_numero();
                                        $camillero=$objUsuario->buscar($aWhere);
                                        $nameCamillero='';
                                        if (count($camillero)>0)
                                        {
                                            $profile_small = @fopen($camillero[0]->getImagen(), "r");
                                            $nameCamillero=$camillero[0]->getNombre();
                                            if ($profile_small)
                                            {
                                                $logo=$camillero[0]->getImagen();
                                                fclose($profile_small);
                                            }
                                            else 
                                            {
                                                $profile_small = @fopen($aEmpresas[0]->getLogo_empresa(), "r");
                                                if ($profile_small)
                                                {
                                                    $logo=$aEmpresas[0]->getLogo_empresa();
                                                    fclose($profile_small);
                                                }
                                                else
                                                {
                                                    $logo=BASE_URL."/img/gestion.png";
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $logo=BASE_URL."/img/gestion.png";
                                        }

                                        
                    					?>
                    						<tr>
                    							
                    							<td>
                                                    <?php
                                                    $label_type="label-primary";
                                                    $estado="ACTIVO";
                                                    unset($aWhere);
                                                    $aWhere['estado_registro']=$objeto->getEstado_registro();
                                                    $oEstado=$objEstados->buscar($aWhere);
                                                    if ($objeto->getEstado_registro()==2)
                                                    {
                                                        $label_type="label-warning";
                                                        $estado="INACTIVO";
                                                    }
                                                    else if ($objeto->getEstado_registro()==3)
                                                    {
                                                        $label_type="label-danger";
                                                        $estado="ELIMINADO";
                                                    }
                                                    else if ($objeto->getEstado_registro()==4)
                                                    {
                                                        $label_type="label-info";
                                                        $estado="ASIGNADO";
                                                    }
                                                    else if ($objeto->getEstado_registro()==5)
                                                    {
                                                        $label_type="label-primary";
                                                        $estado="FINALIZADA";
                                                    }
                                                    ?>
                                                    <span class="label <?=$label_type;?>"><?=strtoupper($oEstado[0]->getDescripcion());?></span>                     
                                                </td>
                    							<td><b><?=$objeto->getAsunto();?>-<?=$objeto->getPaciente();?></b><br><?=substr($objeto->getCreated_at(),0,19);?></td>
                                                <td>
                                                    <?
                                                    $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
                                                    $timezone="America/Bogota";
                                                    $fecha2=new datetime("now",new datetimezone($timezone));
                                                    $fecha2->sub( new DateInterval('PT11M') );
                                                    //$fecha2 = new DateTime(Now);
                                                    //var_dump($fecha2);
                                                    $fecha = $fecha1->diff($fecha2);
                                                    if ($estado!="FINALIZADA") {
                                                    ?><span name="h[]" id="hora_<?=$cron;?>"><?=$fecha->h;?></span>:<span name="m[]" id="minuto_<?=$cron;?>"><?=$fecha->i;?></span>:<span name="s[]" id="segundo_<?=$cron;?>"><?=$fecha->s;?></span>
                                                    <?
                                                    $cron++;
                                                    }
                                                    else
                                                    {
                                                        $ultPtoCheck=$objeto->getUltimoPuntoChequeoM();
                                                        if (count($ultPtoCheck)>0)
                                                        {
                                                            $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
                                                            $fecha2 = new DateTime(substr($ultPtoCheck[0]['updated_at'],0,19));
                                                            $fecha = $fecha1->diff($fecha2);
                                                        }
                                                    ?><span><?=str_pad($fecha->h,2,'0',STR_PAD_LEFT);?></span>:<span><?=str_pad($fecha->i,2,'0',STR_PAD_LEFT);?></span>:<span><?=str_pad($fecha->s,2,'0',STR_PAD_LEFT);?></span>
                                                    <?
                                                    }
                                                    $idruta=$objeto->getRutaChequeo();
                                                    if ($idruta!="0")
                                                    {
                                                    $objRuta=new Rutas($idruta);
                                                    ?>
                                                    <input type="hidden" name="tiempo_ruta[]" value="<?=$objRuta->getTiempo();?>">
                                                    <?
                                                    }
                                                    ?>
                                                </td>
                    							<td>
                                                    Porcentaje de avance
                                                    <?
                                                        $VarPorc=$objeto->getPorcentajePuntoChequeoM();
                                                        if (count($VarPorc)>0)
                                                        {
                                                            $porc=0;
                                                            if ($VarPorc[0]['total']>0)
                                                            $porc=($VarPorc[0]['marcados']*100)/$VarPorc[0]['total'];
                                                            echo number_format($porc,1,',','.')."%";
                                                        }
                                                        else
                                                        {
                                                            echo "0%";
                                                        }
                                                    ?>
                                                </td>
                    							
                                                <td>
                                                    <?
                                                    $ultPtoCheck=$objeto->getUltimoPuntoChequeoM();
                                                    if (count($ultPtoCheck)>0)
                                                    {
                                                        $objPto=new Puntos_chequeo($ultPtoCheck[0]['idpunto']);
                                                        $fecha1 = new DateTime(substr($ultPtoCheck[0]['updated_at'],0,19));
                                                        $timezone="America/Bogota";
                                                        $fecha2=new datetime("now",new datetimezone($timezone));
                                                        $fecha2->sub( new DateInterval('PT11M') );
                                                    
                                                        //$fecha2 = new DateTime(Now);
                                                        $fecha = $fecha1->diff($fecha2);
                                                        echo $objPto->getNombre()."<br>".$ultPtoCheck[0]['updated_at'];
                                                        if ($estado!="FINALIZADA") {
                                                    
                                                        ?>
                                                        <!-- (<span name="hp[]" id="horap_<?=$cronp;?>"><?=$fecha->h;?></span>:<span name="mp[]" id="minutop_<?=$cronp;?>"><?=$fecha->i;?></span>:<span name="sp[]" id="segundop_<?=$cronp;?>"><?=$fecha->s;?></span>) -->
                                                        <?
                                                        $cronp++;
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <!-- (<span ><?=str_pad($fecha->h,2,'0',STR_PAD_LEFT);?></span>:<span ><?=str_pad($fecha->i,2,'0',STR_PAD_LEFT);?></span>:<span ><?=str_pad($fecha->s,2,'0',STR_PAD_LEFT);?></span>) -->
                                                        <?    
                                                        }
                                                    }                                        
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $nameCamillero;?>
                                                     <!-- <img alt="image" class="img-circle" src="<?=$logo;?>" /> -->
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!$objeto->getEn_movil())
                                                    {
                                                        $label_type="label-danger";
                                                        $estado_movil="NO RECIBIDO";
                                                    }
                                                    else if ($objeto->getEn_movil())
                                                    {
                                                        $label_type="label-primary";
                                                        $estado_movil="RECIBIDO";
                                                    }
                                                    
                                                    ?>
                                                    <span class="label <?=$label_type;?>"><?=strtoupper($estado_movil);?></span>                     
                                                </td>
                    	                    </tr>
                    					<?php
                                        
                                        }
									}
								}
							}
							?>                    		
			            </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" style="text-align:center">
                                    <button class="btn btn-white" <?=(count($aAsignacionesCount)==0 || $page==0)?'disabled':'';?> type="button" onclick="linkPrevPage($('input[name=pagina]'));"><i class="fa fa-chevron-left"></i></button>
                                    <?php
                                    $j=1;
                                    if (intval(($page+1)/10)*10==0)
                                        $inicial=1;
                                    else
                                        $inicial=intval(($page+1)/10)*10;

                                    for($i=$inicial;$i<=intval(count($aAsignacionesCount)/20)+1 && $j<10;$i++)
                                    {
                                        ?>
                                        <button class="btn btn-white <?=($page+1==$i)?'active':'';?>" data-page="<?=$i;?>" onclick="linkPage($('input[name=pagina]'),$(this));"><?=$i;?></button>
                                        <?php
                                        $j++;
                                    }  
                                    ?>    
                                    <button class="btn btn-white" <?=(count($aAsignacionesCount)==0 || $page>=intval(count($aAsignacionesCount)/20))?'disabled':'';?> type="button" onclick="linkNextPage($('input[name=pagina]'));"><i class="fa fa-chevron-right"></i> </button>
                                </th>
                                
                            </tr>
                        </tfoot>
			         </table>
                     </div>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
