<style type="text/css">
    .faq-form {
        padding-top: 20px;
    }

    .tx-my {
        text-align: center;
        font-size: 25px !important;
    }

    .my-box {
        background-color: transparent !important;
    }

    .my-box .simple-title {
        text-align: center;
    }

    .my-box .simple-title:after {
        display: none;
    }
</style>
<section class="faq-area">

    <div class="faq-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                FAQ
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Przejrzyj najczęsciej zadawane pytania
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">
        <?php foreach ($faqs as $faq): ?>
            <div class="simply-box">
                <div class="simple-inner-container">

                    <h1 class="tx-hand tx-green simple-title pull-left"> <?php echo $faq['Faq']['title'] ?></h1>

                    <div class="faq-description">
                        <?php echo $faq['Faq']['body'] ?>

                    </div>

                </div>


            </div>
        <?php endforeach; ?>
        <div class="simply-box">
            <div class="simple-inner-container my-box">

                <h1 class="tx-hand tx-green simple-title"> Zadaj pytanie</h1>

                <div class="faq-description tx-my">
                    Nie znalazłeś odpowiedzi na swoje pytanie? Wyślij je do
                    nas, odpowiemy na nie tak szybko, jak to możliwe.

                </div>
                <div class="faq-form">
                    <form class="faq-form" method="post" action="/pages/faq_message">
                        <div class="input-container">

                            <div class="col-sm-2 label-box">

                            </div>

                            <div class="col-sm-8 input-box">
                                <textarea rows="10" cols="90" class="my-input" name="message" type="textarea" id="faq-entry"
                                          placeholder="Zadaj pytanie">
</textarea>
                            </div>

                        </div>

                        <div class="col-sm-2">
                            <input type="submit" class="green-submit btn-green faq-button" value="Wyślij">
                        </div>


                    </form>
                </div>

            </div>


        </div>
        <!--        <h1 class="tx-hand tx-main tx-green tx-my">Nie znalazłeś odpowiedzi na swoje pytanie? Wyślij je do-->
        <!--            nas, odpowiemy na nie tak szybko, jak to możliwe.-->
        <!--        </h1>-->


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
        });


    </script>

</section>