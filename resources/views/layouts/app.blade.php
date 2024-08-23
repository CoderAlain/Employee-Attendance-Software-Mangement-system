
<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard UI' }}</title>

    <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar Component -->
        <x-sidenavbar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar Component -->
            @include('layouts.navigation')

            <!-- Dynamic Content Slot -->
            <div class="flex-1 p-6 bg-gray-100">       
                    {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Icons CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
