<section class="single-pack-area">

    <div class="black-heading package-heading">
        <div class="tx-holder only-one-title">
            <h1 class="tx-hand tx-main">
                <?php echo $pack['Pack']['title']; ?>
            </h1>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container custom-container simply-box-container">
        <?php echo $this->Html->link('Powrót', array('controller' => 'pages', 'action' => 'pack'), array('class' => 'btn-green btn-back')) ?>
        <div class="simply-box">

            <div class="simple-inner-container">
                <h1 class="tx-hand simple-title pull-left">Wybierając plan <?php echo $pack['Pack']['title']; ?> zyskujesz:</h1>
                <div class="col-sm-12 single-package">


                    <div class="package-info">

                        <?php echo $pack['Pack']['body']; ?>


                        <h3 class="tx-hand package-price">
                            Cena <span class="tx-green price"><?php echo $pack['Pack']['ammount']; ?> PLN</span>
                            na <?php echo $pack['Pack']['per'];
                            if ($pack['Pack']['per'] == '1') {
                                echo ' miesiąc';
                            }
                            if ($pack['Pack']['per'] == '3') {
                                echo ' miesiące';
                            }
                            if ($pack['Pack']['per'] == '6') {
                                echo ' miesięcy';
                            }
                            ?>
                        </h3>

                        <hr>
                        <!--                        class="highlight-table"-->
                        <div class="package-table table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Usługi</th>
                                    <?php foreach ($packs as $item): ?>
                                        <th class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>">
                                            Pakiet - <?php echo $item['Pack']['title']; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Liczba miesięcy</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['per']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Liczba osób</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['people']; ?></td>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <td>Wsparcie dietetyka</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['help']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Lista zakupów</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['list']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Zapis Twojej wagi oraz BMI</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['remember']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Dostęp do aplikacji moblinej</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo $item['Pack']['special']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td>Cena</td>
                                    <?php foreach ($packs as $item): ?>
                                        <td class="<?php if ($item['Pack']['id'] == $id) echo 'highlight-table'; ?>"><?php echo round($item['Pack']['ammount'], 2) . ' PLN'; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <!--                        <hr>-->

                        <a href="#" data-toggle="modal" data-target="#packGetModal"
                           class="green-submit btn-green package-get pull-right">Wybierz</a>

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
        });


    </script>

</section>
<div class="modal fade pack-get-modal" id="packGetModal" tabindex="-1" role="dialog" aria-labelledby="packGetLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close modal-close faa-tada animated-hover" data-dismiss="modal"
                    aria-hidden="true">&times;</button>

            <div class="modal-header">
                <h4 class="modal-title" id="packGetLabel">Zakup pakiet</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 modal-column-left">
                        <h2>Zakup pakiet</h2>


                        <div class="input checkbox">
                            <input type="hidden" name="data[terms_agree]" id="pack-agree_" value="0">
                            <input type="checkbox" name="data[terms_agree]" value="1" id="pack-agree">
                            <label for="pack-agree">Przeczytałem i zapoznałem się z
                                <a href="regulamin.html">regulaminem</a> serwisu </label>
                        </div>
                    </div>
                    <div id="SummaryContainer" class="col-sm-12 modal-column-right" style="display: none;">

                        <table class="table table-hover price-table">
                            <thead style="">
                            <tr>
                                <th>Nazwa</th>
                                <th>Cena</th>
                                <th>Razem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="pack_title"><?php echo $pack['Pack']['title']; ?></td>
                                <td><span id="amount" class="price-add"><?php echo $pack['Pack']['ammount']; ?></span>zł
                                </td>
                                <td><span class="price-summary"></span>zł</td>
                            </tr>
                            </tbody>

                            <script>
                                $(document).ready(function () {
                                    var summary = 0;
                                    $('.price-add').each(function () {
                                        summary += parseFloat($(this).html());
                                    });
                                    summary = Math.round(summary * 100) / 100;
                                    $(".price-summary").html(summary);
                                });
                            </script>
                        </table>


                        <!--                        <a id="pack-get" href="" data-pack_id="-->
                        <?php //echo $pack['Pack']['id']; ?><!--"-->
                        <!--                           class="green-submit btn-green package-get center-block">Zapłać</a>-->

                        <form action="https://ssl.dotpay.pl/test_payment/" method="POST">
                            <!--                        <form action="/payments/add" method="POST">-->
                            <input type="hidden" name="api_version" value="legacy"/>
                            <input type="hidden" name="id" value="778724"/>
                            <input type="hidden" name="opis" value="<?php echo $pack['Pack']['title']; ?>"/>
                            <input type="hidden" name="waluta" value="PLN"/>
                            <input type="hidden" name="amount" value="<?php echo $pack['Pack']['ammount']; ?>"/>
                            <!--                            <input type="hidden" name="email" value="tbiegun@180creative.pl"/>-->
                            <input type="hidden" name="jezyk" value="pl"/>
                            <input type="hidden" name="control" value="<?php echo $pack['Pack']['id']; ?>"/>
                            <input type="hidden" name="typ" value="3"/>
                            <input type="hidden" name="URL" value="http://dev-greencook.180c.pl/payments/check"/>
                            <input type="hidden" name="URLC" value="http://dev-greencook.180c.pl/payments/add"/>
                            <input type="submit" value="Zapłać" class="green-submit btn-green package-get center-block">
                        </form>


                    </div>
                </div>


                <script type="text/javascript">
                    $(document).ready(function () {

                        $("input[type='checkbox']").on('change', function () {

                            if ($('[name="data[terms_agree]"]').is(":checked")) {
                                $('#SummaryContainer').slideDown(400);
                            }
                            else {
                                $('#SummaryContainer').slideUp(400);
                            }


                        });


//                        $(document).on('click', '#pack-get', function (e) {
//                            $('[name="data[terms_agree]"]').parent().removeClass('acceptance-error');
//                            if ($('[name="data[terms_agree]"]').is(":checked")) {
//                                e.preventDefault();
//                                var pack_id = $(this).data('pack_id');
//                                var kwota = $('#amount').html();
//                                var opis = $('#pack_title').html();
//
//                                $.ajax({
//                                    type: "POST",
//                                    url: "/payments/add",
//                                    data: {
//                                        pack_id: pack_id
//                                    },
//                                    dataType: "html",
//                                    error: function (response) {
//                                    },
//                                    success: function (response) {
//                                        console.log(response);
//                                        if (response == 'error') {
//                                            window.location.href = '/';
//                                        }
//                                        var win = window.open("https://ssl.dotpay.pl/", '_blank');
//                                        win.document.write(response);
//
//                                    },
//                                    done: function (response) {
//
//                                    }
//                                });
//
////                                window.location.href = "https://ssl.dotpay.pl/test_payment/?id=778724&kwota=" + kwota + "&opis=Pakiet - " + opis + "&waluta=PLN&grupykanalow=T&blokuj=0";
//
//                            } else {
//                                $('[name="data[terms_agree]"]').parent().addClass('acceptance-error');
//                            }
//                        });

                    })
                    ;
                </script>
            </div>
        </div>
    </div>
</div>