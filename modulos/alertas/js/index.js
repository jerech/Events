function fnSearch(event) {
	if (event.keyCode == 13) {
		$("form[name=formulario]").attr("action","");
		$("form[name=formulario]").attr("target", '');
		$("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
		$("form[name=formulario] input[name=eliminar]").attr("disabled","disabled");
		$("form[name=formulario] input[name=buscar]").removeAttr('disabled');
		$("form[name=formulario] input[name=buscar]").val(1);
		$("form[name=formulario]").submit();
	}
}

function fnOpenVisualize(destino, id) {
	$("form[name=formulario]").attr("action", destino);
	$("form[name=formulario] input[name=id]").removeAttr("disabled");
	$("form[name=formulario] input[name=id]").val(id);
	$("form[name=formulario] input[name=eliminar]").attr("disabled","disabled");
	$("form[name=formulario] input[name=buscar]").attr("disabled","disabled");
	$("form[name=formulario]").submit();
}