/*
 *
 *   INSPINIA - Responsive Admin Theme
 *   version 2.0
 *
 */
$( window ).load(function() {
  // Run code
  BuscarNovedadAlertas();
  setInterval(function(){
    BuscarNovedadAlertas();
  },10000);
});

function BuscarNovedadAlertas()
{
    $.post("../ajax/ajax.php",
    {
        funcion:'buscar_novedades'
    },
    function(data){
        $("li#msj_novedad").html("");
        $("li#msj_novedad").html(data.html);
        
    },"json");

    $.post("../ajax/ajax.php",
    {
        funcion:'buscar_alertas'
    },
    function(data){
        if (parseInt($("input[name=historialAlert]").val())<data.total)
        {
            $('#audio_alert')[0].play();
            alert("Tiene nueva alerta del camillero "+data.camillero);
        }

        $("li#msj_alerta").html("");
        $("li#msj_alerta").html(data.html);


        
    },"json");
}

$(document).ready(function () {

    $('div[name^=datepicker]').datetimepicker({
            locale: 'es'
        });

     $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

     if ($("#calendar").length>0)
       ajaxInitActividades();

     if ($("#jstree1").length>0)
        ajaxTreeUsuarios();

     if ($("select[name=usuario_numero]").length>0 && ($("input[name=m]").val()=="42" || $("input[name=m]").val()=="34"))
        ajaxClientesVisor();

    if ($("select[name=pais]").length>0)
    {
        $("select[name=pais]").trigger("change");
    }
    
    if ($("select[name=nivel1_actividad_cita]").length>0)
    {
        $("select[name=nivel1_actividad_cita]").trigger("change");
    }    

    if ($("select[name=nivel1_actividad]").length>0)
    {
        $("select[name=nivel1_actividad]").trigger("change");
    }  

    if ($("select[name=usuario_numero]").length>0)
    {
        $("select[name=usuario_numero]").trigger("change");
    }  
     
     Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 100,
                maxFiles: 1,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button#subir").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                    this.on("addedfile", function (files) {
                        var inputDesc = Dropzone.createElement("");
                        file.previewElement.appendChild(inputDesc);
                    });
                }

            }
    // Add body-small class if window less than 768px
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }

    // MetsiMenu
    $('#side-menu').metisMenu();

    // Collapse ibox function
    $('.collapse-link').click( function() {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').click( function() {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    // Close menu in canvas mode
    $('.close-canvas-menu').click( function() {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // Open close right sidebar
    $('.right-sidebar-toggle').click(function(){
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // Initialize slimscroll for right sidebar
    $('.sidebar-container').slimScroll({
        height: '100%',
        railOpacity: 0.4,
        wheelStep: 10
    });

    // Open close small chat
    $('.open-small-chat').click(function(){
        $(this).children().toggleClass('fa-comments').toggleClass('fa-remove');
        $('.small-chat-box').toggleClass('active');
    });

    // Initialize slimscroll for small chat
    $('.small-chat-box .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });

    // Small todo handler
    $('.check-link').click( function(){
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });

    // Append config box / Only for demo purpose
    // Uncomment on server mode to enable XHR calls
    //$.get("skin-config.html", function (data) {
    //    if (!$('body').hasClass('no-skin-config'))
    //        $('body').append(data);
    //});

    // Minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();

    });

    // Tooltips demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

    // Move modal to body
    // Fix Bootstrap backdrop issu with animation.css
    $('.modal').appendTo("body");

    // Full height of sidebar
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

        var navbarHeigh = $('nav.navbar-default').height();
        var wrapperHeigh = $('#page-wrapper').height();

        if(navbarHeigh > wrapperHeigh){
            $('#page-wrapper').css("min-height", navbarHeigh + "px");
        }

        if(navbarHeigh < wrapperHeigh){
            $('#page-wrapper').css("min-height", $(window).height()  + "px");
        }

    }
    fix_height();

    // Fixed Sidebar
    $(window).bind("load", function () {
        if ($("body").hasClass('fixed-sidebar')) {
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }
    })

    // Move right sidebar top after scroll
    $(window).scroll(function(){
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav') ) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    $(document).bind("load resize scroll", function() {
        if(!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    $("[data-toggle=popover]")
        .popover();

    // Add slimscroll to element
    $('.full-height-scroll').slimscroll({
        height: '100%'
    })


    $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?=BASE_URL;?>/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );    
});


// Minimalize menu when screen is less than 768px
$(window).bind("resize", function () {
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }
});

// Local Storage functions
// Set proper body class and plugins based on user configuration
$(document).ready(function() {
    if (localStorageSupport) {

        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        var body = $('body');

        if (fixedsidebar == 'on') {
            body.addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }

        if (collapse == 'on') {
            if(body.hasClass('fixed-sidebar')) {
                if(!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }
            } else {
                if(!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }

            }
        }

        if (fixednavbar == 'on') {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            body.addClass('fixed-nav');
        }

        if (boxedlayout == 'on') {
            body.addClass('boxed-layout');
        }

        if (fixedfooter == 'on') {
            $(".footer").addClass('fixed');
        }
    }
});

// check if browser support HTML5 local storage
function localStorageSupport() {
    return (('localStorage' in window) && window['localStorage'] !== null)
}

// For demo purpose - animation css script
function animationHover(element, animation){
    element = $(element);
    element.hover(
        function() {
            element.addClass('animated ' + animation);
        },
        function(){
            //wait for animation to finish before removing classes
            window.setTimeout( function(){
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

// Dragable panels
function WinMove() {
    var element = "[class*=col]";
    var handle = ".ibox-title";
    var connect = "[class*=col]";
    $(element).sortable(
        {
            handle: handle,
            connectWith: connect,
            tolerance: 'pointer',
            forcePlaceholderSize: true,
            opacity: 0.8
        })
        .disableSelection();
}

function fnClickAdd(destino){
    
    $("form[name=formulario]").attr("action",destino);
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("form[name=formulario]").submit();
 

}

function fnClickEdit(destino,modulo){
    var ischecked=false;
    var iden="";
    var totalCheck=0;
    $("input[name^=seleccionarItem]").each(function(){
        if ($(this).prop("checked"))
        {
            iden=$(this).val();
            ischecked=true;
            totalCheck=totalCheck+1;
        }
    });

    if (totalCheck>1)
    {
        $("div.alerta_editar span#mensaje_editar").html("No puede seleccionar mas de un "+modulo+" para modificar.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
        return false;
    }

    if (!ischecked)
    {
        $("div.alerta_editar span#mensaje_editar").html("Seleccionar "+modulo+" que desea modificar.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
        return false;
    }
    else
    {
        $("form[name=formulario]").attr("action",destino);
        $("form[name=formulario] input[name=identificador]").removeAttr("disabled");
        $("form[name=formulario] input[name=identificador]").val(iden);
        $("form[name=formulario]").submit();
    }


}

function fnClickDelete(modulo){
    var ischecked=false;
    var iden="";
    $("input[name^=seleccionarItem]").each(function(){
        if ($(this).prop("checked"))
        {
            if (iden=="")
                iden+=$(this).val();
            else
                iden+=","+$(this).val();
            ischecked=true;
        }
    });

    if (!ischecked)
    {
        $("div.alerta_editar span#mensaje_editar").html("Seleccionar "+modulo+" que desea eliminar.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
    }
    else
    {
        if (confirm("Seguro desea eliminar el "+modulo+" seleccionado?"))
        {
            $("form[name=formulario]").attr("action","action");
            $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
            $("form[name=formulario] input[name=eliminar]").val(iden);
            $("form[name=formulario]").submit();
        }
    }
}

function onSubmitCliente()
{
    if ($("input[name^=clusuario_id_usuario]").length<=0)
    {
        alert("Asociar por lo menos un usuario al cliente.-");
         return false;
    }

    return true;
}

function onSubmitAsistente()
{
    if ($("input[name^=asevento_id_evento]").length<=0)
    {
        alert("Asociar por lo menos un evento al asistente.-");
         return false;
    }

    return true;
}

function onSubmitAcompaniante()
{
    if ($("input[name^=nombre_acompaniante]").length<=0 ||
        $("input[name^=apellido_acompaniante]").length<=0)
    {
        alert("Asociar por lo menos un evento al asistente.-");
         return false;
    }

    return true;
}

function onSubmitEditPass()
{
    // $('input[name=password_actual]').val()==""
    //     || $('input[name=password]').val()==""
        
    if ($('input[name=password_movil_actual]').val()==""
        || $('input[name=password_movil]').val()=="")
    {
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
        },5000);
         return false;
        
    }
    //     password_old:$('input[name=password_actual]').val(),
    $.post("../ajax/ajax.php",
    {
        funcion:'validar_editar_pass',
        idusuario:$('input[name=id_edit_pass]').val(),
        password_movil_old:$('input[name=password_movil_actual]').val()
    },
    function(data){
        if (data=="1")
        {
            $("form[name=formulario]").submit();
        }
        else
        {
            $("div.alerta_editar span#mensaje_editar").html("Campo password actual que se ingreso no son los correctos");
            $("div.alerta_editar").css("display","block");
            setTimeout(function(){
                 $("div.alerta_editar").css("display","none");
                 return false;
            },5000);
        }
    });


}

function fnCheckPermMenuVer(elemento)
{
    var padre=$(elemento).val();
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckVer]").each(function(){
       if ($(this).attr("data-padre")==padre)
       {
            if (check)
                $(this).prop("checked","checked");
            else
                $(this).removeAttr("checked");
            
       } 
    });
}

function fnCheckPermMenuAgregar(elemento)
{
    var padre=$(elemento).val();
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckAgregar]").each(function(){
       if ($(this).attr("data-padre")==padre)
       {
            if (check)
                $(this).prop("checked","checked");
            else
                $(this).removeAttr("checked");
            
       } 
    });
}

function fnCheckPermMenuModificar(elemento)
{
    var padre=$(elemento).val();
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckModificar]").each(function(){
       if ($(this).attr("data-padre")==padre)
       {
            if (check)
                $(this).prop("checked","checked");
            else
                $(this).removeAttr("checked");
            
       } 
    });
}

function fnCheckPermMenuEliminar(elemento)
{
    var padre=$(elemento).val();
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckEliminar]").each(function(){
       if ($(this).attr("data-padre")==padre)
       {
            if (check)
                $(this).prop("checked","checked");
            else
                $(this).removeAttr("checked");
            
       } 
    });
}

function fnCheckPermSubMenuVer(elemento)
{
    var padre=$(elemento).attr("data-padre");
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckVer]").each(function(){
       if ($(this).val()==padre)
       {
            if (check)
                $(this).prop("checked","checked");
       } 
    });
}

function fnCheckPermSubMenuAgregar(elemento)
{
    var padre=$(elemento).attr("data-padre");
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckAgregar]").each(function(){
       if ($(this).val()==padre)
       {
            if (check)
                $(this).prop("checked","checked");
       } 
    });
}

function fnCheckPermSubMenuModificar(elemento)
{
    var padre=$(elemento).attr("data-padre");
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckModificar]").each(function(){
       if ($(this).val()==padre)
       {
            if (check)
                $(this).prop("checked","checked");
       } 
    });
}

function fnCheckPermSubMenuEliminar(elemento)
{
    var padre=$(elemento).attr("data-padre");
    var check=$(elemento).prop("checked");

    $("input[name^=menusCheckEliminar]").each(function(){
       if ($(this).val()==padre)
       {
            if (check)
                $(this).prop("checked","checked");
       } 
    });
}

function linkPage(pagina,elemento)
{
    $(pagina).val($(elemento).attr("data-page")-1);
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("input#searchText").val());
    $("form[name=formulario]").submit();
}

function linkPrevPage(pagina)
{
    $(pagina).val(parseInt($(pagina).val())-1);
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("input#searchText").val());
    $("form[name=formulario]").submit();
}

function linkNextPage(pagina)
{
    $(pagina).val(parseInt($(pagina).val())+1);
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("input#searchText").val());
    $("form[name=formulario]").submit();
}

function tabChange(valor)
{
     $("input[name=tab]").val(valor);
   
}

function searchClientes()
{
    $("input[name=pagina]").val("0");
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("input#searchText").val());
    $("form[name=formulario]").submit();
}

function searchActividad()
{
    $("input[name=pagina]").val("0");
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("input#searchText").val());
    $("form[name=formulario]").submit();
}

function buscarCliente(elemento)
{
    $.post("../ajax/ajax.php",
    {
        funcion:'datos_de_cliente',
        idcliente:$(elemento).attr('data-id')
    },
    function(data){
        //console.log(data);
        $("span#datos_nombre").html(data.nombre);
        var htmlImg="";
        if (data.imagen!="")
            htmlImg+='<img alt="image" class="img-circle" src="'+data.imagen+'" style="width: 62px">';
        else
            htmlImg+='<i class="fa fa-camera"></i>';
        $("div#datos_imagen").html(htmlImg);

        var htmlEstado="";
        if (data.estado!="")
        {
            if (data.estado=="ACTIVO")
                htmlEstado+='<span class="label label-primary">'+data.estado+'</span>';
            else if (data.estado=="INACTIVO")
                htmlEstado+='<span class="label label-warning">'+data.estado+'</span>';
            else if (data.estado=="ELIMINADO")
                htmlEstado+='<span class="label label-danger">'+data.estado+'</span>';
            else if (data.estado=="POTENCIAL")
                htmlEstado+='<span class="label label-info">'+data.estado+'</span>';
                  
        }
        $("div#datos_estado").html(htmlEstado);

        $("span#datos_direccion").html(data.direccion);
        $("span#datos_localidad").html(data.ciudad+' '+data.departamento+' '+data.pais);
        $("span#datos_ccnit").html(data.ccnit);
        $("span#datos_telefono").html(data.telefono);
        $("span#datos_celular").html(data.celular);
        $("span#datos_email").html(data.email);
        $("span#datos_sector").html(data.sector);
        $("span#datos_razon_social").html(data.razon_social);
        $("span#datos_usuario").html(data.usuario);
        $("span#datos_sitioweb").html(data.sitio_web);
        $("span#datos_latitud").html(data.latitud);
        $("span#datos_longitud").html(data.longitud);
        $("span#datos_orden_visita").html(data.orden_visita);
        $("span#datos_firma").html(data.firma);
        $("span#datos_cupo").html(data.cupo);
        $("span#datos_contacto").html(data.contacto);
        $("span#datos_cargo_contacto").html(data.cargo_contacto);
        $("span#datos_tipo_cliente").html(data.tipo_cliente);
        
        
    },"json");
}

function ajaxNivel1_Nivel2(elemento_destino,nivel1){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 

    $.post("../ajax/ajax.php",
    {
        funcion:'nivel1_nivel2',
        nivel1:nivel1
    },
    function(json){
          $(elemento_destino).html("");
          var html="<option value=''></option>";
          $.each(json, function(i, value) {
              if ($(elemento_destino).next().val()==value.id)
                html+="<option selected value='"+value.id+"'>"+value.descripcion+"</option>";
              else
                html+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
              
          });
                    
          $(elemento_destino).html(html);
          $(elemento_destino).trigger("change");
          setTimeout($.unblockUI, 200);
    },"json");
}

function ajaxNivel2_Nivel3(elemento_destino,nivel2){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 

    $.post("../ajax/ajax.php",
    {
        funcion:'nivel2_nivel3',
        nivel2:nivel2
    },
    function(json){
          $(elemento_destino).html("");
          var html="<option value=''></option>";
          $.each(json, function(i, value) {
              if ($(elemento_destino).next().val()==value.id)
                html+="<option selected value='"+value.id+"'>"+value.descripcion+"</option>";
              else
                html+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
              
          });
                    
          $(elemento_destino).html(html);
          $(elemento_destino).trigger("change");
          setTimeout($.unblockUI, 200);
    },"json");
}

function ajaxUsuario_Cliente(elemento_destino,usuario){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 

    $.post("../ajax/ajax.php",
    {
        funcion:'usuario_cliente',
        usuario:usuario
    },
    function(json){
          $(elemento_destino).html("");
          var html="<option value=''></option>";
          $.each(json, function(i, value) {
              if ($(elemento_destino).next().val()==value.cnta_numero)
                html+="<option selected value='"+value.cnta_numero+"'>"+value.nombre+"</option>";
              else
                html+="<option value='"+value.cnta_numero+"'>"+value.nombre+"</option>";
              
          });
                    
          $(elemento_destino).html(html);
          $(elemento_destino).trigger("change");
          setTimeout($.unblockUI, 200);
    },"json");
}
function ajaxPais_Departamento(elemento_destino,pais){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 

    $.post("../ajax/ajax.php",
    {
        funcion:'pais_departamento',
        pais:pais
    },
    function(json){
          $(elemento_destino).html("");
          var html="<option value=''></option>";
          $.each(json, function(i, value) {
              if ($(elemento_destino).next().val()==value.departamento)
                html+="<option selected value='"+value.departamento+"'>"+value.nombre+"</option>";
              else
                html+="<option value='"+value.departamento+"'>"+value.nombre+"</option>";
              
          });
                    
          $(elemento_destino).html(html);
          $(elemento_destino).trigger("change");
          setTimeout($.unblockUI, 200);
    },"json");
}

function ajaxDepartamento_Ciudad(elemento_destino,departamento){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'departamento_ciudad',
        departamento:departamento
    },
    function(json){
          $(elemento_destino).html("");
          var html="<option value=''></option>";
          $.each(json, function(i, value) {
              if ($(elemento_destino).next().val()==value.ciudad)
                html+="<option selected value='"+value.ciudad+"'>"+value.nombre+"</option>";
              else
                html+="<option value='"+value.ciudad+"'>"+value.nombre+"</option>";
              
          });
                    
          $(elemento_destino).html(html);
          setTimeout($.unblockUI, 200);
          
    },"json");
}

function ajaxInitActividades(){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'actividades',
        empresa:$("input[name=empresanumero]").val(),
        usuario:$("input[name=usuarionumero]").val()
    },
    function(json){
              /* initialize the calendar
             -----------------------------------------------------------------*/
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                timeFormat: 'H(:mm)',
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {today : 'Hoy',
                             month: 'mes',
                             week: 'semana',
                             day: 'dia'
                             },
                allDayText:'Todo el dia',
                monthNamesShort : ['Ene' , 'Feb' , 'Mar' , 'Abr' , 'May' , 'Jun' , 'Jul' ,
                        'Ago' , 'Sep' , 'Oct' , 'Nov' , 'Dic' ],
                monthNames : ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                        'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
                dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                dayNames : ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                droppable: true, 
                drop: function() {
                    if ($('#drop-remove').is(':checked')) {
                        $(this).remove();
                    }
                 },
                eventReceive: function(calEvent, dayDelta, revertFunc){
                    if ($("input[name=permParaAgregar]").val()=="1")
                    {
                    if (confirm("Seguro desea realizar el cambio y guardar la actividad?")) 
                    {
                        recargarModal(calEvent);
                        var tipo="_llamada";
                        if (calEvent.tipact_numero==1)//CITA
                        { 
                            tipo="_cita";
                        }
                        else if (calEvent.tipact_numero==2)//MAIL
                        {
                            tipo="_mail";
                        
                        }
                        else if (calEvent.tipact_numero==3)//LLAMADA
                        {
                            tipo="_llamada";
                        }

                            var idactividad=$("#idactividad"+tipo).val();
                            var tipact_numero=$("#tipactividadSave"+tipo).val();
                            var fecha_hora_apertura=$("#startTime"+tipo).val();
                            var fecha_hora_fin=$("#endTime"+tipo).val();
                            var asunto=$("#asunto"+tipo).val();
                            var cnta_numero=$("#cnta_numero"+tipo).val();
                            var descripcion=$("#descripcion"+tipo).val();
                            if (calEvent.tipact_numero==1)//CITA
                            {
                                var observaciones=$("#observaciones"+tipo).val();
                                var direccion=$("#direccion"+tipo).val();
                                var nivel1_actividad=$("#nivel1_actividad"+tipo).val();
                                var nivel2_actividad=$("#nivel2_actividad"+tipo).val();
                                var nivel3_actividad=$("#nivel3_actividad"+tipo).val();
                            }
                            else
                            {
                                var observaciones='';
                                var direccion='';
                                var nivel1_actividad='0';
                                var nivel2_actividad='0';
                                var nivel3_actividad='0';
                            }
                            
                            if (fecha_hora_fin=="Invalid date")
                            {
                               fecha_hora_fin=fecha_hora_apertura;
                            }

                            $.blockUI({ 
                                      message: 'Cargando...',
                                      css: { border: 'none',
                                              padding: '10px', 
                                              backgroundColor: '#000', 
                                              '-webkit-border-radius': '10px', 
                                              '-moz-border-radius': '10px', 
                                              opacity: .5, 
                                              color: '#fff',
                                              'font-size': '12px' } 
                                    }); 
                            $.post("../ajax/ajax.php",
                            {
                                funcion:'modificarActividad',
                                idactividad:idactividad,
                                tipact_numero:tipact_numero,
                                fecha_hora_apertura:fecha_hora_apertura,
                                fecha_hora_fin:fecha_hora_fin,
                                empresa_numero:$("input[name=empresanumero]").val(),
                                usuario_numero:$("input[name=usuarionumero]").val(),
                                cnta_numero:cnta_numero,
                                descripcion:descripcion,
                                observaciones:observaciones,
                                nivel1_actividad:nivel1_actividad,
                                nivel2_actividad:nivel2_actividad,
                                nivel3_actividad:nivel3_actividad,
                                direccion:direccion,
                                asunto:asunto
                            },
                            function(data){
                                $.each(data, function(i, value) {
                                    console.log(value.idactividad);
                                    calEvent.id=value.idactividad;

                                });
                                ajaxActividades();
           
                                setTimeout($.unblockUI, 200);
                                  
                            },"json");
                    }
                    }
                      else
                    {
                        alert("No tiene permisos para agregar nueva actividad.-");
                        revertFunc();
                    }
                  
                },
                eventDrop: function(calEvent, dayDelta, revertFunc){
                        if ($("input[name=permParaModificar]").val()=="1")
                      {
                      
                      if (!confirm("Seguro desea realizar el cambio y guardar la actividad?")) {
                        revertFunc();
                      }
                      else
                      {
                        
                        recargarModal(calEvent);
                        
                        var tipo="_llamada";
                        if (calEvent.tipact_numero==1)//CITA
                        { 
                            tipo="_cita";
                        }
                        else if (calEvent.tipact_numero==2)//MAIL
                        {
                            tipo="_mail";
                        
                        }
                        else if (calEvent.tipact_numero==3)//LLAMADA
                        {
                            tipo="_llamada";
                        }

                            var idactividad=$("#idactividad"+tipo).val();
                            var tipact_numero=$("#tipactividadSave"+tipo).val();
                            var fecha_hora_apertura=$("#startTime"+tipo).val();
                            var fecha_hora_fin=$("#endTime"+tipo).val();
                            var asunto=$("#asunto"+tipo).val();
                            var cnta_numero=$("#cnta_numero"+tipo).val();
                            var descripcion=$("#descripcion"+tipo).val();
                            if (calEvent.tipact_numero==1)//CITA
                            {
                                var observaciones=$("#observaciones"+tipo).val();
                                var direccion=$("#direccion"+tipo).val();
                                var nivel1_actividad=$("#nivel1_actividad"+tipo).val();
                                var nivel2_actividad=$("#nivel2_actividad"+tipo).val();
                                var nivel3_actividad=$("#nivel3_actividad"+tipo).val();
                            }
                            else
                            {
                                var observaciones='';
                                var direccion='';
                                var nivel1_actividad='0';
                                var nivel2_actividad='0';
                                var nivel3_actividad='0';
                            }
                            
                            if (fecha_hora_fin=="Invalid date")
                            {
                               fecha_hora_fin=fecha_hora_apertura;
                            }

                            $.blockUI({ 
                                      message: 'Cargando...',
                                      css: { border: 'none',
                                              padding: '10px', 
                                              backgroundColor: '#000', 
                                              '-webkit-border-radius': '10px', 
                                              '-moz-border-radius': '10px', 
                                              opacity: .5, 
                                              color: '#fff',
                                              'font-size': '12px' } 
                                    }); 
                            $.post("../ajax/ajax.php",
                            {
                                funcion:'modificarActividad',
                                idactividad:idactividad,
                                tipact_numero:tipact_numero,
                                fecha_hora_apertura:fecha_hora_apertura,
                                fecha_hora_fin:fecha_hora_fin,
                                empresa_numero:$("input[name=empresanumero]").val(),
                                usuario_numero:$("input[name=usuarionumero]").val(),
                                cnta_numero:cnta_numero,
                                descripcion:descripcion,
                                observaciones:observaciones,
                                nivel1_actividad:nivel1_actividad,
                                nivel2_actividad:nivel2_actividad,
                                nivel3_actividad:nivel3_actividad,
                                direccion:direccion,
                                asunto:asunto
                            },
                            function(data){
                                $.each(data, function(i, value) {
                                    console.log(value.idactividad);
                                    calEvent.id=value.idactividad;
                                });
                                ajaxActividades();
           
                                setTimeout($.unblockUI, 200);
                                  
                            },"json");
                      }
                      }
                        else
                        {
                            alert("No tiene permisos para modificar la actividad.-");
                            revertFunc();
                        }
                  
                  },
         
                  eventResize: function(calEvent, dayDelta, revertFunc){
                      if ($("input[name=permParaModificar]").val()=="1")
                      {
                      if (!confirm("Seguro desea realizar el cambio y guardar la actividad?")) {
                         revertFunc();
                      }
                      else
                      {
                        
                        recargarModal(calEvent);
                        
                        var tipo="_llamada";
                        if (calEvent.tipact_numero==1)//CITA
                        { 
                            tipo="_cita";
                        }
                        else if (calEvent.tipact_numero==2)//MAIL
                        {
                            tipo="_mail";
                        
                        }
                        else if (calEvent.tipact_numero==3)//LLAMADA
                        {
                            tipo="_llamada";
                        }

                            var idactividad=$("#idactividad"+tipo).val();
                            var tipact_numero=$("#tipactividadSave"+tipo).val();
                            var fecha_hora_apertura=$("#startTime"+tipo).val();
                            var fecha_hora_fin=$("#endTime"+tipo).val();
                            var asunto=$("#asunto"+tipo).val();
                            var cnta_numero=$("#cnta_numero"+tipo).val();
                            var descripcion=$("#descripcion"+tipo).val();
                            if (calEvent.tipact_numero==1)//CITA
                            {
                                var observaciones=$("#observaciones"+tipo).val();
                                var direccion=$("#direccion"+tipo).val();
                                var nivel1_actividad=$("#nivel1_actividad"+tipo).val();
                                var nivel2_actividad=$("#nivel2_actividad"+tipo).val();
                                var nivel3_actividad=$("#nivel3_actividad"+tipo).val();
                            }
                            else
                            {
                                var observaciones='';
                                var direccion='';
                                var nivel1_actividad='0';
                                var nivel2_actividad='0';
                                var nivel3_actividad='0';
                            }
                            
                            if (fecha_hora_fin=="Invalid date")
                            {
                               fecha_hora_fin=fecha_hora_apertura;
                            }

                            $.blockUI({ 
                                      message: 'Cargando...',
                                      css: { border: 'none',
                                              padding: '10px', 
                                              backgroundColor: '#000', 
                                              '-webkit-border-radius': '10px', 
                                              '-moz-border-radius': '10px', 
                                              opacity: .5, 
                                              color: '#fff',
                                              'font-size': '12px' } 
                                    }); 
                            $.post("../ajax/ajax.php",
                            {
                                funcion:'modificarActividad',
                                idactividad:idactividad,
                                tipact_numero:tipact_numero,
                                fecha_hora_apertura:fecha_hora_apertura,
                                fecha_hora_fin:fecha_hora_fin,
                                empresa_numero:$("input[name=empresanumero]").val(),
                                usuario_numero:$("input[name=usuarionumero]").val(),
                                cnta_numero:cnta_numero,
                                descripcion:descripcion,
                                observaciones:observaciones,
                                nivel1_actividad:nivel1_actividad,
                                nivel2_actividad:nivel2_actividad,
                                nivel3_actividad:nivel3_actividad,
                                direccion:direccion,
                                asunto:asunto
                            },
                            function(data){
                                
                                $.each(data, function(i, value) {
                                    console.log(value.idactividad);
                                    calEvent.id=value.idactividad;
                                });

                                ajaxActividades();
                                setTimeout($.unblockUI, 200);
                                  
                            },"json");
                      }
                    }
                    else
                    {
                        alert("No tiene permisos para modificar la actividad.-");
                        revertFunc();
                    }
                  },   

                 eventClick: function(calEvent, jsEvent, view) {
                        
                        recargarModal(calEvent);
                        $("#eventContent").modal('toggle');
                },   
                
            });

          setTimeout($.unblockUI, 200);
          
    },"json");



}

function ajaxActividadesEstado(usuario_numero,estado,filtro_cliente,filtro_fecha_desde,filtro_fecha_hasta){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'actividadesEstado',
        estado:estado,
        usuario:usuario_numero,
        filtro_cliente:filtro_cliente,
        filtro_fecha_desde:filtro_fecha_desde,
        filtro_fecha_hasta:filtro_fecha_hasta
    },
    function(json){
            
        $("div#resultado_actividades").html(json.table);
        $('#eventContent').modal('toggle');
        setTimeout($.unblockUI, 200);
            $('.dataTables-example2').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?=BASE_URL;?>/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

    },"json");
}

function ajaxActividades(){
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'actividades',
        empresa:$("input[name=empresanumero]").val(),
        usuario:$("input[name=usuarionumero]").val()
    },
    function(json){
            
            $("#calendar").fullCalendar('removeEvents');
   
            $('#calendar').fullCalendar(
                'addEventSource',json
            );

          setTimeout($.unblockUI, 200);
          
    },"json");
}

function ajaxTreeUsuarios()
{
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'usuariosAgenda',
        empresa:$("input[name=empresanumero]").val(),
        usuario:$("input[name=usuarionumero]").val()
    },
    function(json){

    $('#jstree1').on('changed.jstree', function (e, data) {
            var i, j, r=[],q = [];
            for(i = 0, j = data.selected.length; i < j; i++) {
              r.push(data.instance.get_node(data.selected[i]).a_attr.usuario_numero);
              q.push(data.instance.get_node(data.selected[i]).text);
            }
            $("input[name=usuarionumero]").val(r.join(', '));
            $("#usuarioselected").html(q.join(', '));
            ajaxActividades();
            ajaxClientesActividades();
          });

     $('#jstree1').jstree({ 'core' : json});

    setTimeout($.unblockUI, 200);
          
    },"json");
}

function ajaxClientesActividades()
{
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../ajax/ajax.php",
    {
        funcion:'clientesAgenda',
        empresa:$("input[name=empresanumero]").val(),
        usuario:$("input[name=usuarionumero]").val()
    },
    function(json){

         $("#external-events-llamada").html("");
         $("#external-events-mail").html("");
         $("#external-events-cita").html("");
          var html="";
          $.each(json, function(i, value) {
               html+="<div class='external-event navy-bg' data-nit='"+value.ccnit+"' data-cliente='"+value.text+"' data-cnta='"+value.cnta_numero+"' data-direccion='"+value.direccion+"'>"+value.ccnit+" "+value.text+"</div>";
              
          });
                    
        $("#external-events-llamada").html(html);
        $("#external-events-mail").html(html);
        $("#external-events-cita").html(html);
        habilitaDraggable();
        setTimeout($.unblockUI, 200);
          
    },"json");
}

function ajaxClientesVisor()
{
    if ($("select[name=usuario_numero]").val()!="")
    {
    $.blockUI({ 
              message: 'Cargando...',
              css: { border: 'none',
                      padding: '10px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '10px', 
                      '-moz-border-radius': '10px', 
                      opacity: .5, 
                      color: '#fff',
                      'font-size': '12px' } 
            }); 
    $.post("../../ajax/ajax.php",
    {
        funcion:'clientesVisor',
        usuario:$("select[name=usuario_numero]").val()
    },
    function(json){

         $("select[name=cnta_numero]").html("");
          var html="<option value=''>Seleccione</option>";
          $.each(json, function(i, value) {
               if (value.value==$("input[name=value_cnta_numero]").val())
                html+="<option value='"+value.value+"' selected>"+value.text+"</option>";
               else
                html+="<option value='"+value.value+"'>"+value.text+"</option>";
              
          });
                    
        $("select[name=cnta_numero]").html(html);
        setTimeout($.unblockUI, 200);
          
    },"json");
    }
}

function habilitaDraggable()
{
    $('#external-events-llamada div.external-event').each(function() {
            var cnta=$(this).attr('data-cnta');
            var cliente= $(this).attr('data-cliente');
            var direccion= $(this).attr('data-direccion');
            //console.log(res);
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), 
                cnta_numero: cnta, 
                color: '#42b2b6',
                description: 'llamada',
                tipact_numero:3,
                start:'T10:00:00',
                duration:'01:00',
                cliente:cliente,
                direccion:direccion,
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });

    $('#external-events-mail div.external-event').each(function() {
            var cnta=$(this).attr('data-cnta');
            var cliente= $(this).attr('data-cliente');
            var direccion= $(this).attr('data-direccion');
           //console.log(res);
            
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), 
                cnta_numero: cnta, 
                color: '#42b2b6',
                description: 'mail',
                tipact_numero:2,
                start:'T10:00:00',
                duration:'01:00',
                cliente:cliente,
                direccion:direccion,
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });

    $('#external-events-cita div.external-event').each(function() {
            var cnta=$(this).attr('data-cnta');
            var cliente= $(this).attr('data-cliente');
            var direccion= $(this).attr('data-direccion');
           
            
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), 
                cnta_numero: cnta, 
                color: '#42b2b6',
                description: 'cita',
                tipact_numero:1,
                start:'T10:00:00',
                duration:'01:00',
                cliente:cliente,
                direccion:direccion,
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
}

function ajaxGuardar_Actividad(){
    
    var tipo="_llamada";
    if ($("#tipact").val()==1)//CITA
    { 
        tipo="_cita";
    }
    else if ($("#tipact").val()==2)//MAIL
    {
        tipo="_mail";

    }
    else if ($("#tipact").val()==3)//LLAMADA
    {
        tipo="_llamada";
    }

    var idactividad=$("#idactividad"+tipo).val();
    var tipact_numero=$("#tipactividadSave"+tipo).val();
    var fecha_hora_apertura=$("#startTime"+tipo).val();
    var fecha_hora_fin=$("#endTime"+tipo).val();
    var asunto=$("#asunto"+tipo).val();
    var cnta_numero=$("#cnta_numero"+tipo).val();
    var descripcion=$("#descripcion"+tipo).val();
    if ($("#tipact").val()==1)//CITA
    {
        var observaciones=$("#observaciones"+tipo).val();
        var direccion=$("#direccion"+tipo).val();
        var nivel1_actividad=$("#nivel1_actividad"+tipo).val();
        var nivel2_actividad=$("#nivel2_actividad"+tipo).val();
        var nivel3_actividad=$("#nivel3_actividad"+tipo).val();
    }
    else
    {
        var observaciones='';
        var direccion='';
        var nivel1_actividad='0';
        var nivel2_actividad='0';
        var nivel3_actividad='0';
    }
    
    if (fecha_hora_fin=="Invalid date")
    {
       fecha_hora_fin=fecha_hora_apertura;
    }


    if (idactividad!="")
    {
        $("#eventContent").modal('toggle');
           
        $.blockUI({ 
                  message: 'Cargando...',
                  css: { border: 'none',
                          padding: '10px', 
                          backgroundColor: '#000', 
                          '-webkit-border-radius': '10px', 
                          '-moz-border-radius': '10px', 
                          opacity: .5, 
                          color: '#fff',
                          'font-size': '12px' } 
                }); 
        $.post("../ajax/ajax.php",
        {
            funcion:'modificarActividad',
            idactividad:idactividad,
            tipact_numero:tipact_numero,
            fecha_hora_apertura:fecha_hora_apertura,
            fecha_hora_fin:fecha_hora_fin,
            empresa_numero:$("input[name=empresanumero]").val(),
            usuario_numero:$("input[name=usuarionumero]").val(),
            cnta_numero:cnta_numero,
            descripcion:descripcion,
            observaciones:observaciones,
            nivel1_actividad:nivel1_actividad,
            nivel2_actividad:nivel2_actividad,
            nivel3_actividad:nivel3_actividad,
            direccion:direccion,
            asunto:asunto
        },
        function(data){
            ajaxActividades();
            setTimeout($.unblockUI, 200);
              
        },"json");
    }
    else
    {
        $("#eventContent").modal('toggle');
           
    }
}

function recargarModal(calEvent)
{
    $("#tipact").val(calEvent.tipact_numero);
    if (calEvent.tipact_numero==1)//CITA
    {   
        $("#a-tab-llamada").css("display","none");
        $("#a-tab-mail").css("display","none");
        $("#a-tab-cita").css("display","block");
        $("#a-tab-cita").trigger("click");
        $("#startTime_cita").val(moment(calEvent.start).format('YYYY-MM-DD HH:mm'));
        $("#endTime_cita").val(moment(calEvent.end).format('YYYY-MM-DD HH:mm'));
        $("#asunto_cita").val(calEvent.description);
        $("#idactividad_cita").val(calEvent.id);
        $("#cnta_numero_cita").val(calEvent.cnta_numero);
        $("#cliente_cita").val(calEvent.cliente);
        $("#direccion_cita").val(calEvent.direccion);
        $("#descripcion_cita").val(calEvent.detalle);
        $("#observaciones_cita").val(calEvent.observaciones);
        
    }
    else if (calEvent.tipact_numero==2)//MAIL
    {
        $("#a-tab-llamada").css("display","none");
        $("#a-tab-cita").css("display","none");
        $("#a-tab-mail").css("display","block");
        $("#a-tab-mail").trigger("click");
        $("#startTime_mail").val(moment(calEvent.start).format('YYYY-MM-DD HH:mm'));
        $("#endTime_mail").val(moment(calEvent.end).format('YYYY-MM-DD HH:mm'));
        $("#asunto_mail").val(calEvent.description);
        $("#idactividad_mail").val(calEvent.id);
        $("#cnta_numero_mail").val(calEvent.cnta_numero);
        $("#cliente_mail").val(calEvent.cliente);
        $("#descripcion_mail").val(calEvent.detalle);
    
    }
    else if (calEvent.tipact_numero==3)//LLAMADA
    {
        $("#a-tab-cita").css("display","none");
        $("#a-tab-mail").css("display","none");
        $("#a-tab-llamada").css("display","block");
        $("#a-tab-llamada").trigger("click");
        $("#startTime_llamada").val(moment(calEvent.start).format('YYYY-MM-DD HH:mm'));
        $("#endTime_llamada").val(moment(calEvent.end).format('YYYY-MM-DD HH:mm'));
        $("#asunto_llamada").val(calEvent.description);
        $("#idactividad_llamada").val(calEvent.id);
        $("#cnta_numero_llamada").val(calEvent.cnta_numero);
        $("#cliente_llamada").val(calEvent.cliente);
        $("#descripcion_llamada").val(calEvent.detalle);
    
    }

}

function SetNameFileClientes() {
    var file = $("input[name=imagen]").val();
    var position = file.lastIndexOf("\\");
    var name_file = file.substring(position + 1);

    $("#nombre_archivo").val(name_file);
}

function SelectImageClientes() {
    $("input[name=imagen]").click();
}

function searchVisorActividad()
{
    var estados="";
    
    $("input[name^=seleccionarItem]:checked").each(function(){
        
        if (estados=="")
            estados+=$(this).val();
        else
            estados+=","+$(this).val();
    }); 

    if (estados=="")
    {
        alert("Seleccionar Estado de Actividad");
        return false;
    }
    //console.log(estados);
    //return false;
    $("form[name=formularioExport] input[name=estado]").val(estados);
    $("form[name=formularioExport] input[name=usuario]").val($("select[name=usuario_numero]").val());
    $("form[name=formularioExport] input[name=filtro_cliente]").val($("select[name=cnta_numero]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_desde]").val($("input[name=filtro_fecha_desdeSearch]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_hasta]").val($("input[name=filtro_fecha_hastaSearch]").val());
    $("form[name=formularioExport]").submit();

}

function exportarXLS_GestionDiaria()
{
    $("form[name=formularioExport]").attr("action","../export_to_excel/actividadesEstado.php");
        
    $("form[name=formularioExport]").attr("target","_blank");
    $("form[name=formularioExport] input[name=estado]").val($("input[name=estadoSearch]").val());
    $("form[name=formularioExport] input[name=usuario]").val($("input[name=usuarioSearch]").val());
    $("form[name=formularioExport] input[name=filtro_cliente]").val($("input[name=filtro_clienteSearch]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_desde]").val($("input[name=filtro_fecha_desdeSearch]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_hasta]").val($("input[name=filtro_fecha_hastaSearch]").val());
    $("form[name=formularioExport]").submit();
}

function verMapa_GestionDiaria(usuario)
{
    $("form[name=formularioExport]").attr("action","geolocalizador/");
        
    //$("form[name=formularioExport]").attr("target","_blank");
    var estados="programadas,pendientes,realizadas,canceladas,efectivas,por_validar";
    $("form[name=formularioExport] input[name=estado]").val(estados);
    $("form[name=formularioExport] input[name=usuario]").val(usuario);
    $("form[name=formularioExport] input[name=filtro_cliente]").val($("input[name=filtro_cliente_search]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_desde]").val($("input[name=filtro_fecha_desde_search]").val());
    $("form[name=formularioExport] input[name=filtro_fecha_hasta]").val($("input[name=filtro_fecha_hasta_search]").val());
    $("form[name=formularioExport]").submit();
}

function exportarXLS(modulo)
{
    var identificadores="";
    $('input[name^=seleccionarItem]').each(function(){
        if ($(this).prop('checked'))
        {
          if (identificadores=="")
            identificadores+=$(this).val();
          else
            identificadores+=","+$(this).val();
            
        }
      });
    if (modulo=="actividades")
        $("form[name=formularioExport]").attr("action","../../export_to_excel/"+modulo+".php");
    else
        $("form[name=formularioExport]").attr("action","../export_to_excel/"+modulo+".php");
        
    $("form[name=formularioExport]").attr("target","_blank");
    $("form[name=formularioExport] input[name=identificadores]").val(identificadores);

    if (modulo=="usuarios" || modulo=="tipo_clientes")
        $("form[name=formularioExport] input[name=busqueda]").val($("input[type=search]").val());
    else
        $("form[name=formularioExport] input[name=busqueda]").val($("input#searchText").val());
    
    $("form[name=formularioExport]").submit();
}

function exportarPDF(modulo)
{
    var ischecked=false;
    var identificadores="";
    $('input[name^=seleccionarItem]').each(function(){
        if ($(this).prop('checked'))
        {
          ischecked=true;
          
          if (identificadores=="")
            identificadores+=$(this).val();
          else
            identificadores+=","+$(this).val();
            
        }
      });

    

    if (!ischecked)
    {
        $("div.alerta_editar span#mensaje_editar").html("Seleccionar "+modulo+" que desea exportar a PDF.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
        return false;
    }
    else
    {
        if (modulo=="actividades")
            $("form[name=formularioExport]").attr("action","../../export_to_pdf/"+modulo+".php");
        else
            $("form[name=formularioExport]").attr("action","../export_to_pdf/"+modulo+".php");
            
        $("form[name=formularioExport]").attr("target","_blank");

        $("form[name=formularioExport] input[name=identificadores]").val(identificadores);

        if (modulo=="usuarios" || modulo=="tipo_clientes")
            $("form[name=formularioExport] input[name=busqueda]").val($("input[type=search]").val());
        else
            $("form[name=formularioExport] input[name=busqueda]").val($("input#searchText").val());
        
        $("form[name=formularioExport]").submit();
    }
}

function fnAsociarEventos()
{
    var ischecked=false;
    var identificadores="";
    $('input[name^=seleccionarItem]').each(function(){
        if ($(this).prop('checked'))
        {
          ischecked=true;
          
          if (identificadores=="")
            identificadores+=$(this).val();
          else
            identificadores+=","+$(this).val();
            
        }
      });

    

    if (!ischecked)
    {
        $("div.alerta_editar span#mensaje_editar").html("Seleccionar asistentes que desea Asociar Eventos.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
        return false;
    }
    else
    {
        $.post("../ajax/ajax.php",
        {
            funcion:'buscar_asistentes_asociar',
            identificadores:identificadores
        },
        function(json){
            var rta=false;
            console.log(json);
            var html="";
            $("tbody#list-asistentes").html('');
            $.each(json, function(i, value) {

                html="";
                rta=true;
                    html+="<tr>";
                    html+="<td>";
                    html+="<span>"+value.asistente+"</span>";
                    html+="</td>";
                    html+="<td>";
                    html+="<span>"+value.evento+"</span>";
                    html+="</td>";
                    html+="<td>";
                    html+="<input name='codigos[]' type='width:50px' type='text' value='"+value.codigo+"'/>";
                    html+="</td>";
                    html+="</tr>";
    
                $("tbody#list-asistentes").append(html); 
              
            });

            if (rta)
            {
                $("input[name=asistentes_asociar]").val(identificadores);
                $("#eventContent").modal('toggle');
            }   
        },"json");
        
    }
}

function fnAgregarAcompaniante(){
    $("#eventContent").modal('toggle');

}

function fnAsociarUsuarios()
{
    var ischecked=false;
    var identificadores="";
    $('input[name^=seleccionarItem]').each(function(){
        if ($(this).prop('checked'))
        {
          ischecked=true;
          
          if (identificadores=="")
            identificadores+=$(this).val();
          else
            identificadores+=","+$(this).val();
            
        }
      });

    

    if (!ischecked)
    {
        $("div.alerta_editar span#mensaje_editar").html("Seleccionar Clientes que desea Asociar Usuarios.");
        $("div.alerta_editar").css("display","block");
        setTimeout(function(){
             $("div.alerta_editar").css("display","none");
             return false;
        },5000);
        return false;
    }
    else
    {
        $.post("../ajax/ajax.php",
        {
            funcion:'buscar_clientes_asociar',
            identificadores:identificadores
        },
        function(json){
            var rta=false;
            var html="";
            $("tbody#list-clcliente").html('');
            $.each(json, function(i, value) {
                html="";
                rta=true;
                    html+="<tr>";
                    html+="<td>";
                    html+="<span>"+value.cliente+"</span>";
                    html+="</td>";
                    html+="<td>";
                    html+="<span>"+value.usuario+"</span>";
                    html+="</td>";
                    html+="</tr>";
    
                $("tbody#list-clcliente").append(html); 
              
            });

            if (rta)
            {
                $("input[name=clientes_asociar]").val(identificadores);
                $("#eventContent").modal('toggle');
            }   
        },"json");
        
    }
}

function fnGeolocalizacion(destino)
{
    var identificadores="";
    $('input[name^=seleccionarItem]').each(function(){
        if ($(this).prop('checked'))
        {
          if (identificadores=="")
            identificadores+=$(this).val();
          else
            identificadores+=","+$(this).val();
            
        }
      });

    $("form[name=formularioExport]").attr("action",destino);
        
    $("form[name=formularioExport] input[name=identificadores]").val(identificadores);
    $("form[name=formularioExport] input[name=busqueda]").val($("input#searchText").val());
    $("form[name=formularioExport]").submit();
}

function fnClickAddClusuario()
{
    var html="";
    var existe=false;
    $("input[name^=clusuario_id_usuario]").each(function(){
        if ($(this).val()==$("select[name=usuario_numero]").val())
        {
            existe=true;
        }
    });

    if (existe)
    {
       alert("El usuario que intenta agregar ya se encuentra cargado.-");
       return false;      
    }

    html+="<tr>";
    html+="<td>";
    html+="<span>"+$("select[name=usuario_numero] option:selected").html()+"</span>";
    html+="</td>";
    html+="<td>";
    html+="<input type='hidden' name='clusuario_id_usuario[]' value='"+$("select[name=usuario_numero]").val()+"'>";
    html+=" <a onclick='fnClickDelClusuario($(this));' href='javascript:void(0);'  class='btn btn-primary '><i class='fa fa-minus-square'></i></a>";
    html+="</td>";
    html+="</tr>";
    
    $("tbody#list-clusuario").append(html);   
}

function fnClickAddAsisEvent()
{
    var html="";
    var existe=false;
    $("input[name^=asevento_id_evento]").each(function(){
        if ($(this).val()==$("select[name=id_evento]").val())
        {
            existe=true;
        }
    });

    if (existe)
    {
       alert("El evento que intenta agregar ya se encuentra cargado.-");
       return false;      
    }

    html+="<tr>";
    html+="<td>";
    html+="<span>"+$("select[name=id_evento] option:selected").html()+"</span>";
    html+="</td>";
    html+="<td>";
    html+="<input type='hidden' name='asevento_id_evento[]' value='"+$("select[name=id_evento]").val()+"'>";
    html+=" <a onclick='fnClickDelAsevento($(this));' href='javascript:void(0);'  class='btn btn-primary '><i class='fa fa-minus-square'></i></a>";
    html+="</td>";
    html+="</tr>";
    
    $("tbody#list-asevento").append(html);   
}

function fnClickDelAsevento(elem)
{
    if (confirm("Seguro desea quitar el usuario de la lista?"))
    {
        var fila=$(elem).parent().parent();
        $(fila).remove();
    }
}

function fnClickDelClusuario(elem)
{
    if (confirm("Seguro desea quitar el usuario de la lista?"))
    {
        var fila=$(elem).parent().parent();
        $(fila).remove();
    }
}

function chkAllClientes(checkbox)
{
    var isChecked = $(checkbox).parent().find('input[type=checkbox]').is(":checked");
        
        $("table#table-clientes input[name^=seleccionarItem], table#table-clientes input[name^=chk_all_clientes]").each(function() {
            this.checked = isChecked;

            if (isChecked) {
                $(this).parent().addClass('checked');
            } else {
                $(this).parent().removeClass('checked');
            }
        });
}
function chkAllClientesPotenciales(checkbox)
{
    var isChecked = $(checkbox).parent().find('input[type=checkbox]').is(":checked");
        
        $("table#table-clientes-potenciales input[name^=seleccionarItem], table#table-clientes-potenciales input[name^=chk_all_clientes_potenciales]").each(function() {
            this.checked = isChecked;

            if (isChecked) {
                $(this).parent().addClass('checked');
            } else {
                $(this).parent().removeClass('checked');
            }
        });
}

function SetNameFileLogoEmpresa() {
    var file = $("input[name=logo_empresa]").val();
    var position = file.lastIndexOf("\\");
    var name_file = file.substring(position + 1);

    $("#nombre_archivo_logo_empresa").val(name_file);
}

function SelectLogoEmpresa() {
    $("input[name=logo_empresa]").click();
}


function SetNameFileBackgroundMovil() {
    var file = $("input[name=background_movil]").val();
    var position = file.lastIndexOf("\\");
    var name_file = file.substring(position + 1);

    $("#nombre_archivo_background_movil").val(name_file);
}

function SelectBackgroundMovil() {
    $("input[name=background_movil]").click();
}

function visualizarAlerta(id)
{
    location.href="http://nativoapps.com/NFC/alertas/visualizar&id="+id+"&m=19";
}

function visualizarNovedad(id)
{
    location.href="http://nativoapps.com/NFC/novedades/visualizar&id="+id+"&m=18";
}
