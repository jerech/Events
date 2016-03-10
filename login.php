<body class="bodyLogin">
    <div class="container loginscreen animated" >
    <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4">
        <!-- <div class="panel panel-default panelLogin"> -->
          <!-- <div class="panel-heading">
            <strong>Iniciar Sesi&oacute;n</strong>
          </div> -->
          <!-- <div class="panel-body"> -->
            <form role="form" method="post" name="frmLogin" action="">
              <fieldset>
                <div class="row">
                  <div class="center-block">
                    <div class="logo-name">
                        <h2 >EVENTOS</h2>
                        <h3 style="color: #FFF;">Asistentes</h3>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span> 
                        <input class="form-control" placeholder="Username" required name="usuario" type="text" autofocus="" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input class="form-control" placeholder="Password" required name="password" type="password" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="btnlogin" id="btnlogin" class="btn btn-lg btn-primary btn-block" value="Ingresar">
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <!-- <div class="panel-footer">
            <?php 
            if($msjErrorLogin!=""){echo $msjErrorLogin;}
            ?></div>
                </div> -->
      </div>
    </div>
   