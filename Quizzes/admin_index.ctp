<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quizy</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('user_mail', 'E-mail'); ?></th>
                            <th><?php echo $this->Paginator->sort('gender', 'Płeć'); ?></th>
                            <th><?php echo $this->Paginator->sort('diet_id', 'Dieta'); ?></th>
                            <th><?php echo $this->Paginator->sort('meal_count', 'Ilość posiłków'); ?></th>
                            <th><?php echo $this->Paginator->sort('level', 'Stopień trudności potraw'); ?></th>
                            <th><?php echo $this->Paginator->sort('adult_count', 'Ilość osób'); ?></th>
                            <th><?php echo $this->Paginator->sort('active', 'Aktywność'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($quizzes as $quiz): ?>
                            <tr>
                                <td>
                                    <?php echo h($quiz['Quiz']['user_mail']); ?>
                                </td>
                                <td><?php if ($quiz['Quiz']['gender'] == 1) echo 'Mężczyzna'; else echo 'Kobieta'; ?>
                                    &nbsp;</td>
                                <td><?php echo h($diet[$quiz['Quiz']['diet_id']]); ?>&nbsp;</td>
                                <td><?php echo h($quiz['Quiz']['meal_count']); ?>&nbsp;</td>
                                <td><?php echo h($level[$quiz['Quiz']['level']]); ?>&nbsp;</td>
                                <td><?php echo h($quiz['Quiz']['adult_count']); ?>&nbsp;</td>
                                <td><?php echo h($quiz['Quiz']['active']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('action' => 'view', $quiz['Quiz']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Usuń'), array('action' => 'delete', $quiz['Quiz']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $quiz['Quiz']['id']))); ?>
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

