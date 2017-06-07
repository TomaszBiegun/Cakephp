<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Produkty</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('Lp', 'Lp'); ?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Nazwa'); ?></th>
                            <th><?php echo $this->Paginator->sort('shoplist', 'Grupa - Lista zakupów'); ?></th>
                            <th><?php echo $this->Paginator->sort('group_name', 'Grupa - Quiz'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Stworzono'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo h($product['Product']['Lp']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['shoplist']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['group_name']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <!--                                    --><?php //echo $this->Html->link(__('Edycja'), array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <!--                                    --><?php //echo $this->Form->postLink(__('Usuń'), array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
                                </td>
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
