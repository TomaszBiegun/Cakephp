<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">FAQ - <?php echo $faq['Faq']['title']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID:</th>
                            <td><?php echo h($faq['Faq']['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Tytuł:</th>
                            <td><?php echo $faq['Faq']['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Tekst:</th>
                            <td><?php echo $faq['Faq']['body']; ?></td>
                        </tr>
                        <tr>
                            <th>Aktywność:</th>
                            <td><?php echo $faq['Faq']['active']; ?></td>
                        </tr>
                        <tr>
                            <th>Utworzono:</th>
                            <td><?php echo h($faq['Faq']['created']); ?></td>
                        </tr>
                        <tr>
                            <th>Zmodyfikowano:</th>
                            <td><?php echo h($faq['Faq']['modified']); ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-3">
        </div>
    </div><!-- /.row -->
</section>

