<div class="breadcrumb"><!--breadcrumb start-->
	<div class="welcome_text"><!--welcome_text start-->
          <font size="2">
			 <?php echo $this->Html->link("Home","/") ?> >>
                
            View Notice
                
          </font>
     </div><!--welcome_text end -->
        
        <div class="clear"></div>   
</div><!--breadcrumb end-->


<br /><br />


<div class="company" style="text-align:left" ><!--company start-->

<h2><?php  __('Notice Board');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notice Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['notice_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notice'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $noticeBoard['NoticeBoard']['notice']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Published Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
				//echo $noticeBoard['NoticeBoard']['published_date']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['published_date']));
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valid Until'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
				//echo $noticeBoard['NoticeBoard']['valid_until']; 
				echo strftime("%d %B,%Y", strtotime($noticeBoard['NoticeBoard']['valid_until']));
			?>
			&nbsp;
		</dd>
        
        
        
       <!--edited by nandinee start--> 
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			
				$zone= $noticeBoard['NoticeBoard']['zone']; 
				if($zone==NULL) { echo "All zones"; }
				else { echo $zone;} 
			
			?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php 
			
				$productCat= $noticeBoard['NoticeBoard']['product_category']; 
				if($productCat==0) { echo "All product categories"; }
				else { echo $productCat;} 
			
			?>
			&nbsp;
		</dd>
        <!--edited by nandinee end-->
        
        
        
        
        <dt<?php if ($i % 2 == 0) echo $class;?>>Documents</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			//$noticeBoard['NoticeBoard']['id'].""
			$name = $noticeBoard['NoticeBoard']['id'].".pdf";
			echo $html->link("click Here to get the file", "/uploads/$name"); 
			?>
			&nbsp;
		</dd>
	</dl>


</div>