


<style>
/*.dropdown li .dark a{ 
	color:#000;
}*/
	

</style>




<?php 
	/*$menu_item = $this->Session->read('menu_item'); 
	$new_notice = $this->Session->read('new_notice'); */
?>




<ul class="dropdown" > 
	
	<li>
           <?php echo '<a href="'.$html->url('/') .'">Home</a>'; ?>
       
    </li>
	

	<li>
        <a href="#">
            To be surveyed
        </a>
    
    
		<ul>
			<?php
			$topmenu = $session->read('session_factories');
			
			
			foreach($topmenu[0]['Factory']  as $factory)
			{
					$name= $factory['factory_name'];
					$factory_id = $factory['id'];
								
					if( empty($factory['status']) )
					{ ?>
                 <li>   
					<?php echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));?>
				 </li>	
                 
                 <?php 
                    }
			} ?>
				
		</ul>
		
	
	</li>
	
	
	
    
    
    <li>
        <a href="#">
            Follow up
        </a>
    
		<ul>
			<?php
			$topmenu = $session->read('session_factories');
			
			
			foreach($topmenu[0]['Factory']  as $factory)
			{
					$name= $factory['factory_name'];
					$factory_id = $factory['id'];
								
				if( !empty($factory['status']) & $factory['status'] == 1) { ?>
                 <li>   
					<?php echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));?>
				 </li>	
                 
                 <?php 
                    }
			} ?>
		</ul>
		
	
	</li>
    
    
    
   
    <li>
        <a href="#">
            Completed
        </a>
    
		<ul>
			<?php
			$topmenu = $session->read('session_factories');
			
			
			foreach($topmenu[0]['Factory']  as $factory)
			{
					$name= $factory['factory_name'];
					$factory_id = $factory['id'];
								
				if( !empty($factory['status']) & $factory['status'] == 2) { ?>
                 <li>   
					<?php echo $html->link($name, array('controller' => 'users','action' => 'factory', $factory_id));?>
				 </li>	
                 
                 <?php 
                    }
			} ?>
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




























