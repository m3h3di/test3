<style>
.main_contents{
	width:760px;
	margin:auto;
	
}
.contents{
padding:0px;
height:336px;
background:url('../img/middle_bg_gra.jpg') repeat-x;
border: solid 0px black;	
}
.log_l{
	width:423px;
	float:left;	
}

.log_l #bottom{
	width:404px;
	min-height:219px;
	background:url('<?php echo $html->url('/img/login_bg.png');?>');
	
}
.log_l #top{
	width:423px;
	height:70px;	
}

.log_m{
	width:4px;
	min-height:336px;
	background-color:#FFF;
	float:left;
	
}
.log_r{
	float:right;
	width:333px;	
}
.log_r #top{
	width:333px;
	height:90px;	
}

.log_r #bottom{
	float:right;
	width:313px;
	min-height:219px;
	background:url('<?php echo $html->url('/img/login_image.png');?>');
	
}

</style>
<div class="main_contents">
    <div class="log_l"> &nbsp;
        <div id="top">
        	<div>
            	<font style="font-size:35px; font-stretch:extra-expanded; font-weight:bold">Login Panel </font>
            </div>
        </div>
        <div id="bottom">
        	<div style="border:0px solid #D8D2C3;">
							
				<?php echo $form->create('User', array('action' => 'login')); ?>

                   <div style="float:left;width:178px; height:100px; padding-top:40px; padding-left:24px;"> <span style="padding-left:70px; font-size:18px;">Username </span> <br /> <br /> <input type="text" name="data[User][username]"  /> </div>
                    <div style="float:right;width:178px;height:100px;padding-top:40px;padding-left:24px;">Password<br /> <br /> <input type="password" name="data[User][password]"  /></div>
                    
                    <div style="float:right; width:290px;"><input type="image" src="<?php echo $html->url('/img/login_btn_normal.png');?>" name="Login" width="167" height="59"></div>
                </form>
			</div>
        
        </div>
    </div>
    <div class="log_m"> &nbsp;
    </div>
    <div class="log_r">
        <div id="top">
        </div>
        <div id="bottom">
        </div>
    </div>
</div>