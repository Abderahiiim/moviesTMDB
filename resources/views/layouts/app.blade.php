<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">

    <!-- Sidebar -->
    <span
        class="absolute text-white text-4xl top-5 left-4 cursor-pointer"
        onclick="openSidebar()">
        <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
    </span>

    <div
        class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
                <h1 class="font-bold text-gray-200 text-[15px] ml-3">TailwindCSS</h1>
                <i
                    class="bi bi-x cursor-pointer ml-28 lg:hidden"
                    onclick="openSidebar()">
                </i>
            </div>
            <div class="my-2 bg-gray-600 h-[1px]"></div>
        </div>

        <!-- Search Input -->
        <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
            <i class="bi bi-search text-sm"></i>
            <input
                type="text"
                placeholder="Search"
                class="text-[15px] ml-4 w-full bg-transparent focus:outline-none"
            />
        </div>

        <!-- Navigation Links -->
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-house-door-fill"> <a href="{{ route('admin.index') }}">Movies List</a></i>
            </span>
        </div>

        <div class="my-4 bg-gray-600 h-[1px]"></div>

        <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu">
            <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">Social</h1>
            <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">Personal</h1>
            <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">Friends</h1>
        </div>

        <!-- Logout Link -->
        <!-- Logout Link -->
        <form method="POST" action="{{ route('logout') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            @csrf
            <button type="submit" class="flex items-center">
                <i class="bi bi-box-arrow-in-right"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
            </button>
        </form>

    </div>

    <!-- Main Content -->
    <main class="w-3/4 ml-96">
        @yield('content') 
    </main>

    @stack('modals')

    @livewireScripts

    <script type="text/javascript">
        function dropdown() {
            document.querySelector("#submenu").classList.toggle("hidden");
            document.querySelector("#arrow").classList.toggle("rotate-0");
        }
        dropdown();

        function openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        }
    </script>
</body>
</html>
