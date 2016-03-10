<body>
<div id="wrapper">

    <!-- Side left menu -->

    <nav class="navbar-default navbar-static-side" role="navigation">

        <div class="sidebar-collapse">

            <ul class="nav" id="side-menu">

                <li class="nav-header">

                    <div class="dropdown profile-element">

                         <span>

                            <img alt="image" class="img-circle" src="<?=$logo;?>" />

                         </span> 

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="clear">

                                <span class="block m-t-xs"> <strong class="font-bold"><?=$oUsuario->getNombre();?></strong></span>

                                <span class="text-muted text-xs block"><?=$oRol->getRol();?><b class="caret"></b></span>

                            </span>

                        </a>

                        <ul class="dropdown-menu animated fadeInRight m-t-xs">


                            <!-- <li><a href="profile.html">Profile</a></li> -->

                            <li class="divider"></li>

                            <li><a href="<?=BASE_URL;?>logout/">Salir</a></li>

                        </ul>

                    </div>

                    <div class="logo-element"></div>

                </li>

                
                    <?php
                        foreach($aMenus as $objeto)
                        {
                        ?>
                        <li class="">
                        <?php
                            $checkPerm=false;
                            if (count($aPermisos)>0)
                            {
                                foreach($aPermisos as $operm)
                                {
                                    if ($operm->getIdmenu()==$objeto->getId())
                                    {
                                        if ($operm->getVer() || $operm->getAgregar() || $operm->getModificar())
                                        {
                                            $checkPerm=true;
                                            break;
                                        }
                                    }
                                }
                            }
                            if ($checkPerm || $oUsuario->getRol_numero()==SUPERADMIN)
                            {
                                ?>
                                 <a href="<?=BASE_URL;?><?=$objeto->getDestino();?>"><?=$objeto->getIcono();?><span class="nav-label"><?=$objeto->getNombre();?></span> <span class="fa arrow"></span></a>
                                <?
                                $i=0;
                                foreach($aSubMenus as $subobjeto)
                                {
                                    $checkPerm=false;
                                    if (count($aPermisos)>0)
                                    {
                                        foreach($aPermisos as $operm)
                                        {
                                            if ($operm->getIdmenu()==$subobjeto->getId())
                                            {
                                                if ($operm->getVer() || $operm->getAgregar() || $operm->getModificar())
                                                {
                                                    $checkPerm=true;
                                                    break;
                                                }
                                            }
                                        }
                                    } 
                                    if ($checkPerm || $oUsuario->getRol_numero()==SUPERADMIN)
                                    {  
                                        if ($subobjeto->getIdpadre()==$objeto->getId())
                                        {

                                            if ($i==0){
                                                ?>
                                                <ul class="nav nav-second-level">
                                                <?php
                                            }
                                            ?>
                                            <li class=""><a href="<?=BASE_URL;?><?=$subobjeto->getDestino();?>&m=<?=$subobjeto->getId();?>"><?=$subobjeto->getIcono();?><?=$subobjeto->getNombre();?></a></li>
                                            <?php

                                            $i++;
                                        }
                                    }

                                }

                                if ($i>0)
                                {
                                    ?>
                                    </ul>
                                    </li>
                                    <?php
                                }
                            }
                        } 
                    ?>

                    <!-- <a href="index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Tableros</span> <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">

                        <li class="<?php if($_SERVER["REQUEST_URI"] == "/nativoapps_app/index.php") echo "active"; ?>"><a href="index.php">Principal</a></li>

                        <li class="<?php if($_SERVER["REQUEST_URI"] == "/nativoapps_app/data_usuarios.php") echo "active"; ?>"><a href="data_usuarios.php">Usuarios</a></li>

                        <li class="<?php if($_SERVER["REQUEST_URI"] == "/nativoapps_app/actividades_entregas.php") echo "active"; ?>"><a href="actividades_entregas.php">Actividades y Entregas</a></li>

                    </ul> -->

                </li>

            </ul>

        </div>

    </nav>



    <div id="page-wrapper" class="gray-bg">

        <!-- Header nav -->

        <div class="row border-bottom">

            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">

                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <li>

                        <span class="m-r-sm text-muted welcome-message">Bienvenidos <?=($oEmpresa->getNombre_empresa()!="")?"a ".strtoupper($oEmpresa->getNombre_empresa()):'';?></span>

                    </li>

                   <!-- <li class="dropdown" id="msj_novedad">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning"></span>
                        </a>
                    </li>

                    <li class="dropdown" id="msj_alerta">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                        </a>
                    </li>-->
                    <li>

                        <a href="<?=BASE_URL;?>logout/">

                            <i class="fa fa-sign-out"></i> Salir

                        </a>

                    </li>

                </ul>

            </nav>

        </div>