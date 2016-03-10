<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Menus)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Men&uacute;s</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>menus/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Menus))?$Menus[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
								<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-10">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Menus))?$Menus[0]->getNombre():'';?>">
                                </div>
                            </div>
                        	<div class="hr-line-dashed"></div>
						    <div class="form-group">
								<label class="col-lg-2 control-label">Icono</label>

                                <div class="col-lg-10">
                                    <input type="text" name="icono" placeholder="C&oacute;digo HTML" class="form-control" value="<?=(isset($Menus))?str_replace('"',"'",$Menus[0]->getIcono()):'';?>">
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
						    <div class="form-group">
								<label class="col-lg-2 control-label">Destino</label>

                                <div class="col-lg-10">
                                	<input type="text" name="destino"  placeholder="Destino" class="form-control" value="<?=(isset($Menus))?$Menus[0]->getDestino():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Padre</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b" name="idpadre">
                                        <option value="0" <?=(isset($Menus))?($Menus[0]->getIdpadre()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($MenusPadre)>0)
                                        {
                                            foreach($MenusPadre as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getId();?>" <?=(isset($Menus))?($Menus[0]->getIdpadre()==$objeto->getId())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Estado</label>

                                <div class="col-lg-10">
                                    <input type="hidden" name="estado" value="<?=(isset($Menus))?$Menus[0]->getEstado_registro():'1';?>" >
                                    <input type="text" disabled name="val_estado"  class="form-control" value="<?=(isset($Menus))?($Menus[0]->getEstado_registro()=='1')?'ACTIVO':'ELIMINADO':'ACTIVO';?>">
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>menus/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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