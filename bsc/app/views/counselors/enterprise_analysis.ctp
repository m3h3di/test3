


<div class="breadcrumb"><!--breadcrumb start-->
    
    	<div class="welcome_text"><!--welcome_text start-->
        	<font size="2">Enterprise Analysis</font>
        </div><!--welcome_text end -->
        
        <div style="float:right; padding-right:20px; text-decoration:blink; "><!--welcome_text start-->
        	<?php if(!empty($so))echo $this->Html->link('Sign Off', array('action' => 'signoff')); ?>
        </div><!--welcome_text end -->
        
     	<div class="clear"></div>   
</div><!--breadcrumb end-->

<br /><br />


<div class="company"><!--company start-->
    <div class="admin_facility"><!--admin_facility start--> 
        
    	<div class="admin_facility_item"><!--admin_facility_item start-->
        	<div class="admin_facility_item_top"><!--admin_facility_item_top start--></div><!--admin_facility_item_top end-->
            
            <div class="admin_facility_item_body"><!--admin_facility_item_body start-->
        		<div class="admin_fac_title"><!--admin_panel_title start-->By Single Enterprise</div><!--admin_fac_title end-->
                <?php //echo $this->Html->image('adm_fac_text_underline.gif', array('alt' => 'line','border'=>'0') );?>
                
                	<div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Compliance Issues', array('action' => 'by_single_ent_comliance_issu')); ?> 
                    </div><!--fac_menu_item end-->
                     <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Enterprise Characteristics', array('action' => 'by_single_ent_ent_char')); ?> 
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
                        <?php echo $this->Html->link('By Enterprise', array('action' => 'mul_ent_by_ent')); ?> 
                    </div><!--fac_menu_item end-->
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Compliance Issues', array('action' => 'mul_ent_by_compliance_issue')); ?> 
                    </div><!--fac_menu_item end-->
                     <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Question', array('action' => 'mul_ent_by_question')); ?> 
                    </div><!--fac_menu_item end-->
                    <div class="fac_menu_item"><!--fac_menu_item start-->
                        <?php echo $this->Html->link('By Enterprise Characteristics', array('action' => 'mul_ent_by_ent_char')); ?> 
                    </div><!--fac_menu_item end-->
                
                	<div class="clear"></div>
            </div><!--admin_facility_item_body end-->
            
            <div class="admin_facility_item_bottom"><!--admin_facility_item_bottom start--></div><!--admin_facility_item_bottom end-->
        </div><!--admin_facility_item end-->


    <div class="clear"></div>     
   
   </div><!--admin_facility end-->
    
	
    
    <br /><br />
    
    
      
</div><!--company end-->
  


