@extends('template')

@section('contenu')
<style>
    :root {
        --primary: #ff0000;
        --primary-dark: #cc0000;
        --secondary: #333333;
        --light-bg: #f5f5f5;
        --text-dark: #333;
        --text-light: #fff;
        --border-radius: 3px;
        --box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }

    body {
        background-color: #f5f5f5;
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Event header/banner */
    .event-banner {
        position: relative;
        height: 180px;
        background-color: #fff;
        margin-bottom: 20px;
        box-shadow: var(--box-shadow);
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .event-banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Navigation */
    .event-nav {
        background-color: #fff;
        border-bottom: 1px solid #e1e1e1;
        margin-bottom: 20px;
    }

    .nav-container {
        display: flex;
        justify-content: flex-end;
        padding: 0;
    }

    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        padding: 10px 15px;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .nav-item a {
        color: #666;
        text-decoration: none;
    }

    .nav-item a:hover {
        color: var(--primary);
    }

    /* Title section */
    .event-title-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .event-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .event-by {
        font-size: 16px;
        color: #666;
        font-weight: normal;
    }

    .contact-btn {
        background-color: white;
        border: 1px solid #ddd;
        padding: 8px 15px;
        border-radius: var(--border-radius);
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    .contact-btn i {
        margin-right: 5px;
    }

    /* Event info bar */
    .event-info-bar {
        background-color: var(--primary);
        color: white;
        border-radius: var(--border-radius);
        padding: 8px 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .event-info-bar i {
        margin-right: 5px;
    }

    .event-info-item {
        margin-right: 20px;
        font-size: 13px;
        display: flex;
        align-items: center;
    }

    /* Epreuve section */
    .epreuve-list {
        margin-bottom: 30px;
    }

    .epreuve-item {
        display: flex;
        margin-bottom: 10px;
        background-color: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
    }

    .epreuve-time {
        width: 80px;
        background-color: var(--primary);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 15px 0;
        font-weight: bold;
    }

    .epreuve-time-icon {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .epreuve-content {
        flex: 1;
        padding: 15px;
        position: relative;
    }

    .epreuve-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 10px 0;
    }

    .epreuve-details {
        display: flex;
        flex-wrap: wrap;
        font-size: 13px;
        color: #666;
    }

    .epreuve-detail {
        margin-right: 15px;
        margin-bottom: 5px;
    }

    .epreuve-price {
        color: var(--primary);
        font-weight: 600;
    }

    .epreuve-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: var(--border-radius);
        text-decoration: none;
        margin-left: 5px;
        font-weight: 500;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-outline {
        background-color: white;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    /* Footer */
    .site-footer {
        background-color: #222;
        color: #999;
        padding: 30px 0;
        margin-top: 50px;
        font-size: 13px;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .footer-section {
        margin-bottom: 20px;
    }

    .footer-title {
        color: white;
        font-size: 14px;
        margin-bottom: 15px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .footer-payment-logos {
        display: flex;
        align-items: center;
    }

    .footer-payment-logo {
        height: 30px;
        margin-right: 15px;
    }

    .footer-contact {
        color: #999;
        margin-bottom: 5px;
    }

    .footer-copyright {
        border-top: 1px solid #444;
        padding-top: 15px;
        text-align: center;
        margin-top: 30px;
        font-size: 12px;
        color: #777;
    }

    /* No events message */
    .no-events {
        background-color: white;
        padding: 30px;
        text-align: center;
        border-radius: var(--border-radius);
        color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .epreuve-actions {
            position: static;
            margin-top: 15px;
        }

        .event-title-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .contact-btn {
            margin-top: 10px;
        }
    }
</style>



<div class="container">
    <!-- Event Banner -->


    <!-- Event Title Section -->
    <div class="event-title-section">
        <h1 class="event-title">
            Les Foulées de {{ ucfirst($event->nom) }}
        </h1>


    </div>

    <!-- Event Info Bar -->
    <div class="event-info-bar">
        <div class="event-info-item">
            <i class="ti-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
        </div>

        <div class="event-info-item">
            <i class="ti-location-pin"></i> {{ $event->ville }}
        </div>

        <div class="event-info-item">
            <i class="ti-tag"></i> {{ $event->type }}
        </div>
    </div>

    <!-- Epreuves List -->
    <div class="epreuve-list">
        @if($epreuves && $epreuves->count() > 0)
            @foreach ($epreuves as $epreuve)
                <div class="epreuve-item">
                    <div class="epreuve-time">
                        <div class="epreuve-time-icon">
                            <i class="ti-timer"></i>
                        </div>
                        <div>{{ \Carbon\Carbon::parse($epreuve->date_debut)->format('H:i') }}</div>
                    </div>

                    <div class="epreuve-content">
                        <h3 class="epreuve-title">
                            {{ $epreuve->nom }}
                        </h3>

                        <div class="epreuve-details">
                            <div class="epreuve-detail">
                                <strong>Distance:</strong> {{ $epreuve->nom }}
                            </div>

                            <div class="epreuve-detail">
                                <strong>Tarif:</strong> <span class="epreuve-price">{{ number_format($epreuve->tarif, 2) }} TND</span>
                            </div>

                            <div class="epreuve-detail">
                                <strong>Sexe:</strong> {{ $epreuve->genre }}
                            </div>

                            <div class="epreuve-detail">
                                <strong>Clôture:</strong> {{ \Carbon\Carbon::parse($epreuve->inscription_date_fin)->format('d M Y') }}
                            </div>
                        </div>

                        <div class="epreuve-actions">
                            <a href="{{ route('inscription.create', [$event->id, $epreuve->id]) }}" class="btn-action btn-primary">
                                Inscription individuelle
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-events">
                <p>Aucune épreuve n'est disponible pour cet événement.</p>
            </div>
        @endif
    </div>
</div>


@endsection
