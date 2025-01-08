<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .navbar {
            background: linear-gradient(135deg, #27547D, #35495E);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: white;
        }

        .hero {
            text-align: center;
            padding: 5rem 0;
            background: url('https://source.unsplash.com/1600x900/?technology') no-repeat center center/cover;
            color: white;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero h1 {
            position: relative;
            font-size: 3.5rem;
            font-weight: 700;
            z-index: 1;
        }

        .hero p {
            position: relative;
            font-size: 1.25rem;
            z-index: 1;
        }

        .btn-cta {
            background-color: #35495E;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-cta:hover {
            background-color: #2c3e50;
            transform: scale(1.05);
        }

        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0;
            height: 5px;
            background-color: #27547D;
            z-index: 1030;
            transition: width 0.2s;
        }

        .footer {
            background-color: #35495E;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Scroll Progress -->
        <div class="scroll-progress" id="scrollProgress"></div>

        <!-- Navbar -->
        @include('layouts.include.navbar')

        <!-- Hero Section -->
        <section class="hero">
            <div class="container position-relative">
                <h1>Transformez vos idées avec {{ config('app.name', 'Laravel') }}</h1>
                <p>Découvrez des solutions numériques innovantes pour votre entreprise.</p>
                <a href="#services" class="btn btn-cta">Explorez nos services</a>
            </div>
        </section>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
            <p><a href="#">Politique de confidentialité</a> | <a href="#">Conditions d utilisation</a></p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Scroll Progress Bar
        const scrollProgress = document.getElementById('scrollProgress');
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = `${scrollPercent}%`;
        });

        // Dark Mode Toggle
        const body = document.body;
        const toggleDarkMode = () => body.classList.toggle('dark-mode');
    </script>

    @stack('scripts')
</body>
</html>
