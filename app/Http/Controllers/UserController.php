<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $take = $request->query('take', 10); // default 10 data
        $skip = $request->query('skip', 0); // default 0 data
        $search = $request->query('search');

        if ($search) {
            $user = User::where('name', 'like', '%' . $search . '%')
                ->take($take)
                ->skip($skip)
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role')
                ->get();
        } else {
            $user = User::take($take)->skip($skip)->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role')
                ->get();
        }
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        // $role = Role::find($request->role_id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        if ($request->role == 'admin') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->assignRole('admin');
        } elseif ($request->role == 'user') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->assignRole('user');
        }
        return response()
            ->json(
                [
                    'code' => '201',
                    'status' => 'success',
                    'data' => $user
                ],
                201
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // get data by id
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // validate request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        //update data user by id
        if ($request->role == 'admin') {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->syncRoles('admin');
        } elseif ($request->role == 'user') {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->syncRoles('user');
        }
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // delete data by id
        $user->delete();
        $user->removeRole($user->role);
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $user
            ],
            200
        );
    }
}
