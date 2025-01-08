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
        font-size: 20px;
        text-align: center;
        padding: 15px 10px;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .match-header {
        background-color: #6A8CCC;
        color: #FFFFFF;
        font-weight: 700;
        padding: 10px;
        border-radius: 0.375rem;
        margin-bottom: 10px;
    }

    .league-name {
        font-size: 16px;
        padding: 10px;
        background-color: #F8F9FA;
        border-left: 4px solid #6A8CCC;
        margin-bottom: 15px;
    }

    .match-card {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 0.375rem;
        border: none;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .match-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #EFEFEF;
    }

    .team-name {
        font-weight: 700;
        font-size: 14px;
    }

    .match-time a {
        text-decoration: none;
        color: #007BFF;
        font-size: 12px;
    }

    .match-time a:hover {
        text-decoration: underline;
    }

    .win-probability {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .outcome {
        font-weight: bold;
        font-size: 14px;
    }

    .probability {
        font-size: 16px;
        color: #17A2B8;
    }

    .alert-info {
        background-color: #E9F7FE;
        color: #31708F;
        border-radius: 0.375rem;
        padding: 15px;
        text-align: center;
    }

    .predictions-footer {
        background-color: #F8F9FA;
        padding: 10px;
        text-align: center;
        font-size: 14px;
        border-radius: 0 0 0.375rem 0.375rem;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card match-card">
                <div class="predictions-header">
                    {{ __('PREDICTIONS : ') }} {{ $predictionLabel }}
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
                                    <div class="match-details">
                                        <span class="badge bg-{{ $isFinished ? 'danger' : 'success' }}">
                                            {{ $matchStatus }}
                                        </span>
                                        <div>
                                            <div class="team-name">{{ $homeTeam }}</div>
                                            <div class="match-time">
                                                <a href="{{ route('predictions.show', ['matchId' => $item['match_id']]) }}">
                                                    {{ $matchDate }} à {{ $matchTime }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="win-probability">
                                            <div class="outcome">{{ __('Probabilité') }}</div>
                                            <div class="{{ $outcomeClass }}">{{ $probability }}%</div>
                                        </div>
                                        <div>
                                            <div class="team-name">{{ $awayTeam }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            {{ __('Aucune prédiction disponible pour l\'affichage.') }}
                        </div>
                    @endif
                </div>

                <div class="predictions-footer">
                    <span class="fw-bold">{{ $option }}</span><br>
                    {{ __('Probabilité') }} : {{ $predictionLabel }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
