<section class="content">
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dodaj przedmiot</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create('Item', array('novalidate' => 'novalidate', 'type' => 'file')); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => 'Tytuł')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('price', array('class' => 'form-control', 'after' => 'zł', 'min' => 0, 'label' => 'Cena')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('body', array('class' => 'form-control', 'label' => 'Tekst')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('file', array('class' => 'form-control', 'label' => 'Zdjęcie', 'type' => 'file')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->input('basename', array('class' => 'form-control hidden', 'label' => false)); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('dirname', array('class' => 'form-control hidden', 'label' => false)); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('checksum', array('class' => 'form-control hidden', 'label' => false)); ?>
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
