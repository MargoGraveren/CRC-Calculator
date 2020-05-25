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
                <div class="tm-flex-center tm-flex-col">
                    <h2 class="tm-text-color-primary mb-4">CRC</h2>
                    <p>
                        CRC<i>(ang.Cyclic Redundancy Code, Cyclic Redundancy Check)</i> jest to cykliczny kod nadmiarowy, system sum kontrolnych,
                        który wykorzystywany jest do wykrywania przypadkowych błędów pojawiających się podczas
                        przesyłania i magazynowania danych binarnych.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0 text-center">
            <img src="img/image-01.jpg" alt="Image" class="img-fluid">
        </div>
    </section>

    <!-- 3rd Section -->
    <section class="row tm-section tm-mb-30">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0">
            <div class="tm-flex-center p-5 tm-bg-color-primary">
                <div class="tm-max-w-400 tm-flex-center tm-flex-col">
                    <h2 class="tm-text-color-primary mb-4" style="color: white">Opis działania</h2>
                    <!--<img src="img/image-04.jpg" alt="Image" class="rounded-circle mb-4">-->
                    <p class="tm-text-color-white  tm-font-thin mb-0">
                        1. Należy wprowadzić sygnał wejściowy. </br> Może być to dowolny ciąg znaków o dowolnej długości.
                    </p>
                    &nbsp
                    <p class="tm-text-color-white  tm-font-thin mb-0">
                        2. Należy wprowadzić przekłamane bity.
                        </br> Nie jest to pole wymagane.
                    </p>
                    &nbsp
                    <p class="tm-text-color-white  tm-font-thin mb-0">
                        3. Należy wybrać rodzaj CRC.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="tm-flex-center p-5">
                <div class="tm-md-flex-center">

                    {!! Form::open(['url'=>'crc']) !!}
                    <h2 class="tm-text-color-primary mb-4">Wprowadź sygnał wejściowy</h2>
                    <label class="form-group">
                        <input id="valueToConvert" type="text" class="form-control" name="valueToConvert" required>
                        <span>Sygnał wejściowy</span>
                        <span class="border"></span>
                    </label>
                    <h2 class="tm-text-color-primary mb-4">Bity do zakłamania</h2>
                    <div style=" display: flex; flex-direction: row">
                        <label class="form-group" style="width: 20%" >
                            <input id="error1" type="number" class="form-control" name="error1" min="0">
                            <span>Bit 1</span>
                            <span class="border"></span>
                        </label>
                        <label class="form-group" style="width: 20%" >
                            <input id="error2" type="number" class="form-control" name="error2" min="0">
                            <span>Bit 2</span>
                            <span class="border"></span>
                        </label>
                        <label class="form-group" style="width: 20%" >
                            <input id="error3" type="number" class="form-control" name="error3" min="0">
                            <span>Bit 3</span>
                            <span class="border"></span>
                        </label>
                        <label class="form-group" style="width: 20%" >
                            <input id="error4" type="number" class="form-control" name="error4" min="0">
                            <span>Bit 4</span>
                            <span class="border"></span>
                        </label>
                    </div>
                    <h2 class="tm-text-color-primary mb-4">Wybierz sygnał CRC</h2>
                    <div style="display: flex; flex-direction: row">
                        <button type="submit" class="zmdi zmdi-arrow-right" name="crcButton" value="CRC 16" >CRC 16
                        </button>
                        <button type="submit" class="zmdi zmdi-arrow-right" name="crcButton" value="CRC 16 SDLC" >CRC 16 SDLC
                        </button>
                        <button type="submit" class="zmdi zmdi-arrow-right" name="crcButton" value="CRC 32" >CRC 32
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center small tm-copyright-text mb-0" style="color: white; background-color: #818182">Copyright &copy;
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
