<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Asignaciones</a></li>
            <li class="active"><strong><?php echo $modulo; ?></strong></li>
        </ol>
	</div>
	<div class="col-lg-2">
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content animated fadeInRight">
			<div id="divPrint" class="ibox-content p-xl">
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<h2><?=strtoupper($asignacion);?></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<h3><strong>Estado:</strong></h3>
							</div>
							<div class="col-sm-7">
								<?php
		                        $label_type="label-primary";
		                        $estado="ACTIVO";
		                        unset($aWhere);
		                        $aWhere['estado_registro']=$oAsignacion->getEstado_registro();
		                        $oEstado=$objEstados->buscar($aWhere);
		                        if ($oAsignacion->getEstado_registro()==2)
		                        {
		                            $label_type="label-warning";
		                            $estado="INACTIVO";
		                        }
		                        else if ($oAsignacion->getEstado_registro()==3)
		                        {
		                            $label_type="label-danger";
		                            $estado="ELIMINADO";
		                        }
		                        else if ($oAsignacion->getEstado_registro()==4)
		                        {
		                            $label_type="label-info";
		                            $estado="ASIGNADO";
		                        }
		                        else if ($oAsignacion->getEstado_registro()==5)
		                        {
		                            $label_type="label-primary";
		                            $estado="FINALIZADA";
		                        }
		                        ?>
		                                                
								<strong>
									<span class="label <?=$label_type;?>"><?=strtoupper($oEstado[0]->getDescripcion());?></span>                     
		                        </strong>
		                    </div>
		                </div>
		                <div class="row">
							<div class="col-sm-5">
								<h3><strong>Creado Por:</strong></h3>
							</div>
							<div class="col-sm-7">
								<h3><?=$responsable;?></h3>
							</div>
						</div>    
						<div class="row">
							<div class="col-sm-5">
								<h3><strong>Asunto / Paciente:</strong></h3>
							</div>
							<div class="col-sm-7">
								<h3><?=$oAsignacion->getPaciente();?>-<?=$oAsignacion->getAsunto();?></h3>
							</div>
						</div>  
						<div class="row">
							<div class="col-sm-5">
								<h3><strong>Hora de Creaci&oacute;n:</strong></h3>
							</div>
							<div class="col-sm-7">
								<?php
								$date = date_create($oAsignacion->getCreated_at());
								$created_at = date_format($date, 'H:i:s A');
								?>
								<h3><?=$created_at;?></h3>
							</div>
						</div>  
					</div>
					<div class="col-sm-6 ">
						<div class="row">
							<div class="col-sm-8 text-right">
								<span>

		                            <img alt="image" class="img-circle" src="<?=$logoCamillero;?>" />

		                        </span> 
		                    </div>
		                </div>
						<div class="row">
							<div class="col-sm-10 text-right">
								<h3 style="color:#1ab394;"><strong>Camillero <?=$camillero;?></strong></h3> <br /><br />
						    </div>
		                </div>
							
						<div class="row">
							<div class="col-sm-5  text-right">
								<h3><strong>Inicio del Servicio:</strong></h3>
							</div>
							<div class="col-sm-7">
								<h3><?=$oInicio->getNombre();?></h3>
							</div>
						</div>    
						<div class="row">
							<div class="col-sm-5  text-right">
								<h3><strong>Fin del Servicio:</strong></h3>
							</div>
							<div class="col-sm-7">
								<h3><?=$oFin->getNombre();?></h3>
							</div>
						</div>  
						<div class="row">
							<div class="col-sm-5  text-right">
								<h3><strong>Ruta / Camino:</strong></h3>
							</div>
							<div class="col-sm-7">
									<h3><?=$oRuta->getNombre();?></h3>
							</div>
						</div>
						
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-2">
						<h3><strong>Completado:</strong></h3>
					</div>
					<div class="col-sm-10">
						<div class="progress progress-striped">
                            <div style="width: <?=$avance;?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?=$avance;?>" role="progressbar" class="progress-bar progress-bar-primary">
                                <span class="sr-only"><?=$avance;?>% Complete (success)</span>
                            </div>
                        </div>
                        <h5>El servicio esta a un <?=$avance?>% de avance, ultimo punto de control reportado <?=$oUltimo->getNombre();?>.-</h5>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-registradas" aria-expanded="false" >Actividades Regist.</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-detalles" aria-expanded="false" >Detalle del Servicio</a></li>
                        </ul>
                        <div class="tab-content">
                        	<div id="tab-registradas" class="tab-pane active">
                        		<table id="table-registradas" class="table table-striped table-hover" style="font-size:smaller;margin-bottom: 0;">
                                <tbody>
                                	<?php
                                	 if (count($Puntos)>0)
							            {
							            	$index=0;
							            	foreach($Puntos as $control)
							            	{
							            		$index+=1;
							            		if ($control['checkpoint']=="1")
							            		{
							            			?>
							            			<tr>
							            				<td>
														    <?php
															$date = date_create($control['updated_at']);
															$updated_at = date_format($date, 'H:i:s A');
															?>
															<h5><?=$updated_at;?></h5>
														</td>
														<td>
															<?php
															$label_type="label-primary";
		                        							$estado="Check";
															if ($index==1)
															{
		                        								$label_type="label-danger";
		                        								$estado="Inicio";
		                        							}
		                        							if ($index==count($Puntos))
															{
		                        								$label_type="label-danger";
		                        								$estado="Fin";
		                        							}
		                       								?>
		                                                
															<strong>
																<span class="label <?=$label_type;?>"><?=$estado;?></span>                     
									                        </strong>
														</td>
														<td>
															<?php
															$oPto=New Puntos_chequeo($control['idpunto']);
															if ($index==1)
															{
																$lblPunto="Salida Paciente desde ".$oPto->getNombre();	
															}
															else if ($index==count($Puntos))
															{
																$lblPunto="Llegada Paciente hasta ".$oPto->getNombre();	
															}
															else 
															{
																$lblPunto="Punto Control - ".$oPto->getNombre();	
																
															}
															?>
															<h5><?=$lblPunto;?></h5>
														</td>
														<td>
															<?php
															$fecha1 = new DateTime(substr($control['updated_at'],0,19));
	                                                        
	                                                        
	                                                        $timezone="America/Bogota";
                                                    $fecha2=new datetime("now",new datetimezone($timezone));
                                                    $fecha2->sub( new DateInterval('PT11M') );
                                                    //$fecha2 = new DateTime(Now);
                                                    //var_dump($fecha2);
                                                    $fecha = $fecha1->diff($fecha2);
                                                        	
															?>
															<h5>Hace <?=str_pad($fecha->h,2,'0',STR_PAD_LEFT);?>:<?=str_pad($fecha->i,2,'0',STR_PAD_LEFT);?></h5>
														</td>
													</tr>    
													<?php
							            		}
							            		
							            	
							            	}
							            }
                                	?>
                			    </tbody>        
                                </table>
                            </div>
                        	<div id="tab-detalles" class="tab-pane">
                        		<br>
                        		<table class="table table-striped table-bordered table-hover dataTables-example" >
						            <thead>
						            <tr>
						                <th>Id Asignaci&oacute;n</th>
			                            <th>Camillero</th>
			                            <th>Observaci&oacute;n</th>
						                <th>Asignaci&oacute;n</th>
						                <th>Le&iacute;do</th>
						                <th>Fecha</th>
			                            <th>Empresa</th>
			                        </tr>
						            </thead>
						            <tbody>
						            	<?php
						            	if ($aAleNov)
						            	{
						            		if (count($aAleNov)>0)
			                    			{
			                    				foreach($aAleNov as $objeto)
			                    				{
			                    					unset($aWhere);
			                                        $aWhere['estado_registro']=$objeto['estado_registro'];
			                                        $Estados=$objEstados->buscar($aWhere);

			                                        $empresa="";

			                                        if ($objeto['empresa_numero']!="")
			                                        {
			                                            unset($aWhere);
			                                            $aWhere['empresa_numero']=$objeto['empresa_numero'];
			                                            $aEmpresas=$objEmpresas->buscar($aWhere);
			                                            if (count($aEmpresas)>0)
			                                                $empresa=$aEmpresas[0]->getNombre_empresa();
			                                        }

			                                        $asignacion="";
			                                        $camillero="";

			                                        if ($objeto['idasignacion']!="")
			                                        {
			                                            $objAsignacion=New Asignaciones($objeto['idasignacion']);

			                                            $tipo="";
			                                            
			                                            if ($objAsignacion->getIdtipoasignacion()!="")
			                                            {
			                                                unset($aWhere);
			                                                $aWhere['id']=$objAsignacion->getIdtipoasignacion();
			                                                $aTipos=$objTipo->buscar($aWhere);
			                                                if (count($aTipos)>0)
			                                                    $tipo=$aTipos[0]->getNombre();
			                                            }

			                                            $asignacion=$objAsignacion->getAsunto()."-".$objAsignacion->getPaciente();
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
			                    							<td><?=$objeto['idasignacion'];?></td>
			                    							<td><?=$camillero;?></td>
			                                                <td><?=$objeto['observacion'];?></td>
			                                                <td><?=$asignacion;?></td>
			                    							<td>
			                                                <?
			                                                    if ($objeto['leido']==0)
			                                                    {
			                                                        $label_type="label-danger";
			                                                        $estado="NO LEIDO";
			                                                    }
			                                                    else if ($objeto['leido']==1)
			                                                    {
			                                                        $label_type="label-primary";
			                                                        $estado="LEIDO";
			                                                    }
			                                                    
			                                                    ?>
			                                                    <span class="label <?=$label_type;?>"><?=strtoupper($estado);?></span>                     
			                                                
			                                                </td>
			                                                
			                                                <td><?=substr($objeto['created_at'],0,19);?></td>
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
			                               <th>Id Asignaci&oacute;n</th>
			                                <th>Camillero</th>
			                                <th>Observaci&oacute;n</th>
			                                <th>Asignaci&oacute;n</th>
			                                <th>Le&iacute;do</th>
			                                <th>Fecha</th>
			                                <th>Empresa</th>
			                            </tr>
					                </tfoot>
						        </table>
                            </div>
                            
                        </div>
					</div>
				</div>
			</div>
			<br>
			<div class="text-right">
				<button class="btn btn-primary" onclick="window.location.href = '<?php echo BASE_URL ?>asignaciones/&m=<?php echo $_REQUEST["m"] ?>'">Regresar</button>
			</div>
		</div>
	</div>
</div>