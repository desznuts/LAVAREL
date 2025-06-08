<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Project Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-300 font-sans">
    <header class="bg-gray-800 shadow-md py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/book.png') }}" alt="Book Logo" class="h-10 w-auto mr-4" />
                </a>
                <h1 class="text-4xl font-extrabold tracking-tight text-red-400 drop-shadow-md select-none">
                    Student Project Archive
                </h1>
            </div>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-teal-400 hover:text-teal-300 transition-colors duration-300 ml-6 font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-teal-400 hover:text-red-300 transition-colors duration-300 ml-6 font-medium">Login</a>
                    <a href="{{ route('register') }}" class="text-teal-400 hover:text-red-300 transition-colors duration-300 ml-6 font-medium">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="min-h-screen flex items-center justify-center px-6 py-12">
        <section id="home" class="text-center fade-in-up max-w-3xl mx-auto">
            <h2 class="text-5xl font-extrabold mb-6 leading-tight tracking-tight text-gray-100 select-none">
                Explore &amp; Share Student Projects
            </h2>
            <p class="text-lg text-gray-400 mb-8 leading-relaxed max-w-xl mx-auto">
                A digital archive for academic works, capstone projects, and innovations.
            </p>
            <a href="{{ route('projects.index') }}"
                class="inline-block bg-gradient-to-r from-red-500 to-red-400 hover:from-red-600 hover:to-red-500 text-white px-8 py-4 rounded-lg shadow-lg text-lg font-semibold transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-teal-400/60 focus:ring-offset-2 focus:ring-offset-gray-900">
                Browse Projects
            </a>
        </section>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm tracking-wider border-t border-gray-700 select-none">
        &copy; {{ date('Y') }} Student Project Archive. All rights reserved.
    </footer>
</body>
</html>
