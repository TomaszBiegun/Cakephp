<style type="text/css">

</style>
<section class="content">
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edytuj składnik - <?php echo $recipeProduct['RecipeProduct']['product_name'];?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create('RecipeProduct', array('novalidate' => 'novalidate')); ?>
                <div class="box-body">
                    <?php echo $this->Form->input('id', array('type' => 'hidden','value'=>$recipeProduct['RecipeProduct']['id'])); ?>
                    <div class="form-group">
                        <?php echo $this->Form->input('product_id', array('options' => $options, 'class' => 'form-control', 'label' => 'Nazwa: ')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->input('value', array('label' => 'Ilość: ')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('unit', array('options' => array('ml' => 'ml', 'g' => 'g'), 'label' => 'Jednostka: ')); ?>
                    </div>

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

