<section class="search-results-area">

    <div class="black-heading blog-heading">
        <div class="tx-holder">
            <h2 class="tx-hand tx-subtitle">
                Szukaj
            </h2>

            <h2 class="tx-hand tx-subtitle">
                <?php echo $word; ?>
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>


    <div class="container simply-box-container">
        <?php if (!empty($results['Blog'])): ?>
            <?php foreach ($results['Blog'] as $one): ?>
                <div class="simply-box">
                    <div class="simple-inner-container">
                        <div class="row">
                            <div class="col-sm-12 search-result-box">

                                <div class="col-xs-10">
                                    <?php echo $this->Html->link(' <h3 class="">' . $one['Post']['title'] . '</h3>', array('controller' => 'pages', 'action' => 'singleblog', $one['Post']['id']), array('class' => 'result-title', 'escape' => false)); ?>
                                </div>

                                <div class="col-xs-2">
                                    <h5 class="tx-hand pull-right result-type">BLOG</h5>
                                </div>

                                <div class="col-xs-12 result-description">
                                    <?php echo $one['Post']['body']; ?>
                                </div>

                                <div class="col-xs-12">
                                    <?php echo $this->Html->link('przejdź', array('controller' => 'pages', 'action' => 'singleblog', $one['Post']['id']), array('class' => 'btn-green btn-open-result')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if (!empty($results['Diet'])): ?>
            <?php foreach ($results['Diet'] as $one): ?>
                <div class="simply-box">
                    <div class="simple-inner-container">
                        <div class="row">
                            <div class="col-sm-12 search-result-box">

                                <div class="col-xs-10">
                                    <?php echo $this->Html->link(' <h3 class="">' . $one['Diet']['name'] . '</h3>', array('controller' => 'pages', 'action' => 'dinglediet', $one['Diet']['id']), array('class' => 'result-title', 'escape' => false)); ?>
                                </div>

                                <div class="col-xs-2">
                                    <h5 class="tx-hand pull-right result-type">DIETA</h5>
                                </div>

                                <div class="col-xs-12 result-description">
                                    <?php echo $one['Diet']['body']; ?>
                                </div>

                                <div class="col-xs-12">
                                    <?php echo $this->Html->link('przejdź', array('controller' => 'pages', 'action' => 'singlediet', $one['Diet']['id']), array('class' => 'btn-green btn-open-result')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

<!--        <div class="pagination pagination-simply">-->
        <!--            <span class="prev"><a href="/blog" rel="prev">« Previous</a></span><span><a href="/blog">1</a></span> |-->
        <!--            <span class="current">2</span><span class="disabled">Next »</span>-->
        <!--        </div>-->

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