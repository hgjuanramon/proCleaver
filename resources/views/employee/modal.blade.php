<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form id="frmEmployee" method="post">
            <input type="hidden" id="id" name="id" value="0"/>
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleModal">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" id="first_name" name="first_name">
                            <span class="errores" data-error="first_name"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input class="form-control" id="last_name" name="last_name">
                            <span class="errores" data-error="last_name"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Fecha de Nacimiento</label>
                            <input class="form-control" id="birth_date" name="birth_date" readonly>
                            <span class="errores" data-error="birth_date"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" id="email" name="email">
                            <span class="errores" data-error="email"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Puesto</label>
                            <input class="form-control" id="employment" name="employment">
                            <span class="errores" data-error="employment"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" id="address" name="address">
                            <span class="errores" data-error="address"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-inline">
                                @foreach($skills as $value)
                                <li class="form-group">
                                    <label>
                                    <input type="checkbox" name="skills[]" id="skill_{{ $value->id }}" value="{{ $value->id }}"> {{ $value->name }}
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            <span class="errores" data-error="skills"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>