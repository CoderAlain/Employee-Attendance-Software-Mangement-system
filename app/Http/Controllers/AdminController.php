<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    // Display the admin dashboard
    public function index()
    {
        // Gather some data for the dashboard (example data)
        $employeeCount = User::count();
        $attendanceCount = Attendance::count();
        $recentAttendances = Attendance::orderBy('created_at', 'desc')->take(5)->get();

        // Return a view with this data
        return view('admin.dashboard', compact('employeeCount', 'attendanceCount', 'recentAttendances'));

        // Gather some data for the dashboard (example data)
    
    }

    // Other admin methods can go here...
    public function manageEmployees()
    {
        // Fetch all employees
        $employees = User::all();
        
        // Return a view with the employees data
        return view('admin.employees.index', compact('employees'));
    }

     // Manage Attendance Records
    public function manageAttendance()
    {
        // Fetch all attendance records
        $attendances = Attendance::with('user')->get();

        // Return a view with the attendance data
        return view('admin.attendances.index', compact('attendances'));
    }

     // View Attendance for a Specific Employee
    public function viewEmployeeAttendance($employeeId)
    {
        $employee = User::findOrFail($employeeId);
        $attendances = Attendance::where('user_id', $employeeId)->get();
        
        return view('admin.attendances.view', compact('employee', 'attendances'));
    }


    // Generate Attendance Reports
    public function generateMonthlyReport(Request $request)
    {
        $user = Auth::user();
        $startDate = Carbon::parse($request->input('start_date'))->startOfMonth();
        $endDate = Carbon::parse($request->input('end_date'))->endOfMonth();

        $attendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Calculate work hours, overtime, absences
        $totalWorkHours = $attendances->sum(function ($attendance) {
            if ($attendance->check_in_time && $attendance->check_out_time) {
                return $attendance->check_out_time->diffInHours($attendance->check_in_time);
            }
            return 0;
        });

        $totalAbsences = $attendances->where('is_absent', true)->count();

     
        // Return the report view with the data
        return view('admin.reports.attendance', compact('attendances', 'totalWorkHours', 'totalAbsences', 'startDate', 'endDate'));
    }

}

    // Manage Employees
    
    // Other admin methods can go here...

