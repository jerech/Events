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
                        <h5>Listado de Men&uacute;s</h5>
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
				            	<a onclick="fnClickAdd('<?=BASE_URL;?>menus/add_edit');" href="javascript:void(0);" class="btn btn-primary ">
				            		Nuevo
				            	</a>
				            	<?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
				            	<a onclick="fnClickEdit('<?=BASE_URL;?>menus/add_edit','menu');" href="javascript:void(0);" class="btn btn-primary ">
				            		Modificar
				            	</a>
				            	<?php
                                }
                                if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('menu');" href="javascript:void(0);" class="btn btn-primary ">
				            		Eliminar
				            	</a>
                                <?php
                                }
                                ?>
				            </div>
						</div>
						<div class="row alerta_editar">
							<div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el men&uacute; que desea modificar</span>
                            </div>
						</div>
						<div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
							<div class="alert alert-success " >
                                <span id="mensaje_editar">Men&uacute; <b><?=(isset($_POST['nombre']))?$_POST['nombre']:'';?></b> se guardo correctamente</span>
                            </div>
						</div>
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
			                <th>Nombre</th>
			                <th>Icono</th>
			                <th>Destino</th>
			                <th>Padre</th>
			                <th>Estado</th>
			            </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aMenus)
			            	{
			            		if (count($aMenus)>0)
                    			{
                    				foreach($aMenus as $objeto)
                    				{
                    					$menuPadre="";
                    					
                    					if ($objeto->getIdpadre()!="0")
                    					{
                    						unset($aWhere);
                    						$aWhere['id']=$objeto->getIdpadre();
                    						$aSubMenu=$objMenus->buscar($aWhere);
                    						if (count($aSubMenu)>0)
                    							$menuPadre=$aSubMenu[0]->getNombre();
                    					}

                    					?>
                    						<tr>
                    							<td>
                    								<input type="radio" name="seleccionarItem[]" value="<?=$objeto->getId();?>" />
                    							</td>
                    							<td><?=$objeto->getNombre();?></td>
                    							<td><?=$objeto->getIcono();?></td>
                    							<td><?=$objeto->getDestino();?></td>
                    							<td><?=$menuPadre;?></td>
                    							<td><?=($objeto->getEstado_registro()==1)?'ACTIVO':'ELIMINADO';?></td>
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
				                <th>Icono</th>
				                <th>Destino</th>
				                <th>Padre</th>
			                	<th>Estado</th>
		                    </tr>
		                </tfoot>
			        </table>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
