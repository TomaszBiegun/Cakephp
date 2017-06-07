<div class="quizzes form">
<?php echo $this->Form->create('Quiz'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Quiz'); ?></legend>
	<?php
		echo $this->Form->input('user_mail');
		echo $this->Form->input('gender');
		echo $this->Form->input('weigth');
		echo $this->Form->input('height');
		echo $this->Form->input('age');
		echo $this->Form->input('activity');
		echo $this->Form->input('goal');
		echo $this->Form->input('diet_id');
		echo $this->Form->input('meal_count');
		echo $this->Form->input('level');
		echo $this->Form->input('person-count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Quizzes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nowantedproducts'), array('controller' => 'nowantedproducts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nowantedproduct'), array('controller' => 'nowantedproducts', 'action' => 'add')); ?> </li>
	</ul>
</div>
