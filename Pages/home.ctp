<section class="home-gallery">

    <div class="grid">
        <div class="grid-item" data-colspan="2" data-rowspan="2">
            <?php echo $this->Html->image('home-page/collage/1.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="2" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/text.png', array('class' => 'grid-tx-image')); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/2.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/3.png'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/4.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="2">
            <?php echo $this->Html->image('home-page/collage/5.png'); ?>
        </div>
        <div class="grid-item" data-colspan="2" data-rowspan="2">
            <?php echo $this->Html->image('home-page/collage/6.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/7.png'); ?>
        </div>
        <div class="grid-item" data-colspan="2" data-rowspan="2">
            <?php echo $this->Html->image('home-page/collage/8.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/9.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/10.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/11.jpg'); ?>
        </div>
        <div class="grid-item" data-colspan="1" data-rowspan="1">
            <?php echo $this->Html->image('home-page/collage/12.jpg'); ?>
        </div>
    </div>

    <script type="text/javascript">
        $('.grid').responsivegrid({
            'breakpoints': {
                'desktop': {
                    'range': '*',
                    'options': {
                        'column': 6,
                        'gutter': '20px',
                        'itemHeight': '60%'
                    }
                },
                'mobile': {
                    'range': '-767',
                    'options': {
                        'column': 2,
                        'gutter': '5px',
                        'itemHeight': '50%',
                    }
                }
            }
        });
    </script>

</section>


<section class="how-it-works">
    <div class="works-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                Jak to działa?
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Dowiedz się jak w <?php echo count($steps); ?> krokach korzystać z naszego serwisu
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>


    <div class="container works-steps-container">

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