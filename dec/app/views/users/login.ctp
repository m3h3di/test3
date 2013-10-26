


<div class="login_content"><!--login_content start-->
	<div>
    <?php echo $html->image('login_banner.jpg', array('alt' => 'login_banner','border'=>'0') ); ?>
    </div>
	<div class="login_box"><!--login_box start-->
		<div class="login_box_content" align="center"><!--login_box_content start-->
			<?php echo $form->create('User', array('action' => 'login')); ?>
			
				
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
                    	<input type="submit" name="login" id="login" class="" value="Login To Digital Environmental Cell"  />
                </div>
               
                
			</form>
		</div> <!--login_box_content end-->
		
		
	</div><!--login_box end-->
	
    

	   
    <div class="clear"></div>
</div><!--login_content end-->

<br />



