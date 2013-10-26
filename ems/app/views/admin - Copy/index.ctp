


<div class="breadcrumb"><!--breadcrumb start-->
    
    	<div class="welcome_text"><!--welcome_text start-->
        	<font size="2">Welcome to Admin panel</font>
        </div><!--welcome_text end -->
        
        <!--<div style="float:right; padding-right:20px; text-decoration:blink; ">
        	<?php //if(!empty($so))echo $this->Html->link('Sign Off', array('action' => 'signoff')); ?>
        </div>-->
        
     	<div class="clear"></div>   
</div><!--breadcrumb end-->

<br /><br />


<div class="company"><!--company start-->
	
    <?php 
		$status = $session->read('Auth.User.status');
		if( $status == (2) ) { ?>
				
			<!-- echo $html->image('signoff.jpg', array('alt' => 'signoff','border'=>'0') ); -->
            
            <div class="signoff">
            	<div class="signoff_title">
                	<font color="#4989c7"><b>Sign off</b></font>
                    
                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    	
                    <font color="#4989c7">Pending Survey : <?php echo $signoff;?> </font>
                    
                </div>  
                
                
          <?php if(!empty($so)) //echo $this->Html->link('Sign Off', array('action' => 'signoff')); 
		  
			  $link= $html->image('signoff_link.gif', array('alt' => 'signoff_link','border'=>'0') ); ?>
              
             <div class="signoff_link"> 
		  <?php	echo $html->link($link, array('action' => 'signoff'), array('escape' => false)); ?>
           	 </div>  
              
            
               
              
              
                
			</div>	
	<?php } ?>
    
    

    <div class="admin_facility"><!--admin_facility start--> <br />
        
    	<div class="admin_facility_item"><!--admin_facility_item start-->
        	<div class="admin_facility_item_top"><!--admin_facility_item_top start--></div><!--admin_facility_item_top end-->
            
            <div class="admin_facility_item_body"><!--admin_facility_item_body start-->
        		<div class="admin_fac_title"><!--admin_panel_title start-->By Single Enterprise</div><!--admin_fac_title end-->
                <?php //echo $this->Html->image('adm_fac_text_underline.gif', array('alt' => 'line','border'=>'0') );?>
                
                	<div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Compliance Issues', array('action' => 'bysectionsingle')); ?> 
                    </div><!--fac_menu_item end-->
                    
                   
                
                	<div class="clear"></div><br /><br /><br />
                    
                    <div class="admin_fac_title"><!--admin_panel_title start-->General Informations</div><!--admin_fac_title end-->
                <?php //echo $this->Html->image('adm_fac_text_underline.gif', array('alt' => 'line','border'=>'0') );?>
                
                	<div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('General Information', array('action' => 'GeneralInfo')); ?> 
                    </div><!--fac_menu_item end-->
                     <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('List Of Chemicals', array('action' => 'ChemicalHazmat')); ?> 
                    </div><!--fac_menu_item end-->
                   
                
                	<div class="clear"></div>
            </div><!--admin_facility_item_body end-->
            
            <div class="admin_facility_item_bottom"><!--admin_facility_item_bottom start--></div><!--admin_facility_item_bottom end-->
        </div><!--admin_facility_item end-->
    
    
    	<div class="admin_facility_item"><!--admin_facility_item start-->
        	<div class="admin_facility_item_top"><!--admin_facility_item_top start--></div><!--admin_facility_item_top end-->
            
            <div class="admin_facility_item_body"><!--admin_facility_item_body start-->
        		<div class="admin_fac_title"><!--admin_panel_title start-->By Multiple Enterprises</div><!--admin_fac_title end-->
                <?php //echo $this->Html->image('adm_fac_text_underline.gif', array('alt' => 'line','border'=>'0') );?>
                
                	
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Zone', array('action' => 'ByZone')); ?> 
                    </div><!--fac_menu_item end-->
                     <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Enterprise', array('action' => 'ByFacility')); ?> 
                    </div><!--fac_menu_item end-->
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Compliance Issues', array('action' => 'SectionOverview')); ?> 
                    </div><!--fac_menu_item end-->
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('Compliance Performance Rating', array('action' => 'ByOverviewViewSection')); ?> 
                    </div><!--fac_menu_item end-->
                     <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Survey Questions', array('action' => 'SectionQuestion')); ?> 
                    </div><!--fac_menu_item end-->
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Specific Compliance Criteria', array('action' => 'ByEc')); ?> 
                    </div><!--fac_menu_item end-->
                
                	<div class="clear"></div>
            </div><!--admin_facility_item_body end-->
            
            <div class="admin_facility_item_bottom"><!--admin_facility_item_bottom start--></div><!--admin_facility_item_bottom end-->
        </div><!--admin_facility_item end-->


    <div class="clear"></div>     
   
   </div><!--admin_facility end-->
    
	
    
    <br /><br />
    
    
   <div class="admin_management"><!--admin_management start-->
   		 <div class="admin_management_top"><!--admin_management_top start-->  </div> <!--admin_management_top end-->
         
         <div class="admin_management_body"><!--admin_management_body start-->  
         	<div class="admin_box"><!--admin_box start-->
            	<div class="admin_box_text"><!--admin_box_text start-->
                	<?php echo $this->Html->link('Counselors Information', array('controller'=>'users','action' => 'index')) ; ?>
                </div><!--admin_box_text end-->
            </div><!--admin_box end-->
            
            <div class="admin_box"><!--admin_box start-->
            	<div class="admin_box_text"><!--admin_box_text start-->
                	<?php echo $this->Html->link('Enterprise Information', array('controller'=>'factories','action' => 'index')); ?> 
                </div><!--admin_box_text end-->
            </div><!--admin_box end-->
            
            <div class="admin_box"><!--admin_box start-->
            	<div class="admin_box_text"><!--admin_box_text start-->
                	<?php echo $this->Html->link('Questions Management', array('controller'=>'questions','action' => 'index')); ?> 
                </div><!--admin_box_text end-->
            </div><!--admin_box end-->
            
            <div class="admin_box"><!--admin_box start-->
            	<div class="admin_box_text"><!--admin_box_text start-->
                	<?php echo $this->Html->link('Rating Rules',array('controller'=>'rating_rules','action' => 'index')); ?> 
                </div><!--admin_box_text end-->
            </div><!--admin_box end-->
            
         <div class="clear"></div>        
         </div> <!--admin_management_body end-->
         
         <div class="admin_management_bottom"><!--admin_management_bottom start-->  </div> <!--admin_management_bottom end-->
   
   </div> <!--admin_management end--><br />
    
   
</div><!--company end-->
  


