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
                        <h5>Listado de Asistentes</h5>
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
                                <a onclick="fnClickAdd('<?=BASE_URL;?>asistentes/add_edit');" href="javascript:void(0);"  class="btn btn-primary ">
                                    Nuevo
                                </a>
                                <?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickEdit('<?=BASE_URL;?>asistentes/add_edit','usuario');" href="javascript:void(0);" class="btn btn-primary ">
                                    Modificar
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

                                <?php
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                
                                <a onclick="fnAsociarEventos('buscar_asistentes_asociar');" href="javascript:void(0);" class="btn btn-primary ">
                                    Asociar Evento
                                </a>
                                 <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row alerta_editar">
                            <div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el asistente que desea modificar</span>
                            </div>
                        </div>
                        <div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
                            <div class="alert alert-success " >
                                <span id="mensaje_editar">Asistente <b><?=(isset($_POST['nombre']))?$_POST['nombre']:'';?></b> se guardo correctamente</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                
					<table class="table table-striped table-bordered table-hover dataTables-example" >
			            <thead>
			            <tr>
			                <th></th>
                            <th>Color</th>
			                <th>Nombre</th>
                            <th>Apellido</th>
			                <th>Documento</th>
                            <th>Tipo</th>
                            <th>Zona</th>  
			                <th>Email</th>
			                <th>Estado</th>
                            <th>Empresa</th>
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aAsistentes)
			            	{
			            		if (count($aAsistentes)>0)
                    			{
                    				$aWhere=array();
                    				foreach($aAsistentes as $objeto)
                    				{

                                        $objIdentificacion=New Identificaciones($objeto->getId_identificacion());
                    					$rol="";
                    					$empresa="";

                                        unset($aWhere);
                                        $aWhere['estado_registro']=$objeto->getEstado_registro();
                                        $Estados=$objEstados->buscar($aWhere);

                    					

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
                                                <td><span class="label" style="background-color:<?=$objIdentificacion->getColor();?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                     
                                                <td><?=$objeto->getNombre();?></td>
                    							<td><?=$objeto->getApellido();?></td>
                                                <td><?=$objeto->getDocumento();?></td>
                                                <td>
                                                    <?php
                                                    $objTipo=New TipoAsistentes($objIdentificacion->getId_tipo());
                                                    echo $objTipo->getDescripcion();

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    
                                                    $objZona=New Zonas($objIdentificacion->getId_zona());
                                                    echo $objZona->getDescripcion();
                                                    ?>
                                                </td>
                    							<td><?=$objeto->getEmail();?></td>
                    							<td><?=$Estados[0]->getDescripcion();?></td>
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
                            <th>Apellido</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Empresa</th>
                        </tr>
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

<div class="modal fade" id="eventContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document" style="width:60%;">
    <form name="formularioAsociar" action="" method="post" onSubmit="return onSubmitAsistente();">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Asociar Eventos</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                        
        <input type="hidden" name="asistentes_asociar" value="">
            <div class="row">
                <label class="col-lg-3 control-label">Asistentes</label>

                <div class="col-lg-9">
                    <div class="table-responsive" style="max-height:400px;overflow:auto;">
                        <table class="table table-striped table-hover table-client" >
                            <thead>
                                <tr >
                                    <th>Asistente</th>
                                    <th>Evento</th>
                                    <th>Codigo Barra</th>
                                </tr>
                            </thead>
                            <tbody id="list-asistentes">
                                
                            </tbody>
                        </table>
                    </div>
                
                </div>
                
            </div>
            <div class="hr-line-dashed"></div>
                            
            <div class="row">
                <label class="col-lg-2 control-label">Eventos</label>

                <div class="col-lg-8">
                    <select class="form-control m-b"  name="id_evento">
                        <?php
                        if (count($Eventos)>0)
                        {
                            foreach($Eventos as $objeto)
                            {
                                ?>
                                <option value="<?=$objeto->getId();?>" ><?=$objeto->getNombre();?></option>
                        
                                <?php
                            }
                        }
                        ?>    
                    </select>
                </div>
                <div class="col-lg-2">
                    <a onclick="fnClickAddAsisEvent();" href="javascript:void(0);"  class="btn btn-primary ">
                        <i class="fa fa-plus-square"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-client" >
                        <thead>
                            <tr >
                                <th>Evento</th>
                                <th>QUITAR</th>
                            </tr>
                        </thead>
                        <tbody id="list-asevento">
                            
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="row">
                <div class="col-lg-12">
                    <input type="checkbox" name="quitarAsociacion" value="1" class="i-checks"   /> Quitar Asociaciones Anteriores?
                </div>
            </div>
             
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Asociar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    </form>                 
  </div>
</div>
