<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Ruta)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Rutas</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>rutas/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Ruta))?$Ruta[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
								<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Ruta))?$Ruta[0]->getNombre():'';?>">
                                </div>
                            	<label class="col-lg-2 control-label">Descripci&oacute;n</label>

                                <div class="col-lg-4"><textarea  name="descripcion" placeholder="Descripci&oacute;n" style="resize:none;" class="form-control"><?=(isset($Ruta))?$Ruta[0]->getDescripcion():'';?></textarea></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Puntos de Chequeo</label>
                                <div class="col-lg-4">
                                    <select name="puntos_ns[]" size="15" multiple class="form-control">
                                    <?php
                                    if ($PuntosChequeo)
                                    {
                                        if (count($PuntosChequeo)>0)
                                        {
                                            foreach($PuntosChequeo as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>"><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                    }
                                    ?>   
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <div class="col-lg-6" style="padding-left:0px;">
                                        <input type="button" class="btn btn-default" value="Pasar &raquo;" name="pasar">
                                        <input type="button" class="btn btn-default" value="Todos &raquo;" name="pasar_todos">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="button" class="btn btn-default" value="&laquo; Quitar" name="quitar">
                                        <input type="button" class="btn btn-default" value="&laquo; Todos" name="quitar_todos">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <select name="puntos_s[]" size="15" multiple class="form-control">
                                    <?php
                                    if ($PuntosChequeoIn)
                                    {
                                        if (count($PuntosChequeoIn)>0)
                                        {
                                            foreach($PuntosChequeoIn as $val)
                                            {
                                                foreach($val as $objeto)
                                                {
                                                
                                                ?>
                                                <option value="<?=$objeto->getId();?>"><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    </select>
                               </div>
                               <div class="col-lg-1">
                                    <div class="col-lg-12" style="padding-left:0px;">
                                        <button class="btn btn-default" type="button" name="subir">
                                            <i class="fa fa-angle-double-up"></i>
                                        </button>
                                    </div>
                                    <div class="col-lg-12" style="padding-left:0px;">
                                        <button class="btn btn-default" type="button" name="bajar">
                                            <i class="fa fa-angle-double-down"></i>
                                        </button>
                                     </div>
                               </div>
                            </div>
							<div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tiempo Aprox.</label>
                                <div class="col-lg-4">
                                    <input type="text"  name="tiempo" data-mask="99:99:99" placeholder="Tiempo Aprox." class="form-control" value="<?=(isset($Ruta))?$Ruta[0]->getTiempo():'';?>">
                                </div>
                                <div class="col-lg-6">
                                    <span class="help-block"></span>
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
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Ruta))?($Ruta[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
								<label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Ruta))?($Ruta[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Ruta))?($Ruta[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>         
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>rutas/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
                                    <button class="btn btn-primary" type="button" onClick="recargarPuntos();">Guardar</button>
                                </div>
                            </div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>