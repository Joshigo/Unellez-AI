<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\UserCredentialsMail;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $trainers = User::where('role_id', 3)
            ->orderBy('name', 'asc')
            ->paginate(5);

        $users = User::where('role_id', 4)
            ->orderBy('name', 'asc')
            ->paginate(5);

        $roles = Role::whereNotIn('id', [1, 2])->get()->map(function ($role) {
            if ($role->name === 'trainer') {
                $role->name = 'Entrenador';
            } elseif ($role->name === 'user') {
                $role->name = 'Usuario';
            }
            return $role;
        });

        $programs = Program::all();

        return view('user.index', compact('trainers', 'users', 'roles', 'programs'));
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $randomPassword = Str::random(8);

        Log::info('Nuevo cliente creado', [
            'email' => $validatedData['email'],
            'password' => $randomPassword
        ]);

        $validatedData['password'] = Hash::make($randomPassword);

        // Mail::to($validatedData['email'])->send(new UserCredentialsMail($randomPassword));
        User::create($validatedData);

        return redirect()->back()->with('success', 'Usuario creado con éxito.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        // $user = Auth::user();
        $roles = Role::whereNotIn('id', [1, 2])->get()->map(function ($role) {
            if ($role->name === 'trainer') {
                $role->name = 'Entrenador';
            } elseif ($role->name === 'user') {
                $role->name = 'Usuario';
            }
            return $role;
        });

        $programs = Program::all();

        return view('user.edit', compact('user', 'roles', 'programs'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validated();

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhereHas('program', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(5)
            ->appends(['query' => $query]);

        $roles = Role::whereNotIn('id', [1, 2])->get()->map(function ($role) {
            if ($role->name === 'trainer') {
                $role->name = 'Entrenador';
            } elseif ($role->name === 'user') {
                $role->name = 'Usuario';
            }
            return $role;
        });

        if ($request->ajax()) {
            return response()->json($users);
        }

        $programs = Program::all();

        return view('user.index', compact('users', 'roles', 'programs', 'query'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado con éxito.');
    }
}
