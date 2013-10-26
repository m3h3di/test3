


<style>
.dropdown li .dark a{ 
	color:#000;
}
	

</style>




<?php 
	$menu_item = $this->Session->read('menu_item'); 
	$new_notice = $this->Session->read('new_notice'); 
?>




<ul class="dropdown" > 
	
	<li <?php if($menu_item=="counselor_home") { ?> style="background:#FFF;" >
    	
			<span class="dark">
            	<?php echo $this->Html->link('Home', array('controller'=>'counselors','action' => 'home')); ?>
            </span>
		
		<?php } else { ?> 
        
        <span>
			<?php  echo $this->Html->link('Home', array('controller'=>'counselors','action' => 'home')); }  ?>
        </span>
    </li>
	

	<li <?php if($menu_item=="counselor_ent") { ?> style="background:#FFF;" <?php } ?> >
        <a href="#" <?php if($menu_item=="counselor_ent") { ?> style="color:#000;" <?php } ?>>
            Assigned Enterprises
        </a>
    
		<ul>
			<?php
			$topmenu = $session->read('session_company');
				foreach($topmenu as $key=> $val) 
				{
				   $company_name = $val['t1']['name'];
				   $company_id = $val['t1']['id']; 
				   $link =  $this->Html->url("/counselors/factory/entry"); ?>
				
				<li>   
				<?php echo $this->Html->link($company_name, array('controller'=>'counselors','action' => 
				'facility',$company_id));?>
                </li>
				   					
			   <?php } ?>
		</ul>
		
	
	</li>
	
	
	<li <?php if($menu_item=="counselor_notice") { ?> style="background:#FFF;" >
    
		<span class="dark">
            <?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards'));  ?> 
        </span> <?php }
		
	
	else { ?>
    <span>
    	<?php echo $this->Html->link('Notice Board ('.$new_notice.')', array('controller'=>'notice_boards')); } ?> 	 </span>
        
        
       
        
        
    </li>
    
    
    
   
    
    <li>
    <a href="#">Reference Documents</a>
		 <ul>
				<li><?php echo $html->link('Questionnaire', '/files/RD.pdf');?></li>
				<li><?php echo $html->link('Survey Guidelines', '/files/RD.pdf');?> </li>
		 </ul>		
	</li>
				
	
    <li <?php if($menu_item=="counselor_ent_analysis") { ?> style="background:#FFF;">
	   
            <span class="dark">
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action' => 'enterprise_analysis')); ?>
            </span>
        
	   <?php } 
		
		
		else { ?>
        <span>
			<?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action' => 'enterprise_analysis')); } ?> 
        </span>
    </li>	
    
    
    <li style="float:right;">
		<?php echo '<a style=" text-align:right;" href="'.$html->url('/users/logout') .'">Logout&nbsp;&nbsp;&nbsp;</a>'; ?> 
    </li>	
	
    
    <div class="clear"></div>	
</ul>


<br />









<!--<ul class="dropdown">
		<li>
			<a href="#">Dhaka</a>
			<ul>
				<li>
					<a href="#">Dhaka City &raquo;</a>
					<ul>
						<li><a href="#">Dhanmondi &raquo;</a>
								<ul>
									<li><a href="#">Dhanmondi 3</a></li>
									<li><a href="#">Dhanmondi 8</a></li>
									<li><a href="#">Dhanmondi 9</a></li>
									<li><a href="#">Dhanmondi 10</a></li>
								</ul>
						</li>
						
						
						<li><a href="#">Gulshan &raquo;</a>
								<ul>
									<li><a href="#">South Aveneu</a></li>
									<li><a href="#">Gulshan 2</a></li>
								</ul>
						</li>
						
						<li><a href="#">Motijheel</a></li>
					</ul>
				
				</li>
			</ul>
		</li>
		
		
		
		<li>
			<a href="#">Chittagong</a>
			<ul>
				<li>
					<a href="#">Chittagong City &raquo;</a>
					<ul>
						<li><a href="#">Cox's Bazar</a></li>
						<li><a href="#">Saint Martins</a></li>
						<li><a href="#">Halishohor</a></li>
						<li><a href="#">Bandorban</a></li>
					</ul>
				</li> 
				
				
				<li><a href="#">Rangamati</a></li>
				<li><a href="#">Foyez lake</a></li>  
			</ul>
		</li>
		
		<li><a href="#">Khulna</a></li> 
		
	<div class="clear"></div>	
</ul>-->




























