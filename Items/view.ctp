<style>
    .box {
        width: 200px;
        height: 100px;
        background-color: black;
        position: absolute;
        right: 0;
        top: 50%;
        opacity: 0.5;
        z-index: 9;
        text-align: center;
        display: none;
    }

    .box img {
        vertical-align: middle;
    }
</style>
<section class="shop-area">
    <div class="add-info box">
        <h3 class="tx-hand tx-green item-name">Dodano do koszyka</h3>
        <?php echo $this->Html->image('icons/shop-bag-icon2.png'); ?>
    </div>
    <div class="black-heading shop-heading">
        <div class="tx-holder only-one-title">
            <h2 class="tx-hand tx-subtitle">
                <?php echo $item['Item']['title']; ?>
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">

        <div class="simply-box">
            <div class="simple-inner-container">
                <div class="shop-item single-item">
                    <div class="col-sm-4 item-photo">
                        <?php echo $this->Media->embed('m' . DS . $item['Item']['dirname'] . DS . $item['Item']['basename'], array('height' => '', 'width' => '', 'class' => 'img-responsive')); ?>
                    </div>
                    <div class="col-sm-8 item-info">
                        <div class="item-heading">
                            <a href="shop-item.html">
                                <h3 class="tx-hand tx-green item-name"><?php echo $item['Item']['title']; ?></h3>
                                <h4 class="tx-hand item-price">- <?php echo $item['Item']['price']; ?>zł</h4>
                            </a>
                        </div>

                        <div class="item-description">
                            <p>
                                <?php echo $item['Item']['body']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 item-actions">
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3 single-action">
                            <input type="submit" value="Kup" class="buy btn-green btn-buy"
                                   data-item="<?php echo $item['Item']['id']; ?>">
                        </div>

                    </div>
                </div>

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

            $('.buy').on('click', function () {
                $('.box').show('slow');
                var product_id = $(this).data('item');
                $.ajax({
                    type: "POST",
                    url: "/baskets/add",
                    data: {
                        product_id: product_id
                    },
                    dataType: "json",
                    error: function (response) {
                        console.log(response);
                    },
                    success: function (response) {

                        console.log('success');
                        console.log(response);

                    },
                    done: function (response) {
                        console.log(response);
                    }
                });
                setTimeout(function () {
                    $('.box').hide('slow');
                }, 2000);

            });

            $(window).scroll(function () {
                $('.box').css('top', $(this).scrollTop() + $(window).height() / 2);
            });

        });


    </script>

</section>