<section class="calculator-area">
    <div class="black-heading about-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                KALKULATOR TDEE
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Oblicz Twoje całkowite dzienne zapotrzebowanie kaloryczne
            </h2>
        </div>

        <i class="arrow-element"> </i>
    </div>

    <div class="container simply-box-container">

        <div class="simply-box">
            <div class="simple-inner-container">

                <form id='calculator-form' class="green-form calculator-form">
                    <h1 class="tx-hand simple-title pull-left">Kalkulator</h1>

                    <div class="row">

                        <div class="col-sm-7 col-md-5">

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box">
                                    <label>Płeć</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <?php echo $this->Form->input('gender', array(
                                        'type' => 'radio',
                                        'name' => 'radioGender',
                                        'legend' => false,
                                        'options' => array('Kobieta', 'Mężczyzna')
                                    )); ?>
                                </div>
                            </div>

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box">
                                    <label for="weight">Waga (kg)</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <input id="weight" min="30" max="250" type="number" class="bmr-value bmi-value">
                                </div>
                            </div>

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box">
                                    <label for="height">Wzrost (cm)</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <input id="height" min="90" max="250" type="number" class="bmr-value bmi-value">
                                </div>
                            </div>

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box">
                                    <label for="age">Wiek</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <input id="age" type="number" class="bmr-value">
                                </div>
                            </div>

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box">
                                    <label for="activity">Aktywność</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <div class="custom-select green-select">
                                        <?php echo $this->Form->input('activity', array('label' => false, 'class' => 'turnintodropdown', 'id' => 'activity', 'options' => $options)); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="input-container calculator-row row">
                                <div class="col-sm-1 label-box long-label">
                                    <label for="personal-goal">Ile chcesz schudnąć ?(miesięcznie)</label>
                                </div>
                                <div class="col-sm-4 input-box">
                                    <input id="personal-goal" type="number" class="bmr-value">
                                </div>
                            </div>


                        </div>


                        <div class="bmr-calculator">

                            <div class="calculator-box hasBMI ">
                                <!--<i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>-->

                                <h4 class="tx-hand calculator-heading">
                                    Twoje zapotrzebowanie kalorii
                                </h4>


                                <div class="tx-hand bmi-score" id="bmr-score"> Wypełnij wszystkie pola</div>
                                <h4 class="tx-hand calculator-heading warn-info">
                                    <strong>Uwaga: spożycie dziennie mniej niż 1000 kcal nie jest zalecane.
                                        Rekomendujemy ustalenie niższego celu redukcji wagi lub zastosowanie diety 1000
                                        kcal i wyrównanie różnicy poprzez zwiększenie aktywności fizycznej.</strong>
                                </h4>

                            </div>

                            <input type="hidden" name="data[User][bmi]" id="bmr-value_" value="0">


                        </div>
                        <h1 class="tx-hand simple-title pull-left add-text">Nie wiesz, jaką dietę wybrać? Dowiedz się
                            więcej o naszych planach:
                            <?php echo $this->Html->link('DIETY', array('controller' => 'pages', 'action' => 'diet')); ?></h1>
                    </div>

                </form>


                <script>

                    $('#personal-goal').on('input', function () {
                        console.log($(this).val());
                        if ($(this).val() > 5) {
                            $(this).val(5);
                        }
                        if ($(this).val() < 1) {
                            $(this).val(1);
                        }
                    });

                    var activity = $("#activity :selected").text();


                    function calcBMR() {
                        var weight = $('#weight').val();
                        var height = $('#height').val();
                        var age = $('#age').val();
                        var gender = $('input[name="radioGender"]:checked', '#calculator-form').val();
                        var personalGoal = $('#personal-goal').val();
                        var activitySplit = activity.split(" -");

                        var check = false;

                        check = checkVariables([weight, height, gender, age, personalGoal, activitySplit[0]]);

                        if (check) {

                            $.ajax({
                                type: "POST",
                                url: "/pages/bmr",
                                data: {
                                    Bmr: {
                                        weight: weight,
                                        height: height,
                                        gender: gender,
                                        age: age,
                                        personalGoal: personalGoal,
                                        activity: activitySplit[0]
                                    }
                                },
                                dataType: "json",
                                error: function (response) {
                                },
                                success: function (response) {

                                    if (response['bmr'] < 1000) {
                                        $('.warn-info').show();
                                    }else{
                                        $('.warn-info').hide();
                                    }
                                    $('#bmr-score').html(response['bmr'] + " kCal");
                                    $("#bmr-value_").val(response['bmr']);

                                },
                                done: function (response) {

                                }
                            });

                        } else {
                            $('#bmr-score').html('Wypełnij wszystkie pola');

                        }


                    }
                    function checkVariables(myVar) {

                        for (var i = 0; i < myVar.length; i++) {
                            if (myVar[i] == null || myVar[i] == undefined || myVar[i] == "") {
                                return false;
                            }
                        }
                        return true;
                    }


                    $(document).ready(function () {
                        $(document).on('click', '.dropcontainer ul li a', function () {
                            activity = $(this).html();
                            calcBMR();
                        });
                        $(document).on('change', 'input[name="radioGender"]:checked', function () {

                            gender = $('input[name="radioGender"]:checked', '#calculator-form').val();
                            calcBMR();
                        })
                        $('#weight').bind('input', function () {
                            if (($('#height').val() != null) && ($('#height').val() > 0)) {
                                calcBMR();
                            }
                        });
                        $('#height').bind('input', function () {
                            if (($('#weight').val() != null) && ($('#weight').val() > 0)) {
                                calcBMR();

                            }

                        });
                        $('#age').bind('input', function () {
                            if (($('#weight').val() != null) && ($('#weight').val() > 0)) {
                                calcBMR();

                            }

                        });


                        $('.bmr-value').each(function () {
                            $(this).keyup(function () {
                                calcBMR();
                            });
                        });

//                         BMR
                    });
                </script>


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
