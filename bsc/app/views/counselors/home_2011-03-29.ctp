<?php
echo '<pre style="text-align: left">';
//print_r($companies);
//print_r($companies_status);
//print_r($notices);
//print_r($session->read('session_company'));
echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>

<script type="text/javascript">

function aaaa(id){
	var linkk = '<?php echo $this->Html->url("/counselors/facility/"); ?>';
	linkk += id;
	location.href=linkk ;
}
</script>




<div class="top_menu">
	<ul>
    	<li><?php echo $this->Html->link('Home', array('controller'=>'counselors','action' => 'home')); ?></li>
    	<li>
        	<select name="" onchange="aaaa(this.value)" >
            <option>Assigned Factories</option>
            <?php
			$topmenu = $session->read('session_company');
            foreach($topmenu as $key=> $val) {
               $company_name = $val['t1']['name'];
               $company_id = $val['t1']['id']; 
                $link =  $this->Html->url("/counselors/factory/entry");
				?>
              	<option value="<?php	echo $company_id; ?>"><?php	echo $company_name; ?></option>
            	<?php
            }
            ?>
            </select>
        </li>
        <li><?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards')); ?> </li>
        <li><?php echo $html->link('Reference Documents', '/files/RD.pdf'); ?> </li>
        
        
        <!--<li><?php //echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> </li>-->
    </ul>

</div>

<br />

<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text"><!--welcome_text start-->
        	Welcome <b><?php echo $session->read('Auth.User.name'); ?> </b>
        </div><!--welcome_text end -->
        
        <div class="date_combo"><!--date_combo start-->
        <form action="" method="post">
            <font size="2">Month</font>
        	<select name="month" >
            <option value="0">Select</option>
            	<opt
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['month']) & ($_POST['month'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <font size="2">Year</font>
            <select name="year">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['year']) & ($_POST['year'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>
            	
                
            </select>
        	<input type="submit" name="go" id="go" onclick="" class="go_button" value="" />
		</form>
        </div><!--date_combo end -->
        
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->



<div class="company"><!--company start-->
	<div class="company_info"><!--company_info start-->
    	<div class="company_title"><!--company_title start--><strong>Counselor Information</strong></div><!--company_title end-->

		<div class="small_line"><!--small_line start-->
        	<?php echo $html->image('plain_line1.gif', array('alt' => 'bottom','border'=>'0') );?>
        </div><!--small_line end-->
		
        <div class="company_description"><!--company_description start-->
        	<font color="#58595b"><strong><?php echo $session->read('Auth.User.name'); ?></strong></font>
            <div class="small_line"><!--small_line start-->
        		<?php echo $html->image('small_dot_line.gif', array('alt' => 'bottom','border'=>'0') );?>
        	</div><!--small_line end-->
            
			UserName: <font color="#58595b"><b><?php echo $session->read('Auth.User.username'); ?></b></font>
             <div class="small_line"><!--small_line start-->
        		<?php echo $html->image('small_dot_line.gif', array('alt' => 'bottom','border'=>'0') );?>
        	</div><!--small_line end-->
			
            Address : <font color="#58595b"><b><?php echo $session->read('Auth.User.address'); ?></b></font>
             <div class="small_line"><!--small_line start-->
        		<?php echo $html->image('small_dot_line.gif', array('alt' => 'bottom','border'=>'0') );?>
        	</div>
            
         </div><!--company_description end--><br />
         
         <?php echo $html->image('map_dhaka.gif', array('alt' => 'map','border'=>'0') );?>
         
    </div><!--company_info end-->
    
    
    
    
    
	    	
    <div class="company_table"><!--company_table start-->  
    	<div class="company_table_title"><!--company_table_title start-->
        	<strong>Assigned enterprises with pending survey</strong>
        </div><!--company_table_title end-->
    	
        <div class="big_line"><!--big_line start-->
        	<?php echo $html->image('plain_line2.gif', array('alt' => 'bottom','border'=>'0') );?>
        </div><!--big_line end-->
        
    	<table class="survey_table2">
        <?php
            foreach($companies_status as $key=> $val) {
                    $company_name = $val['t1']['name'];
                    $company_id = $val['t1']['id']; 
                    //$view_details=$val['view_details'];
                    //$survey=$val['survey'];
					
					if( !empty($val['t2']['survey_date']) ) continue;
					
					$date ='';
					//if( !empty($_POST['date']) ) $date = $_POST['date'];
					$link =  $this->Html->url("/surveys/entry/$company_id/$date");
                    ?>
               <tr>
                <td width="320">
                	<?php
                    echo $this->Html->link($company_name, array('controller'=>'counselors','action' => 'facility',$company_id))."<br/>";
                
            		?>
                </td>
                <td>
                    <input type="submit" name="add_entry" id="add_entry" onclick="window.location.href='<?php echo $link ?>'" 
                    class="add_survey_button" value="" />
                   
                </td>
              
               
              </tr >
           <?php } ?>
        </table>
 
    	
    </div><!--company_table end-->
<div class="clear"></div>   
</div><!--company end-->

<br />

<div class="dot_line"><!--big_line start-->
	<?php echo $html->image('dot_line.gif', array('alt' => 'bottom','border'=>'0') );?>
</div><!--big_line end-->





<div class="company"><!--company start-->
	<div class="company_info"><!--company_info start-->
    	
        	<?php 
				/*foreach($notices as $key=>$notice){
					echo "<b>". $notice['notice_boards']['notice_title'] ."</b><br/>";
					echo  $notice['notice_boards']['notice'] ."<br/><br/>";
					
				}*/
			
			?>
            
        
        
        <div class="msg">
        	<div class="msg_top"></div>
            
            <div class="msg_body">
            	<div class="company_title"><!--company_title start-->
                	<font color="#468407"><strong>Notice Board</strong></font>
                </div><!--company_title end-->
                
                <div class="message">
                    <div class="message_top"></div>
                
                    <div class="message_body">
                        <?php //echo $html->image('unread_massege.gif', array('alt' => 'Unread msg','border'=>'0') );?>
                        
                        
                        
                        <?php foreach($notices as $key=>$notice){
							if( !empty($notice['t2']['status']) ) continue;
							?>
                            <div class="single_msg">
                            	<div class="single_msg_top"></div>
                            	
                                <div class="single_msg_body">
                                <?php  
										$notice_title=$notice['t1']['notice_title']; 
										$notice_id=$notice['t1']['id']; 
								
                    				echo $this->Html->link($notice_title, array('controller'=>'notice_boards','action' => 'view',$notice_id,'1'))."<br/>";
            					?>
                                </div>
                                
                                <div class="single_msg_bottom"></div>
                                
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="message_bottom"></div>
                </div>
                
                
                <br />
                
                <div class="message">
                    <div class="message_top"></div>
                
                    <div class="message_body">
                        <?php //echo $html->image('read_massege.gif', array('alt' => 'Unread msg','border'=>'0') );?>
                        
                        
                        <?php foreach($notices as $key=>$notice){
							if( empty($notice['t2']['status']) ) continue;
							?>
                            <div class="read_msg">
                            	
                                <?php  
										$notice_title=$notice['t1']['notice_title']; 
										$notice_id=$notice['t1']['id']; 
								
                    				echo $this->Html->link($notice_title, array('controller'=>'notice_boards','action' => 'view',$notice_id,'1'))."<br/>";
            					?>
                                
                            </div><br />
                        <?php } ?>
                        
                        
                    </div>
                    
                    <div class="message_bottom"></div>
                </div>
                
                <br />
                
               <?php $link =  $this->Html->url("/notice_boards/"); ?> 
               <div class="view_all_notice">
               	<input type="submit" name="view_all" id="view_all" onclick="window.location.href='<?php echo $link ?>'" class="view_all_button" value="" />
               </div><div class="clear"></div>
            </div>
            
            <div class="msg_bottom"></div>
        </div>
        
        
    	
    </div><!--company_info end-->
	    	
    <div class="company_table"><!--company_table start-->     
    	<div class="company_table_title"><!--company_table_title start--><strong>Completed Survey for this month</strong></div><!--company_table_title end-->

		<div class="big_line"><!--big_line start-->
        	<?php echo $html->image('plain_line2.gif', array('alt' => 'bottom','border'=>'0') );?>
        </div><!--big_line end-->
        
        <div class="notice"><!--notice start-->
        	<div class="notice_left"><!--notice_left start-->
                <div class="notice_left_top"><!--notice_left_top start--></div><!--notice_left_top end-->
                
                <div class="notice_left_body"><!--notice_left_body start-->Company Name</div><!--notice_left_body end-->
                
                <div class="notice_left_bottom"><!--notice_left_bottom start--></div><!--notice_left_bottom end-->
            </div> <!--survey_left end-->  
            
            <div class="notice_middle"><!--notice_middle start-->
                <div class="notice_middle_top"><!--notice_middle_top start--></div><!--notice_middle_top end-->
                
                <div class="notice_middle_body"><!--notice_middle_body start-->Survey Date</div><!--notice_middle_body end-->
                
                <div class="notice_middle_bottom"><!--notice_middle_bottom start--></div><!--notice_middle_bottom end-->
            </div> <!--notice_middle end--> 
            
            <div class="notice_right"><!--survey_right start-->
                <div class="notice_right_top"><!--notice_right_top start--></div><!--notice_right_top end-->
                
                <div class="notice_right_body"><!--notice_right_body start-->View Details</div><!--notice_right_body end-->
                
                <div class="notice_right_bottom"><!--notice_right_bottom start--></div><!--notice_right_bottom end-->
            </div> <!--survey_right end--> 
            <div class="clear"></div>
        </div><!--notice end-->
        
        
        <table class="survey_table2">
        <?php 
		foreach($companies_status as $key=>$val){
			$com_id = $val['t1']['id'];
			$com_name  = $val['t1']['name'];
			$date = $val['t2']['survey_date'];
			if( empty($date) ) continue;
			//$date = 
			?>
                           
              <tr>
                <td width=""><?php echo $val['t1']['name']; ?></td>
                <td width=""><?php echo  strftime("%B,%Y", strtotime($date)); ?></td>
                <td width=""><?php echo $this->Html->link('Details', array('controller'=>'surveys','action' => 'showans',$com_id,$date)); ?></td>
              </tr>
              
			<?php
		}
		?>
        </table>


    </div><!--company_table end-->
<div class="clear"></div> 	
</div><!--company end-->
  
<br />




