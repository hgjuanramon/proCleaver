<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('js/vendor/datatables-1.10.12/css/datatables-custom.css') !!}
        {!! Html::style('js/vendor/lobibox/css/lobibox.min.css') !!}
        {!! Html::style('js/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}
        <style>
            .errores{
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Lista de empleados</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Buscador</div>
                        <div class="panel-body">
                            <form id="frmBuscar">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Por Nombre</label>
                                                <input class="form-control" name="filtros[name_filter]">
                                                <span class="errores" data-error="name_filter"><i class="fa fa-times"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-raised btn-primary">Buscar</button>
                                                <button id="btnAdd" type="button" class="btn btn-raised btn-success">Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <table class="table display" id="tblEmployee">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
        @include('employee/modal')
        <!-- Scripts -->
        {!! Html::script('js/jquery-2.2.0.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/vendor/handlebars/handlebars.min.js') !!}
        {!! Html::script('js/vendor/datatables-1.10.12/js/datatables.min.js') !!}
        {!! Html::script('js/vendor/lobibox/js/notifications.min.js') !!}
        {!! Html::script('js/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
        {!! Html::script('js/vendor/bootstrap-datepicker/js/datepicker-es.js') !!}
        {!! Html::script('js/component/dataTableComponente.js') !!}
        {!! Html::script('js/component/handlebarsComponente.js') !!}
        {!! Html::script('js/component/baseComponente.js') !!}
        <script>
            $(function() {
                baseComponente.inicializarAjax("[[base_url]]");
            });
        </script>
        {!! Html::script('js/component/notificacionComponente.js') !!}
        {!! Html::script('js/component/dataTableComponente.js') !!}
        {!! Html::script('js/modules/employee.js') !!}

    </body>
</html>
