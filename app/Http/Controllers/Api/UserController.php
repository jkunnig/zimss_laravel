<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 📋 GET /api/users
    public function index()
    {
        return User::with('person')->get();
    }

    // ➕ POST /api/users
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'person_id' => 'required|exists:persons,id',
        ]);

        $user = User::create([
            //'name' => Person::find($request->person_id)->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'person_id' => $request->person_id,
        ]);

        return response()->json($user, 201);
    }

    // ✏️ PUT /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['email', 'person_id']));
        return response()->json($user);
    }

    // ❌ DELETE /api/users/{id} (soft delete later)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // we’ll change this to soft-delete if needed
        return response()->json(['message' => 'User deleted']);
    }
}
