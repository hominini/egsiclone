<?php

namespace App\Http\Controllers;

use App\FulfillmentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class FulfillmentActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FulfillmentActivity::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editActivity">Editar</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteActivity">Borrar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $fulfillment_activities = FulfillmentActivity::all();

        return view('activities.index', compact('fulfillment_activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fulfillment-activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // se valida los parametros pasados en la peticion
        $this->validate($request, [
            'fulfillment_id' => 'required',
            'activity_summary' => 'required',
        ]);

        // recuperando los parametros que se necesitan para crear un hito
        $input = $request->all();

        // se obtien la ruta del archivo
        $path_file = $request->file('evidence_file')->store('verifiables', 'public');

        // se sobreescribe los paths en la variable input
        $input['evidence_file_path'] = $path_file;

        // guardando el registro en la base
        $fulfillement_activity = \App\FulfillmentActivity::create($input);

        // redirigiendo a la pangina index de hitos con mensaje de exito
        return $fulfillement_activity;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = FulfillmentActivity::find($id);
        return response()->json($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // se valida los parametros pasados en la peticion
        $this->validate($request, [
            'fulfillment_id' => 'required',
            'activity_summary' => 'required',
        ]);

        $input = $request->all();

        // si se paso el archivo verificable en la peticion, entonces procesar
        if (array_key_exists('evidence_file', $input))
        {
            // eliminar el archivo previamente almacenado
            Storage::disk('public')->delete(\App\FulfillmentActivity::find($id)->evidence_file_path);
            // obtener la ruta del nuevo archivo
            $path_file = $request->file('evidence_file')->store('verifiables', 'public');
            $input['evidence_file'] = $path_file;
        }

        $fulfillment_activity = \App\FulfillmentActivity::find($id);
        $fulfillment_activity->update($input);

        return $fulfillment_activity;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FulfillmentActivity::find($id)->delete();

        return response()->json(['success'=>'Actividad eliminada correctamente']);
    }
}
