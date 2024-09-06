<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar Toggle Button (visible on mobile screens) -->
    <button id="sidebarToggle" class="bg-indigo-600 text-white p-3 fixed top-0 left-0 z-50 sm:hidden">
        <i class="bi bi-list"></i> Menu
    </button>

    <!-- Wrapper Div for Sidebar and Content -->
    <div class="flex">

        <!-- Sidebar -->
        <div id="sidebar"
            class="w-64 h-screen bg-indigo-600 text-white fixed top-0 left-0 transform -translate-x-full transition-transform duration-300 sm:relative sm:translate-x-0 z-40">
            <div class="p-6">
                <h1 class="text-2xl font-semibold mb-8">Admin Dashboard</h1>
                <nav class="flex-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.employees.index') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                        <i class="bi bi-people-fill"></i> Employee Management
                    </a>
                    <a href="{{ route('admin.attendances.index') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                        <i class="bi bi-folder-fill"></i> Attendance Records
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                        <i class="bi bi-calendar-fill"></i> Notifications and Alerts
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                        <i class="bi bi-file-earmark-fill"></i> Analytics and Reports
                    </a>
                </nav>

                <hr class="my-6 border-indigo-400" />

                <nav>
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700">
                        <i class="bi bi-gear-fill"></i> Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')"
                            class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            <span class="inline-block w-3 h-3 mr-2 bg-red-500 rounded-full"></span> {{ __('Log Out') }}
                        </a>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 sm:ml-64 transition-all duration-300">
            <!-- Top Navbar -->
            <div class="flex items-center justify-between p-6 bg-white border-b border-gray-200">
                <div>
                    <input type="text" placeholder="Search"
                        class="w-full max-w-xs py-2 px-4 rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="flex items-center space-x-4">
                    <button class="focus:outline-none">
                        <i class="bi bi-bell-fill"></i>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 p-6 bg-gray-100">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Overlay for mobile when sidebar is open -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden sm:hidden"></div>

    <!-- Include the Bootstrap Icons CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

    <!-- Toggle Sidebar Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</body>

</html>
