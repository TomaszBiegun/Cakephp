<section class="how-it-works">
    <div class="works-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                JAK TO DZIAŁA?
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Dowiedz się jak w <?php echo count($steps); ?> krokach korzystać z naszego serwisu
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>


    <div class="container works-steps-container">
        <div class="step">
            <div class="step-inner-container" data-colspan="1" data-rowspan="1">
                <div class="col-sm-6 step-info video-info">
                    <div class="step-heading">
                        <h2 class="tx-hand tx-step-count">To proste!</h2>

                        <h1 class="tx-hand tx-step-title">Film</h1>
                    </div>
                    <div class="step-description">
                        Przejdź z nami krok po kroku i zobacz jak to działa.
                    </div>
                </div>
                <div class="col-sm-6 step-photo step-video">
                    <video width="100%" height="auto" controls autoplay>
                        <source src="/img/animate.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            </div>
        </div>
        <?php foreach ($steps as $key => $step): ?>
            <div class="step">
                <div class="step-inner-container" data-colspan="1" data-rowspan="1">
                    <div class="col-sm-6 step-info">
                        <div class="step-heading">
                            <h2 class="tx-hand tx-step-count">Krok <?php echo $key + 1; ?></h2>

                            <h1 class="tx-hand tx-step-title"><?php echo $step['Step']['title']; ?></h1>
                        </div>
                        <div class="step-description">
                            <?php echo $step['Step']['body']; ?>
                        </div>
                    </div>
                    <div class="col-sm-6 step-photo">
                        <?php echo $this->Media->embed('t' . DS . $step['Step']['dirname'] . DS . $step['Step']['basename'], array('width' => '', 'height' => '')); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <script type="text/javascript">


        $(document).ready(function () {

            var $animation_elements = $('.step');
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