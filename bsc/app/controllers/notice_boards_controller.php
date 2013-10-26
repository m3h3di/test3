<?php
class NoticeBoardsController extends AppController {

	var $name = 'NoticeBoards';
	function beforeFilter() {
		$this->layout = 'cake';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		
		
		//for new notice start 
		$date = date("Y_m_d");
		$notices=$this->NoticeBoard->query("SELECT count(t1.id) as n FROM notice_boards as t1 
										  WHERE t1.valid_until >= '$date' AND '$date'  >= t1.published_date AND t1.id not in
										  (SELECT t2.notice_id FROM notice_status as t2) ");
			
			//print_r($notices);exit;
			foreach($notices as $key=>$notice)
			{
				 $new_notice=$notice['0']['n'];  
			}
			$this->set("new_notice",$new_notice);	
			
			//$this->Session->write('new_notice', $new_notice);
			
		//for new notice end 	
		
		
	}
	// for counselor start
	function index() 
	{
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin','action'=>'cpanels') );
		//edited by nandinee for only admin access end			
				
		$this->NoticeBoard->recursive = 0;
		$this->set('noticeBoards', $this->paginate());
		
		$menu_item="counselor_notice";$this->Session->write('menu_item', $menu_item);
		
	}
	
	function view($id = null,$id2 = null) 
	{
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') == (1||2) ) // status=1 means admin
				$this->redirect( array('controller'=>'admin','action'=>'cpanels') );
		//edited by nandinee for only admin access end	
		
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid notice board', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if( !empty($id2)){
			$this->loadModel("NoticeStatus");
			$user_id = $this->Session->read('Auth.User.id');
			$data = array("status"=>1,"user_id"=>$user_id,"notice_id"=>$id);
			
			$this->NoticeStatus->create();
			$this->NoticeStatus->save($data);
		}
		$this->set('noticeBoard', $this->NoticeBoard->read(null, $id));
		
		
		
		
		
		
		
		
	}
	
	// for counselor end
	
	
	
	function admin_index() 
	{
		$menu_item="admin_notice";$this->Session->write('menu_item', $menu_item);
		
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		//edited by nandinee for only admin access end	
		
		
		$this->NoticeBoard->recursive = 0;
		$this->set('noticeBoards', $this->paginate());
	}

	
	
	function admin_view($id = null) 
	{
		$menu_item="admin_notice";$this->Session->write('menu_item', $menu_item);
		
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		//edited by nandinee for only admin access end	
		
		
		if (!$id) 
		{
			$this->Session->setFlash(__('Invalid notice', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('noticeBoard', $this->NoticeBoard->read(null, $id));
	}
	
	
	function admin_add() 
	{   //print_r($_POST['data']);exit;
		//$this->layout = 'default1';
		
		$menu_item="admin_notice";$this->Session->write('menu_item', $menu_item);
		
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		//edited by nandinee for only admin access end	
			
		
		if(!empty($this->data))
		{
            $d=$this->data['NoticeBoard']['day'];
			$m=$this->data['NoticeBoard']['month'];
			$y=$this->data['NoticeBoard']['year'];
			$valid_until=$y."-".$m."-".$d;
			//echo $deadline;
			//$valid_until= date('Y/m/d h:m:s', time());
			
			$this->data['NoticeBoard']['valid_until']=$valid_until;
			
			$dp=$this->data['NoticeBoard']['pday'];
			$mp=$this->data['NoticeBoard']['pmonth'];
			$yp=$this->data['NoticeBoard']['pyear'];
			$published=$yp."-".$mp."-".$dp;
			
			//$published=date('Y/m/d', time());
			$this->data['NoticeBoard']['published_date']=$published;
			
			
			$this->NoticeBoard->create();
			if ($this->NoticeBoard->save($this->data)) {
				if(is_uploaded_file($this->data['NoticeBoard']['File']['tmp_name'])) {
					$ext = explode(".",$this->data['NoticeBoard']['File']['name']);
					$image_name = $this->NoticeBoard->getLastInsertId().".".$ext[1];
				
			   		$rand=rand(0, 100);							 
					move_uploaded_file($this->data['NoticeBoard']['File']['tmp_name'], "../webroot/uploads/".$image_name);
											 
					$this->data['NoticeBoard']['supporting_document'] =  $rand.$this->data['NoticeBoard']['File']['name'];
				}
				
				//$this->Session->setFlash('The notice is added successfully');
				//$this->redirect(array('action' => 'add'));
				
				$this->redirect(array('action' => 'index'));
			} 
			else{
				$this->Session->setFlash(__('The notice could not be saved. Please, try again.', true));
			}
            //$this->redirect('somecontroller/someaction');
			
			
		}
		
		
		
		//edited by nandinee to add product_category and zone to notice start
		
		
		/*$productCategories = $this->Company->ProductCategory->find('list',
		array('conditions' => array('ProductCategory.id !=' => 1)) );
			$this->set(compact('productCategories'));*/
			
		$this->loadModel("ProductCategory");	
		$this->set('product_categories', $this->ProductCategory->query("SELECT * FROM product_categories") );
		
		$this->loadModel("Company");	
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone FROM companies") );
		
		//edited by nandinee to add product_category and zone to notice end
		
	}

	function admin_edit($id = null) 
	{
		$menu_item="admin_notice";$this->Session->write('menu_item', $menu_item);
		
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		//edited by nandinee for only admin access end	
		
		
			//$this->layout = 'default1';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid notice', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			 if(is_uploaded_file($this->data['NoticeBoard']['File']['tmp_name'])) {
           
			
				$rand=rand(0, 100);							 
				move_uploaded_file($this->data['NoticeBoard']['File']['tmp_name'],
					  "../webroot/img/uploads/".$rand. $this->data['NoticeBoard']['File']['name']);
										 
				$this->data['NoticeBoard']['supporting_document'] =  $rand.$this->data['NoticeBoard']['File']['name'];
			}
			
			if ($this->NoticeBoard->save($this->data)) {
				$this->Session->setFlash(__('The notice has been updated', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notice could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NoticeBoard->read(null, $id);
		}
	}

	function admin_delete($id = null) 
	{
		$menu_item="admin_notice";$this->Session->write('menu_item', $menu_item);
		
		//edited by nandinee for only admin access start
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		//edited by nandinee for only admin access end	
		
		
			$this->layout = 'default1';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for notice', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NoticeBoard->delete($id)) {
			$this->Session->setFlash(__('Notice deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Notice is not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>