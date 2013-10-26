

<div class="login_content"><!--login_content start-->
	<div class="login_content_top"><!--login_content_top start--></div><!--login_content_top end-->
    
    <div class="login_content_body"><!--login_content_body start-->
    	<div class="login_title"><!--login_title start-->Notice Board </div><!--login_title end-->
        
       
        <div class="notice_menu"><!--notice_menu start-->
        	<div class="notice_board"><!--notice start-->
           	  <div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                    <br />  
                    	<?php  echo $form->create('NoticeBoard', array('action' => 'add', 'type' => 'file'));?>
                        <div class="notice_title"><!--user_title start-->Publish Date</div><!--user_title end-->
                        <select name="data[NoticeBoard][pday]"> 
            <option value="" selected="selected">Day</option>
        <?php for($i=1;$i<32;$i++){?>
        
            <option value="<?php echo $i;?>"> <?php echo $i;?></option>
            
             
         <?php }?>  
          </select> 
        
        
                <select name="data[NoticeBoard][pmonth]"> 
            <option value="" selected="selected">Month</option>
        <?php for($j=1;$j<13;$j++){?>
        
            <option value="<?php echo $j;?>"> <?php echo $j;?></option>
            
             
         <?php }?>  
          </select> 
          
                <select name="data[NoticeBoard][pyear]"> 
            <option value="" selected="selected">Year</option>
        <?php for($l=2011;$l<2015;$l++){?>
        
            <option value="<?php echo $l;?>"> <?php echo $l;?></option>
            
             
         <?php }?>  
          </select> 
                        
                        <br />  <br />  
                    
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--notice_board end-->
            
            
            <!--<div class="to">
            	<?php //echo $html->image('to.gif', array('alt' => 'to','border'=>'0') );?>
            </div>-->
            
            
            <div class="notice_board"><!--notice_board start-->
            	<div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                	 <br />  
                     <div class="notice_title"><!--user_title start-->Valid Until</div><!--user_title end-->
                       <select name="data[NoticeBoard][day]"> 
            <option value="" selected="selected">Day</option>
        <?php for($i=1;$i<32;$i++){?>
        
            <option value="<?php echo $i;?>"> <?php echo $i;?></option>
            
             
         <?php }?>  
          </select> 
        
        
                <select name="data[NoticeBoard][month]"> 
            <option value="" selected="selected">Month</option>
        <?php for($j=1;$j<13;$j++){?>
        
            <option value="<?php echo $j;?>"> <?php echo $j;?></option>
            
             
         <?php }?>  
          </select> 
          
                <select name="data[NoticeBoard][year]"> 
            <option value="" selected="selected">Year</option>
        <?php for($l=2011;$l<2015;$l++){?>
        
            <option value="<?php echo $l;?>"> <?php echo $l;?></option>
            
             
         <?php }?>  
          </select> 
                        
                        <br />  <br /> 
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--notice_board end-->
            
            <div class="notice_board"><!--notice_board start-->
            	<div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                	 <br />  
                     <div class="notice_title"><!--user_title start-->Title</div><!--user_title end-->
                       
                      <input type="text" name="data[NoticeBoard][notice_title]" id="" style="width:190px;" />  
                        
                     <br />  <br /> 
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--notice_board end-->
            
            
            
            <div class="clear"></div>
            
            <div class="notice_image"><!--for_image start-->
            	<?php echo $html->image('notice_des.gif', array('alt' => 'for','border'=>'0') );?>
            </div><!--for_image end-->
            
        </div><!--notice_menu end-->
        
        
        <div class="notice_area"><!--notice_area start-->
         	<div class="notice_area_top"><!--notice_area_top start--></div><!--notice_area_top end-->
            
            <div class="notice_area_body"><!--notice_area_body start-->
            	<textarea name="data[NoticeBoard][notice]" class="notice_text_area">
                </textarea>
            </div><!--notice_area_body end-->
            
            <div class="notice_area_bottom"><!--notice_area_bottom start--></div><!--notice_area_bottom end-->
            
            <br /> 
            Support Document: <input type="file" name="data[NoticeBoard][File]" id="NoticeBoardFile" />
            <div class="notice_button" align="right"><!--notice_button start-->
        		<input type="submit" name="post" id="post" class="post_button" value=""  />
        	</div><!--notice_button end-->
        </div><!--notice_area end-->
        </from>
        
        
        
    </div><!--login_content_body end-->
    
    <div class="login_content_bottom"><!--login_content_bottom start--></div><!--login_content_bottom end-->
</div>
  


