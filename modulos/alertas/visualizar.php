<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Alertas</a></li>
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
								<h4><?=strtoupper($asignacion);?></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<h5>Estado:</h5>
							</div>
							<div class="col-sm-10">
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

					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12 text-right">
								<span>

		                            <img alt="image" class="img-circle" src="<?=$logoCamillero;?>" />

		                        </span> 
		                    </div>
		                </div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<span><strong>Camillero <?=$camillero;?></strong></span> <br /><br />
						    </div>
		                </div>
							
						<?php
						$date = date_create($oAlerta->getCreated_at());
						$created_at = date_format($date, 'd/m/Y H:m:s');

						$date = date_create($oAlerta->getUpdated_at());
						$updated_at = date_format($date, 'd/m/Y H:m:s');
						?>
						<div class="row">
							<div class="col-sm-12 text-right">
								<span><strong>Fecha de Creacion:</strong></span> <?php echo $created_at ?><br />
						    </div>
		                </div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<span><strong>Fecha de Modificacion:</strong></span> <?php echo $updated_at ?>
						    </div>
		                </div>
						
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-2">
						<h5>Observaci&oacute;n:</h5>
					</div>
					<div class="col-sm-10">
						<textarea class="form-control" readonly style="resize:none;"><?=$oAlerta->getObservacion();?></textarea>
					</div>
				</div>
			</div>
			<br>
			<div class="text-right">
				<button class="btn btn-primary" onclick="window.location.href = '<?php echo BASE_URL ?>alertas/&m=<?php echo $_REQUEST["m"] ?>'">Regresar</button>
			</div>
		</div>
	</div>
</div>