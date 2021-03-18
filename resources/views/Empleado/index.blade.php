@extends('layouts.layout')
@section('content')

<div class="row">
    <div class="container-fluid">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" id="mensaje-error" style="display:none">
                    <strong>Error!</strong> No se pudo completar la petición.<br><br>
                </div>
                <div class="alert alert-success" id="mensaje-success-activar" style="display:none">
                    <p>Se activó correctamente el empleado</p>
                </div>
                <div class="alert alert-success" id="mensaje-success-eliminar" style="display:none">
                    <p>Se eliminó correctamente el empleado</p>
                </div>
                <div class="alert alert-success" id="mensaje-success-desactivar" style="display:none">
                    <p>Se desactivó correctamente el empleado</p>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class=" ml- 5row ">
                            <div class="btn-group">
                                <a href="{{ route('empleado.create') }}" class="btn btn-info btn-lg">Añadir Empleado</a>
                            </div>
                        </div>
                        <br><br>
                        <div class="table-container ">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                    <th class="text-center">Codigo</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Salario pesos</th>
                                    <th class="text-center">Salario dolares</th>
                                    <th class="text-center">Correo</th>
                                    <th class="text-center">Activo</th>
                                    <th class="text-center">Acciones</th>
                                </thead>
                                <tbody>
                                    @if($empleados->count())
                                    @foreach($empleados as $empleado)
                                    <tr class="tr-empleado{{$empleado->id}}">
                                        <td class="text-center">{{$empleado->codigo}}</td>
                                        <td>{{$empleado->nombre}}</td>
                                        <td class="text-center">${{$empleado->salarioPesos}}</td>
                                        <td class="text-center">${{$empleado->salarioDolares}}</td>
                                        <td>{{$empleado->correo}}</td>
                                        <td class="text-center" id="text-activo{{$empleado->id}}">{{$empleado->activo === 1 ? 'Si' : 'No'}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-light btn-xs"
                                                href="{{action('EmpleadoController@show', $empleado->id)}}"><i
                                                    class="far fa-eye"></i></a>
                                            <a class="btn btn-primary btn-xs"
                                                href="{{action('EmpleadoController@edit', $empleado->id)}}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-xs"
                                                onclick="eliminarEmpleado('{{$empleado->id}}')"><i
                                                    class="far fa-trash-alt"></i></a>
                                            <a class="btn btn-info btn-xs "
                                                onclick="activarEmpleado('{{$empleado->id}}')"><i
                                                    class='fas {{$empleado->activo === 1 ? "fa-pause" : "fa-play"}} activar-empleado{{$empleado->id}}'></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No hay registro !!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

    $(document).ready(function () {
    });


    function activarEmpleado(empleado_id) {
        $.ajax({
            url: '{{route("empleado.activar")}}',
            type: 'POST',
            data: { empleado_id: empleado_id, _token: '{{csrf_token()}}' },
            success: function (data) {

                if (data.status === 0) {
                    $(".activar-empleado" + empleado_id).addClass('fa-play');
                    $(".activar-empleado" + empleado_id).removeClass('fa-pause');
                    document.getElementById("text-activo" + empleado_id).innerHTML = "No";
                    $("#mensaje-success-desactivar").show();
                    setTimeout(() => {
                        $("#mensaje-success-desactivar").hide();
                    }, 2000);
                }
                else {
                    $(".activar-empleado" + empleado_id).removeClass('fa-play');
                    $(".activar-empleado" + empleado_id).addClass('fa-pause');
                    document.getElementById("text-activo" + empleado_id).innerHTML = "Si";
                    $("#mensaje-success-activar").show();
                    setTimeout(() => {
                        $("#mensaje-success-activar").hide();
                    }, 2000);
                }
            }
        });
    }

    function eliminarEmpleado(empleado_id) {
        $.ajax({
            url: '{{route("empleado.destroy")}}',
            type: 'POST',
            data: { empleado_id: empleado_id, _token: '{{csrf_token()}}' },
            success: function (data) {

                if (data.status === 0) {
                    $(".tr-empleado" + empleado_id).remove();
                    $("#mensaje-success-eliminar").show();
                    setTimeout(() => {
                        $("#mensaje-success-eliminar").hide();
                    }, 2000);
                }
                else {
                    $("#mensaje-error").show();
                    setTimeout(() => {
                        $("#mensaje-error").hide();
                    }, 2000);
                }
            }
        });
    }
</script>
@endsection