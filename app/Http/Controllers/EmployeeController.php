<?php


namespace App\Http\Controllers;

use App\Models\User; // Assuming you're using the User model for employees
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display a listing of employees
    public function index()
    {
        $employees = User::all();
        return view('employees.index', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        return view('employees.create');
    }

    // Store a newly created employee in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // Add other validation rules as needed
        ]);

        $employee = new User();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = bcrypt($request->input('password')); // Hash the password
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Display the specified employee
    public function show($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    // Show the form for editing the specified employee
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // Update the specified employee in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            // Add other validation rules as needed
        ]);

        $employee = User::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        if ($request->filled('password')) {
            $employee->password = bcrypt($request->input('password')); // Hash the password
        }
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Remove the specified employee from storage
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}

