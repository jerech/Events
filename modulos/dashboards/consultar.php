<link href="<?php echo BASE_URL ?>/modulos/dashboards/css/index.css" rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
	<input type="hidden" name="base_url" value="<?=BASE_URL;?>"/>
	
    <div class="row">
	    <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Asistentes por Tipo</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">

                        <?php
                           for ($i=0; $i < count($identificadores_id); $i++) { 
                            $objIdentificacion=New Identificaciones($identificadores_id[$i]);
                            $objTipo=New TipoAsistentes($objIdentificacion->getId_tipo());
                            $objZona=New Zonas($objIdentificacion->getId_zona());

                            $aWhere= array();
                            $aWhere['a.id_identificacion']=$identificadores_id[$i];

                            if($search!=""){
                                $aWhere['ae.id_evento']=$search;
                            }
                            if($oUsuario->getRol_numero()!=SUPERADMIN){
                                $aWhere['a.empresa_numero']=$oUsuario->getEmpresa_numero();
                             } 
                             $aWhere['ae.estado']=1;
                            $canActivos=count($objAsistente->buscar2($aWhere));
                            $aWhere['ae.estado']=4;
                            $canRegistrados=count($objAsistente->buscar2($aWhere));
                            $canTotal=$canRegistrados+$canActivos;

                            ?>
                            <div class="col-lg-3" >
                            <div style="background-color:<?=$objIdentificacion->getColor();?> !important;" class="widget style1 navy-bg" >
                            <div class="row vertical-align" >
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h2 class="font-bold"><?=$canRegistrados;?>/<?=$canTotal;?></h2><br>
                                <?=$objTipo->getDescripcion();?>
                            </div>
                            </div>
                            </div>
                            </div>

                            <?php
                               
                           }




                           ?>
                        
          

                    </div>
    </div>
    </div>
	</div>

    <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Gráfico</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="ibox-content">
             <div id="chartPie" style="height:200px"></div>
               
            </div>
                </div>
            </div>
    </div>
    
            
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5></h5>
					<div class="pull-right">
						<!--<div class="btn-group">
							<input type="button" name="btnNewAsign" id="btnNewAsign" class="btn btn-primary windowAsign" value="Nueva asignaci&oacute;n">
						</div>-->
					</div>
				</div>
				<div class="ibox-content">
					<form name="formulario" action="" method="post">
						<input type="hidden" name="identificador" value=""/>
                        <input type="hidden" name="pagina" value="<?=$page;?>"/>
                        <input type="hidden" name="search" value=""/>
                        <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>

                    </form>

              
                        <div class="col-lg-12">
                                <label class="col-lg-2 control-label">Evento:</label>
                        </div>
                        <div class="form-group">
                                <div class="col-lg-12">
                                    <select data-placeholder="Seleccionar Evento" name="search" id="search"  class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?=(isset($_POST['search']))?($_POST['search']=='')?'selected':'':'selected';?>></option>
                                        <?php
                                        $aWhere=array();
                                        if (count($aEventos)>0)
                                        {
                                            foreach($aEventos as $objetoC)
                                            {
                                                 ?>
                                                <option value="<?=$objetoC->getId();?>" <?=(isset($_POST['search']))?($_POST['search']==$objetoC->getId())?'selected':'':'';?>><?=$objetoC->getNombre();?></option>
                                        
                                                <?php
                                                // }
                                            }
                                        }
                                        ?>
                                    </select>
                                     
                                    
                                    
                                            <button type="button" class="btn btn btn-primary" onclick="searchAsistentes()"> <i class="fa fa-search"></i> Buscar</button>
                                    
                               
                                </div>
                            </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                
                            <table id="table-asistentes" class="table table-striped table-hover dataTables-example" style="font-size:smaller;margin-bottom: 0;">
                                
                    <!-- <table class="table table-striped table-bordered table-hover dataTables-example" > -->
			            <thead>
			            <tr>
                            <th>Color</th>
			                <th>Nombre/Apellido</th>
			                <th>Documento</th>
			                <th>Tipo</th>
                            <th>Zona</th>                            
			                <th>Email</th>

                            <th>Telefono</th>
                            <th>Estado</th>
                            <!-- <th>acciones</th> -->
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
                    					/*unset($aWhere);
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
                                        }*/

                                        /*$tipo="";
                                        
                                        if ($objeto->getIdtipoasignacion()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['id']=$objeto->getIdtipoasignacion();
                                            $aTipos=$objTipo->buscar($aWhere);
                                            if (count($aTipos)>0)
                                                $tipo=$aTipos[0]->getNombre();
                                        }*/
                                
                                    $objIdentificacion=New Identificaciones($objeto->getId_identificacion());
                                        
                    					?>
                    						<tr>

                                             
                                                    <td><span class="label" style="background-color:<?=$objIdentificacion->getColor();?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                                
                    						
                    							<td>
                                                      <?=$objeto->getNombre();?> <?=$objeto->getApellido();?>                  
                                                </td>
                    							
                                                <td>
                                                  <?=$objeto->getDocumento();?>
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
                                                     <!-- <img alt="image" class="img-circle" src="<?=$logo;?>" /> -->
                                                </td>
                                                <td>
                                                    <?=$objeto->getTelefono();?>                     
                                                </td>
                                                <td>
                                                    <?php
                                                    $label_type="label-primary";
                                                    $estado="REGISTRADO";
                                                    unset($aWhere);
                                                   
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
                    						    <!-- <td>
                                                    <button type="button" class="btn btn-xs btn-white" onclick="fnOpenVisualize('<?php echo BASE_URL ?>asignaciones/visualize', '<?php echo $objeto->getId(); ?>')" title="Visualizar">
                                                        <i class="fa fa-eye"></i>
                                                    </button>                  
                                                </td> -->
                                            </tr>
                    					<?php
                                        
                                        
									}
								}
							}
							?>                    		
			            </tbody>
                        <tfoot>
                            <tr>
                             <th>Color</th>
                            <th>Nombre/Apellido</th>
                            <th>Documento</th>
                            <th>Tipo</th>
                            <th>Zona</th>                            
                            <th>Email</th>

                            <th>Telefono</th>
                            <th>Estado</th>
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
</div>
<!-- Chart Visitas -->
<script src="<?php echo BASE_URL ?>modulos/dashboards/js/canvasjs.min.js" rel="stylesheet"></script>

<script type="text/javascript">
    
    canActivos='<?=$canAsistentesActivos;?>';
    canRegistrados='<?=$canAsistentesRegistrados;?>';
</script>