<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transakcje - pakiety</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('ID', 'id'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_mail', 'E-mail'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Wpłata'); ?></th>
                            <th><?php echo $this->Paginator->sort('due_date', 'Wygaśnie'); ?></th>
                            <th><?php echo $this->Paginator->sort('pack_id', 'ID pakietu'); ?></th>
                            <th><?php echo $this->Paginator->sort('amount', 'Kwota'); ?></th>
                            <th><?php echo $this->Paginator->sort('DotPay ID', 'dotpay_id'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['user_mail']); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['created']); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['due_date']); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['pack_id']); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['amount'] . ' zł'); ?>&nbsp;</td>
                                <td><?php echo h($payment['Payment']['dotpay_id']); ?>&nbsp;</td>
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
