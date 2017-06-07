<section class="pack-area">

    <div class="black-heading package-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                CENNIK
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Wybierz najbardziej odpowiednią dla siebie ofertę
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">

        <div class="simply-box">
            <div class="simple-inner-container">
                <?php foreach ($packs as $pack): ?>
                    <div class="col-sm-4 single-package <?php if ($pack['Pack']['per'] == 3) echo 'most-wanted'; ?>">
                        <?php if ($pack['Pack']['per'] == 3): ?>
                            <p class="most-info tx-hand tx-green">Najczęściej wybierany !</p>
                        <?php endif; ?>
                        <div class="image-holder package-image">
                            <?php echo $this->Media->embed('m' . DS . $pack['Pack']['dirname'] . DS . $pack['Pack']['basename'], array('width' => '', 'height' => '')); ?>
                        </div>

                        <div class="package-info">
                            <h1 class="tx-hand tx-green simple-title package-title"><?php echo $pack['Pack']['title']; ?></h1>

                            <?php echo $pack['Pack']['body']; ?>
                            <?php if ($pack['Pack']['per'] == '1') {
                                echo '<br>';
                            } ?>
                            <h3 class="tx-hand package-price">
                                Cena <span class="tx-green price"><?php echo $pack['Pack']['ammount']; ?> PLN</span>
                                na <?php echo $pack['Pack']['per'];
                                if ($pack['Pack']['per'] == '1') {
                                    echo ' miesiąc ';
                                }
                                if ($pack['Pack']['per'] == '3') {
                                    echo ' miesiące';
                                }
                                if ($pack['Pack']['per'] == '6') {
                                    echo ' miesięcy';
                                }
                                ?>
                            </h3>

                            <h4 class="tx-hand package-price">
                                <?php echo $pack['Pack']['subtitle']; ?>
                            </h4>
                            <?php if ($pack['Pack']['per'] == '1') {
                                echo '<br>';
                            } ?>
                            <?php if ($pack['Pack']['active'] == 1): ?>
                                <?php echo $this->Html->link('Więcej', array('controller' => 'pages', 'action' => 'singlepack', $pack['Pack']['id']), array('class' => 'green-submit btn-green package-get')); ?>
                            <?php else: ?>
                                <?php echo $this->Html->link('Chwilowo nieaktywny', array(), array('class' => 'green-submit btn-green package-get')); ?>
                            <?php endif; ?>
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