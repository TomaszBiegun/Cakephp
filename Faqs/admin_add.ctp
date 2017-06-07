<section class="content">
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dodaj FAQ</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create('Faq', array('novalidate' => 'novalidate')); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => 'Tytuł')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('body', array('class' => 'form-control', 'label' => 'Tekst', 'type' => 'textarea')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('active', array('options' => array('0' => 'Nieaktywny', '1' => 'Aktywny'), 'class' => 'form-control', 'label' => 'Aktywność')); ?>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <?php echo $this->Form->submit('Zapisz', array('class' => 'btn btn-success')); ?>
                    <!--                <button type="submit" class="btn btn-primary">Submit</button>-->
                </div>
                <?php echo $this->Form->end(); ?>
            </div><!-- /.box -->
        </div>
        <div class="col-xs-3">
        </div>
    </div>
</section>
