<x-slot name="title">Attendance Form</x-slot>

<x-app-layout>
    <x-main-content>
        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-bold text-indigo-600 mb-8">Attendance Records</h1>

            <!-- Success and Error Alerts -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Check-In Form -->
            <form action="{{ route('attendance.checkin') }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-48">
                    Check In
                </button>
            </form>

            <!-- Check-Out Form -->
            <form action="{{ route('attendance.checkout') }}" method="POST" class="mb-6">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full md:w-48">
                    Check Out
                </button>
            </form>

            <!-- Attendance Records Table -->
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Attendance History</h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="px-4 py-2 text-left">Date</th>
                            <th class="px-4 py-2 text-left">Check In Time</th>
                            <th class="px-4 py-2 text-left">Check Out Time</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $attendance->date->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2">{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : '-' }}</td>
                                <td class="border px-4 py-2">{{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : '-' }}</td>
                                <td class="border px-4 py-2">
                                    <span class="font-bold {{ $attendance->is_absent ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $attendance->is_absent ? 'Absent' : 'Present' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Geolocation Script -->
        <script>
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                });
            }
        </script>
    </x-main-content>
</x-app-layout>
