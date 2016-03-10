<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $modulo ?></h2>
            <ol class="breadcrumb">
                <li><a>Alertas</a></li>
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
                        <h5>Listado de Alertas</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="ibox-content">
						<form name="formulario" action="" method="post">
							<input type="hidden" name="id" value=""/>
						    <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                            <input type="hidden" name="buscar" />
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombre_camillero">Camillero</label>
                                    <input type="text" name="filtro_camillero_search" value="<?php echo (!empty($_POST['filtro_camillero_search'])) ? $_POST['filtro_camillero_search'] : '' ?>" placeholder="Ingrese Nombre de Camillero" onkeyup="fnSearch(event)" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="fecha_desde">Fecha</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="date" name="filtro_fecha_search" value="<?php echo (!empty($_POST['filtro_fecha_search'])) ? $_POST['filtro_fecha_search'] : '' ?>" placeholder="aaaa-mm-dd" onkeyup="fnSearch(event)" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="alert alert-info alert-dismissable" style="margin-bottom:0">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Presionar tecla ENTER para iniciar la busqueda.
                        </div>

                        </form>
                        <br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				            	<?php
                                // if ($permParaAgregar || $oUsuario->getRol_numero()==SUPERADMIN)
                                // { 
                                ?>
				            	<!-- <a onclick="fnClickAdd('<?=BASE_URL;?>alertas/add_edit');" href="javascript:void(0);" class="btn btn-primary ">
				            		Nuevo
				            	</a> -->
				            	<?php
                                // }
                                // if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                // {
                                ?>
				            	<!-- <a onclick="fnClickEdit('<?=BASE_URL;?>alertas/add_edit','alerta');" href="javascript:void(0);" class="btn btn-primary ">
				            		Modificar
				            	</a> -->
				            	<?php
                                // }
                                // if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                // {
                                ?>
                                <!-- <a onclick="fnClickDelete('alerta');" href="javascript:void(0);" class="btn btn-primary ">
				            		Eliminar
				            	</a> -->
                                <?php
                                // }
                                ?>
                                
				            </div>
						</div>
						<div class="row alerta_editar">
							<div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar la alerta que desea modificar</span>
                            </div>
						</div>
						<div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
							<div class="alert alert-success " >
                                <span id="mensaje_editar">La alerta se guardo correctamente</span>
                            </div>
						</div>
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <!-- <th></th> -->
			                <th>Id Asignaci&oacute;n</th>
                            <th>Camillero</th>
                            <th>Observaci&oacute;n</th>
			                <th>Asignaci&oacute;n</th>
			                <th>Le&iacute;do</th>
			                <th>Fecha</th>
                            <th>Empresa</th>
                            <th>Acciones</th>
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aAlertas)
			            	{
			            		if (count($aAlertas)>0)
                    			{
                    				foreach($aAlertas as $objeto)
                    				{
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

                                        $asignacion="";
                                        $camillero="";

                                        if ($objeto->getIdasignacion()!="")
                                        {
                                            $objAsignacion=New Asignaciones($objeto->getIdasignacion());

                                            $tipo="";
                                            
                                            if ($objAsignacion->getIdtipoasignacion()!="")
                                            {
                                                unset($aWhere);
                                                $aWhere['id']=$objAsignacion->getIdtipoasignacion();
                                                $aTipos=$objTipo->buscar($aWhere);
                                                if (count($aTipos)>0)
                                                    $tipo=$aTipos[0]->getNombre();
                                            }

                                            $asignacion=$tipo." ".$objAsignacion->getPaciente();
                                             unset($aWhere);
                                            $aWhere['usuario_numero']=$objAsignacion->getUsuario_numero();
                                            $aCamillero=$objUsuario->buscar($aWhere);
                                            
                                            if (count($aCamillero)>0)
                                            {
                                            
                                                $camillero=$aCamillero[0]->getNombre();
                                            }
                                        }

                                       
            
                                        
                    					?>
                    						<tr>
                    							<!-- <td>
                    								<input type="checkbox" name="seleccionarItem[]" value="<?=$objeto->getId();?>" class="i-checks"   />
                                                    
                    							</td> -->
                                                <td><?=$objeto->getIdasignacion();?></td>
                    							<td><?=$camillero;?></td>
                                                <td><?=$objeto->getObservacion();?></td>
                                                <td><?=$asignacion;?></td>
                    							<td>
                                                <?
                                                    if ($objeto->getLeido()==0)
                                                    {
                                                        $label_type="label-danger";
                                                        $estado="NO LEIDO";
                                                    }
                                                    else if ($objeto->getLeido()==1)
                                                    {
                                                        $label_type="label-primary";
                                                        $estado="LEIDO";
                                                    }
                                                    
                                                    ?>
                                                    <span class="label <?=$label_type;?>"><?=strtoupper($estado);?></span>                     
                                                
                                                </td>
                                                <td><?=substr($objeto->getCreated_at(),0,19);?></td>
                                                <td><?=$empresa;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-white" onclick="fnOpenVisualize('<?php echo BASE_URL ?>alertas/visualizar', '<?php echo $objeto->getId(); ?>')" title="Visualizar">
                                                        <i class="fa fa-eye"></i>
                                                    </button>                  
                                                </td>
                    						</tr>
                    					<?php
									}
								}
							}
							?>                    		
			            </tbody>
			            <tfoot>
		                    <tr>
                                <!-- <th></th> -->
                                <th>Id Asignaci&oacute;n</th>
                                <th>Camillero</th>
                                <th>Observaci&oacute;n</th>
                                <th>Asignaci&oacute;n</th>
                                <th>Le&iacute;do</th>
                                <th>Fecha</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
		                </tfoot>
			        </table>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
