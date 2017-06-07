<section class="content">
    <div class="row">
        <div class="col-xs-1">
        </div>
        <div class="col-xs-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dodaj pakiet</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create('Pack', array('novalidate' => 'novalidate', 'type' => 'file')); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => 'Tytuł')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('subtitle', array('class' => 'form-control', 'label' => 'Informacja')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('body', array('class' => 'form-control', 'label' => 'Tekst')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('ammount', array('class' => 'form-control', 'label' => 'Kwota')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('per', array('class' => 'form-control', 'label' => 'Za okres:', 'options' => array('1' => '1 miesiąc', '3' => '3 miesiące', '6' => '6 miesięcy'))); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->input('people', array('class' => 'form-control', 'label' => 'Ilość osób', 'options' => array('1' => '1', '2' => '2'))); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('help', array('class' => 'form-control', 'label' => 'Wsparcie dietetyka:')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('list', array('class' => 'form-control', 'label' => 'Generowanie listy zakupów:')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('remember', array('class' => 'form-control', 'label' => 'Zapis BMI oraz wagi:')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('special', array('class' => 'form-control', 'label' => 'Dostęp do aplikacji mobilnej:')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('file', array('class' => 'form-control', 'label' => 'Zdjęcie', 'type' => 'file')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('active', array('options'=>array('0' => 'Nieaktywny', '1' => 'Aktywny'),'class' => 'form-control', 'label' => 'Aktywność')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('basename', array('type' => 'hidden')); ?>
                        <?php echo $this->Form->input('dirname', array('type' => 'hidden')); ?>
                        <?php echo $this->Form->input('checksum', array('type' => 'hidden')); ?>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <?php echo $this->Form->submit('Zapisz', array('class' => 'btn btn-success')); ?>
                    <!--                <button type="submit" class="btn btn-primary">Submit</button>-->
                </div>
                <?php echo $this->Form->end(); ?>
            </div><!-- /.box -->
        </div>
        <div class="col-xs-1">
        </div>
    </div>
</section>
