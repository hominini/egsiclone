<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra el listado de recursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Muestra el formulario de creación de usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions = DB::table('institutions')->pluck('name', 'id');
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles', 'institutions'));
    }


    /**
     * Almacena un usuario.
     *
     * @param   \App\Http\Requests\StoreUser $request
     * @param   \App\Repositories\UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request, UserRepository $userRepository)
    {
        // se almacena el usuario
        $user = $userRepository->create($request);

        // se le asigna un rol al usuario
        $user->assignRole($request->input('roles'));

        // token del usuario
        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        // se le envia un email al usuario con un enlace para que establezca su clave
        $user->sendPasswordResetNotification($token);

        return redirect()->route('users.index')
                        ->with('success','Usuario creado exitosamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $institution = $user->institution;
        return view('users.show',compact('user', 'institution'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $institutions = DB::table('institutions')->pluck('name', 'id');

        return view('users.edit',compact('user','roles','userRole', 'institutions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\StoreUser $request
     * @param   \App\Repositories\UserRepository $userRepository
     * @param   number $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, UserRepository $userRepository, $id)
    {
        // se actualiza el usuario
        $user = $userRepository->update($request, $id);

        // se borra todos los roles previos
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        // se asigna los roles nuevos
        $user->assignRole($request->input('roles'));

        // se redirecciona
        return redirect()->route('users.index')
                        ->with('success','Usuario actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','Usuario eliminado exitosamente');
    }
}
