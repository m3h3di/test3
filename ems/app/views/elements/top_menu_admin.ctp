


<style>
/*.dropdown li .dark a{ 
	color:#000;
}*/
</style>




<?php //$menu_item = $this->Session->read('menu_item'); ?>

<ul class="dropdown">
    
    <li>
		<?php //echo $this->Html->link('All Facilities', array('controller'=>'admins','action' => 'ByFacility')); ?> 
        <?php echo '<a href="'.$html->url('/admin').'"><span>Control Panel</span></a>'; ?>       
    </li>
    
   <!-- <li>
		<?php //echo $this->Html->link('General Information', array('controller'=>'admins','action' => 'GeneralInfo')); ?>    
    </li>
    
     <li>
		<?php //echo $this->Html->link('By Section Overview', array('controller'=>'admins','action' => 'SectionOverview')); ?>    </li>
    
    
     <li>
		<?php //echo $this->Html->link('By Section Observation', array('controller'=>'admins','action' => 'ByOverviewViewSection')); ?>   
    </li>-->
    
    
	
	
	
	<li>
    	<a href="#">Reports</a>
    
		<ul>
			
        	 <li>
				<?php echo $this->Html->link('General Information', array('controller'=>'admins','action' => 'GeneralInfo')); ?>    
    		</li>
			
			<li>
				<?php echo $this->Html->link('List Of Chemicals', array('controller'=>'admins','action' => 'ChemicalHazmat')); ?>
			</li>
    
			<li>
				<?php echo $this->Html->link('Overall performance rating', array('controller'=>'admins','action' => 'ByFacility')); ?> 
    		</li>
	
	
			 <li>
				<?php echo $this->Html->link('Area wise performance rating', array('controller'=>'admins','action' => 'SectionOverview')); ?>    
			</li>
			
			
			 <li>
				<?php echo $this->Html->link('Sub Area wise performance rating', array('controller'=>'admins','action' => 'ByOverviewViewSection')); ?>   
    		</li>
			
			<li>
				<?php echo $this->Html->link('By Section-wise Questions', array('controller'=>'admins','action' => 'SectionQuestion')); ?>   
    		</li>
    
    
			 <li>
				<?php echo $this->Html->link('Question Wise Response', array('controller'=>'admins','action' => 'BySingleQuestionViewSection')); ?>    
			</li>
    
    
			   
            
		</ul>
	</li> 
	
	
	
    
  	
	

	<li>
    	<a href="#">Management</a>
    
		<ul>
        	<li>
			<?php echo $this->Html->link('Surveyor list', array('controller'=>'users','action' => 'index','prefix'=>'admin')); ?>
            </li>       
                   
			<li>	   
            <?php echo $this->Html->link('Facility List', array('controller'=>'factories','action' => 'index')); ?>
            </li>
            
            
            <li>
            <?php echo $this->Html->link('Question List', array('controller'=>'questions','action' => 'index')); ?>
            </li>
            
            
            <li>
            <?php echo $this->Html->link('Rating Rules', array('controller'=>'rating_rules','action' => 'index')); ?>
            </li>
            
            <li>
            <?php echo $this->Html->link('Weight Factor', array('controller'=>'weight_factors','action' => 'index')); ?>
            </li>
            
		</ul>
	</li> 
    
    
	
	
	
	<li>
    	<a href="#">Reference documents</a>
    
		<ul>
        	<li>
				<a href="#">Manual</a>
            </li>       
                   
			<li>	   
            	<a href="#">Questionnaire</a>
            </li>
            
		</ul>
	</li> 
	
    
   
   
   
    <li style="float:right;">
		<?php echo '<a style=" text-align:right;" href="'.$html->url('/users/logout') .'">Logout&nbsp;&nbsp;&nbsp;</a>'; ?> 
    </li>	
    
    	
</ul>
<div class="clear"></div>


<br />







