<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ChronoSports-Tunisie</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{URL::asset('img/logoentete.png')}}" rel="icon" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <!-- Spinner Start -->
        <div id="spinner" class="show position-fixed w-100 vh-100 top-50 start-50 translate-middle bg-white d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="{{url('/')}}" class="navbar-brand p-0">
                <!--  <h1 class="text-primary m-0"><i class="far fa-clock"></i></i> ChronoSports-Tunisie</h1>-->
                    <img src="{{asset('img/logo.png')}}" alt="Logo" width="80px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{url('/')}}" class="nav-item nav-link">Présentation</a>
                        <a href="{{url('about')}}" class="nav-item nav-link">QUI SOMMES-NOUS</a>
                        <a href="{{url('service')}} "class="nav-item nav-link">Nos Services</a>
                        <a href="{{url('Calender')}}" class="nav-item nav-link">Calendrier</a>
                        <a href="{{ route('public.events') }}" class="nav-item nav-link">Inscription en ligne</a>


                        <a href="{{url('contact')}}" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="{{url('resultats')}}" class="btn btn-primary py-2 px-4"id="btn1">Tous les résultats</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">

                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft" style="text-shadow: 4px 5px 13px rgb(0, 0, 0)">SERVICE DE<br>CHRONOMÉTRAGE SPORTIF</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2"></p>
                            <a href="{{url('devis')}}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft" id="btn2">Login</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="" alt="" width="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @yield('contenu')

        <!-- Footer Start -->
        <div class="container-fluid bg-dark1 text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Compagnie</h4>
                        <a class="btn btn-link" href="{{url('/')}}">Présentation</a>
                        <a class="btn btn-link" href="{{url('about')}}">QUI SOMMES-NOUS</a>
                        <a class="btn btn-link" href="{{url('service')}}">Nos Services</a>
                        <a class="btn btn-link" href="{{url('Calender')}}">Calendrier</a>
                        <a class="btn btn-link" href="{{url('inscription')}}">Inscription en ligne</a>
                        <a class="btn btn-link" href="{{url('contact')}}">Contact</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>B.P.18 Sfax El Jadida 3027 - Sfax - Tunisie</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+216 94 005 007</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@chrono-sports.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/chronosportstunisie"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/chronosportstunisie"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/channel/UCRjS6yk-BOraoMM0dlq0Z_A/videos"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/chronosportstunisie"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Ouverture</h4>
                        <h5 class="text-light fw-normal">Lundi - Dimanche</h5>
                        <p>08AM - 05PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>INSCRIPTION À LA NEWSLETTER</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre E-mail">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">ChronoSports-Tunisie</a>, All Right Reserved. | 2025 |


							Devloped By <a class="border-bottom" href="https://mega-pixel.tn">MEGA PIXEL</a><br><br>
                        </div>
                        <div class="col-md-6 text-center text-md-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>
