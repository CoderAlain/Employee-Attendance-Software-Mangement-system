<!-- resources/views/components/sidebar.blade.php -->

<!-- Sidebar Toggle Button (visible on small screens) -->
<button id="sidebarToggle" class="bg-indigo-600 text-white p-3 fixed top-0 left-0 z-50 sm:hidden">
    <i class="bi bi-list"></i> Menu
</button>

<!-- Sidebar -->
<div id="sidebar" class="w-64 h-screen bg-indigo-600 text-white fixed top-0 left-0 transform -translate-x-full transition-transform duration-300 sm:translate-x-0 z-40">
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-8">Employee View</h1>
        <nav class="flex-1">
            <a href="{{ route('employees.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="{{ route('attendance.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-house-door-fill"></i> Checkin
            </a>
            <a href="{{ route('profile.edit') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                <i class="bi bi-person-fill"></i> Profile
            </a>
        </nav>

        <hr class="my-6 border-indigo-400" />

        <nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </nav>
    </div>
</div>

<!-- Overlay for mobile when sidebar is open -->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden sm:hidden"></div>

<!-- Toggle Sidebar Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
