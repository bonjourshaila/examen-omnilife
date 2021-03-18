@extends('layouts.layout')
@section('content')
<div class="row">
    <section class="content container-fluid">
        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-danger" id="mensaje-error" style="display:none">
                <strong>Error!</strong> Revise los campos.<br><br>
                <ul id="lista-error">
                </ul>
            </div>
            <div class="alert alert-success" id="mensaje-success" style="display:none">
                <p>Se editó correctamente el empleado</p>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar empleado</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <form method="POST" id="form-guardar-empleado" role="form">

                            <input type="hidden" name="id" id="id" class="form-control input-sm"
                                value="{{$empleado->id}}">

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Código</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="codigo" id="codigo" class="form-control input-sm"
                                            value="{{$empleado->codigo}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Nombre</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm"
                                            value="{{$empleado->nombre}}">
                                    </div>
                                </div>


                            </div>




                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend ">
                                        <span class=" col-md-12">Salario Pesos</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="salarioPesos" id="salarioPesos" onblur="conversionDolar()"
                                            class="form-control input-sm" value="{{$empleado->salarioPesos}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend ">
                                        <span class=" col-md-12">Salario Dolares</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="salarioDolares" id="salarioDolares"
                                            class="form-control input-sm" value="{{$empleado->salarioDolares}}" readonly>
                                    </div>
                                </div>
                                

                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Dirección</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="direccion" id="direccion" class="form-control input-sm"
                                            value="{{$empleado->direccion}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Estado</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="estado" id="estado" class="form-control input-sm"
                                            value="{{$empleado->estado}}">
                                    </div>
                                </div>
                            </div>





                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Ciudad</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ciudad" id="ciudad" class="form-control input-sm"
                                            value="{{$empleado->ciudad}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Teléfono</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="telefono" id="telefono" class="form-control input-sm"
                                            value="{{$empleado->telefono}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Correo</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="correo" id="correo" class="form-control input-sm"
                                            value="{{$empleado->correo}}">
                                    </div>
                                </div>
                            </div>





                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="button" value="Actualizar" id="btnGuardar"
                                        class="btn btn-success btn-block">
                                    <a href="{{ route('empleado.index') }}" class="btn btn-info btn-block">Atrás</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

    $(document).ready(function () {
        $(document).on('click', '#btnGuardar', function () {
            $.ajax({
                url: '{{route("empleado.update")}}',
                type: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },             
                data: $('#form-guardar-empleado').serialize(),
                success: function (data) {
                    console.log(data);

                    if (data.status === 0) {
                        console.log("todo ok");
                        $("#mensaje-error").hide();
                        $("#mensaje-success").show();
                        setTimeout(() => {
                            $("#mensaje-success").hide();
                        }, 3000);
                    }
                    else {
                        console.log("todo mal");
                        var msg_error = '';
                        for (var i = 0; i < data.error.length; i++) {
                            msg_error += '<li>' + data.error[i] + '</li>'
                        }
                        $('#lista-error').append(msg_error);
                        console.log(msg_error);
                        $("#mensaje-error").show();
                    }
                }
            });
        });
    });


    function conversionDolar(){
        $.ajax({
            url : 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno?token=4a58ce5006f7edc14c8a6e3c74aaebb3af01888ae3625dfece3c19a52905c685',
            jsonp : 'callback',
            dataType : 'jsonp',
            success : function (response) {
                var respuesta = {
                    dolar_mxn : response.bmx.series[0].datos[0].dato,
                    fecha_cambio : response.bmx.series[0].datos[0].fecha,
                    id_serie : response.bmx.series[0].idSerie,
                    titulo : response.bmx.series[0].titulo
                };
                console.log(respuesta.dolar_mxn);
                var conversion = ($('#salarioPesos').val()/respuesta.dolar_mxn).toFixed(2);
                $('#salarioDolares').val(conversion);
                
            },
            error : function(){
               console.log('Ocurrio un error en el consumo del servicio de BANXICO, intentar mas tarde');
            }
        });
    }

</script>
@endsection