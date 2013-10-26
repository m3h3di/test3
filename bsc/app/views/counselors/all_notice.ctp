
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



<div class="company"><!--company start-->
	       
	    	
    <div class="company_table"><!--company_table start-->     
    	<div class="company_table_title"><!--company_table_title start-->
        	<font size="4"><strong>All Notice</strong></font>
        </div><!--company_table_title end-->

		
        	<?php echo $html->image('notice_line_3.gif', array('alt' => 'bottom','border'=>'0') );?><br /><br />
        
       
        
        <table class="all_notice">
        	<tr>
                <td width=""><font size="2"><strong>Title</strong></font></td>
                <td width=""><font size="2"><strong>Publish Date</strong></font></td>
                <td width=""><font size="2"><strong>Valid Until</strong></font></td>
                <td width=""><font size="2"><strong>Attachments</strong></font></td>
                <td width=""><font size="2"><strong>Notice Detail</strong></font></td>
             </tr>
        <?php foreach($notices as $key=>$notice){?>
            <tr>
                  <?php  $notice_id=$notice['notice_boards']['id']; ?>
                  
                <td width=""><?php echo $notice['notice_boards']['notice_title']; ?></td>
                <td width=""><?php echo $notice['notice_boards']['published_date']; ?></td>
                <td width=""><?php echo $notice['notice_boards']['valid_until']; ?></td>
                <td width=""><?php echo "Attachments"; ?></td>
                <td width=""><?php echo $this->Html->link('Details', array('controller'=>'counselors','action' => 'notice_detail',$notice_id)); ?></td>
             </tr>
        <?php } ?>
               
        </table>


    </div><!--company_table end-->
<div class="clear"></div> 	
</div><!--company end-->
  
<br />




