<section class="single-blog-area">

    <div class="black-heading blog-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main only-one-title">
                <?php echo $post['Post']['title']; ?>
            </h1>
        </div>

        <i class="arrow-element"> </i>
    </div>


    <div class="container simply-box-container">
        <?php echo $this->Html->link('Powrót', array('controller' => 'pages', 'action' => 'blog'), array('class' => 'btn-green btn-back')); ?>

        <div class="simply-box">
            <div class="simple-inner-container">

                <div class="col-sm-12 single-article">

                    <h5 class="tx-hand pull-right article-date"><?php echo date('d.m.Y', strtotime($post['Post']['created'])); ?></h5>

                    <div class="row article-row">
                        <div class="col-xs-12 col-sm-12 article-info">

                            <div class="article-description">
                                <div class="article-image">
                                    <?php echo $this->Media->embed('m' . DS . $post['Post']['dirname'] . DS . $post['Post']['basename'], array('height' => '', 'width' => '', 'class' => 'article-image')); ?>
                                </div>
                                <?php echo $post['Post']['body']; ?>
                            </div>

                        </div>
                        <div class="col-sm-12 feed-bar" id="feed-bar-article-<?php echo $post['Post']['id']; ?>"
                             role="tablist"
                             aria-multiselectable="true">
                            <div class="row">
                                <div class="col-sm-12 feed-actions">
                                    <a class="feed-action comment-release" data-toggle="collapse"
                                       href="#comments-article-<?php echo $post['Post']['id']; ?>" role="tabpanel"
                                       aria-expanded="false"
                                       aria-controls="comments-article-<?php echo $post['Post']['id']; ?>"
                                       data-parent="#feed-bar-article-<?php echo $post['Post']['id']; ?>">
                                        Komentarze (<?php echo count($comments); ?>)
                                    </a>
                                    <a class="feed-action comment-new" data-toggle="collapse"
                                       href="#comment-new-article-<?php echo $post['Post']['id']; ?>" role="tabpanel"
                                       aria-expanded="false"
                                       aria-controls="comment-new-article-<?php echo $post['Post']['id']; ?>"
                                       data-parent="#feed-bar-article-<?php echo $post['Post']['id']; ?>">
                                        Dodaj komentarz
                                    </a>
                                    <a class="feed-action fb-share"
                                       href="#facebook-share-<?php echo $post['Post']['id']; ?>">
                                        poleć na FB
                                    </a>

                                </div>

                                <div class="col-sm-12 comments-block">
                                    <div class="panel-collapse collapse comments-area"
                                         id="comments-article-<?php echo $post['Post']['id']; ?>"
                                         role="tabpanel">
                                        <div id="comment_container" class="row">

                                            <?php echo $this->Element('comment', array(
                                                'comments' => $comments
                                            )); ?>

                                        </div>

                                        <a id="load_more" href="" class="load-more-comments"
                                           data-page="1" data-maxpage="<?php echo $max_pages; ?>"
                                           data-id="<?php echo $post['Post']['id']; ?>">Załaduj więcej</a>
                                    </div>
                                    <div class="panel-collapse collapse new-comment-area"
                                         id="comment-new-article-<?php echo $post['Post']['id']; ?>"
                                         role="tabpanel">
                                        <b>Dodaj komentarz</b>

                                        <div class="">
                                            <?php echo $this->Form->create('Comment', array('novalidate' => 'novalidate')); ?>
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 comment-name-container">
                                                    <?php echo $this->Form->input('user_name', array('id' => 'user_name' . $post['Post']['id'], 'class' => 'comment-name', 'placeholder' => 'Imię', 'label' => false)); ?>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 comment-submit-container">
                                                    <?php echo $this->Form->submit('Dodaj', array('class' => 'comment-submit', 'type' => 'submit', 'data-id' => $post['Post']['id'])); ?>
                                                </div>
                                                <div class="col-xs-12 comment-text-container">
                                                    <?php echo $this->Form->input('body', array('id' => 'body' . $post['Post']['id'], 'rows' => '3', 'class' => 'comment-text', 'type' => 'textarea', 'placeholder' => 'Twój komentarz', 'label' => false)); ?>
                                                </div>
                                            </div>
                                            <?php echo $this->Form->end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>


    </div>

    <script type="text/javascript">

        if ($('#load_more').data('page') >= $('#load_more').data('maxpage')) {
            $('#load_more').attr('hidden', true);
            console.log('siema');
        }

        $(document).ready(function () {
            $('#load_more').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var page = $(this).data('page');
                $(this).data('page', page + 1);

                $.ajax({
                    type: "POST",
                    url: "/pages/singleblog/" + id,
                    data: {
                        page: page + 1
                    },
                    dataType: "html",
                    error: function (response) {
                    },
                    success: function (response) {
                        $(response).appendTo($('#comment_container')).hide().slideDown('fast');
                        if ($('#load_more').data('page') >= $('#load_more').data('maxpage')) {
                            $('#load_more').attr('hidden', true);
                            console.log('siema');
                        }
                    },
                    done: function (response) {
                    }
                });
            });
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
                });
            }

            $window.on('scroll resize', check_if_in_view);
            $window.trigger('scroll');
        });


    </script>

</section>