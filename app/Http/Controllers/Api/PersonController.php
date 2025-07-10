<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    // GET /api/persons
    public function index()
    {
        return response()->json(Person::all());
    }

    // GET /api/persons/{id}
    public function show($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }
        return response()->json($person);
    }

    // POST /api/persons
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:20',
        ]);

        $person = Person::create($data);

        return response()->json($person, 201);
    }

    // PUT /api/persons/{id}
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:20',
        ]);

        $person->update($data);

        return response()->json($person);
    }
}
