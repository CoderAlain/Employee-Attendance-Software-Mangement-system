<x-adminDashboard>

    <div class="container mx-auto p-6">
        <!-- Dashboard Title -->
        <h1 class="text-4xl font-bold text-indigo-600 mb-8">Admin Dashboard</h1>

        <!-- Overview of Attendance Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Employees -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Total Employees</h2>
                <p class="text-4xl font-semibold text-indigo-600">{{ $totalEmployees }}</p>
            </div>

            <!-- Employees Present Today -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Present Today</h2>
                <p class="text-4xl font-semibold text-green-600">{{ $presentToday }}</p>
            </div>

            <!-- Employees Absent Today -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Absent Today</h2>
                <p class="text-4xl font-semibold text-red-600">{{ $absentToday }}</p>
            </div>

            <!-- Employees Late Today -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Late Today</h2>
                <p class="text-4xl font-semibold text-yellow-600">{{ $lateToday }}</p>
            </div>
        </div>

        <!-- Real-Time Attendance Updates -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Real-Time Attendance Updates</h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="px-4 py-2 text-left">Employee Name</th>
                            <th class="px-4 py-2 text-left">Check In Time</th>
                            <th class="px-4 py-2 text-left">Check Out Time</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($realTimeAttendance as $attendance)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $attendance->user->name }}</td>
                                <td class="border px-4 py-2">
                                    {{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : '-' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : '-' }}
                                </td>
                                <td class="border px-4 py-2">
                                    <span class="font-bold {{ $attendance->is_late ? 'text-yellow-600' : ($attendance->is_absent ? 'text-red-600' : 'text-green-600') }}">
                                        {{ $attendance->is_absent ? 'Absent' : ($attendance->is_late ? 'Late' : 'Present') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-adminDashboard>
