<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $modulo ?></h2>
            <ol class="breadcrumb">
                <li><a>Configuraci&oacute;n</a></li>
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
                        <h5>Listado de Turnos</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="ibox-content">
						<form name="formulario" action="" method="post">
							<input type="hidden" name="identificador" value=""/>
						    <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                        </form>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				            	<?php
                                if ($permParaAgregar || $oUsuario->getRol_numero()==SUPERADMIN)
                                { 
                                ?>
				            	<a onclick="fnClickAdd('<?=BASE_URL;?>turnos/add_edit');" href="javascript:void(0);" class="btn btn-primary ">
				            		Nuevo
				            	</a>
				            	<?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
				            	<a onclick="fnClickEdit('<?=BASE_URL;?>turnos/add_edit','turno');" href="javascript:void(0);" class="btn btn-primary ">
				            		Modificar
				            	</a>
				            	<?php
                                }
                                if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('turno');" href="javascript:void(0);" class="btn btn-primary ">
				            		Eliminar
				            	</a>
                                <?php
                                }
                                ?>
				            </div>
						</div>
						<div class="row alerta_editar">
							<div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el turno que desea modificar</span>
                            </div>
						</div>
						<div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
							<div class="alert alert-success " >
                                <span id="mensaje_editar">Turno <b><?=(isset($_POST['nombre']))?$_POST['nombre']:'';?></b> se guardo correctamente</span>
                            </div>
						</div>
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
			                <th>Nombre</th>
			                <th>Descripci&oacute;n</th>
			                <th>Hora Inicio</th>
			                <th>Hora Fin</th>
			                <th>D&iacute;as</th>
                            <th>Empresa</th>
                        
			            </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aTurnos)
			            	{
			            		if (count($aTurnos)>0)
                    			{
                    				foreach($aTurnos as $objeto)
                    				{
                    					$dias=array();
                    					
                    					if ($objeto->getLunes()!="0")
                    					{
                    						$dias[]="Lun";
                    					}
                                        if ($objeto->getMartes()!="0")
                                        {
                                            $dias[]="Mar";
                                        }
                                        if ($objeto->getMiercoles()!="0")
                                        {
                                            $dias[]="Mie";
                                        }
                                        if ($objeto->getJueves()!="0")
                                        {
                                            $dias[]="Jue";
                                        }
                                        if ($objeto->getViernes()!="0")
                                        {
                                            $dias[]="Vie";
                                        }
                                        if ($objeto->getSabados()!="0")
                                        {
                                            $dias[]="Sab";
                                        }
                                        if ($objeto->getDomingo()!="0")
                                        {
                                            $dias[]="Dom";
                                        }

                                        $empresa="";

                                        if ($objeto->getEmpresa_numero()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['empresa_numero']=$objeto->getEmpresa_numero();
                                            $aEmpresas=$objEmpresas->buscar($aWhere);
                                            if (count($aEmpresas)>0)
                                                $empresa=$aEmpresas[0]->getNombre_empresa();
                                        }

                    					?>
                    						<tr>
                    							<td>
                    							 <input type="checkbox" name="seleccionarItem[]" value="<?=$objeto->getId();?>" class="i-checks"   />
                                                </td>
                    							<td><?=$objeto->getNombre();?></td>
                    							<td><?=$objeto->getDescripcion();?></td>
                    							<td><?=$objeto->getHora_inicio();?></td>
                    							<td><?=$objeto->getHora_fin();?></td>
                    							<td><?=implode("-",$dias);?></td>
                                                <td><?=$empresa;?></td>
                    						</tr>
                    					<?php
									}
								}
							}
							?>                    		
			            </tbody>
			            <tfoot>
		                    <tr>
		                        <th></th>
			                	<th>Nombre</th>
                                <th>Descripci&oacute;n</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>D&iacute;as</th>
                                <th>Empresa</th>
                        
		                    </tr>
		                </tfoot>
			        </table>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
