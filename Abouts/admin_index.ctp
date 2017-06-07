<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">O nas - Wpisy</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="table" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('title','Tytuł'); ?></th>
							<th><?php echo $this->Paginator->sort('info','Informacja'); ?></th>
							<th><?php echo $this->Paginator->sort('body','Tekst'); ?></th>
							<th><?php echo $this->Paginator->sort('basename','Zdjęcie'); ?></th>
							<th><?php echo $this->Paginator->sort('created','Utworzono'); ?></th>
							<th><?php echo $this->Paginator->sort('modified','Zmodyfikowano'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($abouts as $about): ?>
							<tr>
								<td><?php echo $about['About']['title']; ?>&nbsp;</td>
								<td><?php echo $about['About']['info']; ?>&nbsp;</td>
								<td><?php echo $about['About']['body']; ?>&nbsp;</td>
								<td><?php echo $this->Media->embed('s'.DS.$about['About']['dirname'].DS.$about['About']['basename']); ?>&nbsp;</td>
								<td><?php echo h($about['About']['created']); ?>&nbsp;</td>
								<td><?php echo h($about['About']['modified']); ?>&nbsp;</td>
								<td class="actions">
									<?php echo $this->Html->link(__('Podgląd'), array('admin'=>true,'controller'=>'abouts','action' => 'view', $about['About']['id']), array('class' => 'btn btn-block btn-info btn-xs')); ?>
									<?php echo $this->Html->link(__('Edycja'), array('action' => 'edit', $about['About']['id']), array('class' => 'btn btn-block btn-warning btn-xs')); ?>
									<?php echo $this->Form->postLink(__('Usuń'), array('admin'=>true,'controller'=>'abouts','action' => 'delete', $about['About']['id']), array('class' => 'btn btn-block btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $about['About']['id']))); ?>
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
