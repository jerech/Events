$( window ).load(function() {
  // Run code
  if ($("select[name=idruta]").length>0)
	{
		$("select[name=idruta]").trigger("click");
	}

	if ($("span[name^=h]").length>0)
	{
		initCron();
		verificar_tiempo_ruta();
	}
	if ($("span[name^=hp]").length>0)
	{
		initCronp();
	}



    //$(".navbar-minimalize").trigger("click");
    fnPlotChartPie();
});




function fnPlotChartPie() {
    
    var data = [];   
    
    data.push({ indexLabel: "", y: Number(canActivos), name:"REGISTRADOS"});
    data.push({ indexLabel: "", y: Number(canRegistrados), name:"CONFIRMADOS"});
  
    
    CanvasJS.addColorSet("colores", ["#1AB394", "#5BC0DE"]);

    var chart = new CanvasJS.Chart("chartPie",
                    {
                    theme: "theme2",
                    legend: {
                        maxWidth: 180,
                        itemWidth: 70
                    },
                    colorSet:  "colores",
                    zoomEnabled: true,
                    axisX:{
                        labelFontSize:12
                    },
                    data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{y} - #percent % {name}",
                        yValueFormatString: "#0.#",
                        legendText: "{name}",
                        dataPoints: data
                    }
                    ]
                });

    chart.render();
        
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

function gd(year, month, day,hour,minute,secound) {
    return new Date(year, month - 1, day,hour,minute,secound).getTime();
}
function searchAsistentes()
{
    $("input[name=pagina]").val("0");
    $("form[name=formulario]").attr("action","");
    $("form[name=formulario] input[name=identificador]").attr("disabled","disabled");
    $("input[name=search]").val($("select#search").val());
    $("form[name=formulario]").submit();
}


