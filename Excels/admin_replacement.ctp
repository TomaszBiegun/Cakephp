<style type="text/css">

</style>
<section class="content">
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Zaimportuj plik z zamiennikami</h3>


                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="fileManager">
                    <div class="row">
                        <div class="col-xs-6">
                            <p>Zobacz przykładowy plik:</p>

                            <div class="templateView">

                                <?php echo $this->Html->image('template3.jpg', array('id' => 'templatePhoto')); ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <p>Pobierz przykładowy plik</p>

                            <div class="templateDownload">
                                <?php echo $this->Html->link('Pobierz', array('admin' => true, 'controller' => 'excels', 'action' => 'downloadreplacements'), array('class' => 'btn btn-success')) ?>
                            </div>
                        </div>
                    </div>

                </div>


                <?php echo $this->Form->create('Excels', array('novalidate' => 'novalidate', 'type' => 'file')); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $this->Form->input('file', array('class' => 'form-control', 'label' => 'Plik .xls', 'type' => 'file')); ?>
                    </div>

                </div><!-- /.box-body -->
                <h4>Skoroszyt zamienników musi być na pierwszej pozycji w pliku .xlsx</h4>

                <div class="box-footer">
                    <?php echo $this->Form->submit('Zapisz', array('class' => 'btn btn-success', 'id' => 'save')); ?>
                    <!--                <button type="submit" class="btn btn-primary">Submit</button>-->
                </div>
                <?php echo $this->Form->end(); ?>


            </div><!-- /.box -->
        </div>
        <div class="col-xs-3">
        </div>
    </div>
</section>
<div class="loader">
    <?php echo $this->Html->image('loading.gif', array('style' => 'display:none;', 'id' => 'gif')); ?>
</div>
<div class="myShadow">
    <div class="main-shadow-photo">
        <?php echo $this->Html->image('template3.jpg', array('style' => 'display:none;', 'id' => 'bigTemplate')); ?>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('#save').on('click', function (e) {

            $('.loader').addClass('loader-active');
            $('#gif').fadeIn("slow");
        });
        $('#templatePhoto').on('click', function (e) {

            $('.myShadow').addClass('myShadow-active');
            $('#bigTemplate').fadeIn("slow");
        });
        $('.myShadow').on('click', function () {
            console.log('siema');
            $('#bigTemplate').fadeOut('slow');
            setTimeout(function () {
                $('.myShadow').removeClass('myShadow-active');

            }, 750);

        });
    });

</script>