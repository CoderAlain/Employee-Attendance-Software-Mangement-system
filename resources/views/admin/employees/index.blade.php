<x-slot name="title">Attendance Dashboard</x-slot>
    <x-adminDashboard>

        <x-main-content>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-indigo-600 mb-8">Employee Directory</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.employees.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Add New Employee</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-indigo-600 text-white">
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Role</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2">{{ $employee->name }}</td>
                    <td class="px-4 py-2">{{ $employee->email }}</td>
                    <td class="px-4 py-2">{{ ucfirst($employee->role) }}</td>
                    <td class="px-4 py-2 flex space-x-4">
                        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </x-main-content>
    </x-adminDashboard>