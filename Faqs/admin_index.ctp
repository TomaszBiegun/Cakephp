<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">FAQ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('title', 'Tytuł'); ?></th>
                            <th><?php echo $this->Paginator->sort('body', 'Tekst'); ?></th>
                            <th><?php echo $this->Paginator->sort('active', 'Aktywność'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Utworzono'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified', 'Zmodyfikowano'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($faqs as $faq): ?>
                            <tr>
                                <td><?php echo $faq['Faq']['title']; ?>&nbsp;</td>
                                <td><?php echo substr($faq['Faq']['body'], 0, 100);
                                    echo '[...]'; ?>&nbsp;</td>
                                <td><?php if ($faq['Faq']['active'] == 1) {
                                        echo 'Aktywny';
                                    } else echo 'Nieaktywny'; ?>&nbsp;</td>
                                <td><?php echo h($faq['Faq']['created']); ?>&nbsp;</td>
                                <td><?php echo h($faq['Faq']['modified']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('action' => 'view', $faq['Faq']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <?php echo $this->Html->link(__('Edycja'), array('action' => 'edit', $faq['Faq']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń'), array('action' => 'delete', $faq['Faq']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $faq['Faq']['id']))); ?>
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