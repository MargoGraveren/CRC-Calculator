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

    <!-- 1th Section -->
    <section class="row tm-section tm-mb-30">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="tm-flex-center pl-5 pr-5 pt-5 pb-5">
                <div class="tm-md-flex-center">
                    <h2 class="mb-4 tm-text-color-primary">Kalkulator CRC</h2>
                    <p><span>Wprowadzona wartość: {{ $valueToConvert }}</span></p>
                    <p> Wartość w postaci binarnej: {{ $valueInBinary }}</p>
                    <a href="{{ asset('crc') }}" class="btn btn-primary float-lg-right tm-md-align-center">Powrót</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 text-xl-right text-md-center text-center mt-5 mt-lg-0 pr-lg-0">
            <img src="img/image-02.jpg" alt="Image" class="img-fluid">
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