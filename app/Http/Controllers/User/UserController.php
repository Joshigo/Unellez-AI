<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $trainers = User::where('role_id', 3)
            ->orderBy('name', 'asc')
            ->get();

        $users = User::where('role_id', 4)
            ->orderBy('name', 'asc')
            ->get();

        return view('user.index', compact('trainers', 'users'));
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->back()->with('success', 'Usuario creado con éxito.');
    }
}
