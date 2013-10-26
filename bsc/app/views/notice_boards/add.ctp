<div class="noticeBoards form">
<?php echo $this->Form->create('NoticeBoard');?>
	<fieldset>
 		<legend><?php __('Add Notice Board'); ?></legend>
	<?php
		echo $this->Form->input('notice_title');
		echo $this->Form->input('notice');
		echo $this->Form->input('published_date');
		echo $this->Form->input('valid_until');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notice Boards', true), array('action' => 'index'));?></li>
	</ul>
</div>