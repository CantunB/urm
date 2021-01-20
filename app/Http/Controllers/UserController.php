<?php

namespace Smapac\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Smapac\AssignedAreas;
use Illuminate\Http\Request;
use Smapac\AssignedUserAreas;
use Smapac\Coordination;
use Smapac\Department;
use Smapac\User;
use Smapac\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_or_permission:create_users')->only(['create','store']);
        $this->middleware('role_or_permission:read_users')->only(['index','show']);
        $this->middleware('role_or_permission:update_users')->only(['edit','update']);
        $this->middleware('role_or_permission:delete_users')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id','NoEmpleado','name','rfc','email']);
            return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '
                <a href="' . route('usuarios.edit', $users->id) . '"
                data-id="'.$users->id.'"
                 class="btn btn-sm btn-warning"
                 title="Editar" >
                 <i class="fas fa-pencil-alt "></i>
                 </a>';
            })
            ->make(true);
            }
        return view('users.index');
    }
    public function create()
    {
        $roles = Role::pluck('name', 'id' );
        $coordinations = Coordination::all();
        return view('users.create', compact('roles','coordinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $request->all();
        $users = User::create($request->all());
        $users->password = bcrypt($request->password);
        if($users->save())
        {
            $users->coordinacion = $request->coordinacion;
            $users->depto = $request->departamento;
            $users->save();

            $users->roles()->attach($request->get('roles'));
            $area = AssignedAreas::where('coordination_id','=',$request->coordinacion)
            ->where('department_id','=',$request->departamento)
            ->first();
            $users->asignar()->attach($area->id);
        }
        return redirect()->route('usuarios.index')->with('success','Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id' );
        $coordinations = Coordination::all();
        return view('users.edit', compact('user','roles','coordinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
       // return $request->all();
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        $user->coordinacion = $request->coordinacion;
        $user->depto = $request->departamento;
        $user->save();

        $user->roles()->sync($request->get('roles'));
        $area = AssignedAreas::where('coordination_id','=',$request->coordinacion)
            ->where('department_id','=',$request->departamento)
            ->first();
        $user->asignar()->attach($area->id);
            return redirect('usuarios')->with('update', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $user = User::findOrFail($id);
        $user->delete();
        return back()->with('destroy','Usuario eliminido correctamente');
    }
}
