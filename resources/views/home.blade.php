<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-16 sm:px-6 lg:px-8">
            <div
                class="relative isolate overflow-hidden bg-gray-400 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-10 md:px-16 md:pt-24 lg:flex lg:gap-x-16 lg:px-24 lg:pt-0">
                <!-- Background Gradient -->
                <svg viewBox="0 0 1024 1024"
                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 transform [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                    aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#gradient)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="gradient">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" />
                        </radialGradient>
                    </defs>
                </svg>

                <!-- Left Section (Text and CTA) -->
                <div class="mx-auto max-w-md text-center lg:text-left lg:mx-0 lg:flex-auto lg:py-32">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">Hi Welcome.<br>Let's
                        get you checked in now.</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-300">Login, check in, and everything is good. Don't forget
                        to check out.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                        <a href="{{ route('login') }}"
                            class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get
                            started</a>
                    </div>
                </div>

                <!-- Right Section (Image) -->
                <div class="relative mt-16 h-80 lg:mt-6 lg:flex lg:justify-end">
                    <img src="{{ asset('images/leave.jpeg') }}" alt="Laravel Image"
                        class="absolute left-1/2 transform -translate-x-1/2 lg:static lg:translate-x-0 lg:left-0 w-[22rem] md:w-[28rem] lg:w-[35rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                        width="1824" height="1080">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
