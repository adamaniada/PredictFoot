<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #35495E; color: #FFFFFF;">
    <style>
        .navbar-nav .nav-link {
            color: #FFFFFF; /* Set the text color to white */
        }
    </style>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: #FFFFFF;">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('daily-predictions.options') }}">Prédictions du jour</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('weekly-predictions.options') }}">Prédictions de la semaine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vip.options') }}">Vip</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Autres</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('search.advanced-form') }}">Recherche avancée</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Autre</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contactForm') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
