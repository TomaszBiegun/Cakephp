<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-1">
        </div>
        <div class="col-xs-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quiz użytkownika <?php echo $quiz['Quiz']['user_name']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID:</th>
                            <td><?php echo $quiz['Quiz']['id']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">E-mail:</th>
                            <td><?php echo $quiz['Quiz']['user_mail']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Płeć:</th>
                            <td><?php echo $gender[$quiz['Quiz']['gender']]; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Waga:</th>
                            <td><?php echo $quiz['Quiz']['weight']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Wzrost:</th>
                            <td><?php echo $quiz['Quiz']['height']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Wiek:</th>
                            <td><?php echo $quiz['Quiz']['age']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Aktywość:</th>
                            <td><?php echo $activity[$quiz['Quiz']['activity']]; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Cel:</th>
                            <td><?php echo $quiz['Quiz']['goal']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Dieta:</th>
                            <td><?php echo $diet[$quiz['Quiz']['id']]; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Ilość posiłków:</th>
                            <td><?php echo $quiz['Quiz']['meal_count']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Stopień trudności:</th>
                            <td><?php echo $level[$quiz['Quiz']['level']]; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Ilość osób:</th>
                            <td><?php echo $quiz['Quiz']['adult_count']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Utworzono:</th>
                            <td><?php echo $quiz['Quiz']['created']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Podsumowanie:</th>
                            <td><?php echo $quiz['Quiz']['bmi_summary']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">BMI:</th>
                            <td><?php echo $quiz['Quiz']['bmi']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">TDEG:</th>
                            <td><?php echo $quiz['Quiz']['tdeg']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Aktywność quizu:</th>
                            <td><?php if ($quiz['Quiz']['active']) echo 'Aktywny'; else echo 'Nieaktywny'; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-1">
        </div>
    </div><!-- /.row -->
</section>