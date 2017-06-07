<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Przedmioty</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('title', 'Tytuł'); ?></th>
                            <th><?php echo $this->Paginator->sort('body', 'Tekst'); ?></th>
                            <th><?php echo $this->Paginator->sort('price', 'Cena'); ?></th>
                            <th><?php echo $this->Paginator->sort('basename', 'Zdjęcie'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Utworzono'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?php echo $item['Item']['title']; ?>&nbsp;</td>
                                <td><?php echo $item['Item']['body']; ?>&nbsp;</td>
                                <td><?php echo $item['Item']['price']; ?>&nbsp;</td>
                                <td><?php echo $this->Media->embed('s' . DS . $item['Item']['dirname'] . DS . $item['Item']['basename']); ?>
                                    &nbsp;</td>
                                <td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('admin' => true, 'controller' => 'items', 'action' => 'view', $item['Item']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <?php echo $this->Html->link(__('Edycja'), array('action' => 'edit', $item['Item']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń'), array('admin' => true, 'controller' => 'items', 'action' => 'delete', $item['Item']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $item['Item']['id']))); ?>
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
