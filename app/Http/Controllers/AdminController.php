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

        // Fetch total employees
        $totalEmployees = User::count();

        // Fetch today's attendance data
        $today = Carbon::today();
        $attendances = Attendance::with('user')
            ->whereDate('date', $today)
            ->get();

        // Employees present today
        $presentToday = $attendances->where('is_absent', false)->count();

        // Employees absent today
        $absentToday = $attendances->where('is_absent', true)->count();

        // Employees late today
        $lateToday = $attendances->where('is_late', true)->count();

        // Real-time attendance updates (all employees and their statuses)
        $realTimeAttendance = $attendances;

        // Pass data to the view
        return view('admin.dashboard', compact('totalEmployees', 'presentToday', 'absentToday', 'lateToday', 'realTimeAttendance', 'employeeCount', 'attendanceCount', 'recentAttendances' ));
    }
 
    
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
        // Calculate the difference in minutes and convert to hours
        $minutesWorked = $attendance->check_out_time->diffInMinutes($attendance->check_in_time);
        return $minutesWorked / 60; // Convert minutes to hours
       }
        return 0;
    });

    // Format total work hours to 3 decimal places
    $totalWorkHours = number_format($totalWorkHours, 3);


        $totalAbsences = $attendances->where('is_absent', true)->count();

     
        // Return the report view with the data
        return view('admin.reports.attendance', compact('attendances', 'totalWorkHours', 'totalAbsences', 'startDate', 'endDate'));
    }

}

    // Manage Employees
    
    // Other admin methods can go here...

