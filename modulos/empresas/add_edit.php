<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Empresa)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Empresa</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                           
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>empresas/action" method="post" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=(isset($Empresa))?$Empresa[0]->getId():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Empresa N&uacute;mero</label>

                                <div class="col-lg-10">
                                    <input type="text" disabled="" name="empresa_numero" placeholder="N&uacute;mero de Empresa" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getEmpresa_numero():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo Documento</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b" required name="tipo_documento">
                                        <?php
                                        
                                            foreach($aTipoDoc as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto;?>" <?=(isset($Empresa))?($Empresa[0]->getTipo_documento()==$objeto)?'selected':'':'';?>><?=$objeto;?></option>
                                        
                                                <?php
                                            }
                                        ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Documento</label>

                                <div class="col-lg-10">
                                    <input type="text" name="documento" required placeholder="Documento" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getDocumento():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre Empresa</label>

                                <div class="col-lg-10">
                                    <input type="text" name="nombre_empresa" required placeholder="Nombre Empresa" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getNombre_empresa():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
								<label class="col-lg-2 control-label">Contacto</label>

                                <div class="col-lg-10">
                                	<input type="text"  name="contacto" placeholder="Contacto" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getContacto():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tel&eacute;fono</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="telefono" placeholder="Tel&eacute;fono" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getTelefono():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="email" placeholder="Email" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getEmail():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" >Fecha inicio:</label>
                                <div class="col-lg-10">
                                    <div class='input-group date' name='datepicker[]'>
                                        <input type='text' class="form-control" required name="fecha_inicio" value="<?=(isset($Empresa))?$Empresa[0]->getFecha_inicio():'';?>" placeholder="YYYY-mm-dd" data-date-format="YYYY-MM-DD"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" >Fecha corte:</label>
                                <div class="col-lg-10">
                                    <div class='input-group date' name='datepicker[]'>
                                        <input type='text' class="form-control" required name="fecha_corte" value="<?=(isset($Empresa))?$Empresa[0]->getFecha_corte():'';?>" placeholder="YYYY-mm-dd" data-date-format="YYYY-MM-DD"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        	<div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">D&iacute;as corte</label>

                                <div class="col-lg-10">
                                    <input type="text"  required name="dias_corte" placeholder="D&iacute;as corte" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getDias_corte():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">D&iacute;as prueba</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="dias_prueba" placeholder="D&iacute;as prueba" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getDias_prueba():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Etapa</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="etapa" placeholder="Etapa" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getEtapa():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cantidad usuarios</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="cantidad_usuarios" placeholder="Cantidad usuarios" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getCantidad_usuarios():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Paquete</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="paquete" placeholder="Paquete" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getPaquete():'';?>">
                                </div>
                            </div>
                            <!-- <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" >Ciudad</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b"  name="ciudad">
                                        <option value="" <?=(isset($Empresa))?($Empresa[0]->getCiudad()=='')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($LocalidadCiudad)>0)
                                        {
                                            foreach($LocalidadCiudad as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getNombre();?>" <?=(isset($Empresa))?($Empresa[0]->getCiudad()==$objeto->getNombre())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div> -->
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Direcci&oacute;n</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="direccion" placeholder="Direcci&oacute;n" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getDireccion():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Logo empresa</label>
                                <div class="col-sm-10">
                                    <?php
                                    $name_file = '';
                                    if (isset($Empresa)) {
                                        $pos = strrpos($Empresa[0]->getLogo_empresa(), "/");
                                        $name_file = substr($Empresa[0]->getLogo_empresa(), $pos + 1);
                                    }
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="SelectLogoEmpresa()"><i class="fa fa-upload"></i></button>
                                        </span>
                                        <input type="text" id="nombre_archivo_logo_empresa" value="<?php echo $name_file ?>" class="form-control" readonly="readonly" />
                                        <input type="file" name="logo_empresa" accept="image/*" class="form-control" onchange="SetNameFileLogoEmpresa()" style="display:none" />
                                        <input type="hidden" name="url_logo_empresa" value="<?php echo (isset($Empresa)) ? $Empresa[0]->getLogo_empresa() : "" ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Background inicial</label>

                                <div class="col-lg-10">
                                    <select class="form-control m-b" required name="background_inicial">
                                        <option value="" <?=(isset($Empresa))?($Empresa[0]->getBackground_inicial()=='')?'selected':'':'';?>></option>
                                        <?php
                                        
                                            foreach($aColor as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto['value'];?>" <?=(isset($Empresa))?($Empresa[0]->getBackground_inicial()==$objeto['value'])?'selected':'':'';?>><?=$objeto['nombre'];?></option>
                                        
                                                <?php
                                            }
                                        ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Footer empresa</label>

                                <div class="col-lg-10">
                                    <input type="text"  name="footer_empresa" placeholder="Footer empresa" class="form-control" value="<?=(isset($Empresa))?$Empresa[0]->getFooter_empresa():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Background movil</label>
                                <div class="col-sm-10">
                                    <?php
                                    $name_file2 = '';
                                    if (isset($Empresa)) {
                                        $pos2 = strrpos($Empresa[0]->getBackground_movil(), "/");
                                        $name_file2 = substr($Empresa[0]->getBackground_movil(), $pos2 + 1);
                                    }
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="SelectBackgroundMovil()"><i class="fa fa-upload"></i></button>
                                        </span>
                                        <input type="text" id="nombre_archivo_background_movil" value="<?php echo $name_file ?>" class="form-control" readonly="readonly" />
                                        <input type="file" name="background_movil" accept="image/*" class="form-control" onchange="SetNameFileBackgroundMovil()" style="display:none" />
                                        <input type="hidden" name="url_background_movil" value="<?php echo (isset($Empresa)) ? $Empresa[0]->getBackground_movil() : "" ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Estado</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-b" required name="estado_registro">
                                        <option value="1" <?=(isset($Sector))?($Sector[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Sector))?($Sector[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>      
                                </div>
                               
                               
                            </div>
							<div class="hr-line-dashed"></div>
                            
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>sector/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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