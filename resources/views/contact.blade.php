@extends('template')
@section('contenu')
<!-- Contact Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">CONTACTEZ NOUS</h5>
            <h1 class="mb-5">Pour Plus D'informations</h1>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">International: </h5>
                        <p><i class="fas fa-phone-alt text-primary me-2"></i>+ 216 98 354 405</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">National : </h5>
                        <p><i class="fas fa-phone-alt text-primary me-2"></i>+216 94 005 007</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="section-title ff-secondary fw-normal text-start text-primary">E-mail :</h5>
                        <p><i class="fa fa-envelope-open text-primary me-2"></i>info@chrono-sports.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Map -->
                <div class="map-container" style="height: 300px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.639498428968!2d10.7557951!3d34.739480300000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1301d300622730c7%3A0xe03307c962ff31ac!2sMega%20Pixel!5e0!3m2!1sfr!2stn!4v1741661638470!5m2!1sfr!2stn"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen>
                    </iframe>
                </div>
                <p style="center">Find us at the location above!</p>
            </div>
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form method="POST" action="/contact/send">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="VOTRE NOM COMPLET"  value="{{@old('name')}}">
                                    <label for="name">VOTRE NOM COMPLET</label>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="VOTRE MAIL"value="{{@old('email')}}">
                                    <label for="email">VOTRE MAIL</label>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="subject" placeholder="OBJET DE VOTRE DEMANDE"value="{{@old('subject')}}">
                                    <label for="subject">OBJET DE VOTRE DEMANDE</label>
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" name="MESSAGE" style="height: 150px">{{@old('MESSAGE')}}</textarea>
                                    <label for="message">MESSAGE</label>
                                    @error('MESSAGE')
                                    <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Envoyer un Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
