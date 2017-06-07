<section class="diet-area">

    <div class="black-heading diet-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                DIETY
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Wybierz najbardziej odpowiednią dla siebie
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>
    <div class="gallery">
        <div class="row">


            <?php foreach ($diets as $diet): ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="singlePhoto">
                        <a href="/pages/singlediet/<?php echo $diet['Diet']['id']; ?>"><?php echo $this->Media->embed('t' . DS . $diet['Diet']['dirname'] . DS . $diet['Diet']['basename'], array('width' => '', 'heigth' => '')); ?></a>

                        <div class="dietTitle">
                            <div class="text-box">
                                <p><?php echo $this->Html->link($diet['Diet']['name'], array('controller' => 'pages', 'action' => 'singlediet', $diet['Diet']['id'])); ?></p>
                                <div class="single-diet-description">
                                    <?php echo $this->Html->link($diet['Diet']['info'], array('controller' => 'pages', 'action' => 'singlediet', $diet['Diet']['id'])); ?>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>


            <?php endforeach; ?>


        </div>
    </div>


    <!--    TUTAJ ROBIE GALERIE-->


    <!--    TUTAJ ROBIE GALERIE-->


    <!--    <div class="container custom-container simply-box-container">-->
    <!--        --><?php //foreach ($diets as $diet): ?>
    <!--            <div class="simply-box">-->
    <!--                <div class="simple-inner-container">-->
    <!---->
    <!--                    <div class="single-diet">-->
    <!--                        <div class="col-sm-5 image-holder single-diet-image">-->
    <!--                            --><?php //echo $this->Media->embed('m' . DS . $diet['Diet']['dirname'] . DS . $diet['Diet']['basename'], array('width' => '', 'heigth' => '')); ?>
    <!--                        </div>-->
    <!--                        <div class="col-sm-7 single-diet-info">-->
    <!--                            <h1 class="tx-hand tx-green simple-title pull-left"> -->
    <?php //echo $diet['Diet']['name']; ?><!--</h1>-->
    <!---->
    <!--                                <div class="single-diet-description">-->
    <!--                                    --><?php //echo $diet['Diet']['body']; ?>
    <!--    -->
    <!--                                </div>-->
    <!--                        </div>-->
    <!---->
    <!---->
    <!--                    </div>-->
    <!--                    <div class="col-sm-12">-->
    <!--                        <a href="" class="green-submit btn-green diet-get pull-right">Idź do sklepu</a>-->
    <!--                    </div>-->
    <!---->
    <!---->
    <!--                </div>-->
    <!---->
    <!---->
    <!--            </div>-->
    <!--        --><?php //endforeach; ?>
    <!---->
    <!--    </div>-->
    <!---->
    <!---->
    <!--    <script type="text/javascript">-->
    <!---->
    <!---->
    <!--        $(document).ready(function () {-->
    <!---->
    <!--            var $animation_elements = $('.simply-box');-->
    <!--            var $window = $(window);-->
    <!---->
    <!--            function check_if_in_view() {-->
    <!--                var window_height = $window.height();-->
    <!--                var window_top_position = $window.scrollTop();-->
    <!--                var window_bottom_position = (window_top_position + window_height);-->
    <!---->
    <!--                $.each($animation_elements, function () {-->
    <!--                    var $element = $(this);-->
    <!--                    var element_height = $element.outerHeight();-->
    <!--                    var element_top_position = $element.offset().top;-->
    <!--                    var element_bottom_position = (element_top_position + element_height);-->
    <!---->
    <!--              -->
    <!--                    if ((element_bottom_position >= window_top_position) &&-->
    <!--                        (element_top_position <= window_bottom_position)) {-->
    <!--                        $element.addClass('in-view');-->
    <!---->
    <!--                    }-->
    <!--                    -->
    <!--                });-->
    <!--            }-->
    <!---->
    <!--            $window.on('scroll resize', check_if_in_view);-->
    <!--            $window.trigger('scroll');-->
    <!--        });-->
    <!---->
    <!---->
    <!--    </script>-->


</section>