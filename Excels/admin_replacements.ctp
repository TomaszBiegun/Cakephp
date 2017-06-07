<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Zaminenniki</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('ID', 'id'); ?></th>
                            <th><?php echo $this->Paginator->sort('Zamienniki', 'body'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($replacements as $replacement): ?>
                            <tr>
                                <td><?php echo h($replacement['Replacement']['id']); ?>&nbsp;</td>
                                <td><?php echo h(str_replace('#', ' <=> ', $replacement['Replacement']['body'])); ?>
                                    &nbsp;</td>
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
