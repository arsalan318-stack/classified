<!-- resources/views/livewire/navbar.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
           <!-- Fonts -->
           <link rel="preconnect" href="https://fonts.bunny.net">
           <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
           <!-- Add this in your <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   
           <!-- Scripts -->
           @vite(['resources/css/app.css', 'resources/js/app.js'])
   
           <!-- Styles -->
           @livewireStyles
</head>
<body>
<nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
    <div>
        <a href="/" class="font-bold text-xl">MyApp</a>
    </div>

    <div class="space-x-4">
        @auth
            <span>Welcome</span>
            <button wire:click="logout" class="bg-red-500 px-3 py-1 rounded">Logout</button>
        @else
            <a href="/login" class="bg-blue-500 px-3 py-1 rounded">Login</a>
            <a href="/register" class="bg-green-500 px-3 py-1 rounded">Register</a>
        @endauth
    </div>
</nav>
@livewire('user.navbar')

</body>
</html>