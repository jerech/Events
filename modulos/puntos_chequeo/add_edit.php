<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Punto)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Puntos de Chequeo</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>puntos_chequeo/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Punto))?$Punto[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
								<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Punto))?$Punto[0]->getNombre():'';?>">
                                </div>
                            	<label class="col-lg-2 control-label">Descripci&oacute;n</label>

                                <div class="col-lg-4"><textarea  name="descripcion" placeholder="Descripci&oacute;n" style="resize:none;" class="form-control"><?=(isset($Punto))?$Punto[0]->getDescripcion():'';?></textarea></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Area</label>

                                <div class="col-lg-4">
                                    <select class="form-control m-b"  name="idarea">
                                        <option value="0" <?=(isset($Punto))?($Punto[0]->getIdarea()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($Areas)>0)
                                        {
                                            foreach($Areas as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Punto))?($Punto[0]->getIdarea()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">Piso</label>

                                <div class="col-lg-2">
                                    <input type="text" required name="piso" placeholder="Piso" class="form-control" value="<?=(isset($Punto))?$Punto[0]->getPiso():'';?>">
                                </div>
                                <label class="col-lg-1 control-label">Tag NFC</label>

                                <div class="col-lg-2">
                                    <input type="text" required name="tag" placeholder="Tag NFC" class="form-control" value="<?=(isset($Punto))?$Punto[0]->getTag():'';?>">
                                </div>
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
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Punto))?($Punto[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
								<label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Punto))?($Punto[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Punto))?($Punto[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>         
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>puntos_chequeo/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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