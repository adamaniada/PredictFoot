@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Predictions VIP') }}</h4>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-muted">{{ __('Choisissez une option de prédiction parmi les suivantes :') }}</p>
                    <div class="list-group">
                        <!-- Victoire ou Match nul -->
                        <a href="{{ route('vip.victoire_ou_match_null') }}" class="list-group-item list-group-item-action d-flex align-items-center mb-3 shadow-sm rounded">
                            <div class="me-3 text-primary">
                                <i class="bi bi-trophy" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ __('Victoire ou Match nul') }}</h5>
                                <small class="text-muted">Faites vos prédictions pour une victoire ou un match nul</small>
                            </div>
                        </a>

                        <!-- Total -->
                        <a href="{{ route('vip.total') }}" class="list-group-item list-group-item-action d-flex align-items-center mb-3 shadow-sm rounded">
                            <div class="me-3 text-success">
                                <i class="bi bi-bar-chart-line" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ __('Total') }}</h5>
                                <small class="text-muted">Prédisez les totaux pour les matchs</small>
                            </div>
                        </a>

                        <!-- Double chance -->
                        <a href="{{ route('vip.double_chance') }}" class="list-group-item list-group-item-action d-flex align-items-center mb-3 shadow-sm rounded">
                            <div class="me-3 text-warning">
                                <i class="bi bi-shield-check" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ __('Double chance') }}</h5>
                                <small class="text-muted">Doublez vos chances de prédictions</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
