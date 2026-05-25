<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    public function store(StoreUserRequest $request)
    {
{
    $user = User::create($request->validated());

    return response()->json([
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }



       public function update(UpdateUserRequest $request, User $user)
{
    $users->update($request->validated());

    return response()->json([
        'message' => 'User updated successfully',
        'data' => $user
    ], 200);
}

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
