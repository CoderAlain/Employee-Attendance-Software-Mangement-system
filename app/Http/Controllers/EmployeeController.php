<?php


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;use App\Models\User; 
// use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;
// use App\Models\Attendance;

// class EmployeeController extends Controller
// {
//     // Display a listing of employees
//     public function index()
//     {
//         $user = Auth::user();

//         // Get all attendance records for the logged-in employee
//         $attendances = Attendance::where('user_id', $user->id)->get();

//         // Calculate total hours worked
//         $totalHoursWorked = $attendances->sum(function ($attendance) {
//             if ($attendance->check_in_time && $attendance->check_out_time) {
//                 return $attendance->check_out_time->diffInHours($attendance->check_in_time);
//             }
//             return 0;
//         });

//         // Count days late
//         $daysLate = $attendances->where('is_late', true)->count();

//         // Count absences
//         $absences = $attendances->where('is_absent', true)->count();

//         return view('employees.dashboard', compact('totalHoursWorked', 'daysLate', 'absences', 'attendances'));
//     }
 
//     // Show the form for creating a new employee
//     public function create()
//     {
//         return view('employees.create');
//     }

//     // Store a newly created employee in storage
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|min:6',
//             // Add other validation rules as needed
//         ]);

//         $employee = new User();
//         $employee->name = $request->input('name');
//         $employee->email = $request->input('email');
//         $employee->password = bcrypt($request->input('password')); // Hash the password
//         $employee->save();

//         return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
//     }

//     // Display the specified employee
//     public function show($id)
//     {
//         $employee = User::findOrFail($id);
//         return view('employees.show', compact('employee'));
//     }

//     // Show the form for editing the specified employee
//     public function edit($id)
//     {
//         $employee = User::findOrFail($id);
//         return view('employees.edit', compact('employee'));
//     }

//     // Update the specified employee in storage
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users,email,' . $id,
//             // Add other validation rules as needed
//         ]);

//         $employee = User::findOrFail($id);
//         $employee->name = $request->input('name');
//         $employee->email = $request->input('email');
//         if ($request->filled('password')) {
//             $employee->password = bcrypt($request->input('password')); // Hash the password
//         }
//         $employee->save();

//         return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
//     }

//     // Remove the specified employee from storage
//     public function destroy($id)
//     {
//         $employee = User::findOrFail($id);
//         $employee->delete();

//         return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
//     }
// }

 namespace App\Http\Controllers;

use App\Models\User; // Assuming User model is being used for employees
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees (Employee Directory).
     */
    public function index()
    {
        $employees = User::all(); // Fetch all employees
        $user = Auth::user();
        
            //  Get all attendance records for the logged-in employee
        $attendances = Attendance::where('user_id', $user->id)->get();

        // Calculate total hours worked
        $totalHoursWorked = $attendances->sum(function ($attendance) {
            if ($attendance->check_in_time && $attendance->check_out_time) {
                return $attendance->check_out_time->diffInHours($attendance->check_in_time);
            }
            return 0;
        });

        // Count days late
        $daysLate = $attendances->where('is_late', true)->count();

        // Count absences
        $absences = $attendances->where('is_absent', true)->count();

        

    // $user = Auth::user(); // Assuming you're using user authentication

    if ($user->role === 'admin') {
        // Return the admin view
        return view('admin.employees.index', compact('employees'));
    }

    // Return the employee view if the role is employee
    return view('employees.dashboard', compact('totalHoursWorked', 'daysLate', 'absences', 'attendances'));

    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created employee in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:employee,admin',
        ]);

        // Create new employee
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // Assuming role column distinguishes employee/admin
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id); // Fetch employee to edit
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in the database.
     */
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:employee,admin',
        ]);

        // Update employee details
        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $employee->password,
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee from the database.
     */
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete(); // Delete employee

        return redirect()->route('admin.employees.index')->with('success', 'Employee removed successfully!');
    }
}
