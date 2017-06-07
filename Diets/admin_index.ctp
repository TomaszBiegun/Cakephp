<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista diet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('name', 'Nazwa'); ?></th>
                            <th><?php echo $this->Paginator->sort('body', 'Tekst'); ?></th>
                            <th><?php echo $this->Paginator->sort('dirname', 'Zdjęcie'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Stworzono'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified', 'Zmodyfikowano'); ?></th>
                            <th><?php echo 'Liczba przepisów'; ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($diets as $diet): ?>
                            <tr>
                                <td><?php echo h($diet['Diet']['name']); ?>&nbsp;</td>
                                <td><?php echo substr($diet['Diet']['body'], 0, 100).'[...]'; ?>&nbsp;</td>
                                <td><?php echo $this->Media->embed('s' . DS . $diet['Diet']['dirname'] . DS . $diet['Diet']['basename']); ?>
                                    &nbsp;</td>
                                <td><?php echo h($diet['Diet']['created']); ?>&nbsp;</td>
                                <td><?php echo h($diet['Diet']['modified']); ?>&nbsp;</td>
                                <td><?php echo h($diet['Diet']['count']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('action' => 'view', $diet['Diet']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <?php echo $this->Html->link(__('Edycja'), array('action' => 'edit', $diet['Diet']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń'), array('action' => 'delete', $diet['Diet']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $diet['Diet']['id']))); ?>
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
