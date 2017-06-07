<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-2">
        </div>
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $item['Item']['title']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID:</th>
                            <td><?php echo $item['Item']['id']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Nazwa:</th>
                            <td><?php echo $item['Item']['title']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Zdjęcie:</th>
                            <td><?php echo $this->Media->embed('m' . DS . $item['Item']['dirname'] . DS . $item['Item']['basename']); ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Cena:</th>
                            <td><?php echo $item['Item']['price'] .' zł'; ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Tekst:</th>
                            <td><?php echo $item['Item']['body']; ?></td>
                        </tr>




                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-2">
        </div>
    </div><!-- /.row -->
</section>