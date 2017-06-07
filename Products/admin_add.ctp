<section class="content">
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dodaj produkt</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
				<?php echo $this->Form->create('Product', array('novalidate' => 'novalidate')); ?>
				<div class="box-body">
					<div class="form-group">
						<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Tytuł')); ?>
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
