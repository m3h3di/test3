


<div class="login_content"><!--login_content start-->
	
    <?php echo $html->image('login_banner.png', array('alt' => 'login_banner','border'=>'0') );?>
    
	<div class="login_box"><!--login_box start-->
		<div class="login_box_content" align="center"><!--login_box_content start-->
			<?php echo $form->create('User', array('action' => 'login')); ?>
			
				<!--<div class="login_field">Username</div> 
				<div class="login_field">
					<input type="text" name="data[User][username]" id="user" class="login_text_box"/>
				</div> 
				
				<div class="login_field">Password</div> 
				<div class="login_field">
					<input type="password" name="data[User][password]" id="user" class="login_text_box"/>
				</div> 
				
				<div class="login_button">
                    	<input type="submit" name="login" id="login" class="login_button_style" value=""  />
                </div>-->
                
                <div class="login_field">Username</div> 
				<div class="login_field">
					<input type="text" name="data[User][username]" id="user" class="login_text_box"/>
				</div> 
				
				<div class="login_field">Password</div> 
				<div class="login_field">
					<input type="password" name="data[User][password]" id="user" class="login_text_box"/>
				</div> 
                
                <div class="clear"></div>
				
				<div class="login_button">
                    	<input type="submit" name="login" id="login" class="login_button_style" value=""  />
                </div>
               
                
			</form>
		</div> <!--login_box_content end-->
		
		
	</div><!--login_box end-->
	
    
	<!--<div class="login_divider">
		<?php //echo $html->image('login_panel_divider.gif', array('alt' => 'bottom','border'=>'0') );?>
	</div>
	
	<div class="login_img">
		<?php //echo $html->image('login_page_img.gif', array('alt' => 'image','border'=>'0') );?>
	</div>-->
	   
    <div class="clear"></div>
</div><!--login_content end-->

<br />



