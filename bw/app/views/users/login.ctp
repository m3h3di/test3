<style>
div#logo{margin: 10px auto;width: 968px;}
</style>
<div class="login_content"><!--login_content start-->
	<div class="loginBanner">
    <?php echo $html->image('login_banner.jpg', array('alt' => 'login_banner','border'=>'0') ); ?>
    </div>
	<div class="login_box"><!--login_box start-->
		
			<?php echo $form->create('User', array('action' => 'login')); ?>
				<div class="login_box_content" align="center"><!--login_box_content start-->
					<div style="float:left;margin-top: 11px;width: 300px;">
						<?php echo $html->image('bwLogo.png', array('alt' => '','border'=>'0') )?>
					</div>
					<div style="float:left">
					<table>
						<tr>
							<td><div class="login_field">Username</div> </td>
							<td>
								<div class="login_field">
									<input type="text" name="data[User][username]" id="user" class="login_text_box"/>
								</div> 
							</td>
						</tr>
						<tr>
							<td><div class="login_field">Password</div> </td>
							<td>
								<div class="login_field">
									<input type="password" name="data[User][password]" id="user" class="login_text_box"/>
								</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="login_button">
									<input type="submit" name="login" id="login" class="" value="Login"  />
							</div>
							</td>
						</tr>
					</table>
					</div>
					<div class="clear"></div>
				</div><!--login_content end-->
			</form>
			
		</div> <!--login_box_content end-->
		
	</div><!--login_box end-->





