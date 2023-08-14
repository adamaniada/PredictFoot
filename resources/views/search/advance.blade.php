{{-- search.advance.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="col-md-8 mb-3">
            <h1>Advanced Search</h1>
            <div class="card">
                <div class="card-header">{{ __('Recherche avancée') }}</div>

                <div class="card-body">
                    <form action="{{ route('search.result') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="startDate">Start Date:</label>
                                    <input type="date" id="startDate" name="startDate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="endDate">End Date:</label>
                                    <input type="date" id="endDate" name="endDate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="predictionsOptions">Predictions Options:</label>
                                    <select id="predictionsOptions" name="predictionsOptions" class="form-select">
                                        @foreach($predictionsOptions as $option => $label)
                                            <option value="{{ $option }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="predictionsOptions">Proba:</label>
                                    <select id="predictionsPercent" name="predictionsPercent" class="form-select">
                                        <option value="80.00">{{ __('>= 80.00') }}</option>
                                        <option value="90.00">{{ __('>= 90.00') }}</option>
                                        <option value="100.00">{{ __('>= 100.00') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
