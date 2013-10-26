<div class="banner"><!--banner start-->
    <?php echo $html->image('banner.gif', array('alt' => 'bottom','border'=>'0') );?>
</div><!--banner end-->

<div class="login_content"><!--login_content start-->
	<div class="login_content_top"><!--login_content_top start--></div><!--login_content_top end-->
    
    <div class="login_content_body"><!--login_content_body start-->
    	<div class="login_title"><!--login_title start-->Login Panel </div><!--login_title end-->
        
        <div class="line"><!--line start-->
        	<!--<img src="images/line.gif" alt="" />-->
        	<?php echo $html->image('line.gif', array('alt' => 'bottom','border'=>'0') );?>
        </div><!--line end-->
        <?php echo $form->create('User', array('action' => 'login')); ?>
        <div class="login_menu"><!--login_menu start-->
        	<div class="user"><!--user start-->
           	  <div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                	<div class="user_title"><!--user_title start-->Username</div><!--user_title end-->
                    
                    <div class="user_text"><!--user_text start-->
                    	<input type="text" name="data[User][username]" id="user" class="text_box"/>
                    </div><!--user_text end-->  <br />  
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--user end-->
            
            <div class="user"><!--user start-->
            	<div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                	<div class="user_title"><!--user_title start-->Password</div><!--user_title end-->
                    
                    <div class="user_text"><!--user_text start-->
                    	<input type="password" name="data[User][password]" id="user" class="text_box"/>
                    </div><!--user_text end-->  <br />  
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--user end-->
            
            <div class="user"><!--user start-->
            	<div class="user_top"><!--user_top start--></div><!--user_top end-->
                <div class="user_body"><!--user_body start-->
                	<div class="button"><!--button start-->
                    	<input type="submit" name="login" id="login" class="login_button" value=""  />
                    </div><!--button end-->
                </div><!--user_body end-->
                <div class="user_bottom"><!--user_body bottom--></div><!--user_body bottom-->
            </div><!--user end-->
            
            <div class="clear"></div>
        </div><!--login_menu end-->
        </form>
        
    </div><!--login_content_body end-->
    
    <div class="login_content_bottom"><!--login_content_bottom start--></div><!--login_content_bottom end-->
</div><!--login_content end-->
