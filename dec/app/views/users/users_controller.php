<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	function beforeFilter() {
		
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
	}

	
	function login() {
		if ($this->Session->read('Auth.User')) {
			//$this->Session->setFlash('You are logged in!');
			if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
			else $this->redirect('/', null, false);
		}
	} 
	 
	function logout() {
		//Leave empty for now.
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());

	}
	
	function home() {
		if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
		$id = $this->Auth->User('id');
		$this->set('factories', $this->User->findAllById($id) );	//seba/users/home
	}
	
	function factory($factory_id=NULL,$upload_approved=NULL) {

                if($upload_approved=='yes')
                {
                    $this->set('upload',$upload_approved);
                }

                if(!empty($this->data['User']['factory_id']))
                {
                   $factory_id= $this->data['User']['factory_id'];

                    if( is_uploaded_file($this->data['User']['File1']['tmp_name']))
		    {
                        $rand=rand(0, 10000000);
                        move_uploaded_file($this->data['User']['File1']['tmp_name'],
                                          "../webroot/img/uploads/" .$rand.$this->data['User']['File1']['name']);
                        $image_name1 =  $rand.$this->data['User']['File1']['name'];
                        $this->User->query("insert into files(id,factory_id,file_name) values('','$factory_id','$image_name1')");
                     }
                    if( is_uploaded_file($this->data['User']['File2']['tmp_name']))
		    {
                        $rand=rand(0, 10000000);
                        move_uploaded_file($this->data['User']['File2']['tmp_name'],
                                          "../webroot/img/uploads/" .$rand.$this->data['User']['File2']['name']);
                        $image_name2 =  $rand.$this->data['User']['File2']['name'];
                        $this->User->query("insert into files(id,factory_id,file_name) values('','$factory_id','$image_name2')");
                     }
                    if( is_uploaded_file($this->data['User']['File3']['tmp_name']))
		    {
                        $rand=rand(0, 10000000);
                        move_uploaded_file($this->data['User']['File3']['tmp_name'],
                                          "../webroot/img/uploads/" .$rand.$this->data['User']['File3']['name']);
                        $image_name3 =  $rand.$this->data['User']['File3']['name'];
                        $this->User->query("insert into files(id,factory_id,file_name) values('','$factory_id','$image_name3')");
                     }
                    if( is_uploaded_file($this->data['User']['File4']['tmp_name']))
		    {
                        $rand=rand(0, 10000000);
                        move_uploaded_file($this->data['User']['File4']['tmp_name'],
                                          "../webroot/img/uploads/" .$rand.$this->data['User']['File4']['name']);
                        $image_name4 =  $rand.$this->data['User']['File4']['name'];
                        $this->User->query("insert into files(id,factory_id,file_name) values('','$factory_id','$image_name4')");
                     }
                    if( is_uploaded_file($this->data['User']['File5']['tmp_name']))
		    {
                        $rand=rand(0, 10000000);
                        move_uploaded_file($this->data['User']['File5']['tmp_name'],
                                          "../webroot/img/uploads/" .$rand.$this->data['User']['File5']['name']);
                        $image_name5 =  $rand.$this->data['User']['File5']['name'];
                        $this->User->query("insert into files(id,factory_id,file_name) values('','$factory_id','$image_name5')");
                     }


                      // $image_list=$this->User->query("select * from files where `factory_id`='$factory_id'");
                       //$this->set('image_list',$image_list);



                       $id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2

			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				$this->set('factory', $res);		//seba/users/factory/2
		       }
                        $this->set('manipulate_image','true');
                     

                }

		if( !empty($factory_id)){

			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				$this->set('factory', $res);		//seba/users/factory/2
			}
			
            else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			$this->set('followups',$this->Factory->query("SELECT DISTINCT(created),doc FROM `followups` WHERE factory_id = $factory_id") );
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		
	}


        function manipulate_image($factory_id=NULL,$id=NULL)
        {

            if(!empty($id))
             {
                 $this->User->query("delete from files where `id`='$id'");
             }
             $image_list=$this->User->query("select * from files where `factory_id`='$factory_id'");
             $this->set('image_list',$image_list);
           
        }
	
	function index() {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->layout = 'cake';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'cake';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'cake';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function followup($factory_id = null, $version= 1){
		//$this->set('factory_id',$factory_id);
			 
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			if($version != 1){
				$ttt = $version - 1;
				$factories = $this->Factory->query("SELECT * FROM `followups` AS `factory_ans_tables` WHERE factory_id = $factory_id AND status=$ttt ORDER BY `section` ASC") ;
			}
			else
			$factories = $this->Factory->query("SELECT * FROM `factory_ans_tables` 
WHERE factory_id = $factory_id AND question_id IN ( 23, 54, 36, 133, 61, 74, 82, 91, 97, 102, 107, 115, 127, 131 )
ORDER BY `factory_ans_tables`.`section` ASC") ;
			
			$this->set('factory_info', $res[0]['Factory'] );
			$this->set('factories', $factories );
			$this->set('version', $version );
			
			//echo "<pre>";
			//print_r($factories);
			//echo "</pre>";
			if(!empty($_POST)){
				//echo
				$doc = ""; 
				if ($_FILES["file"]["error"] == 0){ 
					$aaaa = $_FILES["file"]["name"];
					$doc_name = str_replace(" ","_",$aaaa);
					move_uploaded_file($_FILES["file"]["tmp_name"],"files/" . $doc_name);
					$doc = $doc_name;
				}
				
				foreach($_POST['ans'] as $ans){
					$ans['user_id']=$id;
					$ans['iv_date']=$_POST['ivd'];
					$ans['fw_date']=$_POST['fwd'];
					$ans['doc']=$doc;					
					$data_set[] = $ans;
					
				}
				
				//echo "<pre>";
				//print_r($data_set);
				//echo "</pre>";
				
				$this->loadModel("Followup");
				if($this->Followup->saveAll($data_set))	$this->redirect( array('controller' => 'users', 'action' => 'factory',$factory_id) ) ;
				
			}
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
	}
	
	
	function FollowupView($factory_id= null , $version= null){
		//$this->set('factory_id',$factory_id);
			 
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id) and !empty($version)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			
			$factories = $this->Factory->query("SELECT * FROM `followups` WHERE factory_id = $factory_id AND status=$version ORDER BY `section` ASC") ;
			
			$this->set('factory_info', $res[0]['Factory'] );
			$this->set('factories', $factories );		
			
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
	}
	function FollowupEdit($factory_id = null, $version= 1){
		//$this->set('factory_id',$factory_id);
		
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			
			$ttt = $version - 1;
			$factories = $this->Factory->query("SELECT * FROM `followups` AS `factory_ans_tables` WHERE factory_id = $factory_id AND status=1 ORDER BY `section` ASC") ;
			
			/*else
			$factories = $this->Factory->query("SELECT * FROM `factory_ans_tables` 
WHERE factory_id = $factory_id AND question_id IN ( 23, 54, 36, 133, 61, 74, 82, 91, 97, 102, 107, 115, 127, 131 )
ORDER BY `factory_ans_tables`.`section` ASC") ;*/
			
			$this->set('factory_info', $res[0]['Factory'] );
			$this->set('factories', $factories );
			$this->set('version', $version );
			
			//echo "<pre>";
			//print_r($factories);
			//echo "</pre>";
			if(!empty($_POST)){
			
				$doc = ""; 
				if ($_FILES["file"]["error"] == 0){ 
					$aaaa = $_FILES["file"]["name"];
					$doc_name = str_replace(" ","_",$aaaa);
					move_uploaded_file($_FILES["file"]["tmp_name"],"files/" . $doc_name);
					$doc = $doc_name;
				}
				
				foreach($_POST['ans'] as $ans){
					$ans['user_id']=$id;
					$ans['iv_date']=$_POST['ivd'];
					$ans['fw_date']=$_POST['fwd'];
					$ans['doc']=$doc;					
					$data_set[] = $ans;
					
				}
				
				//echo "<pre>";
				//print_r($data_set);
				//echo "</pre>";
				
				$this->loadModel("Followup");
				if($this->Followup->query("DELETE * FROM table_name WHERE factory_id = $factory_id ")){
					if($this->Followup->saveAll($data_set))	$this->redirect( array('controller' => 'users', 'action' => 'FollowupView',$factory_id) ) ;
				}
				
			}
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
	}
        
	function admin_delete($id = null) {
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>