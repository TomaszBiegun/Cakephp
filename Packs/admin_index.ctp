<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cennik - pakiety</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('title', 'Tytuł'); ?></th>
                            <th><?php echo $this->Paginator->sort('subtitle', 'Informacja'); ?></th>
                            <th><?php echo $this->Paginator->sort('body', 'Tekst'); ?></th>
                            <th><?php echo $this->Paginator->sort('ammount', 'Kwota'); ?></th>
                            <th><?php echo $this->Paginator->sort('per', 'Ilość miesięcy:'); ?></th>
                            <th><?php echo $this->Paginator->sort('basename', 'Zdjęcie'); ?></th>
                            <th><?php echo $this->Paginator->sort('active', 'Aktywność'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($packs as $pack): ?>
                            <tr>
                                <td><?php echo h($pack['Pack']['title']); ?>&nbsp;</td>
                                <td><?php echo h($pack['Pack']['subtitle']); ?>&nbsp;</td>
                                <td><?php echo substr($pack['Pack']['body'], 0, 400) . ' [...]'; ?>&nbsp;</td>
                                <td><?php echo h($pack['Pack']['ammount'] . ' zł'); ?>&nbsp;</td>
                                <td><?php echo h($pack['Pack']['per']); ?>&nbsp;</td>
                                <td><?php echo $this->Media->embed('s' . DS . $pack['Pack']['dirname'] . DS . $pack['Pack']['basename']); ?>
                                    &nbsp;</td>
                                <td><?php echo h($pack['Pack']['active']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('admin' => true, 'controller' => 'packs', 'action' => 'view', $pack['Pack']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <?php echo $this->Html->link(__('Edycja'), array('action' => 'edit', $pack['Pack']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń'), array('admin' => true, 'controller' => 'packs', 'action' => 'delete', $pack['Pack']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $pack['Pack']['id']))); ?>
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
