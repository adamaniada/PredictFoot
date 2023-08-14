{{-- predictions.details.blade.php --}}

@php
    function outcomeClass($probability, $threshold) {
        return $probability >= $threshold ? 'text-success fw-bolder' : 'text-danger';
    }
@endphp

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
                <div class="card match-card">
                    <div class="card-header predictions-header text-white">
                        <span class="fw-bolder">{{ __('PREDICTIONS : ') }}</span>
                        {{ $predictionLabel }}
                    </div>

                    <div class="card-body">
                        @if(count($data) > 0)
                            @php
                                $dataByCountry = [];
                            @endphp

                            @foreach($data as $item)
                                @php
                                    $country = $item['country_name'];
                                    $league = $item['league_name'];

                                    if (!isset($dataByCountry[$country])) {
                                        $dataByCountry[$country] = [];
                                    }
                                    if (!isset($dataByCountry[$country][$league])) {
                                        $dataByCountry[$country][$league] = [];
                                    }
                                    $dataByCountry[$country][$league][] = $item;
                                @endphp
                            @endforeach

                            @foreach($dataByCountry as $countryName => $countryData)
                                <div class="match-header">{{ strtoupper($countryName) }}</div>
                                @foreach($countryData as $leagueName => $leagueData)
                                    <div class="league-name">{{ __('League : ') }} {{ $leagueName }}</div>
                                    @foreach($leagueData as $item)
                                        @php
                                            $matchStatus = $item['match_status'];
                                            $homeTeam = $item['match_hometeam_name'];
                                            $awayTeam = $item['match_awayteam_name'];
                                            $matchDate = $item['match_date'];
                                            $matchTime = date('H:i', strtotime($item['match_time']));
                                            $probability = $item[$option];
                                            $isFinished = $matchStatus == 'Finished';
                                            $outcomeClass = outcomeClass($probability, 90.00);
                                        @endphp
                                        <div class="match-details d-flex justify-content-between align-items-center">
                                            <span class="text-{{ $isFinished ? 'danger' : 'success' }}">{{ $matchStatus }}</span>
                                            <div class="team-details">
                                                <div class="team-name">{{ $homeTeam }}</div>
                                                <div class="match-time">
                                                    <a href="{{ route('predictions.show', ['matchId' => $item['match_id']]) }}">
                                                        {{ $matchDate }} à {{ $matchTime }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="win-probability">
                                                <div class="probability-info">
                                                    <div class="outcome">{{ __('Probabilité') }}</div>
                                                    <div class="{{ $outcomeClass }}">{{ $probability }}</div>
                                                </div>
                                            </div>
                                            <div class="team-details">
                                                <div class="team-name">{{ $awayTeam }}</div>
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

                    <div class="card-footer predictions-footer bg-light">
                        <div class="row">
                            <div class="text-center">
                                <span class="fw-bolder">{{ $option }}</span><br>{{ __('Probabilité') }} {{ $predictionLabel }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
