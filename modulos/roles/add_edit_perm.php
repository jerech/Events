<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $modulo ?></h2>
        <ol class="breadcrumb">
            <li><a>Configuraci&oacute;n</a></li>
            <li><a href="&m=<?php echo $_REQUEST['m'] ?>"><?php echo $modulo ?></a></li>
            <li class="active"><strong><?php echo (isset($Roles)) ? "Editar Permisos" : "Agregar Permisos" ?></strong></li>
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
                        <h5>Administrar Permisos del Rol</h5>
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
                    	<form name="formulario" action="<?=BASE_URL;?>roles/action" method="post" class="form-horizontal" >
                            <input type="hidden" name="id_edit_perm" value="<?=(isset($Roles))?$Roles[0]->getId():'';?>" >
                            <input type="hidden" name="rol_numero" value="<?=(isset($Roles))?$Roles[0]->getRol_numero():'';?>" >
                            <input type="hidden" name="rol" value="<?=(isset($Roles))?$Roles[0]->getRol():'';?>" >
                            <input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>

                                        <th>Men&uacute;s</th>
                                        <th>SubMen&uacute;s</th>
                                        <th>Ver</th>
                                        <th>Agregar</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($MenusPadre)
                                            {
                                                if (count($MenusPadre)>0)
                                                {
                                                    $aWhere=array();
                                                    foreach($MenusPadre as $objeto)
                                                    {
                                                        $checkPermVer=false;
                                                        $checkPermAgregar=false;
                                                        $checkPermModificar=false;
                                                        $checkPermEliminar=false;
                                                        if (count($aPermisos)>0)
                                                        {
                                                            foreach($aPermisos as $operm)
                                                            {
                                                                if ($operm->getIdmenu()==$objeto->getId())
                                                                {
                                                                    if ($operm->getVer())
                                                                        $checkPermVer=true;
                                                                    if ($operm->getAgregar())
                                                                        $checkPermAgregar=true;
                                                                    if ($operm->getModificar())
                                                                        $checkPermModificar=true;
                                                                    if ($operm->getEliminar())
                                                                        $checkPermEliminar=true;
                                                                    
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><b><?=$objeto->getNombre();?></b></td>
                                                            <td></td>
                                                            <td>
                                                                <input type="checkbox" <?=($checkPermVer)?'checked':'';?> value="<?=$objeto->getId();?>" onchange="fnCheckPermMenuVer($(this));" class="i-checks" name="menusCheckVer[]" >
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" <?=($checkPermAgregar)?'checked':'';?> value="<?=$objeto->getId();?>" onchange="fnCheckPermMenuAgregar($(this));" class="i-checks" name="menusCheckAgregar[]" >
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" <?=($checkPermModificar)?'checked':'';?> value="<?=$objeto->getId();?>" onchange="fnCheckPermMenuModificar($(this));" class="i-checks" name="menusCheckModificar[]" >
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" <?=($checkPermEliminar)?'checked':'';?> value="<?=$objeto->getId();?>" onchange="fnCheckPermMenuEliminar($(this));" class="i-checks" name="menusCheckEliminar[]" >
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        foreach($MenusHijo as $subobjeto)
                                                        {
                                                            $checkPermVer=false;
                                                            $checkPermAgregar=false;
                                                            $checkPermModificar=false;
                                                            $checkPermEliminar=false;
                                                            if (count($aPermisos)>0)
                                                            {
                                                                foreach($aPermisos as $operm)
                                                                {
                                                                    if ($operm->getIdmenu()==$subobjeto->getId())
                                                                    {
                                                                        if ($operm->getVer())
                                                                            $checkPermVer=true;
                                                                        if ($operm->getAgregar())
                                                                            $checkPermAgregar=true;
                                                                        if ($operm->getModificar())
                                                                            $checkPermModificar=true;
                                                                        if ($operm->getEliminar())
                                                                            $checkPermEliminar=true;

                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            if ($subobjeto->getIdpadre()==$objeto->getId())
                                                            {
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?=$subobjeto->getNombre();?></td>
                                                                <td>
                                                                    <input type="checkbox" <?=($checkPermVer)?'checked':'';?> data-padre="<?=$objeto->getId();?>" onchange="fnCheckPermSubMenuVer($(this));" value="<?=$subobjeto->getId();?>" class="i-checks" name="menusCheckVer[]" >
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" <?=($checkPermAgregar)?'checked':'';?> data-padre="<?=$objeto->getId();?>" onchange="fnCheckPermSubMenuAgregar($(this));" value="<?=$subobjeto->getId();?>" class="i-checks" name="menusCheckAgregar[]" >
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" <?=($checkPermModificar)?'checked':'';?> data-padre="<?=$objeto->getId();?>" onchange="fnCheckPermSubMenuModificar($(this));" value="<?=$subobjeto->getId();?>" class="i-checks" name="menusCheckModificar[]" >
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" <?=($checkPermEliminar)?'checked':'';?> data-padre="<?=$objeto->getId();?>" onchange="fnCheckPermSubMenuEliminar($(this));" value="<?=$subobjeto->getId();?>" class="i-checks" name="menusCheckEliminar[]" >
                                                                </td>
                                                                
                                                            </tr>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="button" onclick="location.href='<?=BASE_URL;?>roles/&m=<?=$_REQUEST['m'];?>';">Cancelar</button>
                                    <button class="btn btn-primary" type="submit" >Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>