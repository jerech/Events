</div> <!-- end wrapper-->
	<!-- Mainly scripts -->
    <script src="<?=BASE_URL;?>js/plugins/fullcalendar/moment.min.js"></script>
    <script src="<?=BASE_URL;?>js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="<?=BASE_URL;?>js/jquery.blockUI.js"></script>
    <script src="<?=BASE_URL;?>js/bootstrap.min.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/jeditable/jquery.jeditable.js"></script>
    
    <script type="text/javascript" src="<?=BASE_URL;?>js/moment-with-locales.js"></script>
    <script type="text/javascript" src="<?=BASE_URL;?>js/bootstrap-datetimepicker.js"></script>

    <!-- Data Tables -->
    <script src="<?=BASE_URL;?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/dataTables/dataTables.responsive.js"></script>
    <!--<script src="<?=BASE_URL;?>js/plugins/dataTables/dataTables.tableTools.min.js"></script>-->

    <!-- Custom and plugin javascript -->
    <script src="<?=BASE_URL;?>js/java.js"></script>
    <script src="<?=BASE_URL;?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI custom -->
    <script src="<?=BASE_URL;?>js/jquery-ui.custom.min.js"></script>
    
    <script src="<?=BASE_URL;?>js/ui/jquery-ui.js"></script>
  
    <!-- iCheck -->
    <script src="<?=BASE_URL;?>js/plugins/iCheck/icheck.min.js"></script>

    <!-- Full Calendar -->
    <script src="<?=BASE_URL;?>js/plugins/fullcalendar/fullcalendar.min.js"></script>

    <!-- DROPZONE -->
    <script src="<?=BASE_URL;?>js/plugins/dropzone/dropzone.js"></script>
    
    <script src="<?=BASE_URL;?>js/plugins/jsTree/jstree.min.js"></script>

    <!-- PRINT TO PDF -->
    <script src="<?=BASE_URL;?>js/jquery.PrintArea.js"></script>
    <script src="<?=BASE_URL;?>js/jQuery.print.js"></script>

    <!-- NUMERIC -->
    <script src="<?=BASE_URL;?>js/jquery.numeric.min.js"></script>

    <!-- Chosen -->
    <script src="<?=BASE_URL;?>js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Steps -->
    <script src="<?=BASE_URL;?>js/plugins/staps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?=BASE_URL;?>js/plugins/validate/jquery.validate.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Morris -->
    <script src="<?php echo BASE_URL ?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/plugins/morris/morris.js"></script>

    <!-- Data picker -->
    <script src="<?php echo BASE_URL ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    
     <!-- Toastr -->
    <script src="<?php echo BASE_URL ?>/js/plugins/toastr/toastr.min.js"></script>

    <!-- Input Mask-->




<?php
if($msjErrorLogin!=""){
?>
<script type="text/javascript">
    setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('Usuario/Contraseña incorrectos', 'Iniciar Sesion');

            }, 1300);
</script>
<?php
}


if (isset($_GET['modulo']) && isset($_SESSION['usuario'])) {
    echo '<script src="' . BASE_URL . 'modulos/' . $_GET['modulo'] . '/js/index.js"></script>';
}

?>
</body>
</html>