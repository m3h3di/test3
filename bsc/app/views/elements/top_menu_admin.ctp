


<style>
.dropdown li .dark a{ 
	color:#000;
}
</style>




<?php $menu_item = $this->Session->read('menu_item'); ?>

<ul class="dropdown">
	
    
    <!--<li <?php //if($menu_item=="admin_home") { ?> style="background:#FFF;" <?php //} ?>>
    	<?php //if($menu_item=="admin_home") { ?> <a href="cpanels"><font color="#000">Admin Panel</font></a><?php //} else { ?>
     
		<?php //echo $this->Html->link('Admin Panel', array('controller'=>'cpanels','action' => 'index')); } ?>
    </li>-->
    
    
    <li <?php if($menu_item=="admin_home") { ?> style="background:#FFF;" >
    	
			<span class="dark">
            	<?php echo $this->Html->link('Admin Panel', array('controller'=>'cpanels','action' => 'index')); ?>
            </span>
		
		<?php } else { ?>
     	
        <span>
		<?php echo $this->Html->link('Admin Panel', array('controller'=>'cpanels','action' => 'index')); } ?>
    	</span>
    </li>
    
    
	

	<li <?php if($menu_item=="single_enterprise") { ?> style="background:#FFF;" <?php } ?>>
    	<a href="#" <?php if($menu_item=="single_enterprise") { ?> style="color:#000;" <?php } ?>>
        By Single Enterprise</a>
    
		<ul>
        	<li>
			<?php echo $this->Html->link('By Compliance Issues', array('controller'=>'cpanels','action' => 'bysectionsingle')); ?>
            </li>       
                   
			<li>	   
            <?php  echo $this->Html->link('By Enterprise Characteristics', array('controller'=>'cpanels',
				   'action' => 'bycriteriasingle')); 
			?>
            </li>
		</ul>
	</li> 
    
    
	
	<li <?php if($menu_item=="multiple_enterprise") { ?> style="background:#FFF;" <?php } ?>>
    <a href="#" <?php if($menu_item=="multiple_enterprise") { ?> style="color:#000;" <?php } ?>>
    	By Multiple Enterprise</a>
    
<ul>
<li><?php echo $this->Html->link('By Zone', array('controller'=>'cpanels','action' => 'byzone')); ?></li>
  <li><?php echo $this->Html->link('By Enterprise', array('controller'=>'cpanels','action' => 'showlist'));?></li>
                   
<li><?php echo $this->Html->link('By Compliance Issues', array('controller'=>'cpanels','action' => 'bysection'));
	?> </li>
    
     
 <li><?php  echo $this->Html->link('By Question', array('controller'=>'cpanels','action' => 'byquestion')); ?>
 </li> 
 
  <li><?php echo $this->Html->link('By Enterprise Characteristics', array('controller'=>'cpanels',
					'action' => 'bycriteria'));
			?>
   </li>  
            
		</ul>
        
	</li>
    
    
    <li <?php if($menu_item=="survey_management") { ?> style="background:#FFF;" <?php } ?>>
    <a href="#" <?php if($menu_item=="survey_management") { ?> style="color:#000;" <?php } ?>>
    	Survey Management</a>
		<ul>
		
<li><?php echo $this->Html->link('Counselors Information', array('controller'=>'users','action' => 'index')) ;?>
</li>

<li><?php echo $this->Html->link('Enterprise Information', array('controller'=>'companies','action' => 'index'));

?></li>

<li><?php
echo $this->Html->link('Questions Management', array('controller'=>'questions','action' => 'index'));?>
</li>
		</ul>
	</li>
	
	
    <li <?php if($menu_item=="admin_notice") { ?> style="background:#FFF;" <?php } ?>>
    
    <a href="#" <?php if($menu_item=="admin_notice") { ?> style="color:#000;" <?php } ?>>
    Notice Board</a>
		 <ul>
				
 <li><?php echo $this->Html->link('Add Notice', array('controller'=>'notice_boards','action' => 'add')); ?></li>
<li><?php echo $this->Html->link('All notices', array('controller'=>'notice_boards','action' => 'index')); ?></li>
                
                
               
		 </ul>		
	</li>
    
    
      
    
    
	
   <!-- <li><?php //echo '<a href="'.$html->url('/users/logout') .'">Logout</a>'; ?></li>	-->
   
   <li style="float:right;">
		<?php echo '<a style=" text-align:right;" href="'.$html->url('/users/logout') .'">Logout&nbsp;&nbsp;&nbsp;</a>'; ?> 
    </li>	
    
    	
</ul>
<div class="clear"></div>


<br />







