<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institution;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;


class InstitutionsController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:list-institutions|create-institutions|edit-institutions|delete-institutions', ['only' => ['index','store']]);
         $this->middleware('permission:create-institutions', ['only' => ['create','store']]);
         $this->middleware('permission:edit-institutions', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-institutions', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Institution::orderBy('id','DESC')->paginate(5);
        return view('institutions.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('institutions.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|confirmed',
            // 'roles' => 'required',
        ]);
        $input = $request->all();

        // se almacena imagenes y se obtiene las rutas
        $path_institutional_image = $request->file('institution_picture')->store('pictures', 'public');
        $path_icon = $request->file('icon')->store('icons', 'public');

        // se sobreescribe los paths en la variable input
        $input['institution_picture'] = $path_institutional_image;
        $input['icon'] = $path_icon;

        // se almacena la institucion
        $institution = \App\Institution::create($input);

        // se redirige hacia el index de instituciones
        return redirect()->route('institutions.index')
                        ->with('success','Institución creada exitosamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // se obtiente la institucion para mostrar
        $institution = Institution::find($id);

        // se obtiene la ruta de la imagen e icono y se la agrega a los parametros
        $institution['institution_picture'] = Storage::url($institution['institution_picture'] );
        $institution['icon'] = Storage::url($institution['icon'] );

        return view('institutions.show',compact('institution'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institution = Institution::find($id);
        // se obtiene la ruta de la imagen e icono y se la agrega a los parametros
        $institution['institution_picture'] = Storage::url($institution['institution_picture'] );
        $institution['icon'] = Storage::url($institution['icon'] );
        return view('institutions.edit', compact('institution'));
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
        $this->validate($request, [
            // 'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'required|confirmed',
            // 'roles' => 'required'
        ]);

        $input = $request->all();

        // si se paso imagen institucional en la peticion, entonces procesar
        if (array_key_exists('institution_picture', $input))
        {
            // eliminar la imagen previament almacenada
            Storage::disk('public')->delete(Institution::find($id)->institution_picture);
            // obtener la ruta de la nueva imagen y guardar
            $path_institutional_image = $request->file('institution_picture')->store('pictures', 'public');
            $input['institution_picture'] = $path_institutional_image;
        }

        // si se paso el icono en la peticion, entonces procesar
        if (array_key_exists('icon', $input))
        {
            // eliminar el icono previamente almacenado
            Storage::disk('public')->delete(Institution::find($id)->icon);
            // obtener la ruta del nuevo icono y guardar
            $path_icon = $request->file('icon')->store('icons', 'public');
            $input['icon'] = $path_icon;
        }

        $institution = \App\Institution::find($id);
        $institution->update($input);

        return redirect()->route('institutions.index')
                        ->with('success','Institución actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Institution::find($id)->delete();
        return redirect()->route('institutions.index')
                        ->with('success','Insitución eliminada exitosamente');
    }
}
