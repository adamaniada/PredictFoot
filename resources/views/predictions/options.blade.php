@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center bg-primary text-white py-3">
                    <h2>
                        {{ Route::currentRouteName() == 'daily-predictions.options' ? __('Prédictions du jour') : __('Prédictions de la semaine') }}
                    </h2>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-center text-muted">{{ __('Choisissez une option de prédiction :') }}</p>
                    <div class="list-group">
                        @foreach($predictionsOptions as $option => $label)
                            @php
                                $routeName = Route::currentRouteName();
                                $routePrefix = $routeName == 'daily-predictions.options' ? 'daily-predictions' : 'weekly-predictions';
                            @endphp
                            <a href="{{ route("$routePrefix.show", $option) }}" class="list-group-item list-group-item-action d-flex align-items-center shadow-sm rounded mb-3">
                                <div class="me-3">
                                    <i class="fas fa-futbol fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ __($label) }}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
