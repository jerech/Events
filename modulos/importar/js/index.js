 
            window.onload = function () { $('.bloquear').css("display","none"); }
 $(document).ready(function(){

            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                enableFinishButton: false,
                enableCancelButton: false,
                enableAllSteps: false,
    
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    $('.bloquear').css("display","block");
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return false;
                    }

                    

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    if (newIndex===1 && $("input[name=next_step]").val()=="0")
                    {
                        // Disable validation on fields that are disabled or hidden.
                        form.validate().settings.ignore = ":disabled,:hidden";

                        // Start validation; Prevent going forward if false
                        if (form.valid())
                        {
                        
                            var formArchivo = $('#formArchivo');

                            // Submit form input
                            formArchivo.submit();
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else if (newIndex===2 && $("input[name=next_step]").val()=="1")
                    {
                        var form = $(this);

                        // Submit form input
                        form.submit();
                    }
                    else
                    {
                        return true;
                    }
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // // Suppress (skip) "Warning" step if the user is old enough.
                     if (currentIndex === 2 )
                     {
                         $("li>a[href=#previous]").css("display","none");
                     }

                    // // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    // if (currentIndex === 2 && priorIndex === 3)
                    // {
                    //     $(this).steps("previous");
                    // }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                },
                onCanceled: function (event, currentIndex)
                {
                    location.href="";
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.parent().before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });

            if ($("input[name=next_step]").val()=="1")
            {
                $("#form").steps("next");
            }

            if ($("input[name=next_step]").val()=="2")
            {
                $("#form").steps("next");
                $("#form").steps("next");
            }
       });


 function SetNameFile() {
    var file = $("input[name=archivo]").val();
    var position = file.lastIndexOf("\\");
    var name_file = file.substring(position + 1);

    $("#nombre_archivo").val(name_file);
}

function SelectFile() {
    $("input[name=next_step]").val("0");
    $("input[name=archivo]").click();
}

function fnSelectEvento() {
    var id = $("#select_evento").val();

    $("#evento").val(id);
}