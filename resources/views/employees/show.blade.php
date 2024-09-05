<!-- resources/views/employees/show.blade.php -->
<x-slot name="title">Attendance Dashboard</x-slot>
    <x-app-layout>

        <x-main-content>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Employee Details</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">{{ $employee->name }}</h2>

            <div class="mb-4">
                <label class="font-semibold">Email:</label>
                <p class="text-gray-700">{{ $employee->email }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Position:</label>
                <p class="text-gray-700">{{ $employee->position ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Date of Joining:</label>
                <p class="text-gray-700">{{ $employee->created_at->format('d M Y') }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Department:</label>
                <p class="text-gray-700">{{ $employee->department ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Phone Number:</label>
                <p class="text-gray-700">{{ $employee->phone ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Address:</label>
                <p class="text-gray-700">{{ $employee->address ?? 'N/A' }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('employees.index') }}" class="text-blue-500 hover:underline">Back to Employee List</a>
            </div>
        </div>
    </div>
 </x-main-content>
    </x-app-layout>