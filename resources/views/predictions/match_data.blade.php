@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            @php
                $predictionsCollection = collect($data);
                $predictionsByCountry = $predictionsCollection->groupBy('country_name');
            @endphp

            @foreach ($predictionsByCountry as $country => $predictionsByLeague)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">{{ $country }}</div>
                    <div class="card-body">
                        @foreach ($predictionsByLeague->groupBy('league_name') as $league => $predictions)
                            <h5 class="fw-bolder mt-3">{{ $league }}</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Heure</th>
                                            <th>Status</th>
                                            <th>Equipe 1</th>
                                            <th>Scores</th>
                                            <th>W1 - W2</th>
                                            <th>Equipe 2</th>
                                            <th>Predictions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($predictions as $match)
                                            <tr>
                                                <td>{{ $match['match_time'] }}</td>
                                                <td>{{ $match['match_status'] }}</td>
                                                <td>{{ $match['match_hometeam_name'] }}</td>
                                                <td>
                                                    {{ $match['match_hometeam_score'] }} {{ __('-') }} {{ $match['match_awayteam_score'] }}
                                                </td>
                                                <td>
                                                    {{ $match['prob_HW'] }} {{ __('-') }} {{ $match['prob_AW'] }}
                                                </td>
                                                <td>{{ $match['match_awayteam_name'] }}</td>
                                                <td>
                                                    {{ $match['match_hometeam_extra_score'] }} {{ __('-') }} {{ $match['match_awayteam_extra_score'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

