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
                            <input type="hidden" name="searchpuntoinicio" value="<?php echo (!empty($_POST['searchpuntoinicio'])) ? $_POST['searchpuntoinicio'] : '' ?>"/>
                            <input type="hidden" name="searchpuntofinal" value="<?php echo (!empty($_POST['searchpuntofinal'])) ? $_POST['searchpuntofinal'] : '' ?>"/>
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
                            <input type="hidden" name="searchpuntoinicio" value="<?php echo (!empty($_POST['searchpuntoinicio'])) ? $_POST['searchpuntoinicio'] : '' ?>"/>
                            <input type="hidden" name="searchpuntofinal" value="<?php echo (!empty($_POST['searchpuntofinal'])) ? $_POST['searchpuntofinal'] : '' ?>"/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>

                        </form>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				         
				            </div>
						</div>
                        <div class="btn-group">
                                    <a onclick="exportarXLS('frecuencia');" href="javascript:void(0);" class="btn btn-primary ">
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
                        <!-- <div class="col-lg-12">
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
                        </div> -->
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
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Punto Inicio</label>

                                <div class="col-lg-4">
                                    <select data-placeholder="Seleccionar Punto Inicio" name="punto_inicio" id="punto_inicio" class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?=(isset($_POST['searchpuntoinicio']))?($_POST['searchpuntoinicio']=='')?'selected':'':'selected';?>></option>
                                        <?php
                                        if (count($PuntosChequeo)>0)
                                        {
                                            foreach($PuntosChequeo as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($_POST['searchpuntoinicio']))?($_POST['searchpuntoinicio']==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                                <label class="col-lg-2 control-label">Punto Final</label>
                                
                                <div class="col-lg-4">
                                     <select data-placeholder="Seleccionar Punto Final" class="chosen-select form-control m-b"  tabindex="4"  name="punto_final" id="punto_final">
                                        <option value="" <?=(isset($_POST['searchpuntofinal']))?($_POST['searchpuntofinal']=='')?'selected':'':'selected';?>></option>
                                        <?php
                                        if (count($PuntosChequeo)>0)
                                        {
                                            foreach($PuntosChequeo as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($_POST['searchpuntofinal']))?($_POST['searchpuntofinal']==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>   
                                    </select>
                                         
                                </div>
                            </div>
                            
                        <div class="col-lg-12">
                                <label class="col-lg-3 control-label">Asunto:</label>
                        </div>
                               
                                <div class="input-group">
                                    <input type="text" value="<?=$search;?>" placeholder="Buscar Asignaciones " id="searchText" class="input form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary" onclick="searchFrecuencias()"> <i class="fa fa-search"></i> Buscar</button>
                                    </span>
                                </div>
                         
                        
					<div class="full-height-scroll">
                        <div class="table-responsive">
                
                            <table id="table-clientes" class="table table-striped table-hover" style="font-size:smaller;margin-bottom: 0;">
                                
                    <!-- <table class="table table-striped table-bordered table-hover dataTables-example" > -->
			            <thead>
			            <tr>
			                <th>Camillero</th>
                            <th>Punto Chequeo Origen</th>
                            <th>Punto Chequeo Destino</th>
                            <th>Total Asignaciones</th>
                        </tr>
			            </thead>
			            <tbody>
			            	<?php
			            	if ($aAsignaciones)
			            	{
			            		if (count($aAsignaciones)>0)
                    			{
                                    foreach($aAsignaciones as $objeto)
                    				{
                                        
                                        
                    					?>
                    						<tr>
                    							
                    				            <td>
                                                    <?php echo $objeto->nombre;?>
                                                     <!-- <img alt="image" class="img-circle" src="<?=$logo;?>" /> -->
                                                </td>
                                                 <td>
                                                    <?php echo $objeto->punto;?>
                                                     <!-- <img alt="image" class="img-circle" src="<?=$logo;?>" /> -->
                                                </td>
                                                 <td>
                                                    <?php echo $objeto->punto_dest;?>
                                                     <!-- <img alt="image" class="img-circle" src="<?=$logo;?>" /> -->
                                                </td>
                                                <td>
                                                   <?php echo $objeto->totalasignaciones;?>
                                                                        
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
                                <th colspan="7" style="text-align:center">
                                    <button class="btn btn-white" <?=($aAsignacionesCount==0 || $page==0)?'disabled':'';?> type="button" onclick="linkPrevPage($('input[name=pagina]'));"><i class="fa fa-chevron-left"></i></button>
                                    <?php
                                    $j=1;
                                    if (intval(($page+1)/10)*10==0)
                                        $inicial=1;
                                    else
                                        $inicial=intval(($page+1)/10)*10;

                                    for($i=$inicial;$i<=intval($aAsignacionesCount/20)+1 && $j<10;$i++)
                                    {
                                        ?>
                                        <button class="btn btn-white <?=($page+1==$i)?'active':'';?>" data-page="<?=$i;?>" onclick="linkPage($('input[name=pagina]'),$(this));"><?=$i;?></button>
                                        <?php
                                        $j++;
                                    }  
                                    ?>    
                                    <button class="btn btn-white" <?=($aAsignacionesCount==0 || $page>=intval($aAsignacionesCount/20))?'disabled':'';?> type="button" onclick="linkNextPage($('input[name=pagina]'));"><i class="fa fa-chevron-right"></i> </button>
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
