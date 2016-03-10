<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Asignacion)) ? "Editar" : "Agregar" ?></strong></li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
    </div>
<!-- Side Right -->

    <div class="wrapper wrapper-content animated fadeInRight">
    	<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Administrar Asignaciones</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>asignaciones/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Asignacion))?$Asignacion[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
									<div class="form-group">
									<label class="col-lg-2 control-label">Asunto</label>

                                <div class="col-lg-10">
                                	<input type="text" required name="asunto" placeholder="Asunto" class="form-control" value="<?=(isset($Asignacion))?$Asignacion[0]->getAsunto():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre del paciente</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="paciente" placeholder="Nombre del paciente" class="form-control" value="<?=(isset($Asignacion))?$Asignacion[0]->getPaciente():'';?>">
                                </div>
                            </div>
                            <!-- <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cedula</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="cedula" placeholder="Cedula" class="form-control" value="<?=(isset($Asignacion))?$Asignacion[0]->getCedula():'';?>">
                                </div>
                            </div> -->
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Punto Inicio</label>

                                <div class="col-lg-4">
                                    <select data-placeholder="Seleccionar Punto Inicio" name="punto_inicio"  class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?=(isset($Asignacion))?($Ruta=='0')?($PuntosIniFin[0]['idpunto']=='0')?'selected':'':'':'';?>></option>
                                        <?php
                                        if (count($PuntosChequeo)>0)
                                        {
                                            foreach($PuntosChequeo as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Asignacion))?($Ruta=='0')?($PuntosIniFin[0]['idpunto']==$objeto->getId())?'selected':'':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                                <label class="col-lg-2 control-label">Punto Final</label>
                                
                                <div class="col-lg-4">
                                     <select data-placeholder="Seleccionar Punto Final" class="chosen-select form-control m-b"  tabindex="4"  name="punto_final">
                                        <option value="" <?=(isset($Asignacion))?($Ruta=='0')?($PuntosIniFin[1]['idpunto']=='0')?'selected':'':'':'';?>></option>
                                        <?php
                                        if (count($PuntosChequeo)>0)
                                        {
                                            foreach($PuntosChequeo as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Asignacion))?($Ruta=='0')?($PuntosIniFin[1]['idpunto']==$objeto->getId())?'selected':'':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>   
                                    </select>
                                         
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Camillero</label>

                                <div class="col-lg-10">
                                    <select data-placeholder="Seleccionar Camillero" name="usuario_numero"  class="chosen-select form-control m-b"  tabindex="4" >
                                        <option value="" <?=(isset($Asignacion))?($Asignacion[0]->getUsuario_numero()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        $aWhere=array();
                                        if (count($Camilleros)>0)
                                        {
                                            foreach($Camilleros as $objeto)
                                            {
                                                // unset($aWhere);
                                                // $aWhere['usuario_numero']=$objeto->getUsuario_numero();
                                                // $aWhere['estado_registro']="4";
                                                // $UserAsignado=$objAsignacion->buscar($aWhere);
                                                // if (count($UserAsignado)==0)
                                                // {
                                                ?>
                                                <option value="<?=$objeto->getUsuario_numero();?>" <?=(isset($Asignacion))?($Asignacion[0]->getUsuario_numero()==$objeto->getUsuario_numero())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                                // }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo de asignaci&oacute;n</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b"  name="idtipoasignacion">
                                        <option value="" <?=(isset($Asignacion))?($Asignacion[0]->getIdtipoasignacion()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($Tiposasignacion)>0)
                                        {
                                            foreach($Tiposasignacion as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Asignacion))?($Asignacion[0]->getIdtipoasignacion()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Ruta</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b"  name="idruta">
                                        <option value="" <?=(isset($Asignacion))?($Ruta=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($Rutas)>0)
                                        {
                                            foreach($Rutas as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Asignacion))?($Ruta==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div> -->
                            <div class="hr-line-dashed"></div>
							<div class="form-group">
                                <label class="col-lg-2 control-label">Empresa</label>

                                <div class="col-lg-4">
                                    <select class="form-control m-b"  name="empresa_numero">
                                        <?php
                                        if (count($Empresas)>0)
                                        {
                                            foreach($Empresas as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Asignacion))?($Asignacion[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
								<label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b"  name="estado">
                                        <?php
                                        if (count($Estados)>0)
                                        {
                                            foreach($Estados as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getEstado_registro();?>" <?=(isset($Asignacion))?($Asignacion[0]->getEstado_registro()==$objeto->getEstado_registro())?'selected':'':(strtoupper($objeto->getDescripcion())=="ASIGNADOS")?'selected':'';?>><?=$objeto->getDescripcion();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>         
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>asignaciones/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
                                    <button class="btn btn-primary" type="button" onClick="validar();">Guardar</button>
                                </div>
                            </div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>