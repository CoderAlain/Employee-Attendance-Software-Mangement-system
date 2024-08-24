    <!-- resources/views/dashboard.blade.php -->
    <x-slot name="title">Attendance Dashboard</x-slot>
    <x-app-layout>
        <x-main-content>
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">

            

                    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
                    <div>
                        <p>Total Employees: {{ $employeeCount }}</p>
                        <p>Total Attendance Records: {{ $attendanceCount }}</p>
                    </div>
                    <!-- Include partials, recent records, etc. -->

            </div>
        </x-main-content>

    </x-app-layout>
