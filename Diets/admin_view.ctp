<style>
    .photo {
        width: 250px;
    }

    .photo img {
        width: 100%;
        height: auto;
    }
    .bad{
        background-color: rgba(255,0,0,0.3)!important;
    }
</style>
<section class="content">
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dieta - <?php echo $diet['Diet']['name']; ?></h3>
                </div><!-- /.box-header -->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID:</th>
                            <td><?php echo h($diet['Diet']['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Nazwa:</th>
                            <td><?php echo $diet['Diet']['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Tekst:</th>
                            <td><?php echo $diet['Diet']['body']; ?></td>
                        </tr>
                        <tr>
                            <th>Zdjęcie:</th>
                            <td><?php echo $this->Media->embed('m' . DS . $diet['Diet']['dirname'] . DS . $diet['Diet']['basename']); ?>
                                &nbsp;</td>

                        </tr>


                        <tr>
                            <th>Stworzono:</th>
                            <td><?php echo $diet['Diet']['created']; ?></td>
                        </tr>
                        <tr>
                            <th>Zmodyfikowano:</th>
                            <td><?php echo $diet['Diet']['modified']; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-3">
        </div>
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Przepisy</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('name', 'Nazwa'); ?></th>
                            <th><?php echo $this->Paginator->sort('basename', 'Zdjęcie'); ?>
                            <th><?php echo $this->Paginator->sort('preparation', 'Sposób przygotowania'); ?></th>
                            <th><?php echo $this->Paginator->sort('type', 'Typ'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Stworzono'); ?></th>
                            <th><?php echo $this->Paginator->sort('veryfied', 'Poprawność'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($recipes as $recipe): ?>
                            <?php
                            if ($recipe['Recipe']['veryfied'] == 1) {
                                echo '<tr>';
                            } else {
                                echo '<tr class="bad">';
                            }
                            ?>&nbsp;

                                <td><?php echo h($recipe['Recipe']['name']); ?>&nbsp;</td>

                                <td>
                                    <div class="photo">
                                        <?php echo $this->Html->image('../odczyt/' . $recipe['Recipe']['basename']); ?>
                                    </div>

                                </td>
                                <td><?php echo h($recipe['Recipe']['preparation']); ?>&nbsp;</td>

                                <td><?php echo h($recipe['Recipe']['type']); ?>&nbsp;</td>
                                <td><?php echo h($recipe['Recipe']['created']); ?>&nbsp;</td>
                                <td><?php
                                    if ($recipe['Recipe']['veryfied'] == 1) {
                                        echo 'OK';
                                    } else {
                                        echo 'NIEPOPRAWNY';
                                    }
                                    ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Podgląd'), array('controller' => 'recipes', 'action' => 'view', $recipe['Recipe']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
                                    <!--									--><?php //echo $this->Html->link(__('Edycja'), array('controller'=>'recipes','action' => 'edit', $recipe['Recipe']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
                                    <!--									--><?php //echo $this->Form->postLink(__('Usuń'), array('controller'=>'recipes','action' => 'delete', $recipe['Recipe']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                    <?php echo $this->Element('pagging'); ?>

                </div>
            </div>
        </div><!-- /.col -->

    </div><!-- /.row -->
</section>