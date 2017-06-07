<section class="blog-area">

    <div class="black-heading blog-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                Blog
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Przejrzyj nasze ciekawe artykuły
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container simply-box-container">
        <?php foreach ($posts as $post): ?>
            <div class="simply-box">
                <div class="simple-inner-container">

                    <div class="col-sm-12 single-article">
                        <?php echo $this->Html->link('<h1 class="tx-hand simple-title pull-left">' . $post['Post']['title'] . '</h1>', array('controller' => 'pages', 'action' => 'singleblog', $post['Post']['id']), array('escape' => false)); ?>

                        <h5 class="tx-hand pull-right article-date"><?php echo date('d.m.Y', strtotime($post['Post']['created'])); ?></h5>

                        <div class="row article-row">
                            <div class="col-xs-12  col-sm-3 article-image">
                                <?php echo $this->Media->embed('m' . DS . $post['Post']['dirname'] . DS . $post['Post']['basename'], array('height' => '', 'width' => '')); ?>
                            </div>
                            <div class="col-xs-12 col-sm-9 article-info">

                                <div class="article-description">
                                    <?php echo $post['Post']['body']; ?>
                                </div>

                            </div>
                            <div class="col-sm-12 feed-bar" id="feed-bar-article-<?php echo $post['Post']['id']; ?>"
                                 role="tablist"
                                 aria-multiselectable="true">
                                <div class="row">
                                    <div class="col-sm-12 feed-actions">

                                        <?php echo $this->Html->link('czytaj więcej..', array('controller' => 'pages', 'action' => 'singleblog', $post['Post']['id']), array('class' => 'feed-action see-more')) ?>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        <?php endforeach; ?>
        <?php echo $this->Element('pagging'); ?>
<!--        <div class="pagination">-->
<!---->
<!--            --><?php
//
//
//            // Shows the next and previous links
//            echo $this->Paginator->prev(
//                '« Previous',
//                null,
//                null,
//                array('class' => 'disabled')
//            );
//            echo $this->Paginator->numbers();
//            echo $this->Paginator->next(
//                'Next »',
//                null,
//                null,
//                array('class' => 'disabled')
//            );
//
//            ?>
<!--        </div>-->
    </div>

    </div>

    <script type="text/javascript">


        $(document).ready(function () {
            $('.comment-submit').click(function (e) {
                e.preventDefault();
                var post_id = $(this).data('id');
                var user_name = $('#user_name' + post_id).val();
                var body = $('#body' + post_id).val();

                $.ajax({
                    type: "POST",
                    url: "/comments/add",
                    data: {
                        Comment: {
                            user_name: user_name,
                            body: body,
                            post_id: post_id
                        }
                    },
                    dataType: "json",
                    error: function (response) {
                    },
                    success: function (response) {
                        location.reload();
                    },
                    done: function (response) {
                    }
                });

            });
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