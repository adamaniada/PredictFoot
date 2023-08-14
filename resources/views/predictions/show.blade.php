@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">Match Predictions</h2>
            @if(isset($data))
                @foreach ($data as $match)
                    @php
                        $statusColor = 'bg-info'; // Default color for upcoming matches
                        if ($match['match_status'] === 'FT') {
                            $statusColor = 'bg-success';
                        } elseif ($match['match_status'] === 'HT') {
                            $statusColor = 'bg-warning';
                        }
                    @endphp

                    <div class="card mb-4 {{ $statusColor }}">
                        <div class="card-header text-white">
                            {{ $match['country_name'] }} - {{ $match['league_name'] }}
                        </div>
                        <div class="card-body">
                            <p class="mb-2">Match Date: {{ $match['match_date'] }}</p>
                            <p class="mb-2">Match Time: {{ $match['match_time'] }}</p>
                            <p class="mb-2">Match Status: {{ $match['match_status'] }}</p>
                            <p class="mb-4">
                                <span class="fw-bold fs-5 text-primary">{{ $match['match_hometeam_name'] }}</span>
                                <span class="fs-3">VS</span>
                                <span class="fw-bold fs-5 text-primary">{{ $match['match_awayteam_name'] }}</span>
                            </p>
                            <p class="mb-4">Home Team Score: {{ $match['match_hometeam_score'] }}</p>
                            <p class="mb-4">Away Team Score: {{ $match['match_awayteam_score'] }}</p>
                            <!-- Add more match information as needed -->

                            <h5 class="fw-bold mb-3">Probabilities:</h5>
                            <ul class="list-unstyled">
                                <li>Home Win (HW): <span class="badge bg-primary">{{ $match['prob_HW'] }}%</span></li>
                                <li>Draw (D): <span class="badge bg-primary">{{ $match['prob_D'] }}%</span></li>
                                <li>Away Win (AW): <span class="badge bg-primary">{{ $match['prob_AW'] }}%</span></li>
                                <!-- Add more probabilities as needed -->
                            </ul>

                            <h5 class="fw-bold mb-3">Over/Under:</h5>
                            <ul class="list-unstyled">
                                <li>Over (O): <span class="badge bg-primary">{{ $match['prob_O'] }}%</span></li>
                                <li>Under (U): <span class="badge bg-primary">{{ $match['prob_U'] }}%</span></li>
                                <!-- Add more Over/Under probabilities as needed -->
                            </ul>

                            <h5 class="fw-bold mb-3">Both Teams to Score (BTS):</h5>
                            <p class="mb-4">{{ $match['prob_bts'] }}%</p>

                            <h5 class="fw-bold mb-3">Asian Handicap:</h5>
                            <ul class="list-unstyled">
                                <li>Handicap +4.5 (AH H 4.5): <span class="badge bg-primary">{{ $match['prob_ah_h_45'] }}%</span></li>
                                <li>Handicap -4.5 (AH A 4.5): <span class="badge bg-primary">{{ $match['prob_ah_a_45'] }}%</span></li>
                                <!-- Add more Asian Handicap probabilities as needed -->
                            </ul>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No predictions available for this match.</p>
            @endif
        </div>
    </div>
</div>
@endsection
