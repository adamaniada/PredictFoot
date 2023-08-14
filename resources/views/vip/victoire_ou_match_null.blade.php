{{-- predictions.details.blade.php --}}

@extends('layouts.app')

@push('styles')
<style>
    .predictions-header {
        background-color: #35495E;
        color: #FFFFFF;
        font-size: 18px;
    }

    .league-name {
        font-size: 14px;
        padding: 5px;
        background-color: #F2F2F2;
        border-top: 1px solid #ECECEC;
        border-bottom: 1px solid #ECECEC;
        margin-top: 5px;
    }

    /* Augmentez la taille de la police pour les écrans de taille moyenne et supérieure */
    @media (min-width: 768px) {
        .league-name {
            font-size: 16px;
        }
    }

    .match-card {
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .match-header {
        font-size: 16px;
        padding: 10px;
        background-color: #6a8ccc;
        color: white;
        font-weight: 900;
    }

    .match-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .team-details {
        flex: 1;
        text-align: center;
    }

    .team-name {
        font-weight: bold;
        font-size: 12px;
    }

    .match-time {
        font-size: 10px;
    }

    .win-probability {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 10px;
    }

    .probability-info {
        text-align: center;
        margin-left: 5px;
        margin-right: 5px;
    }

    .outcome {
        font-weight: bold;
    }

    .percentage {
        color: #17A2B8;
        font-weight: 900;
    }

    .predictions-footer {
        font-size: 12px;
        background-color: #F2F2F2;
        padding: 5px;
    }
</style>
@endpush

@push('styles')
<style>
    /* ... les styles existants ... */

    /* Styles pour les boutons de tri */
    .btn-group {
        margin-bottom: 10px;
    }

    .btn-group button {
        border-radius: 0;
    }
    .tri-button.active {
        background-color: #17A2B8; /* Couleur de fond pour le bouton actif */
        color: #FFFFFF; /* Couleur du texte pour le bouton actif */
    }
</style>
@endpush

@push('scripts')
<script>
    // JavaScript pour changer l'apparence du bouton actif
    const buttons = document.querySelectorAll('.tri-button');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Supprimer la classe active de tous les boutons
            buttons.forEach(b => b.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            button.classList.add('active');
        });
    });
</script>
@endpush

@push('scripts')
<script>
    // JavaScript pour soumettre le formulaire lorsque le bouton est cliqué
    const buttons = document.querySelectorAll('.tri-button');
    const form = document.getElementById('tri-form');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Ajouter une valeur au formulaire pour indiquer le filtre
            const filterValue = button.getAttribute('data-filter');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'filter';
            input.value = filterValue;
            form.appendChild(input);

            // Soumettre le formulaire
            form.submit();
        });
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="col-md-12 mb-4">
            <!-- Formulaire de tri -->
            <div class="d-sm-flex justify-content-sm-between align-items-center">
                <div class="btn-group" role="group" aria-label="Tri">
                    <form method="GET" action="{{ route('vip.victoire_ou_match_null') }}">
                        <input type="hidden" name="filter" value="avant-hier">
                        <button type="submit" class="btn btn-secondary tri-button">Avant Hier</button>
                    </form>
                    <form method="GET" action="{{ route('vip.victoire_ou_match_null') }}">
                        <input type="hidden" name="filter" value="hier">
                        <button type="submit" class="btn btn-secondary tri-button">Hier</button>
                    </form>
                    <form method="GET" action="{{ route('vip.victoire_ou_match_null') }}">
                        <input type="hidden" name="filter" value="aujourd-hui">
                        <button type="submit" class="btn btn-secondary tri-button">Aujourd'hui</button>
                    </form>
                    <form method="GET" action="{{ route('vip.victoire_ou_match_null') }}">
                        <input type="hidden" name="filter" value="demain">
                        <button type="submit" class="btn btn-secondary tri-button">Demain</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <!-- Afficher les dates sélectionnées -->
            <div class="alert alert-info">
                {{ __('Plage de dates sélectionnée :') }}
                {{ __('De') }} {{ $from }} {{ __('à') }} {{ $to }}
            </div>
            <div class="card match-card">
                <div class="card-header predictions-header text-white">
                    <span class="fw-bolder">{{ __('PREDICTIONS : ') }}</span>
                    {{ __('Victoire ou Match Nul') }}
                </div>
                <div class="card-body">
                    @if (count($data) > 0)
                    @php
                        $dataByCountry = collect($data)->groupBy('country_name');
                    @endphp

                    @foreach ($dataByCountry as $countryName => $countryData)
                        <div class="match-header">{{ strtoupper($countryName) }}</div>
                        @foreach ($countryData->groupBy('league_name') as $leagueName => $leagueData)
                            <div class="league-name">{{ __('League : ') }} {{ $leagueName }}</div>
                            @foreach ($leagueData as $item)
                                @php
                                    $isFinished = $item['match_status'] === 'Finished';
                                    $probHW = $item['prob_HW'];
                                    $probD = $item['prob_D'];
                                    $probAW = $item['prob_AW'];
                                @endphp
                                <div class="match-details d-flex justify-content-between align-items-center">
                                    <span class="text-{{ $isFinished ? 'danger' : 'success' }}">{{ $item['match_status'] }}</span>
                                    <div class="team-details">
                                        <div class="team-name">{{ $item['match_hometeam_name'] }}</div>
                                        <div class="match-time">
                                            <a href="{{ route('predictions.show', ['matchId' => $item['match_id']]) }}">
                                                {{ $item['match_date'] }} à {{ date('H:i', strtotime($item['match_time'])) }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="win-probability">
                                        @foreach (['HW' => $probHW, 'N' => $probD, 'AW' => $probAW] as $outcome => $probability)
                                            <div class="probability-info">
                                                <div class="outcome">{{ __($outcome) }}</div>
                                                <div class="{{ $probability >= ($outcome === 'HW' || $outcome === 'AW' ? 90.00 : 50.00) ? 'text-success fw-bolder' : 'text-danger' }}">
                                                    {{ $probability }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="team-details">
                                        <div class="team-name">{{ $item['match_awayteam_name'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                    @else
                        <div class="alert alert-info mt-4">
                            {{ __('Aucune prédiction disponible pour l\'affichage.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
