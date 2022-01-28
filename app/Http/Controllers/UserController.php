<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * @var $user User
         */
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user =  User::create($request->only(['name', 'email', 'password']));
        if($request->has('role_ids')) {
            $request->validate([
                'role_ids' => 'array',
                'role_ids.*' => 'string|exists:mongodb.roles,_id'
            ]);
            $user->user_roles()->createMany(array_map(function ($value) {
                return ['role_id' => $value];
            }, $request->input('role_ids')));
        }
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with('user_roles')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        if($request->has('role_ids')) {
            $request->validate([
                'role_ids' => 'array',
                'role_ids.*' => 'string|exists:mongodb.roles,_id'
            ]);
            $user->user_roles()->delete();
            $user->user_roles()->createMany(array_map(function ($value) {
                return ['role_id' => $value];
            }, $request->input('role_ids')));
        }
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::findOrFail($id)->delete();
    }
}
