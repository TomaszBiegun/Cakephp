<section class="blog-area">

    <div class="black-heading blog-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                Wprowadzenie
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Dowiedz się więcej
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container simply-box-container">

        <div class="simply-box">
            <div class="simple-inner-container">

                <div class="col-sm-12 single-article">
                    <h1 class="tx-hand simple-title pull-left">Tytuł</h1>

                    <h5 class="tx-hand pull-right article-date">data</h5>

                    <div class="row article-row">
                        <div class="col-xs-12  col-sm-3 article-image">
                            <?php echo $this->Html->image('gc-logo.jpg', array('width' => '200px', 'height' => 'auto')); ?>
                        </div>
                        <div class="col-xs-12 col-sm-9 article-info">

                            <div class="article-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis metus elit.
                                Maecenas sagittis nisi placerat, feugiat libero id, vestibulum erat. In vel iaculis
                                turpis. Cras nec finibus mi. Nullam tortor lorem, rhoncus id elit placerat, vestibulum
                                tempus risus. Quisque ultrices interdum orci. Sed eget lectus odio. Pellentesque sit
                                amet rutrum mi.
                                <br><br>
                                Morbi nec nibh a nunc vulputate tempus. Nullam scelerisque euismod purus nec sagittis.
                                Etiam convallis ac arcu ut viverra. Ut sit amet mattis leo. Suspendisse aliquam, nibh
                                vitae fermentum convallis, leo metus sollicitudin velit, sed dapibus mi elit eget dui.
                                Sed gravida ornare dui elementum imperdiet. Nulla aliquam, elit eget ultricies luctus,
                                ante lorem sagittis magna, sit amet feugiat justo dolor sed tortor. Nam convallis, nunc
                                a vulputate sodales, sapien purus accumsan metus, id dictum tortor diam eu sem. Praesent
                                pulvinar non leo at convallis. Donec magna risus, tincidunt et urna nec, egestas
                                dignissim dui.
                                <br>
                                <br>
                                Nullam eu ex non purus cursus finibus. Pellentesque et pretium lacus. Sed hendrerit,
                                ante eu consectetur blandit, tortor nibh commodo nunc, nec dapibus lectus eros sed
                                libero. Curabitur vel condimentum lectus, eu vehicula justo. Fusce non pulvinar ex.
                                Praesent suscipit nec metus sit amet dictum. Pellentesque ultricies mauris sit amet
                                purus vehicula, vitae vestibulum augue suscipit. Donec eu pretium est. Maecenas id
                                elementum neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut
                                vulputate vel sapien sit amet aliquam.
                            </div>

                        </div>
                        <!--                        <div class="col-sm-12 feed-bar" id="feed-bar-article--->
                        <?php //echo 'test'; ?><!--"-->
                        <!--                             role="tablist"-->
                        <!--                             aria-multiselectable="true">-->
                        <!--                            <div class="row">-->
                        <!--                                <div class="col-sm-12 feed-actions">-->
                        <!---->
                        <!--                                    --><?php //echo $this->Html->link('czytaj więcej..', array('controller' => 'pages', 'action' => 'singleblog'), array('class' => 'feed-action see-more')) ?>
                        <!---->
                        <!---->
                        <!--                                </div>-->
                        <!---->
                        <!---->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>


            </div>


        </div>

        <!--        --><?php //echo $this->Element('pagging'); ?>


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