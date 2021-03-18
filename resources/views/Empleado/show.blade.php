@extends('layouts.layout')
@section('content')
<div class="row">
    <section class="content container-fluid">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title alert alert-info">Datos de empleado</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->codigo}}</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->nombre}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label id="salarioPesos" class="form-control">${{$empleado->salarioPesos}}</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">${{$empleado->salarioDolares}}</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->direccion}}</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->estado}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->ciudad}}</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->telefono}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control">{{$empleado->correo}}</label>
                                </div>
                            </div>

                        </div>

                        
                    </div>
                    <hr>


                    
                        <h3 class="panel-title alert alert-info">Proyección salarial</h3>
                 <hr>


                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th class="text-center">Mes</th>
                                <th class="text-center">Salario pesos</th>
                                <th class="text-center">Salario dolares</th>
                            </thead>
                            <tbody>
                                @foreach($meses as $mes) 
                                <tr>
                                    <td class="text-bold"><strong>{{$mes}}</strong></td>
                                    <td class="text-center">${{$empleado->salarioPesos = round((($empleado->salarioPesos*.05)+$empleado->salarioPesos),2)}}</td>
                                    <td class="text-center">${{$empleado->salarioDolares = round((($empleado->salarioDolares*.05)+$empleado->salarioDolares),2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="{{ route('empleado.index') }}" class="btn btn-info btn-block">Atrás</a>
                        </div>

                    </div>



                </div>

            </div>




            
        </div>
    </section>
</div>
@endsection
