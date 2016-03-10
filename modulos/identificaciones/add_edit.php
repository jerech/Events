<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Identificacion)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Identificaciones</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>identificaciones/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Identificacion))?$Identificacion[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
								<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4"><input  name="nombre" placeholder="Nombre" style="resize:none;" class="form-control" value="<?=(isset($Identificacion))?$Identificacion[0]->getNombre():'';?>"/></div>
                            	<label class="col-lg-2 control-label">Color</label>

                                <div class="col-lg-4"><input  type="color" value="<?=(isset($Identificacion))?$Identificacion[0]->getColor():'#000000';?>" name="color" placeholder="Color" style="width:100px;" class="form-control"></input></div>
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
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Identificacion))?($Identificacion[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
								<label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Identificacion))?($Identificacion[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Identificacion))?($Identificacion[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>         
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Zonas</label>

                                <div class="col-lg-4">
                                    <select class="form-control m-b" required name="id_zona">
                                       <?php
                                        if (count($Zonas)>0)
                                        {
                                            foreach($Zonas as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Identificacion))?($Identificacion[0]->getId_zona()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getDescripcion();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                                <label class="col-lg-2 control-label">Tipo Asistente</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b" required name="id_tipo">
                                       <?php
                                        if (count($TipoAsistentes)>0)
                                        {
                                            foreach($TipoAsistentes as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Identificacion))?($Identificacion[0]->getId_tipo()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getDescripcion();?></option>
                                        
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
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>Identificaciones/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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