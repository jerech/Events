<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Roles)) ? "Editar" : "Agregar" ?></strong></li>
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
                        <h5>Administrar Roles</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        
                        <form name="formulario" action="<?=BASE_URL;?>roles/action" method="post" class="form-horizontal">
                            <input type="hidden" name="id" value="<?=(isset($Roles))?$Roles[0]->getId():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Rol N&uacute;mero</label>

                                <div class="col-lg-4">
                                    <input type="text" disabled="" name="rol_numero" placeholder="N&uacute;mero de Rol" class="form-control" value="<?=(isset($Roles))?$Roles[0]->getRol_numero():'';?>">
                                </div>
                                <label class="col-lg-2 control-label">Rol Nombre</label>

                                <div class="col-lg-4">
                                    <input type="text" required name="rol" maxlength="10" placeholder="Rol" class="form-control" value="<?=(isset($Roles))?$Roles[0]->getRol():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nivel</label>

                                <div class="col-lg-4">
                                    <input type="text" required name="nivel" maxlength="10" placeholder="Nivel" class="form-control" value="<?=(isset($Roles))?$Roles[0]->getNivel():'';?>">
                                </div>
                               <label class="col-lg-2 control-label">Descripci&oacute;n</label>

                                <div class="col-lg-4">
                                    <input type="text" name="descripcion"  placeholder="Descripci&oacute;n" class="form-control" value="<?=(isset($Roles))?$Roles[0]->getDescripcion():'';?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Estado</label>
                                
                                <div class="col-lg-10">
                                    <input type="hidden" name="estado" value="<?=(isset($Roles))?$Roles[0]->getEstado_registro():'1';?>" >
                                    <input type="text" disabled name="val_estado"  class="form-control" value="<?=(isset($Roles))?($Roles[0]->getEstado_registro()=='1')?'ACTIVO':'ELIMINADO':'ACTIVO';?>">
                                </div>
                                
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>roles/&m=<?=$_POST['m'];?>';">Cancelar</button>
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