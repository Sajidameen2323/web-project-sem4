<!-- resources/views/components/layout.blade.php -->

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<script>
    function toggleSidebar() {
        document.querySelector('aside').classList.toggle('hidden');
    }
</script>

<body class="flex flex-col h-screen">
    <!-- Top bar -->
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <button class="mr-4 lg:hidden" onclick="toggleSidebar()">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div>My Website</div>
        </div>

        <div class="flex items-center">
            <div class="mr-4">John Doe</div>
            <img class="h-8 w-8 rounded-full" src="https://i.pravatar.cc/300" alt="Avatar">
        </div>
    </header>
    <!-- Side bar and main content -->
    <div class="flex flex-1">
        <!-- Side bar -->
        <aside class="bg-gray-200 p-4 w-64 hidden lg:block">
            <nav>
                <ul class="space-y-2">
                    <li><button class="w-full text-left px-4 py-2 rounded hover:bg-gray-300">Home</button></li>
                    <li><button class="w-full text-left px-4 py-2 rounded hover:bg-gray-300">About</button></li>
                    <li><button class="w-full text-left px-4 py-2 rounded hover:bg-gray-300">Contact</button></li>
                </ul>
            </nav>
        </aside>
        
        <!-- Main content -->
        <main class="bg-gray-100 p-4 flex-1">
            {{$slot}}
        </main>
    </div>
</body>

</html>