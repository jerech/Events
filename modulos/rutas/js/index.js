$(document).ready(function(){

	$("button[name=subir]").click(function(){
		if ($("select[name^=puntos_s] option:selected").length==0)
		{
			alert("Seleccionar Un Punto de Chequeo que desea subir en orden");
			return false;
		}

		if ($("select[name^=puntos_s] option:selected").length>1)
		{
			alert("Seleccionar Un unico Punto de Chequeo que desea subir en orden");
			return false;
		}

		$("select[name^=puntos_s] option:selected").prev().insertAfter("select[name^=puntos_s] option:selected");

	
	});

	$("button[name=bajar]").click(function(){
		if ($("select[name^=puntos_s] option:selected").length==0)
		{
			alert("Seleccionar Un Punto de Chequeo que desea bajar en orden");
			return false;
		}

		if ($("select[name^=puntos_s] option:selected").length>1)
		{
			alert("Seleccionar Un unico Punto de Chequeo que desea bajar en orden");
			return false;
		}

		$("select[name^=puntos_s] option:selected").next().insertBefore("select[name^=puntos_s] option:selected");
	
	});
	

	$("input[name=pasar]").click(function(){
		if ($("select[name^=puntos_ns] option:selected").length==0)
		{
			alert("Seleccionar Punto de Chequeo que desea pasar a la ruta");
			return false;
		}

		$("select[name^=puntos_ns] option:selected").each(function(){
			$(this).appendTo($("select[name^=puntos_s]"));
			//$(this).remove();
		});
	});

	$("input[name=pasar_todos]").click(function(){
		//$("select[name^=puntos_s]").html("");

		if ($("select[name^=puntos_ns] option").length>0)
		{
			$("select[name^=puntos_ns] option").each(function(){
				$(this).appendTo($("select[name^=puntos_s]"));
			});
		}
		//$("select[name^=puntos_ns]").html("");
		
	});

	$("input[name=quitar]").click(function(){
		if ($("select[name^=puntos_s] option:selected").length==0)
		{
			alert("Seleccionar Punto de Chequeo que desea quitar de la ruta");
			return false;
		}

		$("select[name^=puntos_s] option:selected").each(function(){
			$(this).appendTo($("select[name^=puntos_ns]"));
			//$(this).remove();
		});
	});

	$("input[name=quitar_todos]").click(function(){
		//$("select[name^=puntos_ns]").html("");

		if ($("select[name^=puntos_s] option").length>0)
		{
			$("select[name^=puntos_s] option").each(function(){
				$(this).appendTo($("select[name^=puntos_ns]"));
			});
		}
		//$("select[name^=puntos_s]").html("");
		
	});

});

function recargarPuntos(){
	var html="";
	
	if ($("select[name^=puntos_s] option").length==0)
	{
		alert("Ingresar por lo menos un punto de chequeo.-");
		$("input[name=nombre]").focus();
		return false;
	}

	if ($("select[name^=puntos_s] option").length>0)
	{
		$("select[name^=puntos_s] option").each(function(){
			html+="<input type='hidden' name='puntos[]' value='"+$(this).val()+"'>";
		});
	}
	


	$("form[name=formulario]").append(html);

	if ($("input[name=nombre]").val()=="")
	{
		alert("Ingresar un nombre de ruta.-");
		$("input[name=nombre]").focus();
		return false;
	}

	if ($("select[name=empresa_numero]").val()=="")
	{
		alert("Seleccionar una empresa de la ruta.-");
		$("select[name=empresa_numero]").focus();
		return false;
	}

	if ($("input[name=tiempo]").val()=="")
	{
		alert("Ingresar un tiempo aprox. de ruta.-");
		$("input[name=tiempo]").focus();
		return false;
	}

	$("form[name=formulario]").submit();
}