<x-slot name="title">Attendance Dashboard</x-slot>
    <x-app-layout>

        <x-main-content>

<h1>
    Hello Employee view
</h1>

   <h1 class="text-2xl font-bold">Employees</h1>
    <ul>
        @foreach($employees as $employee)
            <li>{{ $employee->name }}</li>
        @endforeach
    </ul>

        </x-main-content>
    </x-app-layout>