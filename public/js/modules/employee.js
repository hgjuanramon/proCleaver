
$(function () {

    var columnas = [
        {
            "data": "first_name",
            "defaultContent": ""
        }, {
            "data": "last_name",
            "defaultContent": ""
        }, {
            "data" : "email",
            "defaultContent" : ""
        }, {
            "data" : "address",
            "defaultContent" : ""
        }, {
            "data": "",
            "defaultContent": "<button class='btn btn-raised btn-primary' id='btnEdit'>Editar</button> <button class='btn btn-raised btn-danger' id='btnDel'>Eliminar</button>"
        }
    ];

    var dt = dataTableComponente("#tblEmployee", "/getEmployees", columnas, "#frmBuscar",10);

    $('#frmBuscar').submit(function (event) {
        dt.buscar();
        event.preventDefault();
    });


    $('#btnAdd').on('click',function () {
        clearForm("#frmEmployee");
        modal("Agregar Empleado",false,null);
    })
    $('#tblEmployee').on('click',"#btnEdit",function () {
        clearForm("#frmEmployee");
        var datos = dt.obtenerSeleccionado($(this));
        modal("Editar Empleado",true,datos);
    })

    var modal = function (title,type,data) {
        baseComponente.ocultarErrores();
        $("#id").val(0);
        if(type) {
            $("#id").val(data['id'])
            $("#first_name").val(data['first_name']);
            $("#last_name").val(data['last_name']);
            $("#email").val(data['email']);
            $("#birth_date").val(data['birth_date']);
            $("#employment").val(data['employment']);
            $("#address").val(data['address']);

            $.each(data['skills'],function (i,value) {
                var id = data["skills"][i]["skill_id"];
                $("#skill_"+id).prop("checked",true);
            })
        }
        $("#titleModal").html(title)
        $("#myModal").modal("show");
    }

    $("#frmEmployee").on("submit",function (e) {

        $.ajax({
            url:"/employee-save",
            dataType:'json',
            type:'post',
            data:$("#frmEmployee").serialize(),
            success:function (data) {
                if (data.tipoRespuesta === "MENSAJE" && data.tipoMensaje === "CORRECTO") {
                    dt.recargar();
                    notificacionComponente.mostrarCorrecto(data.mensaje);
                    dt.recargar();
                    $("#myModal").modal("hide");
                } else {
                    if(data.tipoRespuesta === "MENSAJE" && data.tipoMensaje ==="ERROR"){
                        notificacionComponente.mostrarError(data.mensaje);
                    }else{
                        baseComponente.mostrarMensajes(data.mensajes);
                    }
                }
            }
        });
        e.preventDefault();
    })

    $("#tblEmployee").on('click','#btnDel',function () {
        var datos = dt.obtenerSeleccionado(this);
        var mData = {id : datos.id,_token:$("#_token").val()}

        if(confirm("¿Desea eliminar el registro?")){
            if(datos.id){
                $.ajax({
                    url:"/employee-delete",
                    dataType:'json',
                    type:'post',
                    data: mData,
                    success:function (data) {
                        if (data.tipoRespuesta === "MENSAJE" && data.tipoMensaje === "CORRECTO") {
                            dt.recargar();
                            notificacionComponente.mostrarCorrecto(data.mensaje);
                        } else {
                            if(data.tipoRespuesta === "MENSAJE" && data.tipoMensaje ==="ERROR"){
                                notificacionComponente.mostrarError(data.mensaje);
                            }else{
                                baseComponente.mostrarMensajes(data.mensajes);
                            }
                        }
                    }
                });
            }
        }
    });

    var clearForm =function (selector) {
        $.each($(selector),function () {
            $(this).find('input:text, input:password, input:file, select, textarea').val('');
            $(this).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        })
    }

    $("#birth_date").datepicker({
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
})