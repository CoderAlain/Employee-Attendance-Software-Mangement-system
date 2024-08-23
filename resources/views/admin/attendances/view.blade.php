<!-- resources/views/admin/attendances/view.blade.php -->
{{-- @extends('layouts.admin') --}}

{{-- @section('content') --}}
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Attendance Records for {{ $employee->name }}</h1>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Check In Time</th>
                    <th class="px-4 py-2">Check Out Time</th>
                    <th class="px-4 py-2">Status</th>
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
{{-- @endsection --}}
