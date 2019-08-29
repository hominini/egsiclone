<?php

namespace App\Http\Controllers;

use App\Milestone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MilestoneController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:list-milestones|create-milestones|edit-milestones|delete-milestones', ['only' => ['index','store']]);
         $this->middleware('permission:create-milestones', ['only' => ['create','store']]);
         $this->middleware('permission:edit-milestones', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-milestones', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('milestones')->paginate(15);
        return view('milestones.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = \App\Category::where('parent_number',NULL)->get();
        return view('milestones.create', compact('parentCategories'));
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
            'milestone_number' => 'required|unique:milestones',
            'description' => 'required',
            'is_a_priority' => '',
        ]);

        // guardando los parametros que se necesitan para crear un hito
        $input = $request->all();

        // se verifica si la prioridad fue pasada en la peticion
        $input['is_a_priority'] = array_key_exists('is_a_priority', $input) ? true : false;

        // guardando el registro en la base
        $milestone = Milestone::create($input);

        // redirigiendo a la pangina index de hitos con mensaje de exito
        return redirect()->route('milestones.index')
                        ->with('success','Hito creado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $milestone = Milestone::find($id);
        return view('milestones.show',compact('milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $milestone = Milestone::find($id);
        $parentCategories = \App\Category::where('parent_number',NULL)->get();
        return view('milestones.edit',compact('milestone', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // se valida los parametros pasados en la peticion
        $this->validate($request, [
            'milestone_number' => [
                'required',
                Rule::unique('milestones')->ignore($id),
            ],
            'description' => 'required',
        ]);

        // guardando los parametros que se necesitan para crear un hito
        $input = $request->all();

        // se verifica si la prioridad fue pasada en la peticion
        $input['is_a_priority'] = array_key_exists('is_a_priority', $input) ? true : false;

        // se obtiene el hito a modificar
        $milestone = Milestone::find($id);

        // se guarda el registro en la base
        $milestone->update($input);

        // redirigiendo a la pangina index de hitos con mensaje de exito
        return redirect()->route('milestones.index')
                        ->with('success','Hito actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Milestone::find($id)->delete();
        return redirect()->route('milestones.index')
                        ->with('success','Hito eliminado exitosamente');
    }
}
