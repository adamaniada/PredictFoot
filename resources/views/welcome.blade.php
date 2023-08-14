@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenue sur notre site de prédictions de football') }}</div>

                <div class="card-body">
                    <div class="intro-text">
                        {{ $startOfWeek = date('Y-m-d', strtotime('monday this week')) }}
                        {{ $endOfWeek = date('Y-m-d', strtotime('sunday this week')) }} 
                        <h2>Bienvenue sur notre site de prédictions de football</h2>
                        <p>Ici, vous trouverez des prédictions pour les matchs de football à venir, basées sur des analyses et des statistiques.</p>
                        <p>Nous fournissons des prédictions pour une variété de ligues et de compétitions, afin que vous puissiez prendre des décisions éclairées lors de vos paris ou simplement pour suivre les résultats de vos équipes préférées.</p>
                        <p>Notre équipe d'experts travaille dur pour vous fournir les meilleures prédictions possibles, mais n'oubliez pas que le football est un sport imprévisible et que les résultats réels peuvent varier.</p>
                        <p>Explorez nos prédictions du jour et de la semaine pour commencer à profiter de nos services. Nous vous souhaitons une expérience agréable sur notre site!</p>
                    </div>

                    <div class="latest-news">
                        <h2>Dernières actualités</h2>
                        <ul>
                            <li>Nouvelles mises à jour sur les matchs à venir</li>
                            <li>Analyses approfondies des performances des équipes</li>
                            <li>Informations sur les blessures et les suspensions</li>
                        </ul>
                    </div>

                    <div class="our-services">
                        <h2>Nos services</h2>
                        <ul>
                            <li>Prédictions quotidiennes pour les principales ligues</li>
                            <li>Conseils d'experts pour maximiser vos chances de succès</li>
                            <li>Suivi en direct des scores et des résultats</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
