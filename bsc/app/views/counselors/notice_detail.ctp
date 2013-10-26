<?php
//print_r($company_ans_list);
$notice = $notices[0]['notice_boards'];
//print_r($company_info);
?>


<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text"><!--welcome_text start-->
        	Welcome <b><?php echo $session->read('Auth.User.name'); ?> </b>
        </div><!--welcome_text end -->
                
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->
<br />



<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    
    <div class="notice_detail_info">
    	<strong>Notice Detail</strong> <br /><br />
        <?php echo $html->image('notice_line.gif', array('alt' => 'line','border'=>'0') );?><br /><br />
        
        
        <font size="2"><strong>Publish Date : </strong></font>
        	<?php echo $notice['published_date'] ?>
        
         <br /><br />
          <?php echo $html->image('notice_line_1.gif', array('alt' => 'line','border'=>'0') );?><br /><br /><br />
          
          
        
        <font size="2"><strong>Title :</strong></font>
        	<?php echo $notice['notice_title'] ?>
            
         
         <br /><br />
          <?php echo $html->image('notice_line_2.gif', array('alt' => 'line','border'=>'0') );?><br /><br /><br />   
          
          
          
         <font size="2"><strong>Notice Description : </strong></font>
        	<?php echo $notice['notice'] ?>
            
         
         <br /><br />
          <?php echo $html->image('notice_line_3.gif', array('alt' => 'line','border'=>'0') );?><br /><br /><br />    
            
        
        
        <font size="2"><strong>Attachments</strong></font>	<br /><br />
        	<div class="notice_attachments"><br /><br />
            
            	 <?php echo $html->image('file_pdf.png', array('alt' => 'pdf','border'=>'0') );?>
                 
                 <?php echo $html->image('file_doc.png', array('alt' => 'pdf','border'=>'0') );?>
                 
                 
            	 <br /><br /> <br /><br /> 
            </div>
        
      </div>  
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->









