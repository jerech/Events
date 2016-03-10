
<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $modulo ?></h2>
            <ol class="breadcrumb">
                <li><a>Registro Asistentes</a></li>
                <li class="active"><strong><?php echo $modulo; ?></strong></li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>	
	<div class="wrapper wrapper-content animated fadeInRight">
		
<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins border-bottom" >
                    <div class="ibox-title">
                        <h5>Filtros</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="display:none;">
                        <form name="formulario" action="" method="post">
                            <input type="hidden" name="identificador" value=""/>
                            <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="pagina" value="<?=$page;?>"/>
                            <input type="hidden" name="searchnombre" value="<?php echo (isset($_POST['searchnombre']))?$_POST['searchnombre']:'';?>"/>
                            <input type="hidden" name="searchestado" value="<?php echo (isset($_POST['searchestado']))?$_POST['searchestado']:'';?>"/>
                            <input type="hidden" name="searchdocumento" value="<?=(isset($_POST['searchdocumento']))?$_POST['searchdocumento']:'';?>"/>
                            <input type="hidden" name="searchevento" value="<?php echo (!empty($_POST['searchevento'])) ? $_POST['searchevento'] : '' ?>"/>
                            <input type="hidden" name="searchidentificacion" value="<?php echo (!empty($_POST['searchidentificacion'])) ? $_POST['searchidentificacion'] : '' ?>"/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>

                        </form>
                        
                    
                        <div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
                            <div class="alert alert-success " >
                                <span id="mensaje_editar">Asistente <b><?=(isset($_POST['asunto']))?$_POST['asunto']:'';?></b> se guardo correctamente</span>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group">
                            <div class="col-lg-6">
                                    <label class="col-lg-3 control-label">Evento:</label>
                                    <select class="form-control m-b" name="evento_search" id="evento_search">
                                        <option value="" <?php echo (isset($_POST['searchevento']))?($_POST['searchevento']=='')?'selected':'':'selected';?>>TODOS</option>
                                       <?php

                                        if (count($Eventos)>0)
                                        {
                                            foreach($Eventos as $objeto)
                                            {
                                               
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($_POST['searchevento']))?($_POST['searchevento']==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?> </option>
                                        
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </select>  
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-lg-3 control-label">Estado:</label>
                                    <select class="form-control m-b"  name="estado_search" id="estado_search">
                                        <option value="" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='')?'selected':'':'selected';?>>TODOS</option>
                                        <option value="1" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='1')?'selected':'':'';?>>REGISTRADO</option>
                                        <!-- <option value="2" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='2')?'selected':'':'';?>>INACTIVO</option>
                                        <option value="3" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='3')?'selected':'':'';?>>ELIMINADO</option>
                                         --><option value="4" <?php echo (isset($_POST['searchestado']))?($_POST['searchestado']=='4')?'selected':'':'';?>>CONFIRMADO</option>
                                        
                                    </select>
                                </div>
                            </div>
                  
                        <div class="form-group">
                            
                                <div class="col-lg-6">
                                    <label class="col-lg-3 control-label">Documento:</label>
                                
                               
                                <input type="text" value="<?=$_POST['searchdocumento'];?>" placeholder="Documento " id="documento_search" class="input form-control"/>
                                </div> 
                               

                                <div class="col-lg-6">
                                    <label class="col-lg-2 control-label">Identificacion:</label>
                                    <select data-placeholder="Seleccionar" name="identificacion_search" id="identificacion_search"  class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?php echo (isset($_POST['searchidentificacion']))?($_POST['searchidentificacion']=='')?'selected':'':'selected';?>>TODAS</option>
                                        <?php
                                        $aWhere=array();
                                        if (count($Identificaciones)>0)
                                        {
                                            foreach($Identificaciones as $objetoI)
                                            {
                                                 ?>
                                                <option value="<?=$objetoI->getId();?>" <?=(isset($_POST['searchidentificacion']))?($_POST['searchidentificacion']==$objetoI->getId())?'selected':'':'';?>><span class="label label-info"><?=$objetoI->getNombre();?>888</span> </option>
                                        
                                                <?php
                                                // }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="col-lg-3 control-label">Nombre / Apellido:</label>
                                </div>
                               <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="text" value="<?=$_POST['searchnombre'];?>" placeholder="Buscar Asistente " name="nombre_search" id="nombre_search" class="input form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary" onclick="searchAsistentes()"> <i class="fa fa-search"></i> Buscar</button>
                                    </span>
                                </div>
                            </div>
                            </div>
                             </div>  
                         </div>
                     </div>
                 </div>
             </div>

                                
        <div class="row">
        <div class="col-lg-12">
            <div class="row">
            <div class="col-lg-8">
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
			<div class="full-height-scroll">
                <div class="table-responsive">
                
                            <table id="table-clientes" class="table table-striped table-hover dataTables-example" style="font-size:smaller;margin-bottom: 0;">
                                
                    <!-- <table class="table table-striped table-bordered table-hover dataTables-example" > -->
			            <thead>
			            <tr>
                            <th></th>
			                <th>Color</th>
			                <th>Nombre</th>
			                <th>Apellido</th>
			                <th>Documento</th>
                            <th>Estado</th> 
                            <th>Tipo</th>
                            <th>Zona</th>  
                            <th>Email</th>
                            	                
                            
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aAsistentes)
			            	{
			            		if (count($aAsistentes)>0)
                    			{
                                    $cron=1;
                    				 $cronp=1;
                                    foreach($aAsistentes as $objeto)
                    				{

                                        $objIdentificacion=New Identificaciones($objeto->getId_identificacion());


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
                                        
                                        
                                    

                                        
                    					?>
                    						<tr>
                    							<!--<td>
                    								<input type="checkbox" name="seleccionarItem[]" value="<?=$objeto->getId();?>" class="i-checks"   />
                                                    
                    							</td>
                                            -->
                                            <td>
                                                    <button type="button" class="btn btn-xs btn-white" onclick="fnSeleccion('<?=$objeto->getId();?>','<?=$objeto->getNombre();?>','<?=$objeto->getApellido();?>','<?=$objeto->getDocumento();?>','<?=$objIdentificacion->getColor();?>','<?=$objeto->getEstado_registro();?>','<?=$objeto->getId_evento();?>')" title="Seleccionar">
                                                        <i class="fa fa-eye"></i>
                                                    </button> 
                                                    
                                                </td>
                    					      <td><span class="label" style="background-color:<?=$objIdentificacion->getColor();?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                              </td>

                    							<td><b><?=$objeto->getNombre();?></b></td>
                                                <td>
                                                  <b><?=$objeto->getApellido();?></b>
                                                </td>
                    							<td>
                                                    <?=$objeto->getDocumento();?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $label_type="label-primary";
                                                    $estado="REGISTRADO";
                                                    
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
                                                        $estado="CONFIRMADO";
                                                    }
                                                    else if ($objeto->getEstado_registro()==5)
                                                    {
                                                        $label_type="label-primary";
                                                        $estado="FINALIZADA";
                                                    }
                                                    ?>
                                                    <span class="label <?=$label_type;?>"><?=strtoupper($estado);?></span>                     
                                                </td>
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
                                                <td>
                                                <?=$objeto->getEmail();?>
                                                </td>
                                                

                                                
                                         
                                            </tr>
                    					<?php
                                        
                                        
									}
								}
							}
							?>                    		
			            </tbody>
                        <!--<tfoot>
                            <tr>
                                <th colspan="8" style="text-align:center">
                                    <button class="btn btn-white" <?=(count($aAsistentesCount)==0 || $page==0)?'disabled':'';?> type="button" onclick="linkPrevPage($('input[name=pagina]'));"><i class="fa fa-chevron-left"></i></button>
                                    <?php
                                    $j=1;
                                    if (intval(($page+1)/10)*10==0)
                                        $inicial=1;
                                    else
                                        $inicial=intval(($page+1)/10)*10;

                                    for($i=$inicial;$i<=intval(count($aAsistentesCount)/20)+1 && $j<10;$i++)
                                    {
                                        ?>
                                        <button class="btn btn-white <?=($page+1==$i)?'active':'';?>" data-page="<?=$i;?>" onclick="linkPage($('input[name=pagina]'),$(this));"><?=$i;?></button>
                                        <?php
                                        $j++;
                                    }  
                                    ?>    
                                    <button class="btn btn-white" <?=(count($aAsistentesCount)==0 || $page>=intval(count($aAsistentesCount)/20))?'disabled':'';?> type="button" onclick="linkNextPage($('input[name=pagina]'));"><i class="fa fa-chevron-right"></i> </button>
                                </th>
                                
                            </tr>
                        </tfoot>-->
			         </table>
                     </div>
                </div>
                </div>
            </div>
        </div>

                <div class="col-lg-4">

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Asistente Escaneado</h5>
                            <?php
                               $docseleccionado=$searchdocumento;
                               $nombreseleccionado=$searchnombre;
                               $eventoseleccionado=$searchevento;
                               $estadoseleccionado=$_POST['estado_selec'];
                               $identificacionseleccionado=$_POST['identificacion_selec'];
                                if(count($asistenteEscaneado)>0){
                                    $docseleccionado=$asistenteEscaneado[0]['documento'];
                                    $nombreseleccionado=$asistenteEscaneado[0]['nombre']." ".$asistenteEscaneado[0]['apellido'];
                                    $eventoseleccionado=1;
                                    $estadoseleccionado=$asistenteEscaneado[0]['estado'];

                                    $identificacionseleccionado=$asistenteEscaneado[0]['id_identificacion'];

                                }

                                            ?>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                       </div>
                        <div class="ibox-content">
                            <form name="formulario_asistente" action="<?=BASE_URL;?>registro_asistentes/&m=<?=$_REQUEST["m"];?>" method="post" class="form-horizontal">
                                    <input  type="hidden" value="<?=$asistenteEscaneado[0]['id_evento'];?>" id="id_evento" name="id_evento"/>
                                    <input  type="hidden" value="<?=$asistenteEscaneado[0]['id'];?>" id="id_asistente" name="id_asistente"/>
                                    <div class="form-group">

                                        <label class="col-lg-4 control-label">Cod.:</label>
                                        <div class="col-lg-8">

                                            <input value="" style="resize:none;" placeholder="Leer Codigo" autofocus id="code" name="code" onchange="fnBuscarCodigoBarra();" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-4 control-label">Doc.:</label>
                                        <div class="col-lg-8">

                                            <input  readonly value="<?=$docseleccionado;?>" style="resize:none;" placeholder="Documento" id="documento_selec" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-4 control-label">Nombre:</label>
                                        <div class="col-lg-8">
                                            <input  readonly value="<?=$nombreseleccionado;?>" style="resize:none;" placeholder="Nombre" id="nombre_selec" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-4 control-label">Estado:</label>
                                        <div class="col-lg-8">
                                            <select disabled class="form-control m-b" name="estado_selec" id="estado_selec" class="chosen-select form-control m-b"  tabindex="4">
                                                <option value="" <?=(isset($estadoseleccionado))?($estadoseleccionado=='')?'selected':'':'selected';?>></option>
                                        <option value="1" <?=($estadoseleccionado==1)?'selected':'';?>>REGISTRADO</option>
                                        <option value="4" <?=($estadoseleccionado==4)?'selected':'';?>>CONFIRMADO</option>
                                    </select>  
                                        </div>
                                    </div>
                                    <div class="form-group">


                                        <label class="col-lg-4 control-label">Ident.:</label>
                                        <div class="col-lg-8">
                                            <?php
                                            if($identificacionseleccionado!=""){
                                                $objIdentificacion=New Identificaciones($identificacionseleccionado);
                                                echo '<span id="span_iden" class="label" style="background-color:'.$objIdentificacion->getColor().'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                                            }else{
                                                echo '<span id="span_iden" class="label" style="background-color:#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                                            }
                                            
                                         ?>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                        
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" onclick="fnAgregarAcompaniante();" style="width:200px;" type="button" <?=(isset($estadoseleccionado))?($estadoseleccionado==4)?'disabled':'':'';?> id="btnRegistrar" >Registrar Acompañante</button>
                                    
                                    <button class="btn btn-primary" type="submit" style="width:200px;" <?=(isset($estadoseleccionado))?($estadoseleccionado==4)?'disabled':'':'';?> id="btnConfirmar">Confirmar Invitado</button>
                                <button class="btn btn-primary" style="width:200px;" type="button" target="_blank" onclick="location.href='http://nativoapps.com/webcodecamjs-master';">Escanear</button>
                                </div>
                     
                                </form>
                               
                         
                        </div>
                    </div>
                </div>
            </div>








   
            <!-- Aca ponemos el lector-->
            <!--<div class="row">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lector</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                       
                        

                    </div>
                </div>

            </div>-->

            

			    	</div>
			    </div>
			</div>
		</div>

	</div>
</div>




<div class="modal fade" id="eventContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document" style="width:60%;">
    <form name="formulario_acompaniante" class="form-horizontal" action="" method="post" onSubmit="return onSubmitAcompaniante();">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Registrar Asistente</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
        <input type="hidden" name="id_asistente_acompaniante" id="id_asistente_acompaniante" value=""/>
        <div class="form-group">
            <label class="col-lg-4 control-label">Nombre:</label>

                                        <div class="col-lg-8">            
        <input name="nombre_acompaniante" style="resize:none;" class="form-control" value=""></div>
           </div>
<div class="form-group">
<label class="col-lg-4 control-label">Apellido:</label>
                                        <div class="col-lg-8">
             <input name="apellido_acompaniante" style="resize:none;" class="form-control" value=""></div>
           </div>
            <div class="form-group">
<label class="col-lg-4 control-label">Documento:</label>
                                        <div class="col-lg-8">
            <input name="documento_acompaniante" style="resize:none;" class="form-control" value=""></div>
           </div>
                            
           
        
          
             
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    </form>                 
  </div>
</div>