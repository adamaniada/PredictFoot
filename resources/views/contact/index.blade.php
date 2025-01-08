@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Notification de succès -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Carte de contact -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">@lang('Contactez-nous')</h4>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-muted">@lang("Si vous avez des questions ou des commentaires, n'hésitez pas à nous contacter :")</p>

                    <!-- Formulaire -->
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <!-- Nom -->
                        <div class="mb-4">
                            <label for="name" class="form-label">@lang('Nom')</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="@lang('Entrez votre nom complet')"
                                required>
                        </div>

                        <!-- Adresse e-mail -->
                        <div class="mb-4">
                            <label for="email" class="form-label">@lang('Adresse e-mail')</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="@lang('Entrez une adresse e-mail valide')"
                                required>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label for="message" class="form-label">@lang('Message')</label>
                            <textarea
                                class="form-control"
                                id="message"
                                name="message"
                                rows="5"
                                placeholder="@lang('Saisissez votre message ici...')"
                                required></textarea>
                        </div>

                        <!-- Bouton d'envoi -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-envelope-fill me-2"></i>@lang('Envoyer')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
