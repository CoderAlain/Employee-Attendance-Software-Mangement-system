<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)->get();
        return view('attendance.index', compact('attendances'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Check if user is within company location
        $companyLocation = Location::first();
        if (!$companyLocation->isWithinCompanyLocation($request->latitude, $request->longitude)) {
            return redirect()->route('attendance.index')->with('error', 'You are not within the company location.');
        }

        $existingAttendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if (!$existingAttendance) {
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->date = $today->toDateString();
            $attendance->check_in_time = $this->getCheckInTime($today);
            $attendance->save();
        } else {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }

        return redirect()->route('attendance.index')->with('success', 'Checked in successfully.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if ($attendance && !$attendance->check_out_time) {
            $attendance->check_out_time = $this->getCheckOutTime($today);
            $attendance->save();
        } else {
            return redirect()->back()->with('error', 'You have either not checked in or already checked out today.');
        }

        return redirect()->route('attendance.index')->with('success', 'Checked out successfully.');
    }

    private function getCheckInTime($date)
    {
        if ($date->isSaturday()) {
            return Carbon::createFromTime(9, 0, 0);
        } elseif ($date->isWeekday()) {
            return Carbon::createFromTime(8, 0, 0);
        }

        return null;
    }

    private function getCheckOutTime($date)
    {
        if ($date->isSaturday()) {
            return Carbon::createFromTime(14, 0, 0);
        } elseif ($date->isWeekday()) {
            return Carbon::createFromTime(17, 0, 0);
        }

        return null;
    }

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
