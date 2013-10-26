<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            
            <?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards','action'=>'index')); ?> >>
            Edit Notice
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left" ><!--company start-->

<div class="noticeBoards form">
<?php echo $this->Form->create('NoticeBoard');?>
	<fieldset>
 		<legend><?php __('Admin Edit Notice'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('notice_title');
		echo $this->Form->input('notice');
		echo $this->Form->input('published_date');
		echo $this->Form->input('valid_until'); ?>
		
		<!--Zone: <br />
		<select name="data[NoticeBoard][zone]" id="" rel="">
            <option value="0" >All zones</option>
            <?php 
            /*foreach($all_zone as $k=>$zone){
                $val = $zone['companies']['zone'];
                $select="";
                if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
            }*/
            ?>
		</select>  <br />
		
        Product category: <br />
        <select name="data[NoticeBoard][product_category]" id="" rel="">
            <option value="0" >All product categories</option>
            <?php 
            /*foreach($product_categories as $k=>$product_category){
				
                $val = $product_category['product_categories']['id'];
				$name = $product_category['product_categories']['name'];
				
                $select="";
                if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$name.'</option>';
            }*/
            ?>
		</select>-->
        
		
		
		<?php echo $this->Form->file('File'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('NoticeBoard.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('NoticeBoard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notice Boards', true), array('action' => 'index'));?></li>
	</ul>
</div>

</div>

