<!-- resources/views/components/sidebar.blade.php -->
<div class="w-64 h-screen bg-indigo-600 text-white flex flex-col">
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-8">Employee view</h1>
        <nav class="flex-1">
            <a href="{{ route('employees.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="{{ route('attendance.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> Checkin
            </a>
            <a href="{{ route('profile.edit') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> Profile
            </a>
        </nav>

        <hr class="my-6 border-indigo-400" />

        <nav>
            <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
        </nav>
    </div>
</div>




