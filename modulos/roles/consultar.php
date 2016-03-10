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
                        <h5>Listado de Roles</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="ibox-content">
						<form name="formulario" action="" method="post">
							<input type="hidden" name="identificador" value=""/>
							<input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
						</form>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<?php
								if ($permParaAgregar || $oUsuario->getRol_numero()==SUPERADMIN)
								{ 
								?>
				            	<a onclick="fnClickAdd('<?=BASE_URL;?>roles/add_edit');" href="javascript:void(0);"  class="btn btn-primary ">
				            		Nuevo
				            	</a>
				            	<?php
				            	}
				            	if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
								{
								?>
				            	<a onclick="fnClickEdit('<?=BASE_URL;?>roles/add_edit','rol');" href="javascript:void(0);" class="btn btn-primary ">
				            		Modificar
				            	</a>
				            	<a onclick="fnClickEdit('<?=BASE_URL;?>roles/edit_perm','rol');" href="javascript:void(0);" class="btn btn-primary ">
				            		Permisos
				            	</a>
				            	<?php
				            	}
				            	if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('rol');" href="javascript:void(0);" class="btn btn-primary ">
				            		Eliminar
				            	</a>
                                <?php
                                }
                                ?>
				            </div>
						</div>
						<div class="row alerta_editar">
							<div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el rol que desea modificar</span>
                            </div>
						</div>
						<div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
							<div class="alert alert-success " >
                                <span id="mensaje_editar">Rol <b><?=(isset($_POST['rol']))?$_POST['rol']:'';?></b> se guardo correctamente</span>
                            </div>
						</div>
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
			                <th>Nro.Rol</th>
			                <th>Rol</th>
			                <th>Descripci&oacute;n</th>
			                <th>Nivel</th>
			                <th>Estado</th>
			            </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aRoles)
			            	{
			            		if (count($aRoles)>0)
                    			{
                    				foreach($aRoles as $objeto)
                    				{
                    					?>
                    						<tr>
                    							<td>
                    								<?php 
                    								if ($objeto->getId()!=SUPERADMIN)
                    								{
                    								?>
                    								<input type="radio" name="seleccionarItem[]" value="<?=$objeto->getId();?>" />
                    								<?php 
                    								}
                    								?>
                    							</td>
                    							<td><?=$objeto->getRol_numero();?></td>
                    							<td><?=$objeto->getRol();?></td>
                    							<td><?=$objeto->getDescripcion();?></td>
                    							<td><?=$objeto->getNivel();?></td>
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
			                	<th>Nro.Rol</th>
				                <th>Rol</th>
				                <th>Descripci&oacute;n</th>
				                <th>Nivel</th>
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
