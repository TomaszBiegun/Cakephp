<section class="about-area">

    <div class="black-heading about-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                O NAS
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Poznajmy się
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">

        <div class="simply-box">
            <div class="simple-inner-container">
                <?php foreach ($abouts as $about): ?>
                    <div class="row about-row">
                        <div class="col-sm-4 about-photo">
                            <?php echo $this->Media->embed('l' . DS . $about['About']['dirname'] . DS . $about['About']['basename'], array('width' => '', 'height' => '')); ?>
                        </div>
                        <div class="col-sm-8 about-info">
                            <div class="about-heading">
                                <?php if (($about['About']['info'] != null) && (!empty($about['About']['info']))): ?>
                                    <h2 class="tx-hand small-detail"><?php echo $about['About']['info']; ?></h2>
                                <?php endif; ?>
                                <h1 class="tx-hand main-heading"><?php echo $about['About']['title']; ?></h1>
                            </div>
                            <div class="step-description">
                                <?php echo $about['About']['body']; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

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
        });


    </script>

</section>