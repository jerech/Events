<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Usuarios)) ? "Editar Password" : "Agregar Password" ?></strong></li>
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
                    	<div class="row alerta_editar">
                            <div class="alert alert-danger " >
                                <span id="mensaje_editar">Completar todos los campos del formulario</span>
                            </div>
                        </div>
                    	<form name="formulario" action="<?=BASE_URL;?>usuarios/action" method="post" class="form-horizontal" >
                            <input type="hidden" name="id_edit_pass" value="<?=(isset($Usuarios))?$Usuarios[0]->getId():'';?>" >
                            <input type="hidden" name="nombre" value="<?=(isset($Usuarios))?$Usuarios[0]->getNombre():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password Actual</label>

                                <div class="col-lg-10">
                                    <input type="password" name="password_movil_actual"  placeholder="Password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password Nuevo</label>

                                <div class="col-lg-10">
                                    <input type="password" name="password_movil"  placeholder="Password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>usuarios/&m=<?=$_REQUEST['m'];?>';">Cancelar</button>
                                    <button class="btn btn-primary" type="button" onclick="onSubmitEditPass();">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>