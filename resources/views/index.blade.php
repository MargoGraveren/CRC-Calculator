<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Teleinformatyka">
    <meta name="author" content="Paulina Garbarz">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ URL::asset('css/templatemo-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.scss') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css.map') }}" rel="stylesheet">

    <title>Podstawy teleinformatyki</title>




</head>

<body>


<div class="container">

    <!-- 1st section -->
    <section class="row tm-section">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0">
            <div class="tm-flex-center p-5 tm-bg-color-primary tm-section-min-h">
                <h1 class="tm-text-color-white tm-site-name">Podstawy teleinformatyki</h1>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tm-flex-center p-5">
                <div class="tm-md-flex-center">
                    <h2 class="tm-text-color-primary mb-4">Laboratorium 2</h2>
                    <p class="tm-text-color-gray mb-4">Detekcja i korekcja błędów w transmisji danych.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2nd section -->
    <section class="row tm-section tm-col-md-reverse">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tm-flex-center p-5">
                <div class="tm-md-flex-center">

                    <form action="">
                        <h2 class="tm-text-color-primary mb-4">Wprowadź sygnał wejściowy</h2>
                        <label class="form-group">
                            <input type="text" class="form-control"  required>
                            <span>Sygnał wejściowy</span>
                            <span class="border"></span>
                        </label>
                        <h2 class="tm-text-color-primary mb-4">Wybierz sygnał CRC</h2>
                        <button class="zmdi zmdi-arrow-right">CRC 16
                        </button>
                        <button class="zmdi zmdi-arrow-right">CRC 16 REVERSE
                        </button>
                        <button class="zmdi zmdi-arrow-right">CRC 32
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0">
            <div class="tm-flex-center p-5 tm-bg-color-primary">
                <div class="tm-max-w-400 tm-flex-center tm-flex-col">
                    <h2 class="tm-text-color-primary mb-4" style="color: white">CRC 16</h2>
                    <!--<img src="img/image-04.jpg" alt="Image" class="rounded-circle mb-4">-->
                    <p class="tm-text-color-white small tm-font-thin mb-0">Tutaj info jakieś o tych CRC</p>
                    &nbsp
                    <h2 class="tm-text-color-primary mb-4" style="color: white">CRC 16 REVERSE</h2>
                    <p class="tm-text-color-white small tm-font-thin mb-0">Tutaj info jakieś o tych CRC</p>
                    &nbsp
                    <h2 class="tm-text-color-primary mb-4" style="color: white">CRC 32</h2>
                    <p class="tm-text-color-white small tm-font-thin mb-0">Tutaj info jakieś o tych CRC</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3rd Section -->
    <section class="row tm-section tm-mb-30">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0 text-center">
            <img src="img/image-01.jpg" alt="Image" class="img-fluid">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tm-flex-center p-5">
                <div class="tm-flex-center tm-flex-col">
                    <h2 class="tm-text-color-primary mb-4">Tutaj Haming</h2>
                    <h2 class="tm-text-color-primary mb-4">I kontrola parzystości</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- 4th Section -->
    <section class="row tm-section tm-mb-30">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="tm-flex-center pl-5 pr-5 pt-5 pb-5">
                <div class="tm-md-flex-center">
                    <h2 class="mb-4 tm-text-color-primary">Nullam auctor ornare finibus</h2>
                    <p>Cras eu dolor lorem. Cras justo mauris, rhoncus in mauris ac, pellentesque pulvinar metus. Suspendisse consectetur consequat diam, ac dignissim mauris gravida vitae. Vestibulum blandit vestibulum mi a viverra.</p>
                    <p class="mb-4">Fusce porta lectus vel elit condimentum porttitor. Maecenas at quam congue, sollicitudin risus quis, ultricies enim. Vivamus sodales, tellus ac quismod dignissim, metus ligula porttitor enim.</p>
                    <p class="mb-4">Sed fermentum odio mollis libero iaculis ultrices. Mauris et nibh mi. Nullam vel sapien dolor. Vestibulum ipsum quam, aliquet ac pharetra in, suscipit eu risus. Etiam rutrum eros ultrices, consectetur felis ultrices, vehicula purus.</p>
                    <a href="#" class="btn btn-primary float-lg-right tm-md-align-center">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 text-xl-right text-md-center text-center mt-5 mt-lg-0 pr-lg-0">
            <img src="img/image-02.jpg" alt="Image" class="img-fluid">
        </div>
    </section>

    <!-- 6th Section -->
    <section class="row">
        <div class="col-lg-12  pl-5 pr-5">
            <h2 class="tm-container-inner tm-text-color-white">Application Form</h2>
        </div>
        <div class="col-lg-12 tm-bg-color-gray tm-text-color-white tm-font-thin tm-form-footer">
            <div class="row tm-container-inner">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="tm-footer-info-box">
                        <h4>Lorem ipsum dolor</h4>
                        <address>
                            1010 Vivamaus viverra<br>
                            Leo vel porttitor sodales<br>
                            Non eleifend 10980
                        </address>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="tm-footer-info-box">
                        <p>Maecenas fermentum<br>
                            Nam eu justo et urna<br>
                            Semper maximus libero<br>
                            Etiam magna quam</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center small tm-copyright-text mb-0">Copyright &copy;
                <span class="tm-current-year">2020</span> Paulina Garbarz</p>
        </div>
    </div>
</div>
<!-- load JS -->
<script src="js/jquery-3.2.1.slim.min.js"></script>         <!-- https://jquery.com/ -->
<script>

    /* DOM is ready
    ------------------------------------------------*/
    $(function(){

        if(renderPage) {
            $('body').addClass('loaded');
        }

        $('.tm-current-year').text(new Date().getFullYear());  // Update year in copyright
    });

</script>

</body>
</html>