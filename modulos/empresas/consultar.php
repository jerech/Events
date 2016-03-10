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
                        <h5>Listado de Empresas</h5>
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
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <?php
                                if ($permParaAgregar || $oUsuario->getRol_numero()==SUPERADMIN)
                                { 
                                ?>
                                <a onclick="fnClickAdd('<?=BASE_URL;?>empresas/add_edit');" href="javascript:void(0);"  class="btn btn-primary ">
                                    Nuevo
                                </a>
                                <?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickEdit('<?=BASE_URL;?>empresas/add_edit','empresas');" href="javascript:void(0);" class="btn btn-primary ">
                                    Modificar
                                </a>
                                <?php
                                }
                                if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('empresas');" href="javascript:void(0);" class="btn btn-primary ">
                                    Eliminar
                                </a>
                                <?php
                                }
                                ?>
                                <div class="btn-group">
                                    <a onclick="exportarXLS('empresas');" href="javascript:void(0);" class="btn btn-primary ">
                                        Exportar Excel
                                    </a>
                                    <!-- <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false" name="btnExport">Exportar <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:void(0);" onclick="exportarXLS('usuarios');" name="btnXLS" >EXCEL</a></li>
                                    </ul>    --> 
                                </div>
                            </div>
                        </div>
                        <div class="row alerta_editar">
                            <div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar Empresa que desea modificar</span>
                            </div>
                        </div>
                        <div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
                            <div class="alert alert-success " >
                                <span id="mensaje_editar">Empresa <b><?=(isset($_POST['nombre_empresa']))?$_POST['nombre_empresa']:'';?></b> se guardo correctamente</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
			                <th>Nombre Empresa</th>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Contacto</th>
			                <th>Tel&eacute;fono</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <!-- <th>Fecha Ultima Act</th> -->
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aEmpresa)
			            	{
			            		if (count($aEmpresa)>0)
                    			{
                    				$aWhere=array();
                                    //var_dump($aSector);
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

                    					
                    					
                    					?>
                    						<tr>
                    							<td>
                                                    <input type="checkbox" name="seleccionarItem[]" value="<?=$objeto->getId();?>" class="i-checks"   />
                                                                
                                                </td>
                                                <td><?=$objeto->getNombre_empresa();?></td>
                                                <td><?=$objeto->getTipo_documento();?></td>
                                                <td><?=$objeto->getDocumento();?></td>
                    							<td><?=$objeto->getContacto();?></td>
                    							<td><?=$objeto->getTelefono();?></td>
                                                <td><?=$objeto->getEmail();?></td>
                                                <td><?=$estado;?></td>
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
                                <th>Nombre Empresa</th>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Contacto</th>
                                <th>Tel&eacute;fono</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <!-- <th>Fecha Ultima Act</th> -->
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
