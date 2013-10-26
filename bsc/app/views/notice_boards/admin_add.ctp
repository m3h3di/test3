<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            
            <?php echo $this->Html->link('Notice Board', array('controller'=>'notice_boards','action'=>'index')); ?> >>
            Add Notice
            
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left" ><!--company start-->


<div class="assigned_tasks">

<?php 
//echo '<pre style="text-align: left">';
 // print_r($works);
//echo "</pre>";
?>
<h3> Add a notice  </h3>
<h5 style="color:green;"><?php echo $this->Session->flash();?> </h5>
<table width="600" border="0" cellspacing="5" cellpadding="5">
<?php  echo $form->create('NoticeBoard', array('action' => 'add', 'type' => 'file'));

?>

   <tr>
    <td>&nbsp;Published Date</td>
    <td>   
    		
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
            
    
    </td>
   </tr>
   
   
   
   <tr> 
    <td>&nbsp;Valid Until</td>
    <td>
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
    </td>
    </tr>
   
   
   
   <!--edited by nandinee to add two fields to database.work on notice_board controller start-->
  <tr>
    <td>&nbsp;  Zone</td>
    <td>  
    	<select name="data[NoticeBoard][zone]" id="" rel="">
            <option value="0" >All zones</option>
            <?php 
            foreach($all_zone as $k=>$zone){
                $val = $zone['companies']['zone'];
                $select="";
                if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
            }
            ?>

		</select>
    
    
    </td>
  </tr>
   
   
   <tr>
    <td>&nbsp;  Product category</td>
    <td>   <?php //echo $form->input('NoticeBoard.product_category',array('label'=>false))?> 
    
    	<select name="data[NoticeBoard][product_category]" id="" rel="">
            <option value="0" >All product categories</option>
            <?php 
            foreach($product_categories as $k=>$product_category){
				
                $val = $product_category['product_categories']['id'];
				$name = $product_category['product_categories']['name'];
				
                $select="";
                if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$name.'</option>';
            }
            ?>

		</select>
    
    
    </td>
  </tr>
   <!--edited by nandinee to add two fields to database.work on notice_board controller end-->
   
   
   
   
  <tr>
    <td>&nbsp;  Title</td>
    <td>   <?php echo $form->input('NoticeBoard.notice_title',array('label'=>false))?> </td>
  </tr>
   
   
   <tr> 
    <td>&nbsp; Notice Description</td>
    <td>
    	<?php
			echo $form->textarea('NoticeBoard.notice',array('label'=>false));
			?>
    </td>
    </tr>
    
    
    
    
    
    
    <tr>
     <td>&nbsp; Supporting documents</td>
     <td>   <?php echo $form->file('File');?></td>
    </tr>
     <tr>
     <td> </td>
     <td>
    <?php echo $this->Form->end(__('Submit', true));?>
     </td>
	</tr>
</table>

</div>



</div><!--company end-->