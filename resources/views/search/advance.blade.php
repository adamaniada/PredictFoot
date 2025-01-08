{{-- search.advance.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <h1>Advanced Search</h1>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">{{ __('Recherche avancée') }}</div>
                <div class="card-body">
                    <form action="{{ route('search.result') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="startDate" class="form-label">Start Date:</label>
                                    <input type="date" id="startDate" name="startDate" class="form-control shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="endDate" class="form-label">End Date:</label>
                                    <input type="date" id="endDate" name="endDate" class="form-control shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="predictionsOptions" class="form-label">Predictions Options:</label>
                                    <select id="predictionsOptions" name="predictionsOptions" class="form-select shadow-sm">
                                        @foreach($predictionsOptions as $option => $label)
                                            <option value="{{ $option }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="predictionsPercent" class="form-label">Proba:</label>
                                    <select id="predictionsPercent" name="predictionsPercent" class="form-select shadow-sm">
                                        <option value="80.00">{{ __('>= 80.00') }}</option>
                                        <option value="90.00">{{ __('>= 90.00') }}</option>
                                        <option value="100.00">{{ __('>= 100.00') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
