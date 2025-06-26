<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>{{ $event->nom }} | ChronoSports-Tunisie</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{ asset('img/logoentete.png') }}" rel="icon" type="image/png">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* Hero Section */
        .hero-section {
            width: 100%;
            height: 50vh;
            background: url('{{ asset('storage/' . $event->image_couverture) }}') center center / cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .hero-content {
            position: relative;
            color: white;
            text-align: center;
            z-index: 2;
        }
        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* Navbar */
        .navbar {
            transition: all 0.4s ease;
            z-index: 999;
            position: fixed;
            width: 100%;
            padding: 15px 0;
            background-color: rgba(255, 255, 255, 0.2); /* Transparent initially */
            box-shadow: none;
        }
        .navbar.scrolled {
            background-color: #fff !important; /* Solid white when scrolled */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar .nav-link {
            color: white;
            transition: color 0.3s;
            font-weight: 600;
        }
        .navbar.scrolled .nav-link {
            color: black;
        }

        /* Logo */
        .navbar .navbar-brand img {
            max-width: 120px; /* Ensure logo is responsive */
        }

        /* Main Content */
        .event-content {
            margin-top: 90px;
            margin-bottom: 50px;
        }
        .event-description {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        /* Sidebar */
        .sidebar {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .sidebar img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .sidebar h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background: #0c0c0c;
            color: #bbb;
            padding: 30px 0 20px;
            font-size: 14px;
        }
        footer h5 {
            color: #fff;
            margin-bottom: 10px;
        }
        /* Sponsor Section */
.sponsors-section img {
    max-width: 100%;
    height: auto;
    object-fit: contain;

}
<style>
<style>
    .sponsor-marquee-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        background: linear-gradient(45deg, #fafafa, #f1f1f1); /* Soft gradient background */
        padding: 20px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    }

    .sponsor-marquee {
        display: flex;
        animation: scrollSponsors 30s linear infinite; /* Adjusted slower speed */
    }

    .sponsor-logo {
        flex: 0 0 auto;
        padding: 0 30px; /* Increased spacing for clarity */
        text-align: center;
    }

    .sponsor-logo img {
        height: 80px;  /* Slightly smaller size for a more balanced look */
        object-fit: contain;
        transition: transform 0.3s ease-in-out; /* Smooth hover effect */
    }

    .sponsor-logo img:hover {
        transform: scale(1.1); /* Subtle zoom effect on hover */
    }

    /* Keyframes for scrolling effect (left to right) */
    @keyframes scrollSponsors {
        0% {
            transform: translateX(0%); /* Start from the extreme left */
        }
        100% {
            transform: translateX(100%); /* Move to the extreme right */
        }
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .sponsor-logo {
            padding: 0 15px; /* Adjust padding for smaller screens */
        }

        .sponsor-logo img {
            height: 60px; /* Smaller logo on mobile */
        }
    }
</style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#info">INFO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#inscription">INSCRIT</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">

        </div>
    </div>

    <!-- Main Content -->
    <div class="container event-content" id="info">
        <div class="row g-5">
            <div class="col-lg-8">
                <h1>Bienvenue a {{ $event->nom }} evenement</h1>
                <div class="event-description">
                    <p class="mb-0">{!! $event->description !!}</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <h5 class="text-center mb-3">Rendez-vous sur la ligne de départ !</h5>
                    <img src="{{ asset('storage/' . $event->image_couverture) }}" alt="Event Image">
                    <div class="mt-3">
                        <h6><i class="fas fa-map-marker-alt me-2"></i>Lieu</h6>
                        <p class="mb-0">{{ $event->ville }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Sponsors Section -->
<div class="bg-light py-5 mt-5" style="background: #f9f9f9; padding: 40px 0;">
    <h4 class="text-center mb-4" style="font-size: 2rem; font-weight: 600; color: #333;">Nos Sponsors</h4>
    <div class="sponsor-marquee-container overflow-hidden">
        <div class="sponsor-marquee d-flex align-items-center">
            @foreach($event->sponsors as $sponsor)
                <div class="sponsor-logo mx-5">
                    <img src="{{ asset('storage/' . $sponsor->image) }}"
                         alt="{{ $sponsor->nom }}"
                         class="img-fluid">
                </div>
            @endforeach

        </div>
    </div>
</div>









    <!-- Footer -->
    <footer class="mt-5">
        <div class="container-fluid bg-dark1 text-light footer pt-5 mt-0">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title text-start text-primary fw-normal mb-4">Compagnie</h4>
                        <a class="btn btn-link" href="{{url('/')}}">Présentation</a>
                        <a class="btn btn-link" href="{{url('about')}}">QUI SOMMES-NOUS</a>
                        <a class="btn btn-link" href="{{url('service')}}">Nos Services</a>
                        <a class="btn btn-link" href="{{url('Calender')}}">Calendrier</a>
                        <a class="btn btn-link" href="{{url('inscription')}}">Inscription en ligne</a>
                        <a class="btn btn-link" href="{{url('contact')}}">Contact</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>B.P.18 Sfax El Jadida 3027 - Sfax - Tunisie</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+216 94 005 007</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@chrono-sports.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title text-start text-primary fw-normal mb-4">Ouverture</h4>
                        <h5 class="text-light fw-normal">Lundi - Dimanche</h5>
                        <p>08AM - 05PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>INSCRIPTION À LA NEWSLETTER</p>
                        <div class="position-relative w-100">
                            <input class="form-control bg-transparent border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email address">
                            <button type="button" class="btn btn-primary rounded-circle position-absolute top-50 end-0 translate-middle-y me-3">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Scroll Script -->
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

</body>

</html>
