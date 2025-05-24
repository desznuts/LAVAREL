<!DOCTYPE html>
<html lang="en">
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
<body class="bg-gradient-to-r from-blue-50 via-white to-blue-50 text-gray-900 font-sans">
    <header class="bg-white shadow-md py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <h1 class="text-4xl font-extrabold tracking-tight text-teal-600 drop-shadow-md">
                Student Project Archive
            </h1>
            <nav class="flex-1 mx-6">
                <ul class="flex justify-center space-x-6 text-blue-600 font-medium">
                    <li><a href="#home" class="hover:text-blue-800 transition-colors duration-300">Home</a></li>
                    <li><a href="#features" class="hover:text-blue-800 transition-colors duration-300">Features</a></li>
                    <li><a href="#about" class="hover:text-blue-800 transition-colors duration-300">About</a></li>
                    <li><a href="#contact" class="hover:text-blue-800 transition-colors duration-300">Contact</a></li>
                </ul>
            </nav>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-800 transition-colors duration-300 ml-6">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-800 transition-colors duration-300 ml-6">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-800 transition-colors duration-300 ml-6">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-24">
        <section id="home" class="text-center fade-in-up max-w-3xl mx-auto">
            <h2 class="text-5xl font-extrabold mb-6 leading-tight tracking-tight text-gray-900">Explore &amp; Share Student Projects</h2>
            <p class="text-xl text-gray-700 mb-8 leading-relaxed">A digital archive for academic works, capstone projects, and innovations.</p>
            <a href="{{ route('dashboard') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-4 rounded-lg shadow-lg text-lg font-semibold transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">Browse Projects</a>
        </section>

        <section id="features" class="max-w-4xl mx-auto text-left">
            <h3 class="text-3xl font-bold text-teal-600 mb-6">Features</h3>
            <ul class="list-disc list-inside text-gray-800 space-y-2 text-lg">
                <li>Browse and search student projects easily</li>
                <li>Submit and share your own projects</li>
                <li>Organized by categories and academic years</li>
                <li>Secure user authentication and profiles</li>
                <li>Responsive and modern UI design</li>
            </ul>
        </section>

        <section id="about" class="max-w-4xl mx-auto text-left">
            <h3 class="text-3xl font-bold text-teal-600 mb-6">About</h3>
            <p class="text-gray-700 text-lg leading-relaxed mx-auto max-w-prose">
                The Student Project Archive is a platform designed to help students showcase their academic projects and innovations. It serves as a digital repository for capstone projects, research papers, and other academic works, fostering collaboration and knowledge sharing among students and educators.
            </p>
        </section>

        <section id="contact" class="max-w-4xl mx-auto text-left">
            <h3 class="text-3xl font-bold text-teal-600 mb-6">Contact</h3>
            <form action="#" method="POST" class="space-y-4 max-w-md mx-auto text-left">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" required />
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" required />
                </div>
                <div>
                    <label for="message" class="block text-gray-700 font-semibold mb-1">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" required></textarea>
                </div>
                <button type="submit" class="bg-teal-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-teal-700 transition-colors duration-300">Send Message</button>
            </form>
        </section>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm tracking-wider border-t border-gray-200">
        &copy; {{ date('Y') }} Student Project Archive. All rights reserved.
    </footer>
</body>
</html>
