@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Predictions Vip') }}
                </div>
                <div class="card-body">
                    <p class="mb-3">{{ __('Choisissez une option de prédiction :') }}</p>
                    <div class="list-group">
                        <a href="{{ route("vip.victoire_ou_match_null") }}" class="list-group-item list-group-item-action mb-2">
                            <h5 class="mb-0">Victoire ou Match null</h5>
                        </a>
                        <a href="{{ route("vip.total") }}" class="list-group-item list-group-item-action mb-2">
                            <h5 class="mb-0">Total</h5>
                        </a>
                        <a href="{{ route("vip.double_chance") }}" class="list-group-item list-group-item-action mb-2">
                            <h5 class="mb-0">Double chance</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
