<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $role;
    protected $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }


    public function index(Request $request)
    {
        $search = $request->get(key:'q');

        $roles = $this->role->latest('id')->where(column:'name', operator:'like', value:'%'.$search.'%')->paginate(3);
        return view('admin.role.index', compact('roles','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permission->all()->groupBy('group');

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['guard_name'] = 'web';
        $role = $this->role->create($dataCreate);
        $role->permissions()->attach($dataCreate['permission_ids']);
        return redirect()->route('roles.index')->with(['message' => 'create role success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->role->with('permissions')->findOrFail($id);
        $permissions = $this->permission->all()->groupBy('group');

        return view('admin.role.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $role = $this->role->findOrFail($id);
        $dataUpdate = $request->all();
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permission_ids']);
        return redirect()->route('roles.index')->with(['message' => 'update role success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->role->destroy($id);
        return redirect()->route('roles.index')->with(['message' => 'delete role success']);
    }
}