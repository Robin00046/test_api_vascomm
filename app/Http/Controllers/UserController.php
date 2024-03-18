<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all user data
        $user = User::all();
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed, required'
        ]);
        //store data to database
        $user = User::create($request->all());
        return response()->json(
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
            'password' => 'confirmed, required'
        ]);
        //update data user by id
        $user->update($request->all());
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
