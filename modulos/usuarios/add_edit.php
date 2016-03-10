<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Usuarios)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Usuarios</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                    	
                    	<form name="formulario" action="<?=BASE_URL;?>usuarios/action" method="post" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=(isset($Usuarios))?$Usuarios[0]->getId():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Usuario N&uacute;mero</label>

                                <div class="col-lg-4">
                                    <input type="text" disabled="" name="usuario_numero" placeholder="N&uacute;mero de Usuario" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getUsuario_numero():'';?>">
                                </div>
                            	<label class="col-lg-2 control-label">Nombre</label>

                                <div class="col-lg-4">
                                	<input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getNombre():'';?>">
                                </div>
                                <!-- <label class="col-lg-1 control-label">C&oacute;digo</label>

                                <div class="col-lg-2">
                                    <input type="text" name="codigo" placeholder="C&oacute;digo" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getCodigo():'';?>">
                                </div> -->
                            </div>
                        	<!-- <div class="hr-line-dashed"></div>
						    <div class="form-group">
								<label class="col-lg-2 control-label">Tel&eacute;fono</label>

                                <div class="col-lg-4">
                                	<input type="text" name="telefono"  placeholder="Tel&eacute;fono" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getTelefono():'';?>">
                                </div>
                                <label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-4">
                                    <input type="email" name="email"  placeholder="Email" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getEmail():'';?>">
                                </div>
                            </div> -->
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Login</label>

                                <div class="col-lg-4">
                                    <input type="text" name="login"  placeholder="Login" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getLogin():'';?>">
                                </div>
                            <?php
                            if (!isset($Usuarios))
                            {
                            ?>
                                <label class="col-lg-2 control-label">Password</label>

                                <div class="col-lg-4">
                                    <input type="password" required name="password_movil"  placeholder="Password" class="form-control" value="">
                                </div>
                            <?php
                            }
                            ?>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <!-- <label class="col-lg-2 control-label">Imei</label>

                                <div class="col-lg-3">
                                    <input type="text" name="imei"  placeholder="Imei" class="form-control" value="<?=(isset($Usuarios))?$Usuarios[0]->getImei():'';?>">
                                </div> -->
                                <label class="col-lg-2 control-label">Imagen</label>
                                <div class="col-lg-3">
                                    <?php
                                    $name_file = '';
                                    if (isset($Usuarios)) {
                                        $pos = strrpos($Usuarios[0]->getImagen(), "/");
                                        $name_file = substr($Usuarios[0]->getImagen(), $pos + 1);
                                    }
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="SelectImageClientes()"><i class="fa fa-upload"></i></button>
                                        </span>
                                        <input type="text" id="nombre_archivo" value="<?php echo $name_file ?>" class="form-control" readonly="readonly" />
                                        <input type="file" name="imagen" accept="image/*" class="form-control" onchange="SetNameFileClientes()" style="display:none" />
                                        <input type="hidden" name="url_imagen" value="<?php echo (isset($Usuarios)) ? $Usuarios[0]->getImagen() : "" ?>" />
                                    </div>
                                </div>
                                <label class="col-lg-1 control-label">Director</label>

                                <div class="col-lg-3">
                                    <select class="form-control m-b"  name="director">
                                        <option value="0" <?=(isset($Usuarios))?($Usuarios[0]->getDirector_usuario()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($UsuariosDirector)>0)
                                        {
                                            foreach($UsuariosDirector as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getUsuario_numero();?>" <?=(isset($Usuarios))?($Usuarios[0]->getDirector_usuario()==$objeto->getUsuario_numero())?'selected':'':'';?>><?=$objeto->getNombre();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">Rol</label>

                                <div class="col-lg-2">
                                    <select class="form-control m-b" required name="rol_numero">
                                        <option value="" <?=(isset($Usuarios))?($Usuarios[0]->getRol_numero()=='0')?'selected':'':'';?>></option>
                                        <?php
                                        if (count($Roles)>0)
                                        {
                                            foreach($Roles as $objeto)
                                            {
                                                ?>
                                                <option value="<?=$objeto->getRol_numero();?>" <?=(isset($Usuarios))?($Usuarios[0]->getRol_numero()==$objeto->getRol_numero())?'selected':'':'';?>><?=$objeto->getRol();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
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
                                                <option value="<?=$objeto->getEmpresa_numero();?>" <?=(isset($Usuarios))?($Usuarios[0]->getEmpresa_numero()==$objeto->getEmpresa_numero())?'selected':'':'';?>><?=$objeto->getNombre_empresa();?></option>
                                        
                                                <?php
                                            }
                                        }
                                        ?>    
                                    </select>
                                </div>
                            	<label class="col-lg-2 control-label">Estado</label>
                                <div class="col-lg-4">
                                    <select class="form-control m-b" required name="estado">
                                        <option value="1" <?=(isset($Usuarios))?($Usuarios[0]->getEstado_registro()=='1')?'selected':'':'';?>>ACTIVO</option>
                                        <option value="2" <?=(isset($Usuarios))?($Usuarios[0]->getEstado_registro()=='2')?'selected':'':'';?>>INACTIVO</option>
                                    </select>      
                                </div>
                                <!-- <div class="col-lg-10">
                                    <input type="hidden" name="estado" value="<?=(isset($Usuarios))?$Usuarios[0]->getEstado_registro():'1';?>" >
                                    <input type="text" disabled name="val_estado"  class="form-control" value="<?=(isset($Usuarios))?($Usuarios[0]->getEstado_registro()=='1')?'ACTIVO':'ELIMINADO':'ACTIVO';?>">
                                </div> -->
                               
                            </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>usuarios/&m=<?=$_REQUEST["m"];?>';">Cancelar</button>
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