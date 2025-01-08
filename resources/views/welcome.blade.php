@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white bg-primary text-center">
                    <h1>{{ __('Bienvenue sur notre site de prédictions de football') }}</h1>
                </div>
                <div class="card-body">
                    <div class="intro-text text-center py-3">
                        <h2 class="mb-3 text-primary">Analyse et Prédictions</h2>
                        <p class="text-muted">
                            Ici, vous trouverez des prédictions basées sur des analyses et des statistiques approfondies. Prenez des décisions éclairées pour vos paris ou suivez simplement vos équipes préférées !
                        </p>
                    </div>

                    <!-- Latest News Section -->
                    <div class="latest-news bg-light p-4 rounded mb-4">
                        <h2 class="text-success">Dernières actualités</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">⚽ Nouvelles mises à jour sur les matchs à venir</li>
                            <li class="list-group-item">📊 Analyses approfondies des performances des équipes</li>
                            <li class="list-group-item">🚑 Informations sur les blessures et les suspensions</li>
                        </ul>
                    </div>

                    <!-- Our Services Section -->
                    <div class="our-services p-4 rounded" style="background-color: #f8f9fa;">
                        <h2 class="text-warning">Nos services</h2>
                        <div class="row g-3">
                            <div class="col-md-4 text-center">
                                <i class="fas fa-chart-line fa-3x text-primary mb-2"></i>
                                <p class="fw-bold">Prédictions quotidiennes</p>
                                <p class="text-muted">Pour les principales ligues.</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-lightbulb fa-3x text-success mb-2"></i>
                                <p class="fw-bold">Conseils d'experts</p>
                                <p class="text-muted">Maximisez vos chances de succès.</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-futbol fa-3x text-danger mb-2"></i>
                                <p class="fw-bold">Scores en direct</p>
                                <p class="text-muted">Suivez les résultats en temps réel.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-dark text-white text-center py-3">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
