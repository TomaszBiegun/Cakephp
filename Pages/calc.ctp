<section class="calculator-area">
    <div class="black-heading about-heading">
        <div class="tx-holder">
            <h1 class="tx-hand tx-main">
                KALKULATOR BMI
            </h1>

            <h2 class="tx-hand tx-subtitle">
                Oblicz Twój wskaźnik masy ciała
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
                                    <div class="control-group radio">
                                        <input type="radio" name="gender" class="radio-value bmr-value" value="female"
                                               id="sex-female">
                                        <label for="sex-female" class="control-label">Kobieta</label>
                                    </div>
                                    <div class="control-group radio">
                                        <input type="radio" name="gender" class="radio-value bmr-value" value="male"
                                               id="sex-male">
                                        <label for="sex-male" class="control-label">Mężczyzna</label>
                                    </div>
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

                            <!--                            <div class="input-container calculator-row row">-->
                            <!--                                <div class="col-sm-1 label-box">-->
                            <!--                                    <label for="age">Wiek</label>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-sm-4 input-box">-->
                            <!--                                    <input id="age" type="number" class="bmr-value">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!---->
                            <!--                            <div class="input-container calculator-row row">-->
                            <!--                                <div class="col-sm-1 label-box">-->
                            <!--                                    <label for="activity">Aktywność</label>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-sm-4 input-box">-->
                            <!--                                    <div class="custom-select green-select">-->
                            <!--                                        <select id="activity" class="turnintodropdown">-->
                            <!---->
                            <!--                                            <option> Wybierz aktywność</option>-->
                            <!--                                            <option> Bardzo niska - siedzący tryb pracy/ brak aktywności fizyczne-->
                            <!--                                            </option>-->
                            <!--                                            <option> Niska - mało aktywny tryb pracy/ lekka aktywność fizyczna 1-2 razy-->
                            <!--                                                w tygodniu-->
                            <!--                                            </option>-->
                            <!--                                            <option> Średnia - umiarkowany tryb pracy/ćwiczenia lub treningi sportowe-->
                            <!--                                                3-4 razy w tygodniu-->
                            <!--                                            </option>-->
                            <!--                                            <option> Wysoka - praca fizyczna/ ćwiczenia/treningi sportowe 5-6 razy w-->
                            <!--                                                tygodniu-->
                            <!--                                            </option>-->
                            <!--                                            <option> Bardzo wysoka - ciężki wysiłek dzienny/ wymagające-->
                            <!--                                                ćwiczenia/treningi sportowe codzienne-->
                            <!--                                            </option>-->
                            <!--                                        </select>-->
                            <!---->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!---->
                            <!--                            <div class="input-container calculator-row row">-->
                            <!--                                <div class="col-sm-1 label-box long-label">-->
                            <!--                                    <label for="personal-goal">Ile chcesz schudnąć?</label>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-sm-4 input-box">-->
                            <!--                                    <input id="personal-goal" type="number" class="bmr-value">-->
                            <!--                                </div>-->
                            <!--                            </div>-->


                        </div>


                        <div class="bmi-calculator">

                            <div class="calculator-box hasBMI ">
                                <!--<i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>-->

                                <h2 class="tx-hand calculator-heading">
                                    Twoje BMI
                                </h2>


                                <div class="tx-hand bmi-score" id="bmi-score"> 0</div>

                                <div class="bmi-summary" id="bmi-summary"> prawidłowe</div>
                            </div>

                            <input type="hidden" name="data[User][bmi]" id="bmi-value_" value="0">
                            <input type="hidden" name="data[User][bmi-summary]" id="bmi-summary_">


                        </div>

                        <!--                        <div class="bmr-calculator">-->
                        <!---->
                        <!--                            <div class="calculator-box hasBMI ">-->
                        <!--                                <!--<i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>-->

                        <!---->
                        <!--                                <h4 class="tx-hand calculator-heading">-->
                        <!--                                    Twoje zapotrzebowanie kalorii-->
                        <!--                                </h4>-->
                        <!---->
                        <!---->
                        <!--                                <div class="tx-hand bmi-score" id="bmr-score"> Wypełnij wszystkie pola</div>-->
                        <!---->
                        <!---->
                        <!--                            </div>-->
                        <!---->
                        <!--                            <input type="hidden" name="data[User][bmi]" id="bmr-value_" value="0">-->
                        <!---->
                        <!---->
                        <!--                        </div>-->
                    </div>

                </form>
                <!--                "Aby obliczyć Twoje całkowite dzienne zapotrzebowanie kaloryczne, kliknij:-->
                <!--                KALKULATOR TDEE <hiperłącze do kalkulatora TDEE>"-->
                <h1 class="tx-hand simple-title pull-left add-text">Aby obliczyć Twoje całkowite dzienne zapotrzebowanie
                    kaloryczne,
                    kliknij <?php echo $this->Html->link('KALKULATOR TDEE', array('controller' => 'pages', 'action' => 'calc2')); ?></h1>

                <script>
                    function calcBMI() {
                        var height = $('#height').val();
                        var weight = $('#weight').val();

                        $.ajax({
                            type: "POST",
                            url: "/pages/bmi",
                            data: {
                                Bmi: {
                                    height: height,
                                    weight: weight
                                }
                            },
                            dataType: "json",
                            error: function (response) {
                            },
                            success: function (response) {


                                $('#bmi-score').html(response['bmi']);
                                $('#bmi-summary').html(response['summary']);

                                $("#bmi-value_").val(response['bmi']);
                                $("#bmi-summary_").val(response['summary']);
                            },
                            done: function (response) {

                            }
                        });
                    }


                    //                    function calcBMR() {
                    //                        var weight = $('#weight').val();
                    //                        var height = $('#height').val();
                    //                        var gender = $('.bmr-value[name="gender"]:checked', '#calculator-form').val();
                    //                        var age = $('#age').val();
                    //                        var personalGoal = $('#personal-goal').val();
                    //                        var activity = $("#activity").val();
                    //                        var activitySplit = activity.split(" -");
                    //
                    //
                    //                        var check = true;
                    //                        check = checkVariables([weight, height, gender, age, personalGoal, activitySplit[0]]);
                    //
                    //
                    //                        if (check) {
                    //
                    //                            $.ajax({
                    //                                type: "POST",
                    //                                url: "/pages/bmr",
                    //                                data: {
                    //                                    Bmr: {
                    //                                        weight: weight,
                    //                                        height: height,
                    //                                        gender: gender,
                    //                                        age: age,
                    //                                        personalGoal: personalGoal,
                    //                                        activity: activitySplit[0]
                    //                                    }
                    //                                },
                    //                                dataType: "json",
                    //                                error: function (response) {
                    //                                },
                    //                                success: function (response) {
                    //                                    $('#bmr-score').html(response['bmr'] + " kCal");
                    //                                    $("#bmr-value_").val(response['bmr']);
                    //
                    //                                },
                    //                                done: function (response) {
                    //
                    //                                }
                    //                            });
                    //
                    //                        } else {
                    //                            $('#bmr-score').html('Wypełnij wszystkie pola');
                    //
                    //                        }
                    //
                    //
                    //                    }
                    function checkVariables(myVar) {
                        for (var i = 0; i < myVar.length; i++) {
                            if (myVar[i] == null || myVar[i] == undefined || myVar[i] == "") {
                                return false;
                            }
                        }
                        return true;
                    }


                    $(document).ready(function () {
                        $('#weight').bind('input', function () {
                            if (($('#height').val() != null) && ($('#height').val() > 0)) {
                                calcBMI();
                            }
                        });
                        $('#height').bind('input', function () {
                            if (($('#weight').val() != null) && ($('#weight').val() > 0)) {
                                calcBMI();
                            }

                        });


//                        $('.bmr-value').each(function () {
//                            $(this).keyup(function () {
//                                calcBMR();
//                            });
//                        });

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
