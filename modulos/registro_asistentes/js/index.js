$( window ).load(function() {

	var url = document.location.origin+"/eventos/";



	//Esto es para el lector de barcode

       
	
});

function initCronp()
{	
		var cron=1;
	$("span[name^=hp]").each(function(){
		var tiempo = {
	        hora: $("span#horap_"+cron).html(),
	        minuto: $("span#minutop_"+cron).html(),
	        segundo: $("span#segundop_"+cron).html(),
	        cron:cron
	    }	
		tiempo_corriendo = setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60)
                {
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }      

                // Minutos
                if(tiempo.minuto >= 60)
                {
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }

                $("span#horap_"+tiempo.cron).html(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("span#minutop_"+tiempo.cron).html(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("span#segundop_"+tiempo.cron).html(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
		cron++;
		
	});

	
}



$(document).ready(function(){
	if ($("select[name=usuario_numero]").length>0)
	{
		$("select[name=usuario_numero]").trigger("chosen:updated");
		multiChosen();
	}
	if ($("select[name=usuario_search]").length>0)
	{
		$("select[name=usuario_search]").trigger("chosen:updated");
		multiChosenUsuarioSearch();
	}
	if ($("select[name=punto_inicio]").length>0)
	{
		$("select[name=punto_inicio]").trigger("chosen:updated");
		multiChosenPuntoInicio();
	}
	if ($("select[name=punto_final]").length>0)
	{
		$("select[name=punto_final]").trigger("chosen:updated");
		multiChosenPuntoFinal();
	}

	if ($("select[name=idruta]").length>0)
	{
		$("select[name=idruta]").trigger("click");
	}

	$("select[name=idruta]").click(function(){
		if ($("select[name=idruta]").val()=="")
		{
			$("select[name=punto_inicio]").removeAttr("disabled");
			$("select[name=punto_final]").removeAttr("disabled");
		}
		else
		{
			$("select[name=punto_inicio] option").each(function(){
				if ($(this).val()=="")
				{
					$(this).attr("selected","true");
				}
			});
			$("select[name=punto_final] option").each(function(){
				if ($(this).val()=="")
				{
					$(this).attr("selected","true");
				}
			});
			$("select[name=punto_inicio]").attr("disabled","true");
			$("select[name=punto_final]").attr("disabled","true");
			
		}
	});


});

function multiChosen()
{
	var config = {
	    'select[name=usuario_numero].chosen-select'           : {},
	    'select[name=usuario_numero].chosen-select-deselect'  : {allow_single_deselect:true},
	    'select[name=usuario_numero].chosen-select-no-single' : {disable_search_threshold:10},
	    'select[name=usuario_numero].chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	    'select[name=usuario_numero].chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
}

function multiChosenUsuarioSearch()
{
	var config = {
	    'select[name=usuario_search].chosen-select'           : {},
	    'select[name=usuario_search].chosen-select-deselect'  : {allow_single_deselect:true},
	    'select[name=usuario_search].chosen-select-no-single' : {disable_search_threshold:10},
	    'select[name=usuario_search].chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	    'select[name=usuario_search].chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
}

function multiChosenPuntoInicio()
{
	var config = {
	    'select[name=punto_inicio].chosen-select'           : {},
	    'select[name=punto_inicio].chosen-select-deselect'  : {allow_single_deselect:true},
	    'select[name=punto_inicio].chosen-select-no-single' : {disable_search_threshold:10},
	    'select[name=punto_inicio].chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	    'select[name=punto_inicio].chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
}

function multiChosenPuntoFinal()
{
	var config = {
	    'select[name=punto_final].chosen-select'           : {},
	    'select[name=punto_final].chosen-select-deselect'  : {allow_single_deselect:true},
	    'select[name=punto_final].chosen-select-no-single' : {disable_search_threshold:10},
	    'select[name=punto_final].chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	    'select[name=punto_final].chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
}

function searchAsistentes()
{
    $("input[name=pagina]").val("0");
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=searchnombre]").val($("input#nombre_search").val());
   	$("input[name=searchestado]").val($("select#estado_search").val());
    $("input[name=searchevento]").val($("select#evento_search").val());
    $("input[name=searchdocumento]").val($("input#documento_search").val());
   	$("input[name=searchidentificacion]").val($("select#identificacion_search").val());
   	$("form[name=formulario]").submit();
}

function validar()
{
	if ($("input[name=asunto]").val()=="")
	{
		alert("Ingresar Asunto de la asignacion.-");
		$("input[name=asunto]").focus();
		return false;
	}

	if ($("select[name=usuario_numero]").val()=="")
	{
		alert("Seleccionar Camillero.-");
		$("select[name=usuario_numero]").focus();
		return false;
	}

	// if ($("input[name=paciente]").val()=="")
	// {
	// 	alert("Ingresar Nombre del paciente.-");
	// 	$("input[name=paciente]").focus();
	// 	return false;
	// }

	// if ($("input[name=cedula]").val()=="")
	// {
	// 	alert("Ingresar Cedula.-");
	// 	$("input[name=cedula]").focus();
	// 	return false;
	// }

	// if ($("select[name=idtipoasignacion]").val()=="")
	// {
	// 	alert("Seleccionar Tipo de asignacion.-");
	// 	$("select[name=idtipoasignacion]").focus();
	// 	return false;
	// }

	if ($("select[name=idruta]").val()=="")
	{
		if ($("select[name=punto_inicio]").val()=="" || $("select[name=punto_final]").val()=="")
		{
			alert("Seleccionar Punto de Inicio y Final.-");
			$("select[name=punto_inicio]").focus();
			return false;
		}
		// else if ($("select[name=punto_inicio]").val()==$("select[name=punto_final]").val())
		// {
		// 	alert("Seleccionar Punto Inicio distinto al punto Final.-");
		// 	$("select[name=punto_inicio]").focus();
		// 	return false;
		// }
	}

	// if ($("select[name=empresa_numero]").val()=="")
	// {
	// 	alert("Seleccionar Empresa.-");
	// 	$("select[name=empresa_numero]").focus();
	// 	return false;
	// }

	$("form[name=formulario]").submit();

}

function fnOpenVisualize(destino, id) {
	$("form[name=formulario]").attr("action", destino);
	$("form[name=formulario] input[name=identificador]").removeAttr("disabled");
	$("form[name=formulario] input[name=identificador]").val(id);
	$("form[name=formulario] input[name=eliminar]").attr("disabled","disabled");
	$("form[name=formulario] input[name=pagina]").attr("disabled","disabled");
	$("form[name=formulario] input[name=search]").attr("disabled","disabled");
	$("form[name=formulario]").submit();
}


function fnBuscarCodigoBarra() {
	
	$("form[name=formulario_asistente]").submit();
}


function fnSeleccion(id, nombre, apellido, documento, id_identificacion, estado, evento) {
	$("#id_asistente").val(id);
	$("#id_evento").val(evento);
	$("#nombre_selec").val(nombre+" "+apellido);
	$("#documento_selec").val(documento);
	//$("#identificacion_selec").val(id_identificacion);
	$("#estado_selec").val(estado);
	$("#id_asistente_acompaniante").val(id);

	$("#span_iden").css("background-color", id_identificacion);

	if(estado==4){
		$("#btnConfirmar").attr("disabled", "disabled");
		$("#btnRegistrar").attr("disabled", "disabled");
	}else{
		$("#btnConfirmar").removeAttr('disabled');
		$("#btnRegistrar").removeAttr('disabled');
	}
}

function tabChange(valor)
{
     $("input[name=tab]").val(valor);
   
}