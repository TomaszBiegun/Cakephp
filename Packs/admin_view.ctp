<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-1">
        </div>
        <div class="col-xs-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pakiet - <?php echo $pack['Pack']['title']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Informacja:</th>
                            <td><?php echo $pack['Pack']['subtitle']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Tekst:</th>
                            <td><?php echo $pack['Pack']['body']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Ilość miesięcy:</th>
                            <td><?php echo $pack['Pack']['per']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Cena:</th>
                            <td><?php echo $pack['Pack']['ammount'].' zł'; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Aktywność:</th>
                            <td><?php echo $pack['Pack']['active']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Zdjęcie:</th>
                            <td><?php echo $this->Media->embed('s' . DS . $pack['Pack']['dirname'] . DS . $pack['Pack']['basename']); ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Utoworzono:</th>
                            <td><?php echo $pack['Pack']['created']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Zmodyfikowano:</th>
                            <td><?php echo $pack['Pack']['modified']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Ilość osób:</th>
                            <td><?php echo $pack['Pack']['people']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Pomoc dietetyka:</th>
                            <td><?php echo $pack['Pack']['help']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Generowana lista zakupów:</th>
                            <td><?php echo $pack['Pack']['list']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Zapamiętywanie BMI oraz wagi:</th>
                            <td><?php echo $pack['Pack']['remember']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Dostęp do aplikacji mobilnej:</th>
                            <td><?php echo $pack['Pack']['special']; ?></td>
                        </tr>


                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-1">
        </div>
    </div><!-- /.row -->
</section>