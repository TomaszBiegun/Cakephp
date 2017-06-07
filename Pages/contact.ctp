<style type="text/css">
    #map {
        width: 100%;
        height: 500px;
        margin-bottom: 50px;
    }

    #contact-alert-error {
        display: none;
    }

    .logo-init {
        text-align: center;
        padding-bottom: 20px;
    }

</style>


<section class="contact-area">

    <div class="black-heading package-heading">
        <div class="tx-holder only-one-title">
            <h1 class="tx-hand tx-main">
                Kontakt
            </h1>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">

        <div class="simply-box">

            <div class="simple-inner-container">
                <h1 class="tx-hand pull-left">Czy możemy Ci jakoś pomóc ?</h1>

                <h3 class="tx-hand simple-title pull-left">Wypełnij poniższy formularz, postaramy się odpowiedzieć tak
                    szybko, jak to
                    możliwe.</h3>

                <div class="col-md-8 col-md-offset-2">
                    <!-- Contact Form -->
                    <article class="contact-form">
                        <form action="/pages/contact" id="contact-form" role="form" method="post">
                            <div class="alert alert-success hidden" id="contact-alert-success">
                                <strong>Gratuluję!</strong> Dziękuję za wiadomość, odpowiem na nią jak najszybciej.
                            </div>

                            <div class="row">
                                <div class="col-sm-12 logo-init">
                                    <!--                                    <div id="map"></div>-->
                                    <?php echo $this->Html->image('gc-logo.jpg'); ?>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" id="contact-alert-error">
                                        <strong>*</strong> Należy wypełnić pola <strong>E-mail</strong> oraz <strong>Wiadomość</strong>.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="sr-only" for="name"></label>
                                        <input type="text" class="form-control" value="" placeholder="Imię i nazwisko"
                                               data-msg-required="Proszę wpisać swoję imię i nazwisko." name="name"
                                               id="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="sr-only" for="email"></label>
                                        <input type="email" value="" placeholder="E-mail"
                                               data-msg-required="Proszę podać swój adres e-mail."
                                               data-msg-email="Proszę podać poprawny e-mail." class="form-control"
                                               name="mail" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="sr-only" for="message"></label>
                                        <textarea placeholder="Twoja wiadomość ..."
                                                  data-msg-required="Proszę o przesłanie krótkiej wiadomości" rows="6"
                                                  class="form-control" name="message" id="message"></textarea>
                                    </div>
                                    <input type="submit" value="Wyślij wiadomość"
                                           class="btn btn-submit btn-block btn-green btn-submit"
                                           data-loading-text="Ładuję..." id="send">
                                </div>
                            </div>
                        </form>
                    </article>
                </div>


            </div>


        </div>


    </div>


    </div>

    <script type="text/javascript">


        $(document).ready(function () {

            var $animation_elements = $('.simply-box');
            var $window = $(window);

            function check_if_in_view() {
                var window_height = $window.height();
                var window_top_position = $window.scrollTop();
                var window_bottom_position = (window_top_position + window_height);

                $.each($animation_elements, function () {
                    var $element = $(this);
                    var element_height = $element.outerHeight();
                    var element_top_position = $element.offset().top;
                    var element_bottom_position = (element_top_position + element_height);

                    //check to see if this current container is within viewport
                    if ((element_bottom_position >= window_top_position) &&
                        (element_top_position <= window_bottom_position)) {
                        $element.addClass('in-view');

                    }
                    /*
                     else{
                     //                        console.log("__");
                     //                        console.log($animation_elements);
                     //                        console.log(element_bottom_position);
                     //                        console.log(window_top_position);
                     //                        console.log(element_top_position);
                     //                        console.log(window_bottom_position);
                     //                        console.log("___");
                     $element.removeClass('in-view');
                     }
                     */
                });
            }

            $window.on('scroll resize', check_if_in_view);
            $window.trigger('scroll');

            $('#send').on('click', function (e) {
                e.preventDefault();
                var email = $('#email').val();
                var name = $('#name').val();
                var message = $('#message').val();
                if ((email != '') && (message != '')) {
                    $('#contact-form').submit();
                } else {
                    $('#contact-alert-error').show('slow');
                }

            });


        });


    </script>

</section>
<script type="text/javascript">
    //    function initMap() {
    //        var factory = {lat: 50.9730562, lng: 18.215005};
    //        var map_options = {
    //            zoom: 18,
    //            center: factory,
    //            styles: [{
    //                "featureType": "landscape",
    //                "stylers": [{"hue": "#FFA800"}, {"saturation": 0}, {"lightness": 0}, {"gamma": 1}]
    //            }, {
    //                "featureType": "road.highway",
    //                "stylers": [{"hue": "#53FF00"}, {"saturation": -73}, {"lightness": 40}, {"gamma": 1}]
    //            }, {
    //                "featureType": "road.arterial",
    //                "stylers": [{"hue": "#FBFF00"}, {"saturation": 0}, {"lightness": 0}, {"gamma": 1}]
    //            }, {
    //                "featureType": "road.local",
    //                "stylers": [{"hue": "#00FFFD"}, {"saturation": 0}, {"lightness": 30}, {"gamma": 1}]
    //            }, {
    //                "featureType": "water",
    //                "stylers": [{"hue": "#00BFFF"}, {"saturation": 6}, {"lightness": 8}, {"gamma": 1}]
    //            }, {
    //                "featureType": "poi",
    //                "stylers": [{"hue": "#679714"}, {"saturation": 33.4}, {"lightness": -10.4}, {"gamma": 1}]
    //            }]
    //        };
    //        var map = new google.maps.Map(document.getElementById('map'), map_options);
    //
    //
    //        var marker = new google.maps.Marker({
    //            position: factory,
    //            map: map,
    //            title: 'ul. Zamkowa 15, 46-200 Kluczbork',
    //            animation: google.maps.Animation.DROP,
    //            visible: true,
    //            icon: "/img/map-marker.png"
    //        });
    //        var infowindow = new google.maps.InfoWindow({
    //            content: "GreenCook"
    //        });
    //        infowindow.open(map, marker);
    //        google.maps.event.addListener(infowindow, 'domready', function () {
    //                $(".gm-style-iw").next("div").hide();
    //                $(".gm-style-iw div").css({
    //                    margin: "0 auto",
    //                    width: "80px",
    //                    display: "block",
    //                    textAlign: "center"
    //                })
    //
    //            }
    //        )
    //        ;
    //
    //
    //    }
    $(document).ready(function () {

        var $animation_elements = $('.simply-box');
        var $window = $(window);

        function check_if_in_view() {
            var window_height = $window.height();
            var window_top_position = $window.scrollTop();
            var window_bottom_position = (window_top_position + window_height);

            $.each($animation_elements, function () {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('in-view');

                }


            });
        }

        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');


    });


</script>
<!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBn0GmroQ9WiRBgWrCyiJ6uhf1X61H2MPo&callback=initMap"-->
<!--        async defer></script>-->