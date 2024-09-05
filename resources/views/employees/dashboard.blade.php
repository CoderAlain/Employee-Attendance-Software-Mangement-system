    <!-- resources/views/dashboard.blade.php -->
    <x-slot name="title">Attendance Dashboard</x-slot>
    <x-app-layout>

        <x-main-content>

    <div class="container mx-auto p-6">
        <!-- Dashboard Heading -->
        <h1 class="text-4xl font-bold mb-6">Employee Dashboard</h1>

        <!-- Personal Attendance Summary Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Hours Worked -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Total Hours Worked</h2>
                <p class="text-4xl font-semibold text-indigo-600">{{ $totalHoursWorked }} hrs</p>
            </div>

            <!-- Days Late -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Days Late</h2>
                <p class="text-4xl font-semibold text-red-600">{{ $daysLate }} days</p>
            </div>

            <!-- Absences -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Days Absent</h2>
                <p class="text-4xl font-semibold text-red-600">{{ $absences }} days</p>
            </div>
        </div>

        <!-- Attendance History Table -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Attendance History</h2>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap bg-white rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Check In</th>
                            <th class="px-4 py-2">Check Out</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr class="text-gray-700">
                                <td class="border px-4 py-2">{{ $attendance->date->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2">{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : 'N/A' }}</td>
                                <td class="border px-4 py-2">
                                    @if ($attendance->is_absent)
                                        <span class="text-red-600 font-bold">Absent</span>
                                    @elseif ($attendance->is_late)
                                        <span class="text-yellow-600 font-bold">Late</span>
                                    @else
                                        <span class="text-green-600 font-bold">Present</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            
        </x-main-content>

    </x-app-layout>