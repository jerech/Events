<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Asistentes)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Asistentes</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>asistentes/action" method="post" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=(isset($Asistentes))?$Asistentes[0]->getId():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
                                
                            	<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Asistentes))?$Asistentes[0]->getNombre():'';?>">
                                </div>

                                <label class="col-lg-2 control-label">Apellido</label>

                                <div class="col-lg-4">
                                    <input type="text" required name="apellido" placeholder="Apellido" class="form-control" value="<?=(isset($Asistentes))?$Asistentes[0]->getApellido():'';?>">
                                </div>
                            </div>
                        	<div class="hr-line-dashed"></div>
						    <div class="form-group">
								<label class="col-lg-2 control-label">Tel&eacute;fono</label>

                                <div class="col-lg-4">
                                	<input type="text" name="telefono"  placeholder="Tel&eacute;fono" class="form-control" value="<?=(isset($Asistentes))?$Asistentes[0]->getTelefono():'';?>">
                                </div>
                                <label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-4">
                                    <input type="email" name="email"  placeholder="Email" class="form-control" value="<?=(isset($Asistentes))?$Asistentes[0]->getEmail():'';?>">
                                </div>
                            </div> 

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Documento</label>

                                <div class="col-lg-4">
                                    <input name="documento"  placeholder="Documento" class="form-control" value="<?=(isset($Asistentes))?$Asistentes[0]->getDocumento():'';?>">
                                </div>
                                <label class="col-lg-2 control-label">Identificacion</label>
                                <div class="col-lg-4">
                                    <select class="form-control m-b" name="id_identificacion">
                                       <?php
                                        if (count($Identificaciones)>0)
                                        {
                                            foreach($Identificaciones as $objeto)
                                            {
                                                $aWhereZ['id']=$objeto->getId_zona();
                                                $Zonas = $objZona->buscar($aWhereZ);
                                                $aWhereT['id']=$objeto->getId_tipo();
                                                $Tipos = $objTipo->buscar($aWhereT);
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Asistentes))?($Asistentes[0]->getId_identificacion()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?> (<?=$Tipos[0]->getDescripcion();?>-<?=$Zonas[0]->getDescripcion();?>)</option>
                                        
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </select>      
                                </div>
                                <!-- <div class="col-lg-10">
                                    <input type="hidden" name="estado" value="<?=(isset($Asistentes))?$Asistentes[0]->getEstado_registro():'1';?>" >
                                    <input type="text" disabled name="val_estado"  class="form-control" value="<?=(isset($Asistentes))?($Asistentes[0]->getEstado_registro()=='1')?'ACTIVO':'ELIMINADO':'ACTIVO';?>">
                                </div> -->
                               
                            </div>
                          
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Empresa</label>

                                <div class="col-lg-4">
                                    <select class="form-control m-b" required name="empresa_numero">
                                        <?php
                                        if (count($Empresas)>0)
                                        {
                                            foreach($Empresas as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Asistentes))?($Asistentes[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            	<label class="col-lg-2 control-label">Estado</label>
                                <div class="col-lg-4">
                                    <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Asistentes))?($Asistentes[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Asistentes))?($Asistentes[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>      
                                </div>
                                <!-- <div class="col-lg-10">
                                    <input type="hidden" name="estado" value="<?=(isset($Asistentes))?$Asistentes[0]->getEstado_registro():'1';?>" >
                                    <input type="text" disabled name="val_estado"  class="form-control" value="<?=(isset($Asistentes))?($Asistentes[0]->getEstado_registro()=='1')?'ACTIVO':'ELIMINADO':'ACTIVO';?>">
                                </div> -->
                               
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>asistentes/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                </div>
                            </div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>