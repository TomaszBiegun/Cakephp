<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Wpis - <?php echo $about['About']['title']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID:</th>
                            <td><?php echo h($about['About']['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Tytuł:</th>
                            <td><?php echo $about['About']['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Informacja:</th>
                            <td><?php echo $about['About']['info']; ?></td>
                        </tr>
                        <tr>
                            <th>Tekst:</th>
                            <td><?php echo $about['About']['body']; ?></td>
                        </tr>
                        <tr>
                            <th>Zdjęcie:</th>
                            <td><?php echo $this->Media->embed('m' . DS . $about['About']['dirname'] . DS . $about['About']['basename']); ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-3">
        </div>
    </div><!-- /.row -->
</section>