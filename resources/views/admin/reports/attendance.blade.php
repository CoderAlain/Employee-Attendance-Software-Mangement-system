{{-- @extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Monthly Attendance Report</h1>

        <p><strong>Period:</strong> {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</p>
        <p><strong>Total Work Hours:</strong> {{ $totalWorkHours }}</p>
        <p><strong>Total Absences:</strong> {{ $totalAbsences }}</p>

        <h2 class="text-xl font-semibold mt-6">Attendance Records</h2>
        <table class="table table-bordered w-full text-left">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Check In Time</th>
                    <th class="border px-4 py-2">Check Out Time</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td class="border px-4 py-2">{{ $attendance->date->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : '-' }}</td>
                        <td class="border px-4 py-2">{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : '-' }}</td>
                        <td class="border px-4 py-2">{{ $attendance->is_absent ? 'Absent' : 'Present' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}

<!-- resources/views/admin/reports/attendance.blade.php -->


<x-slot name="title">Attendance Dashboard</x-slot>
    <x-app-layout>

        <x-main-content>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Attendance Report</h1>

        <p><strong>Report Period:</strong> {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</p>
        <p><strong>Total Work Hours:</strong> {{ $totalWorkHours }} hours</p>
        <p><strong>Total Absences:</strong> {{ $totalAbsences }}</p>

        <h2 class="text-xl font-semibold mt-6">Detailed Attendance Records</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Employee Name</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Check In Time</th>
                    <th class="px-4 py-2">Check Out Time</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td class="border px-4 py-2">{{ $attendance->user->name }}</td>
                        <td class="border px-4 py-2">{{ $attendance->date->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : '-' }}</td>
                        <td class="border px-4 py-2">{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : '-' }}</td>
                        <td class="border px-4 py-2">{{ $attendance->is_absent ? 'Absent' : 'Present' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </x-main-content>
    </x-app-layout>
