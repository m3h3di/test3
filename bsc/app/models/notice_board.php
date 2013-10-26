<?php
class NoticeBoard extends AppModel {
	var $name = 'NoticeBoard';
	
	
	var $validate=array(
			
			
			'notice_title'=>array(
				'notice_title_must_not_be_blank'=>array(
					'rule'=>'notEmpty',
					'message'=>'This notice_title is missing'
				),
			'notice_title_must_be_unique'=>array(
					'rule'=>'isUnique',
					'message'=>'A notice this title  already exist'
				)	
			
			),
			'notice'=>array(
				'notice_must_not_be_blank'=>array(
					'rule'=>'notEmpty',
					'message'=>'This notice is missing'
				)
			
			)
	);
	
}
?>