
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('Title');?>
        
      <textarea name="data[Comment][Comment]">
      </textarea>  
	<?php
		//echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
