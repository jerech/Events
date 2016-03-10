<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Turno)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Turnos</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>turnos/action" method="post" class="form-horizontal">
							<input type="hidden" name="id" value="<?=(isset($Turno))?$Turno[0]->getId():'';?>" >
							<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
								<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Turno))?$Turno[0]->getNombre():'';?>">
                                </div>
                            	<label class="col-lg-2 control-label">Descripci&oacute;n</label>

                                <div class="col-lg-4"><textarea  name="descripcion" placeholder="Descripci&oacute;n" style="resize:none;" class="form-control"><?=(isset($Turno))?$Turno[0]->getDescripcion():'';?></textarea></div>
                            </div>
							<div class="hr-line-dashed"></div>
						    <div class="form-group">
								<label class="col-lg-2 control-label" >Hora Inicio:</label>
                                <div class="col-lg-4">
                                    <div class='input-group date' name='datepicker[]'>
                                        <input type='text' class="form-control" required name="hora_inicio" value="<?=(isset($Turno))?$Turno[0]->getHora_inicio():'';?>" placeholder="HH:mm:ss" data-date-format="HH:mm:ss"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <label class="col-lg-2 control-label" >Hora Fin:</label>
                                <div class="col-lg-4">
                                    <div class='input-group date' name='datepicker[]'>
                                        <input type='text' class="form-control" required name="hora_fin" value="<?=(isset($Turno))?$Turno[0]->getHora_fin():'';?>" placeholder="HH:mm:ss" data-date-format="HH:mm:ss"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">D&iacute;as</label>

                                <div class="col-lg-10">
                                   <label class="control-label"><input type="checkbox" name="lunes" <?=(isset($Turno))?($Turno[0]->getLunes()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Lunes</label>
                                   <label class="control-label"><input type="checkbox" name="martes" <?=(isset($Turno))?($Turno[0]->getMartes()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Martes</label>
                                   <label class="control-label"><input type="checkbox" name="miercoles" <?=(isset($Turno))?($Turno[0]->getMiercoles()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Miercoles</label>
                                   <label class="control-label"><input type="checkbox" name="jueves" <?=(isset($Turno))?($Turno[0]->getJueves()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Jueves</label>
                                   <label class="control-label"><input type="checkbox" name="viernes" <?=(isset($Turno))?($Turno[0]->getViernes()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Viernes</label>
                                   <label class="control-label"><input type="checkbox" name="sabados" <?=(isset($Turno))?($Turno[0]->getSabados()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Sabados</label>
                                   <label class="control-label"><input type="checkbox" name="domingo" <?=(isset($Turno))?($Turno[0]->getDomingo()=='1')?'checked':'':'';?> value="1" class="i-checks"/>Domingo</label>
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>s
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
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Turno))?($Turno[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
								<label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-4">
                                     <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Turno))?($Turno[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Turno))?($Turno[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>         
                                </div>
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>turnos/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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