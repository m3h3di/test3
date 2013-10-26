<?php echo $this->Html->css('login_menu'); ?>
<?php  echo $javascript->link('jquery.js'); ?>
<?php  echo $javascript->link('sliding_effect.js'); ?>
<?php  echo $javascript->link('m3h3di.js'); ?>

<div class="login_content"><!--login_content start-->

    <div style="float:left; width:300px">
	    <div id="navigation-block">
            <ul id="sliding-navigation">
                <li class="sliding-element"><?php echo $html->link('Chemicals/Hazardous Materials Management', '/files/mgt.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Environmental Awareness Training & Recordkeeping', 
			'/files/env_awareness.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Spill Response/Emergency Response', 
			'/files/emergency_response_plan.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Spill Prevention', '/files/spill_prevention.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Environmental Management System (EMS)', '/files/ems.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Cleaner Production', '/files/cleaner_production.html');?></li>
                <li class="sliding-element"><?php echo $html->link('Chemical Backgrounds', '/files/chemicals_background.html');?></li>

            </ul>
        </div>
    </div>    
    
    <div class="login_right_content_text">
    	
        <div class="login_right_content_text_title">
            <font size="2" ><b>Chemicals and Hazardous Materials Management</b></font>
        </div><br />
            Industrial processes at the DEPZ - involved with dyeing, bleaching, and washing of yarns or fabrics; manufacturing metal parts or accessories; printing and labelling; leather finishing; energy generation and operating steam boiler - store and use wide varieties of chemicals and hazardous materials. These chemicals may include dyes, bleaching agent, paints, solvents, cleaners, varnishes, oils, and raw materials for an industrial process. If not properly stored, managed and utilized, chemicals and hazardous materials may release into the environment causing degradation of land, air and water, explosions, and danger to employees who improperly handle or come into contact with these materials.  <br />  <br /> 
    The objective of chemical and hazardous material management is to transport, store, and manage these materials by safeguarding the personal safety of the employees who use them, and to store them in safe areas that will prevent their release to the environment, and reduce or eliminate any potential for explosion and fire.  <br /> 
    	<!--
        <font color="#8ea742"><b>	
            All chemical and hazardous materials using facilities should implement a systematic management process that may include 		</b>
        </font>    
        -->
    </div>
    
    <div class="login_right_content" style="text-align:left"><!--login_right_content start-->
    	<div id="slideshow">
			<?php echo  $this->Html->image("slide/1.jpg", array("alt" => "logo", "class"=>"active"))?>
            <?php echo  $this->Html->image("slide/2.jpg", array("alt" => "logo"))?>
            <?php echo  $this->Html->image("slide/3.jpg", array("alt" => "logo"))?>
            <?php echo  $this->Html->image("slide/2.jpg", array("alt" => "logo"))?>
           
        </div>

         <br />
        <?php echo $form->create('User', array('action' => 'login')); ?>
        <div class="login_menu" style="text-align:center"><!--login_menu start-->
        
            <div class="login_title" style="padding:10px 0 0 10px"><!--login_title start-->
                <font style="font-size:12px"><b>Login</b> into BEPZA Environmental Management System Database </font>
            </div><!--login_title end-->
            <br />  
        
        
           <div class="login_menu_content"><!--login_menu_content start-->
                <div class="menu_title"><!--menu_title start-->Username:</div><!--menu_title end--><div class="clear"></div> <br />  
                        <div class="menu_text"><!--menu_text start-->
                            <input type="text" name="data[User][username]" id="" class="text_box" />
                        </div><!--menu_text end--><br /> <br /> 
                        
                <div class="menu_title"><!--menu_title start-->Password:</div><!--menu_title end--><div class="clear"></div> <br />  
                        <div class="menu_text"><!--menu_text start-->
                            <input type="password" name="data[User][password]" id="" class="text_box" />
                        </div><!--menu_text end-->
                        
                        
                 <div class="login_btn">
                        <?php //echo $this->Html->link('Login', '#', array('class' => 'link')); ?>
                        <input type="submit" value="Login" />
               
                </div> 
            </div><!--login_menu_content end-->
            
           
           
            <?php echo $html->image('tala.jpg', array('alt' => 'lock')); ?>
                       
            
        </div><!--login_menu end-->
        </form>
        
        
    </div><!--login_right_content end-->

	<div class="clear"></div>
</div><!--login_content end-->

<!--<div class="login_bottom"></div>-->
