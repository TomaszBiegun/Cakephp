<style>
    .error-message {
        position: absolute;
        bottom: -17px;
        color: red;
        font-weight: bold;
        font-size: 12px;
        right: 0;
    }

    .nav-tabs {
        display: none;
        position: absolute;
        top: 198px;
        left: 216px;
        z-index: 9;

    }

    .nav-tabs li a {
        color: #61c234 !important;
        font-size: 20px;
    }

    .global-alert {
        display: none;
        text-align: center;
    }

    .global-alert h3 {
        color: red;
    }
</style>

<section class="quiz-area">
    <ul class="nav nav-tabs" id="nav">
        <li class="active"><a data-toggle="tab" href="#person1" id="person1_name">Osoba 1</a></li>
        <li><a data-toggle="tab" href="#person2" id="person2_name">Osoba 2</a></li>
    </ul>
    <div class="tab-content">
        <div id="person1" class="tab-pane fade in active">
            <div class="container custom-container simply-box-container">
                <div class="simply-box">
                    <div class="simple-inner-container">

                        <div>
                            <h1 class="tx-hand simple-title pull-left">Lifestyle Quiz</h1>
                        </div>
                        <div class="row global-alert">
                            <h3>*Wypełnij wymagane pola</h3>
                        </div>
                        <!--TUTAJ DLA UZYTKOWNIKA KTORY JEST ZALOGOWANY I MA QYPELNIONY QUIZ-->
                        <?php if ($log && $logged_have_quiz): ?>
                            <?php echo $this->Form->create('Quiz', array('novalidate' => 'novalidate', 'class' => 'green-form quiz-form', 'id' => 'form_1', 'data-edit' => '1')); ?>
                            <h2 class="tx-hand tx-green"> Opowiedz nam o sobie </h2>

                            <div class="row">
                                <div class="col-sm-7 col-md-5">
                                    <div class="input-container quiz-row row">

                                        <div class="col-sm-1 label-box">
                                            <label for="name">Imię</label>

                                        </div>


                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('name', array('name' => 'name', 'value' => $user['name'], 'label' => false, 'id' => 'name_1', 'disabled' => 'disabled')); ?>
                                            <div id="error-name" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="name">E-mail</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('user_mail', array('name' => 'user_mail', 'label' => false, 'id' => 'mail', 'value' => $user_mail, 'disabled' => 'disabled')); ?>
                                            <div class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label>Płeć</label>
                                        </div>
                                        <!--                            <div class="my-alert2">-->
                                        <!--                                <p>* Pole wymagane</p>-->
                                        <!--                            </div>-->
                                        <div class="col-sm-4 input-box">
                                            <div class="control-group radio">
                                                <?php echo $this->Form->radio('gender', $gender, array('name' => 'gender', 'value' => $user_quiz['Quiz']['gender'], 'legend' => false)); ?>
                                                <div id="error-gender" class="final my-alert2">
                                                    <p>* Pole wymagane</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="weight">Waga (kg)</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('weight', array('value' => $user_quiz['Quiz']['weight'], 'name' => 'weight', 'label' => false, 'id' => 'weight', 'class' => 'bmi-value', 'type' => 'number', 'min' => '30', 'max' => '250')); ?>
                                            <div id="error-weight" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="height">Wzrost (cm)</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('height', array('value' => $user_quiz['Quiz']['height'], 'name' => 'height', 'label' => false, 'id' => 'height', 'class' => 'bmi-value', 'type' => 'number', 'min' => '90', 'max' => '250')); ?>
                                            <div id="error-height" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container register-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="age">Wiek</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('age', array('value' => $user_quiz['Quiz']['age'], 'name' => 'age', 'label' => false, 'id' => 'age', 'type' => 'number')); ?>
                                            <div id="error-age" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="activity">Aktywność</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <!--                                    <input id="activity" type="text" class="">-->
                                            <div class="custom-select green-select"
                                                 data-value="<?php echo $user_quiz['Quiz']['activity']; ?>">
                                                <?php echo $this->Form->input('activity', array('empty' => $activity[$user_quiz['Quiz']['activity']], 'name' => 'activity', 'label' => false, 'div' => false, 'id' => 'activity', 'options' => $activity, 'class' => 'turnintodropdown')); ?>
                                                <div id="error-activity" class="final my-alert2">
                                                    <p>* Pole wymagane</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-5 col-md-6">

                                    <div class="bmi-calculator">

                                        <div class="calculator-box">
                                            <i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>

                                            <h2 class="tx-hand calculator-heading">
                                                Twoje BMI
                                            </h2>


                                            <div class="tx-hand bmi-score" id="bmi-score"> 0</div>

                                            <div class="bmi-summary" id="bmi-summary"> normalne</div>
                                        </div>

                                        <input type="hidden" name="bmi" id="bmi-value_" value="0">
                                        <input type="hidden" name="bmi_summary" id="bmi-summary_">

                                    </div>


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
                                                    if ($('.calculator-box').hasClass('hasBMI')) {

                                                    } else {
                                                        $('.calculator-box').addClass('hasBMI');
                                                    }

                                                },
                                                done: function (response) {

                                                }
                                            });
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


//                         BMR
                                        });

                                    </script>


                                </div>

                            </div>


                            <div class="col-sm-12 quiz-box goal_box_question goal_box_quest">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="goal_question">Podaj swój cel: </label>
                                    </div>


                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select goal_question_select" data-value="1">
                                            <?php echo $this->Form->input('goal_question', array('empty' => 'Chcę schudnąć', 'name' => 'goal_question', 'label' => false, 'id' => 'goal_question', 'class' => 'turnintodropdown', 'div' => false, 'options' => array(0 => 'Wybierz', 1 => 'Chcę schudnąć', 2 => 'Chcę utrzymać wagę', 3 => 'Chcę przytyć'))); ?>
                                            <div id="error-goal_question" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-sm-12 quiz-box goal_box2">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="goal">O ile kg miesięcznie chciałbyś <span
                                                id="wanted">zredukować</span>
                                            wagę?</label>
                                    </div>


                                    <div class="col-sm-4 input-box-quiz">
                                        <?php echo $this->Form->input('goal', array('value' => $user_quiz['Quiz']['goal'], 'name' => 'goal', 'label' => false, 'id' => 'goal', 'type' => 'number', 'min' => 0, 'max' => 5)); ?>
                                        <div id="error-goal" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="diet-type">Wybierz idealną dietę dla siebie:</label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select"
                                             data-value="<?php echo $user_quiz['Quiz']['diet_id']; ?>">

                                            <?php echo $this->Form->input('diet_id', array('empty' => $diet[$user_quiz['Quiz']['diet_id']], 'value' => $user_quiz['Quiz']['diet_id'], 'empty' => $diet[$user_quiz['Quiz']['diet_id']], 'name' => 'diet_id', 'label' => false, 'id' => 'diet-type', 'class' => 'turnintodropdown', 'div' => false, 'options' => $diet)); ?>
                                            <div id="error-diet_id" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-per-day">Ilość posiłków w ciągu dnia: </label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select options-centered"
                                             data-value="<?php echo $user_quiz['Quiz']['meal_count']; ?>">
                                            <?php echo $this->Form->input('meal_count', array('empty' => $meal_count[$user_quiz['Quiz']['meal_count']], 'name' => 'meal_count', 'label' => false, 'id' => 'meal_count', 'class' => 'turnintodropdown', 'div' => false, 'options' => $meal_count)); ?>
                                            <div id="error-meal_count" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-difficulty">Stopień trudności potraw: </label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select"
                                             data-value="<?php echo $user_quiz['Quiz']['level']; ?>">
                                            <?php echo $this->Form->input('level', array('empty' => $level[$user_quiz['Quiz']['level']], 'name' => 'level', 'label' => false, 'id' => 'level', 'class' => 'turnintodropdown', 'div' => false, 'options' => array(0 => 'Wybierz stopień trudności', 1 => 'Łatwe', 2 => 'Łatwe i bardziej wymagające'))); ?>
                                            <div id="error-level" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label>Czy chcesz wyeliminować z diety wybrane produkty ? </label>
                                    </div>
                                    <?php if (isset($no_products) && !empty($no_products)): ?>
                                        <div class="col-sm-4 input-box-quiz">
                                            <div class="custom-select">
                                                <div class="input-container quiz-row row confirm-container">
                                                    <div class="col-sm-4 input-box confirm">
                                                        <div class="control-group radio">
                                                            <input type="hidden" name="data[User][gender]"
                                                                   id="yes-confirm_"
                                                                   value="0"><input type="radio"
                                                                                    name="data[User][remember_me]"
                                                                                    class="modal-input-remember_me"
                                                                                    value="1"
                                                                                    id="yes-confirm" checked="checked">
                                                            <label id="yes" for="yes-confirm"
                                                                   class="control-label">Tak</label>
                                                        </div>
                                                        <div class="control-group radio">
                                                            <input type="hidden" name="data[User][gender]"
                                                                   id="no-confirm_"
                                                                   value="0"><input type="radio"
                                                                                    name="data[User][remember_me]"
                                                                                    class="modal-input-remember_me"
                                                                                    value="1"
                                                                                    id="no-confirm">
                                                            <label id="no" for="no-confirm"
                                                                   class="control-label">Nie</label>
                                                        </div>

                                                    </div>
                                                    <div class="final my-alert3">
                                                        <p>* Pole wymagane</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-sm-4 input-box-quiz">
                                            <div class="custom-select">
                                                <div class="input-container quiz-row row confirm-container">
                                                    <div class="col-sm-4 input-box confirm">
                                                        <div class="control-group radio">
                                                            <input type="hidden" name="data[User][gender]"
                                                                   id="yes-confirm_"
                                                                   value="0"><input type="radio"
                                                                                    name="data[User][remember_me]"
                                                                                    class="modal-input-remember_me"
                                                                                    value="1"
                                                                                    id="yes-confirm">
                                                            <label id="yes" for="yes-confirm"
                                                                   class="control-label">Tak</label>
                                                        </div>
                                                        <div class="control-group radio">
                                                            <input type="hidden" name="data[User][gender]"
                                                                   id="no-confirm_"
                                                                   value="0"><input type="radio"
                                                                                    name="data[User][remember_me]"
                                                                                    class="modal-input-remember_me"
                                                                                    value="1"
                                                                                    id="no-confirm" checked="checked">
                                                            <label id="no" for="no-confirm"
                                                                   class="control-label">Nie</label>
                                                        </div>

                                                    </div>
                                                    <div class="final my-alert3">
                                                        <p>* Pole wymagane</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!--                        <div class="final my-alert3">-->
                                    <!--                            <p>* Pole wymagane</p>-->
                                    <!--                        </div>-->

                                    <div id="meals-content" class="col-sm-12 input-box-quiz meals-eliminate"
                                        <?php if (!isset($no_products) || empty($no_products)) {
                                            echo 'style="display:none"';
                                        }
                                        ?>
                                    >
                                        <div class="row">
                                            <?php foreach ($groups as $key => $group): ?>
                                                <?php if (isset($no_products) && !empty($no_products)): ?>
                                                    <?php if (in_array($group['Group']['id'], $no_products)): ?>
                                                        <div class="col-sm-3 control-group checkbox">
                                                            <input type="checkbox"
                                                                   id="chk_meal_select<?php echo $key + 1; ?>"
                                                                   name="data[Group][<?php echo $group['Group']['name']; ?>]"
                                                                   value="<?php echo $group['Group']['id']; ?>"
                                                                   checked="checked"/>
                                                            <label for="chk_meal_select<?php echo $key + 1; ?>"
                                                                   class="control-label"><?php echo $group['Group']['name']; ?></label>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-sm-3 control-group checkbox">
                                                            <input type="checkbox"
                                                                   id="chk_meal_select<?php echo $key + 1; ?>"
                                                                   name="data[Group][<?php echo $group['Group']['name']; ?>]"
                                                                   value="<?php echo $group['Group']['id']; ?>"/>
                                                            <label for="chk_meal_select<?php echo $key + 1; ?>"
                                                                   class="control-label"><?php echo $group['Group']['name']; ?></label>
                                                        </div>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="col-sm-3 control-group checkbox">
                                                        <input type="checkbox"
                                                               id="chk_meal_select<?php echo $key + 1; ?>"
                                                               name="data[Group][<?php echo $group['Group']['name']; ?>]"
                                                               value="<?php echo $group['Group']['id']; ?>"/>
                                                        <label for="chk_meal_select<?php echo $key + 1; ?>"
                                                               class="control-label"><?php echo $group['Group']['name']; ?></label>
                                                    </div>

                                                <?php endif; ?>


                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!--                        <div class="final my-alert3">-->
                                    <!--                            <p>* Pole wymagane</p>-->
                                    <!--                        </div>-->
                                </div>
                            </div>

                            <div class="col-sm-12 quiz-box ">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-people-count">Jeśli przygotowujesz posiłki również dla swojego
                                            Partnera, możesz podać jego parametry, a Greencook obliczy listę produktówą
                                            dla
                                            Was obojga.</label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select adult_select">
                                            <?php echo $this->Form->input('adult_count', array('name' => 'adult_count', 'label' => false, 'id' => 'adult_count', 'class' => 'turnintodropdown', 'div' => false, 'empty' => '1 osoba', 'options' => array('1' => '1 osoba', '2' => '2 osoby'))); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="quiz-button-container">
                                <?php echo $this->Form->submit('Zapisz', array('id' => 'save', 'class' => 'green-submit btn-green quiz-button', 'div' => false)); ?>
                            </div>


                            <?php echo $this->Form->end(); ?>
                        <?php else: ?>
                            <?php echo $this->Form->create('Quiz', array('novalidate' => 'novalidate', 'class' => 'green-form quiz-form', 'id' => 'form_1', 'data-edit' => '0')); ?>
                            <h2 class="tx-hand tx-green"> Opowiedz nam o sobie </h2>

                            <div class="row">
                                <div class="col-sm-7 col-md-5">
                                    <div class="input-container quiz-row row">

                                        <div class="col-sm-1 label-box">
                                            <label for="name">Imię</label>

                                        </div>


                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('name', array('name' => 'name', 'label' => false, 'id' => 'name_1')); ?>
                                            <div id="error-name" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="name">E-mail</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('user_mail', array('name' => 'user_mail', 'label' => false, 'id' => 'mail', 'value' => $user_mail)); ?>
                                            <div class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label>Płeć</label>
                                        </div>
                                        <!--                            <div class="my-alert2">-->
                                        <!--                                <p>* Pole wymagane</p>-->
                                        <!--                            </div>-->
                                        <div class="col-sm-4 input-box">
                                            <div class="control-group radio">
                                                <?php echo $this->Form->radio('gender', $gender, array('name' => 'gender', 'legend' => false)); ?>
                                                <div id="error-gender" class="final my-alert2">
                                                    <p>* Pole wymagane</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="weight">Waga (kg)</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('weight', array('name' => 'weight', 'label' => false, 'id' => 'weight', 'class' => 'bmi-value', 'type' => 'number', 'min' => '30', 'max' => '250')); ?>
                                            <div id="error-weight" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="height">Wzrost (cm)</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('height', array('name' => 'height', 'label' => false, 'id' => 'height', 'class' => 'bmi-value', 'type' => 'number', 'min' => '90', 'max' => '250')); ?>
                                            <div id="error-height" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container register-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="age">Wiek</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <?php echo $this->Form->input('age', array('name' => 'age', 'label' => false, 'id' => 'age', 'type' => 'number')); ?>
                                            <div id="error-age" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-container quiz-row row">
                                        <div class="col-sm-1 label-box">
                                            <label for="activity">Aktywność</label>
                                        </div>

                                        <div class="col-sm-4 input-box">
                                            <!--                                    <input id="activity" type="text" class="">-->
                                            <div class="custom-select green-select">
                                                <?php echo $this->Form->input('activity', array('name' => 'activity', 'label' => false, 'div' => false, 'id' => 'activity', 'options' => $activity, 'class' => 'turnintodropdown')); ?>
                                                <div id="error-activity" class="final my-alert2">
                                                    <p>* Pole wymagane</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-5 col-md-6">

                                    <div class="bmi-calculator">

                                        <div class="calculator-box">
                                            <i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>

                                            <h2 class="tx-hand calculator-heading">
                                                Twoje BMI
                                            </h2>


                                            <div class="tx-hand bmi-score" id="bmi-score"> 0</div>

                                            <div class="bmi-summary" id="bmi-summary"> normalne</div>
                                        </div>

                                        <input type="hidden" name="bmi" id="bmi-value_" value="0">
                                        <input type="hidden" name="bmi_summary" id="bmi-summary_">

                                    </div>


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
                                                    if ($('.calculator-box').hasClass('hasBMI')) {

                                                    } else {
                                                        $('.calculator-box').addClass('hasBMI');
                                                    }

                                                },
                                                done: function (response) {

                                                }
                                            });
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


//                         BMR
                                        });

                                    </script>


                                </div>

                            </div>


                            <div class="col-sm-12 quiz-box goal_box_question goal_box_quest">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="goal_question">Podaj swój cel: </label>
                                    </div>


                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select goal_question_select">
                                            <?php echo $this->Form->input('goal_question', array('name' => 'goal_question', 'label' => false, 'id' => 'goal_question', 'class' => 'turnintodropdown', 'div' => false, 'options' => array(0 => 'Wybierz', 1 => 'Chcę schudnąć', 2 => 'Chcę utrzymać wagę', 3 => 'Chcę przytyć'))); ?>
                                            <div id="error-goal_question" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-sm-12 quiz-box goal_box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="goal">O ile kg miesięcznie chciałbyś <span
                                                id="wanted">zredukować</span>
                                            wagę?</label>
                                    </div>


                                    <div class="col-sm-4 input-box-quiz">
                                        <?php echo $this->Form->input('goal', array('name' => 'goal', 'label' => false, 'id' => 'goal', 'type' => 'number', 'min' => 0, 'max' => 5)); ?>
                                        <div id="error-goal" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="diet-type">Wybierz idealną dietę dla siebie:</label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select ">

                                            <?php echo $this->Form->input('diet_id', array('name' => 'diet_id', 'label' => false, 'id' => 'diet-type', 'class' => 'turnintodropdown', 'div' => false, 'options' => $diet)); ?>
                                            <div id="error-diet_id" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-per-day">Ilość posiłków w ciągu dnia: </label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select options-centered">
                                            <?php echo $this->Form->input('meal_count', array('name' => 'meal_count', 'label' => false, 'id' => 'meal_count', 'class' => 'turnintodropdown', 'div' => false, 'options' => $meal_count)); ?>
                                            <div id="error-meal_count" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-difficulty">Stopień trudności potraw: </label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select">
                                            <?php echo $this->Form->input('level', array('name' => 'level', 'label' => false, 'id' => 'level', 'class' => 'turnintodropdown', 'div' => false, 'options' => array(0 => 'Wybierz stopień trudności', 1 => 'Łatwe', 2 => 'Łatwe i bardziej wymagające'))); ?>
                                            <div id="error-level" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label>Czy chcesz wyeliminować z diety wybrane produkty ? </label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select">
                                            <div class="input-container quiz-row row confirm-container">
                                                <div class="col-sm-4 input-box confirm">
                                                    <div class="control-group radio">
                                                        <input type="hidden" name="data[User][gender]"
                                                               id="yes-confirm_"
                                                               value="0"><input type="radio"
                                                                                name="data[User][remember_me]"
                                                                                class="modal-input-remember_me"
                                                                                value="1"
                                                                                id="yes-confirm">
                                                        <label id="yes" for="yes-confirm"
                                                               class="control-label">Tak</label>
                                                    </div>
                                                    <div class="control-group radio">
                                                        <input type="hidden" name="data[User][gender]"
                                                               id="no-confirm_"
                                                               value="0"><input type="radio"
                                                                                name="data[User][remember_me]"
                                                                                class="modal-input-remember_me"
                                                                                value="1"
                                                                                id="no-confirm">
                                                        <label id="no" for="no-confirm"
                                                               class="control-label">Nie</label>
                                                    </div>

                                                </div>
                                                <div class="final my-alert3">
                                                    <p>* Pole wymagane</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                        <div class="final my-alert3">-->
                                    <!--                            <p>* Pole wymagane</p>-->
                                    <!--                        </div>-->

                                    <div id="meals-content" class="col-sm-12 input-box-quiz meals-eliminate"
                                         style="display:none">
                                        <div class="row">
                                            <?php foreach ($groups as $key => $group): ?>
                                                <div class="col-sm-3 control-group checkbox">
                                                    <input type="checkbox"
                                                           id="chk_meal_select<?php echo $key + 1; ?>"
                                                           name="data[Group][<?php echo $group['Group']['name']; ?>]"
                                                           value="<?php echo $group['Group']['id']; ?>"/>
                                                    <label for="chk_meal_select<?php echo $key + 1; ?>"
                                                           class="control-label"><?php echo $group['Group']['name']; ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!--                        <div class="final my-alert3">-->
                                    <!--                            <p>* Pole wymagane</p>-->
                                    <!--                        </div>-->
                                </div>
                            </div>

                            <div class="col-sm-12 quiz-box">
                                <div class="row input-container-quiz">
                                    <div class="col-sm-8 label-box-quiz">
                                        <label for="meals-people-count">Jeśli przygotowujesz posiłki również dla swojego
                                            Partnera, możesz podać jego parametry, a Greencook obliczy listę produktówą
                                            dla
                                            Was obojga.</label>
                                    </div>

                                    <div class="col-sm-4 input-box-quiz">
                                        <div class="custom-select adult_select">
                                            <?php echo $this->Form->input('adult_count', array('name' => 'adult_count', 'label' => false, 'id' => 'adult_count', 'class' => 'turnintodropdown', 'div' => false, 'empty' => '1 osoba', 'options' => array('1' => '1 osoba', '2' => '2 osoby'))); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="quiz-button-container">
                                <?php echo $this->Form->submit('Zapisz', array('id' => 'save', 'class' => 'green-submit btn-green quiz-button', 'div' => false)); ?>
                            </div>


                            <?php echo $this->Form->end(); ?>
                        <?php endif; ?>


                    </div>


                </div>

            </div>
        </div>
        <div id="person2" class="tab-pane fade">
            <div class="container custom-container simply-box-container">
                <div class="simply-box">
                    <div class="simple-inner-container">

                        <div>
                            <h1 class="tx-hand simple-title pull-left">Lifestyle Quiz</h1>
                        </div>

                        <?php echo $this->Form->create('Quiz', array('novalidate' => 'novalidate', 'class' => 'green-form quiz-form', 'id' => 'form_2')); ?>
                        <h2 class="tx-hand tx-green"> Poniżej wprowadź informacje dotyczące Twojego Partnera </h2>

                        <div class="row">
                            <div class="col-sm-7 col-md-5">
                                <div class="input-container quiz-row row">

                                    <div class="col-sm-1 label-box">
                                        <label for="name">Imię</label>

                                    </div>


                                    <div class="col-sm-4 input-box">
                                        <?php echo $this->Form->input('name', array('name' => 'user_name', 'label' => false, 'id' => 'name_2')); ?>
                                        <div id="error-name-2" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-container quiz-row row">
                                    <div class="col-sm-1 label-box">
                                        <label>Płeć</label>
                                    </div>
                                    <!--                            <div class="my-alert2">-->
                                    <!--                                <p>* Pole wymagane</p>-->
                                    <!--                            </div>-->
                                    <div class="col-sm-4 input-box">
                                        <div class="control-group radio">
                                            <?php echo $this->Form->radio('gender2', $gender, array('name' => 'gender', 'legend' => false)); ?>
                                            <div id="error-gender-2" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-container quiz-row row">
                                    <div class="col-sm-1 label-box">
                                        <label for="weight">Waga (kg)</label>
                                    </div>

                                    <div class="col-sm-4 input-box">
                                        <?php echo $this->Form->input('weight', array('name' => 'weight', 'label' => false, 'id' => 'weight_2', 'class' => 'bmi-value', 'type' => 'number', 'min' => '30', 'max' => '250')); ?>
                                        <div id="error-weight-2" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-container quiz-row row">
                                    <div class="col-sm-1 label-box">
                                        <label for="height">Wzrost (cm)</label>
                                    </div>

                                    <div class="col-sm-4 input-box">
                                        <?php echo $this->Form->input('height', array('name' => 'height', 'label' => false, 'id' => 'height_2', 'class' => 'bmi-value', 'type' => 'number', 'min' => '90', 'max' => '250')); ?>
                                        <div id="error-height-2" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-container register-row row">
                                    <div class="col-sm-1 label-box">
                                        <label for="age">Wiek</label>
                                    </div>

                                    <div class="col-sm-4 input-box">
                                        <?php echo $this->Form->input('age', array('name' => 'age', 'label' => false, 'id' => 'age', 'type' => 'number')); ?>
                                        <div id="error-age-2" class="final my-alert2">
                                            <p>* Pole wymagane</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-container quiz-row row">
                                    <div class="col-sm-1 label-box">
                                        <label for="activity">Aktywność</label>
                                    </div>

                                    <div class="col-sm-4 input-box">
                                        <!--                                    <input id="activity" type="text" class="">-->
                                        <div class="custom-select green-select">
                                            <?php echo $this->Form->input('activity', array('name' => 'activity', 'label' => false, 'div' => false, 'id' => 'activity', 'options' => $activity, 'class' => 'turnintodropdown')); ?>
                                            <div id="error-activity-2" class="final my-alert2">
                                                <p>* Pole wymagane</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-5 col-md-6">

                                <div class="bmi-calculator">

                                    <div class="calculator-box2">
                                        <i class="fa fa-calculator faa-pulse faa-slow calculator-icon"></i>

                                        <h2 class="tx-hand calculator-heading">
                                            Twoje BMI
                                        </h2>


                                        <div class="tx-hand bmi-score" id="bmi-score_2"> 0</div>

                                        <div class="bmi-summary" id="bmi-summary_2"> normalne</div>
                                    </div>

                                    <input type="hidden" name="bmi" id="bmi-value_2" value="0">
                                    <input type="hidden" name="bmi_summary" id="bmi-summary_2">

                                </div>


                                <script>
                                    function calcBMI_2() {
                                        var height = $('#height_2').val();
                                        var weight = $('#weight_2').val();

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


                                                $('#bmi-score_2').html(response['bmi']);
                                                $('#bmi-summary_2').html(response['summary']);

                                                $("#bmi-value_2").val(response['bmi']);
                                                $("#bmi-summary_2").val(response['summary']);
                                                if ($('.calculator-box2').hasClass('hasBMI')) {

                                                } else {
                                                    $('.calculator-box2').addClass('hasBMI');
                                                }

                                            },
                                            done: function (response) {

                                            }
                                        });
                                    }
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
                                                if ($('.calculator-box').hasClass('hasBMI')) {

                                                } else {
                                                    $('.calculator-box').addClass('hasBMI');
                                                }

                                            },
                                            done: function (response) {

                                            }
                                        });
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

                                        $('#weight_2').bind('input', function () {
                                            if (($('#height_2').val() != null) && ($('#height_2').val() > 0)) {
                                                calcBMI_2();
                                            }
                                        });
                                        $('#height_2').bind('input', function () {
                                            if (($('#weight').val() != null) && ($('#weight_2').val() > 0)) {
                                                calcBMI_2();
                                            }

                                        });

//                         BMR
                                    });

                                </script>


                            </div>

                        </div>

                        <!--                        <div class="col-sm-12 quiz-box">-->
                        <!--                            <div class="row input-container-quiz">-->
                        <!--                                <div class="col-sm-8 label-box-quiz">-->
                        <!--                                    <label for="goal">Ile chcesz schudnąć ? - podaj o ile kg miesięcznie-->
                        <!--                                        chciałbyś-->
                        <!--                                        zredukować-->
                        <!--                                        wagę:</label>-->
                        <!--                                </div>-->
                        <!---->
                        <!---->
                        <!--                                <div class="col-sm-4 input-box-quiz">-->
                        <!--                                    --><?php //echo $this->Form->input('goal', array('label' => false, 'id' => 'goal', 'type' => 'number')); ?>
                        <!--                                    <div class="final my-alert2">-->
                        <!--                                        <p>* Pole wymagane</p>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!---->
                        <!--                            </div>-->
                        <!--                        </div>-->


                        <?php echo $this->Form->end(); ?>


                    </div>


                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $('#yes').on('click', function () {
            $(this).addClass('aggree');
        });
        $('#no').on('click', function () {
            $(this).addClass('aggree');
        });
        var single = true;


        $(document).on('click', '.adult_select .dropcontainer ul li a', function () {

            if ($(this).html() == '2 osoby') {
                single = false;
                $('.nav-tabs').show();
                $('html,body').animate({scrollTop: 0}, 1000);
                setTimeout(function () {
                    document.getElementById('person2_name').click();
                }, 1000);


            } else {
                $('.nav-tabs').hide();
            }

        });

        $(document).on('click', '.goal_question_select .dropcontainer ul li a', function () {
            if ($(this).html() == 'Chcę schudnąć') {
                $('.goal_box_quest').removeClass('goal_box_question');
                $('#wanted').html('zredukować');
                $('.goal_box').show();
            }
            if ($(this).html() == 'Chcę przytyć') {
                $('.goal_box_quest').removeClass('goal_box_question');
                $('#wanted').html('zwiększyć');
                $('.goal_box').show();
            }
            if ($(this).html() == 'Chcę utrzymać wagę') {
                $('.goal_box_quest').addClass('goal_box_question');
                $('.goal_box').hide();
            }

        });
        $('#goal').on('input', function () {
            console.log($(this).val());
            if ($(this).val() > 5) {
                $(this).val(5);
            }
            if ($(this).val() < 1) {
                $(this).val(1);
            }
        });


        $('#save').on('click', function (e) {
            e.preventDefault();
            $('.global-alert').hide();
            $('.final').hide();
            $('#name_1').removeAttr('disabled');
            $('#mail').removeAttr('disabled');
            var quiz1 = $('#form_1').serializeArray();
            var quiz2 = $('#form_2').serializeArray();
            if (single) {

            } else {
                quiz2[9]['value'] = $('#bmi-summary_2').html();
            }

            $.ajax({
                type: "POST",
                url: "/quizzes/add",
                data: {
                    quiz1: quiz1,
                    quiz2: quiz2
                },
                dataType: "json",
                error: function (response) {

                },
                success: function (response) {
                    if (response['error'] != null) {
                        $('.global-alert').show();
                        $.each(response['error'], function (index, value) {
                            $('#error-' + index).show();
                        });
                        jQuery("html,body").animate({scrollTop: 100}, 1000);
                    }
                    if (response['error-2'] != null) {
                        $.each(response['error-2'], function (index, value) {
                            $('#error-' + index + '-2').show();
                        });
                    }
                    if (response == 'done') {
                        window.location.href = '/pages/calculator';
                    }


                },
                done: function (response) {

                }
            });
        });


        $(document).ready(function () {
            calcBMI();
            $('#name_2').on('input', function () {
                $('#person2_name').html($(this).val());
                if ($(this).val() == '' || $(this).val() == null) {
                    $('#person2_name').html('Osoba 2');
                }
            });
            $('#name_1').on('input', function () {
                $('#person1_name').html($(this).val());
                if ($(this).val() == '' || $(this).val() == null) {
                    $('#person1_name').html('Osoba 1');
                }
            });

            var $animation_elements = $('.simply-box');
            var $window = $(window);


            $("#yes").click(function () {


                if ($("#meals-content").hasClass('inContent')) {

                } else {
                    $("#meals-content").slideToggle("slow");
                    $("#meals-content").addClass('inContent');
                }
            });
            $("#no").click(function () {
                if ($("#meals-content").hasClass('inContent')) {
                    $("#meals-content").slideToggle("slow");
                    $("#meals-content").removeClass('inContent');
                }

            });


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


            if ($('#form_1').data('edit') == 1) {
                setTimeout(function () {
                    $('#activity').attr('value', $('#activity').parent().data('value'));
                    $('#goal_question').attr('value', $('#goal_question').parent().data('value'));
                    $('#diet-type').attr('value', $('#diet-type').parent().data('value'));
                    $('#level').attr('value', $('#level').parent().data('value'));
                    $('#meal_count').attr('value', $('#meal_count').parent().data('value'));

                }, 500);
            }
//            $('#activity').parent().data('value')


        });


    </script>

</section>