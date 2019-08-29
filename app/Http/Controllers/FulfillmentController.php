<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fulfillment;
use Illuminate\Support\Facades\DB;

class FulfillmentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:list-fulfillments|create-fulfillments|edit-fulfillments|delete-fulfillments', ['only' => ['index','store']]);
         $this->middleware('permission:create-fulfillments', ['only' => ['create','store']]);
         $this->middleware('permission:edit-fulfillments', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-fulfillments', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // se obtiene todos los cumplimientos
        $data = \App\Fulfillment::paginate(15);
        return view('fulfillments.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $milestones = DB::table('milestones')->pluck('description', 'id');
        $institutions = DB::table('institutions')->pluck('name', 'id');
        return view('fulfillments.create', compact('milestones', 'institutions'));
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
            'institution_id' => 'required',
            'milestone_id' => 'required',
            'fulfillment_date' => 'required',
            'oficial_de_seguridad_id' => 'required',
            'responsable_id' => '',
        ]);

        // recuperando los parametros que se necesitan para crear un hito
        $input = $request->all();

        // guardando el registro en la base
        $fulfillement = Fulfillment::create($input);

        // redirigiendo a la pangina index de hitos con mensaje de exito
        return redirect()->route('fulfillments.index')
                        ->with('success','Ha registrado su cumplimiento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fulfillment = Fulfillment::find($id);
        $oficial = \App\User::find($fulfillment->oficial_de_seguridad_id);
        return view('fulfillments.show',compact('fulfillment', 'oficial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $milestones = DB::table('milestones')->pluck('description', 'id');
        $institutions = DB::table('institutions')->pluck('name', 'id');
        $fulfillment = Fulfillment::find($id);
        return view('fulfillments.edit',compact('fulfillment', 'milestones', 'institutions'));
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
            'institution_id' => 'required',
            'milestone_id' => 'required',
            'fulfillment_date' => 'required',
            'oficial_de_seguridad_id' => 'required',
            'responsable_id' => '',
        ]);

        // guardando los parametros que se necesitan para actualizar
        $input = $request->all();

        // se obtiene el cumplimiento a modificar
        $fulfillement = Fulfillment::find($id);

        // se guarda el registro en la base
        $fulfillement->update($input);

        // redirigiendo a la pangina index de hitos con mensaje de exito
        return redirect()->route('fulfillments.index')
                        ->with('success','Cumplimiento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fulfillment::find($id)->delete();
        return redirect()->route('fulfillments.index')
                        ->with('success','Cumplimiento eliminado exitosamente');
    }
}
