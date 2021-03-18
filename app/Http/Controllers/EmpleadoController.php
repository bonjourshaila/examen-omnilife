<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class   EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empleados = Empleado::where('eliminado', 0)->orderBy('activo', 'desc')->get();
        // dd($empleados);

        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        App::setLocale('es');
        $validacion = Validator::make($request->all(), [
            'codigo' => 'required|max:10|unique:empleado,codigo' . $request->id,
            'nombre' => 'required|max:50|regex:/^[\\w\\s]+$/',
            'salarioDolares'    => 'required|numeric|min:0|not_in:0',
            'salarioPesos'    => 'required|numeric|min:0|not_in:0',
            'direccion' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'estado' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'ciudad' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'telefono' => 'required|max:10',
            'correo'     => 'required|email',

        ]);
 
        if($validacion->fails()){     
             
            $result['msg'] = $validacion->errors()->all();
            return response()->json(['error' => $result['msg'],'status' => 1]);
        }
       
        Empleado::create($request->all());
        

        // return redirect()->route('empleado.index')->with('success','Registro Creado');

        return response()->json(['success' => 'Se registro correctamente el empleado','status' => 0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $meses = [];
        for($i=1; $i<=6; $i++){
            $mes = date("F",strtotime('+'.$i.'month'));
            array_push($meses, $mes);
        }
        
        
        $empleado = Empleado::find($id);
        return view('empleado.show', compact('empleado', 'meses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        App::setLocale('es');
        $validacion = Validator::make($request->all(), [
            'codigo' => 'required|max:10|unique:empleado,codigo,'.$request->id,
            'nombre' => 'required|max:50|regex:/^[\\w\\s]+$/',
            'salarioDolares'    => 'required|numeric',
            'salarioPesos'    => 'required|numeric|min:0|not_in:0',
            'direccion' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'estado' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'ciudad' => 'required|regex:/^[\\w\\s]+$/|max:30',
            'telefono' => 'required|max:10',
            'correo'     => 'required|email',

        ]);

        if($validacion->fails()){     
             
            $result['msg'] = $validacion->errors()->all();
            return response()->json(['error' => $result['msg'],'status' => 1]);
        }


        Empleado::find($request->id)->update($request->all());
        return response()->json(['success' => 'Se registro correctamente el empleado','status' => 0]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $empleado = Empleado::find($request->empleado_id);
        
        $empleado->activo = 0;
        $empleado->eliminado = 1;
        $empleado->save();
        $response = array('status' => 0, 'message' => 'Se elinino correctamente');
        return $response;
        // 
        // return redirect()->route('empleado.index')->with('success', 'Registro eliminado');
    }

    public function activar(Request $request)
    {
        $empleado = Empleado::find($request->empleado_id);

        if ($empleado->activo === 1) {
            $empleado->activo = 0;
            $empleado->save();
            $response = array(
                'status' => 0,
                'message' => ('Se desactivo el empleado'),
            );
        } else {
            $empleado->activo = 1;
            $empleado->save();
            $response = array(
                'status' => 1,
                'message' => ('Se activo el empleado')
            );
        }
        return $response;
        // 
        // return redirect()->route('empleado.index')->with('success', 'Registro eliminado');
    }
}
