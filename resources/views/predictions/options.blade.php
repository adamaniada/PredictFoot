@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ Route::currentRouteName() == 'daily-predictions.options' ? __('Prédictions du jour') : __('Prédictions de la semaine') }}
                </div>
                <div class="card-body">
                    <p class="mb-3">{{ __('Choisissez une option de prédiction :') }}</p>
                    <div class="list-group">
                        @foreach($predictionsOptions as $option => $label)
                            @php
                                $routeName = Route::currentRouteName();
                                $routePrefix = $routeName == 'daily-predictions.options' ? 'daily-predictions' : 'weekly-predictions';
                            @endphp
                            <a href="{{ route("$routePrefix.show", $option) }}" class="list-group-item list-group-item-action mb-2">
                                <h5 class="mb-0">{{ __($label) }}</h5>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
