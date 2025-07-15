<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // GET /api/employees
    public function index()
    {
        return response()->json(Employee::all(), 200);
    }

    // POST /api/employees
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'name_extension' => 'nullable|string|max:50',
            // add additional fields here if needed
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employee added successfully',
            'data' => $employee
        ], 201);
    }
}
