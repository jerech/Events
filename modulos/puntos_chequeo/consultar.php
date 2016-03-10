<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $modulo ?></h2>
            <ol class="breadcrumb">
                <li><a>Configuraci&oacute;n</a></li>
                <li class="active"><strong><?php echo $modulo; ?></strong></li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>  
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Listado de Puntos de chequeo</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form name="formulario" action="" method="post">
                            <input type="hidden" name="identificador" value=""/>
                            <input type="hidden" name="eliminar" value=""/>
                            <input type="hidden" name="m" value="<?=$_REQUEST['m'];?>"/>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <?php
                                if ($permParaAgregar || $oUsuario->getRol_numero()==SUPERADMIN)
                                { 
                                ?>
                                <a onclick="fnClickAdd('<?=BASE_URL;?>puntos_chequeo/add_edit');" href="javascript:void(0);" class="btn btn-primary ">
                                    Nuevo
                                </a>
                                <?php
                                }
                                if ($permParaModificar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickEdit('<?=BASE_URL;?>puntos_chequeo/add_edit','punto chequeo');" href="javascript:void(0);" class="btn btn-primary ">
                                    Modificar
                                </a>
                                <?php
                                }
                                if ($permParaEliminar || $oUsuario->getRol_numero()==SUPERADMIN)
                                {
                                ?>
                                <a onclick="fnClickDelete('punto chequeo');" href="javascript:void(0);" class="btn btn-primary ">
                                    Eliminar
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row alerta_editar">
                            <div class="alert alert-danger " >
                                <span id="mensaje_editar">Seleccionar el punto de chequeo que desea modificar</span>
                            </div>
                        </div>
                        <div class="row alerta_success" style="display:<?=(isset($result_save))?'block':'none';?>">
                            <div class="alert alert-success " >
                                <span id="mensaje_editar">Punto de chequeo <b><?=(isset($_POST['nombre']))?$_POST['nombre']:'';?></b> se guardo correctamente</span>
                            </div>
                        </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>Area</th>
                            <th>Piso</th>
                            <th>Tag</th>
                            <th>Estado</th>
                            <th>Empresa</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($aPuntos)
                            {
                                if (count($aPuntos)>0)
                                {
                                    foreach($aPuntos as $objeto)
                                    {
                                        unset($aWhere);
                                        $aWhere['estado_registro']=$objeto->getEstado_registro();
                                        $Estados=$objEstados->buscar($aWhere);

                                        $empresa="";

                                        if ($objeto->getEmpresa_numero()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['empresa_numero']=$objeto->getEmpresa_numero();
                                            $aEmpresas=$objEmpresas->buscar($aWhere);
                                            if (count($aEmpresas)>0)
                                                $empresa=$aEmpresas[0]->getNombre_empresa();
                                        }

                                        $area="";

                                        if ($objeto->getIdarea()!="")
                                        {
                                            unset($aWhere);
                                            $aWhere['id']=$objeto->getIdarea();
                                            $aAreas=$objArea->buscar($aWhere);
                                            if (count($aAreas)>0)
                                                $area=$aAreas[0]->getNombre();
                                        }

                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="seleccionarItem[]" value="<?=$objeto->getId();?>" class="i-checks"   />
                                                    
                                                </td>
                                                <td><?=$objeto->getNombre();?></td>
                                                <td><?=$objeto->getDescripcion();?></td>
                                                <td><?=$area;?></td>
                                                <td><?=$objeto->getPiso();?></td>
                                                <td><?=$objeto->getTag();?></td>
                                                <td><?=$Estados[0]->getDescripcion();?></td>
                                                <td><?=$empresa;?></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripci&oacute;n</th>
                                <th>Area</th>
                                <th>Piso</th>
                                <th>Tag</th>
                                <th>Estado</th>
                                <th>Empresa</th>
                        
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
