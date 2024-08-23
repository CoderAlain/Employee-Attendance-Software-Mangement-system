<!-- resources/views/components/sidebar.blade.php -->
<div class="w-64 h-screen bg-indigo-600 text-white flex flex-col">
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-8">Atendances</h1>
        <nav class="flex-1">
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> DASHBOARD
            </a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> EMPLOYEES
            </a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> REPORTS
            </a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                <i class="bi bi-people-fill"></i> SETTINGS
            </a>
            
        </nav>

        <hr class="my-6 border-indigo-400" />


        <nav>
            <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
        </nav>
    </div>
</div>





<!-- Sidebar -->
      {{-- <div class="flex">
        <div class="w-64 h-screen bg-indigo-600 text-white flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-semibold mb-8">Dashboard</h1>
                <nav class="flex-1">
                    <x-nav-link> Dashboard</x-nav-link>
                    <x-nav-link> Team</x-nav-link>
                    <x-nav-link> Projects</x-nav-link>
                    <x-nav-link> Calendar</x-nav-link>
                    <x-nav-link> Documents</x-nav-link>
                    <x-nav-link> Reports</x-nav-link>
                </nav>

                <hr class="my-6 border-indigo-400" />

                <nav>
                    <x-nav-link> Settings</x-nav-link>
                </nav>
            </div>
        </div>
        </div> --}}