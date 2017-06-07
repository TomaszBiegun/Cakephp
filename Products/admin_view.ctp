<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Produkt - <?php echo $product['Product']['name']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">LP:</th>
                            <td><?php echo h($product['Product']['Lp']); ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Grupa - Lista zakupów:</th>
                            <td><?php echo h($product['Product']['shoplist']); ?></td>
                        </tr>
                        <tr>
                            <th>Nazwa:</th>
                            <td><?php echo $product['Product']['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Utworzono:</th>
                            <td><?php echo $product['Product']['created']; ?></td>
                        </tr>
                        <tr>
                            <th>Zmodyfikowano:</th>
                            <td><?php echo $product['Product']['modified'] ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-3">
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Składowe</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('name', 'Nazwa'); ?></th>
                            <th><?php echo $this->Paginator->sort('category', 'Grupa'); ?></th>
                            <th><?php echo $this->Paginator->sort('value', 'Wartość'); ?></th>
                            <th><?php echo $this->Paginator->sort('unit', 'Jednostka'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($components as $comp): ?>
                            <tr>
                                <td><?php echo h($comp['Componnent']['name']); ?>&nbsp;</td>
                                <td><?php echo h($comp['Componnent']['category']); ?>&nbsp;</td>
                                <td><?php echo h($comp['Componnent']['value']); ?>&nbsp;</td>
                                <td><?php echo h($comp['Componnent']['unit']); ?>&nbsp;</td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                    <?php echo $this->Element('pagging'); ?>

                </div>
            </div>
        </div>
    </div>


</section>
