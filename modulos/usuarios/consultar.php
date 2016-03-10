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
                        <h5>Listado de Usuarios</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="ibox-content">
                        <form name="formularioExport" action="" method="post">
                            <input type="hidden" name="busqueda" value=""/>
                            <input type="hidden" name="identificadores" value=""/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                            <input type="hidden" name="empresanumero" value="<?=$empresanumero;?>"/>
                            <input type="hidden" name="usuarionumero" value="<?=$usuarionumero;?>"/>
                        </form>
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
                                <a onclick="fnClickAdd('<?=BASE_URL;?>usuarios/add_edit');" href="javascript:void(0);"  class="btn btn-primary ">
                                    Nuevo
                                </a>
                                <?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickEdit('<?=BASE_URL;?>usuarios/add_edit','usuario');" href="javascript:void(0);" class="btn btn-primary ">
                                    Modificar
                                </a>
                                <a onclick="fnClickEdit('<?=BASE_URL;?>usuarios/edit_pass','usuario');" href="javascript:void(0);" class="btn btn-primary ">
                                    Password
                                </a>
                                <?php
                                }
                                if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('usuario');" href="javascript:void(0);" class="btn btn-primary ">
                                    Eliminar
                                </a>
                                <?php
                                }
                                ?>
                                <div class="btn-group">
                                    <a onclick="exportarXLS('usuarios');" href="javascript:void(0);" class="btn btn-primary ">
                                        Exportar Excel
                                    </a>
                                 </div>
                            </div>
                        </div>
                        <div class="row alerta_editar">
                            <div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el usuario que desea modificar</span>
                            </div>
                        </div>
                        <div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
                            <div class="alert alert-success " >
                                <span id="mensaje_editar">Usuario <b><?=(isset($_POST['nombre']))?$_POST['nombre']:'';?></b> se guardo correctamente</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
			                <th>Imagen</th>
                            <th>Nro.Usuario</th>
			                <th>Nombre</th>
			                <th>Rol</th>
			                <th>Empresa</th>
			                <th>Estado</th>
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aUsuarios)
			            	{
			            		if (count($aUsuarios)>0)
                    			{
                    				$aWhere=array();
                    				foreach($aUsuarios as $objeto)
                    				{
                    					$rol="";
                    					$empresa="";

                                        unset($aWhere);
                                        $aWhere['estado_registro']=$objeto->getEstado_registro();
                                        $Estados=$objEstados->buscar($aWhere);

                    					if ($objeto->getRol_numero()!="")
                    					{
                    						unset($aWhere);
                    						$aWhere['rol_numero']=$objeto->getRol_numero();
                    						$aRoles=$objRoles->buscar($aWhere);
                    						if (count($aRoles)>0)
                    							$rol=$aRoles[0]->getRol();
                    					}

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
                                                                
                                                    <!-- <input type="radio" name="seleccionarItem[]" value="<?=$objeto->getId();?>" /> -->
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($objeto->getImagen()!="")
                                                    {
                                                    ?>
                                                    <img src="<?=$objeto->getImagen();?>" width="40">
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?=$objeto->getUsuario_numero();?></td>
                    							<td><?=$objeto->getNombre();?></td>
                    							<td><?=$rol;?></td>
                    							<td><?=$empresa;?></td>
                    							<td><?=$Estados[0]->getDescripcion();?></td>
                                               
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
			                	<th>Imagen</th>
                                <th>Nro.Usuario</th>
				                <th>Nombre</th>
				                <th>Rol</th>
				                <th>Empresa</th>
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
</div>
