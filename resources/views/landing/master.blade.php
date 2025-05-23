<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clothes Store</title>
    <!--===============================================================================================-->	
	    <link rel="icon" type="image/png" href="../../assets/images/icons/favicon.png">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/slick/slick.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../assets/css/util.css">
        <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">

        <!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


        <style>
            .margin-bottom {
                margin-bottom: 20px; /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */
            }
        </style>
        
</head>
<body>

    {{-- START MAIN --}}
    @yield('main')
    {{-- END MAIN --}}
    
    <!--===============================================================================================-->	
	<script src="../../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/bootstrap/js/popper.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/select2/select2.min.js"></script>
        <script>
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            })
        </script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/daterangepicker/moment.min.js"></script>
        <script src="../../assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/slick/slick.min.js"></script>
        <script src="../../assets/js/slick-custom.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/parallax100/parallax100.js"></script>
        <script>
            $('.parallax100').parallax100();
        </script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
        <script>
            $('.gallery-lb').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    },
                    mainClass: 'mfp-fade'
                });
            });
        </script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/sweetalert/sweetalert.min.js"></script>
        <script>
            $('.js-addwish-b2').on('click', function(e){
                e.preventDefault();
            });
    
            $('.js-addwish-b2').each(function(){
                var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");
    
                    $(this).addClass('js-addedwish-b2');
                    $(this).off('click');
                });
            });
    
            $('.js-addwish-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
    
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");
    
                    $(this).addClass('js-addedwish-detail');
                    $(this).off('click');
                });
            });
    
            /*---------------------------------------------*/
    
            $('.js-addcart-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to cart !", "success");
                });
            });
        
        </script>
    <!--===============================================================================================-->
        <script src="../../assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script>
            $('.js-pscroll').each(function(){
                $(this).css('position','relative');
                $(this).css('overflow','hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1,
                    scrollingThreshold: 1000,
                    wheelPropagation: false,
                });
    
                $(window).on('resize', function(){
                    ps.update();
                })
            });
        </script>
    <!--===============================================================================================-->
        <script src="../../assets/js/main.js"></script>

</body>

</html>