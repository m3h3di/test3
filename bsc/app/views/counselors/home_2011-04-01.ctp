<?php
//echo '<pre style="text-align: left">';
//print_r($companies);
//print_r($companies_status);
//print_r($notices);
//print_r($session->read('session_company'));
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>

<script type="text/javascript">

function aaaa(id){
	var linkk = '<?php echo $this->Html->url("/counselors/facility/"); ?>';
	linkk += id;
	location.href=linkk ;
}
</script>



<div class="breadcrumb"><!--breadcrumb start-->
	<div class="welcome_text"><!--welcome_text start-->
    		<font size="2"><?php echo $this->Html->link("Home","/") ?> | </font>
        	<font size="2"><?php echo $session->read('Auth.User.name'); ?></font>
        </div><!--welcome_text end -->
        
        <div class="date_combo" ><!--date_combo start-->
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
        	<input type="submit" name="go" id="go" onclick="" value="Go" />
		</form>
        </div><!--date_combo end -->
        
        <div class="clear"></div>   
</div><!--breadcrumb end-->


<br />




<div class="company"><!--company start-->
	<div class="company_info"><!--company_info start-->
        <div class="company_description"><!--company_description start-->
        	<div class="company_title"><!--company_title start--><strong>Counselor Information</strong></div><!--company_title end-->
            
            
        	<font color="#58595b"><strong><?php echo $session->read('Auth.User.name'); ?></strong></font> <br />
            
			UserName: <font color="#58595b"><b><?php echo $session->read('Auth.User.username'); ?></b></font><br />
            
            Address : <font color="#58595b"><b><?php echo $session->read('Auth.User.address'); ?></b></font><br />
            
         </div><!--company_description end--><br />
         
         <?php echo $html->image('map_dhaka.gif', array('alt' => 'map','border'=>'0') );?>
         
    </div><!--company_info end-->
    
    
    
    
    
	    	
    <div class="company_table"><!--company_table start-->  
    	<div class="company_table_title"><!--company_table_title start-->
        	<strong>Assigned enterprises with pending survey</strong>
        </div><!--company_table_title end-->
    	
        
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
                
				<td width="" title="survey cannot be added after this date">
					<?php 
						//echo  strftime("%B,%Y", strtotime($val['t2']['survey_date'])); 
						
						$newdate = strtotime('+2 month',strtotime($val['t2']['survey_date'])); 
						
						$newdate = date ( 'Y-m-j' , $newdate );
							//echo $newdate;
						echo  strftime("%b %d %Y",strtotime($newdate)); 
					?>
				</td>
                
                
                <td>
                    <input type="submit" name="add_entry" id="add_entry" onclick="window.location.href='<?php echo $link ?>'"  value="Add Survey" />
                    <!--class="add_survey_button"-->
                   
                </td>
                
              
               
              </tr >
           <?php } ?>
        </table>
 
    	
    </div><!--company_table end-->
<div class="clear"></div>   
</div><!--company end-->

<br />




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
										$notice_id=$notice['t1']['id']; ?>
								<blink>
                    				<?php echo $this->Html->link($notice_title, array('controller'=>'notice_boards','action' => 
									'view',$notice_id,'1'))."<br/>";?>
            					</blink>
								
								
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
               	<input type="submit" name="view_all" id="view_all" onclick="window.location.href='<?php echo $link ?>'"  value="View all" />
               </div><div class="clear"></div><!--class="view_all_button"-->
            </div>
            
            <div class="msg_bottom"></div>
        </div>
        
        
    	
    </div><!--company_info end-->
	    	
    <div class="company_table"><!--company_table start-->     
    	<div class="company_table_title"><!--company_table_title start--><strong>Completed Survey for this month</strong></div><!--company_table_title end-->

		
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




