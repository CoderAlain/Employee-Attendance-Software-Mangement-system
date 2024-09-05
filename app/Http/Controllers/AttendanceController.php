<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //Define the company's latitude and longitude
    private $companyLatitude = 3.850203382675274;
    private $companyLongitude = 11.486376414652455;
    private $radius = 100; // Radius in meters within which the check-in is allowed

     // Define the company's working hours
    private $workStartTime = '08:00:00';
    private $workEndTime = '17:00:00';

    protected $fillable = ['user_id', 'date', 'check_in_time', 'check_out_time', 'is_late', 'is_absent'];

    protected $dates = ['check_in_time', 'check_out_time', 'date'];

    protected $check_in_time;

    // Display the attendance records
    public function index()
    {
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)->get();
        return view('attendance.index', compact('attendances'));
    }

    // Handle the check-in process
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Get the user's latitude and longitude from the request
        $userLatitude = 3.850203382675274; // Example latitude
    $userLongitude = 11.486376414652455; // Example longitude

        // Calculate the distance between the user's location and the company's location
        $distance = $this->calculateDistance($userLatitude, $userLongitude);

        // Check if the user is within the allowed radius
        if ($distance > $this->radius) {
            return redirect()->route('attendance.index')->with('error', 'You are not within the company location.');
        }

        // Check if the user has already checked in today
        $existingAttendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if (!$existingAttendance) {
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->date = $today->toDateString();
            $attendance->check_in_time = $this->getCurrentCheckInTime($today);
            $attendance->save();

            return redirect()->route('attendance.index')->with('success', 'Checked in successfully.');
        } else {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }
    }

    // Handle the check-out process
    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Check if the user has already checked in today
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if ($attendance && !$attendance->check_out_time) {
            // Set the check-out time
            $attendance->check_out_time = $this->getCurrentCheckOutTime();
            $attendance->save();

            return redirect()->route('attendance.index')->with('success', 'Checked out successfully.');
        } else {
            return redirect()->back()->with('error', 'You have either not checked in or already checked out today.');
        }
    }

    // Get the appropriate check-in time
    private function getCurrentCheckInTime()
    {
        $currentTime = Carbon::now();
        $workStartTime = Carbon::createFromTimeString($this->workStartTime);

        // If the current time is before work starts, use the work start time
        if ($currentTime->lt($workStartTime)) {
            return $workStartTime;
        }

        // Otherwise, use the current time
        return $currentTime;
    }

    // Get the appropriate check-out time
    private function getCurrentCheckOutTime()
    {
        $currentTime = Carbon::now();
        $workEndTime = Carbon::createFromTimeString($this->workEndTime);

        // If the current time is after work ends, use the work end time
        if ($currentTime->gt($workEndTime)) {
            return $currentTime;
        }

        // Otherwise, use the current time
        return $currentTime;
    }

    // Helper method to calculate the distance between two points
   private function calculateDistance($latitude, $longitude)
{
    $earthRadius = 6371000; // Earth's radius in meters

    $latFrom = deg2rad($this->companyLatitude);
    $lonFrom = deg2rad($this->companyLongitude);
    $latTo = deg2rad($latitude);
    $lonTo = deg2rad($longitude);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    
    return $angle * $earthRadius;
}

// Assume 8:00 AM is the start of the workday
    public function getIsLateAttribute()
    {
        $workStartTime = Carbon::createFromTime(8, 0, 0); // 8:00 AM
        return $this->check_in_time && $this->check_in_time->gt($workStartTime);
    }

    public function getIsAbsentAttribute()
    {
        // If there's no check-in time for today, the user is absent
        return !$this->check_in_time;
    }

}
