<x-slot name="title">Attendance Form</x-slot>
<x-app-layout>

    <x-main-content>
        <div class="container mx-auto p-6">
            <h1 class="text-2xl font-bold mb-4">Attendance Records</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('attendance.checkin') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <button type="submit" class="btn btn-primary">Check In</button>
            </form>

            <form action="{{ route('attendance.checkout') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-danger">Check Out</button>
            </form>

            <h2 class="text-xl font-semibold">Attendance Records</h2>
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
                            <td class="border px-4 py-2">
                                {{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : '-' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $attendance->check_out_time ? $attendance->check_out_time->format('H:i:s') : '-' }}
                            </td>
                            <td class="border px-4 py-2">{{ $attendance->is_absent ? 'Absent' : 'Present' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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
