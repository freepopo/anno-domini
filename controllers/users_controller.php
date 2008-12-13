<?
class UsersController extends AppController {
	var $name = 'Users';
	var $layout = 'admin';
	var $components = array('Email');
	
	function beforeFilter() {
		if ($this->action != 'admin_login' && $this->action != 'admin_logout' && $this->action != 'submit') {
			$this->checkAdmin();
		}
	}
	
	function admin_login(){
		if ($this->data) {
			$user = $this->data;
			if ($this->User->login($user)) {
				$this->Session->write('User',$user);
				$this->Session->setFlash('User '.$user['User']['username'].' logged in.');
				$this->redirect('/admin/events',null,true);
			} else {
				$this->Session->setFlash('The login credentials you supplied could not be recognized. Please try again.');
			}
		}
	}
	
	function admin_logout() {
		$this->Session->delete('User');
		$this->Session->setFlash('User logged out.');
		$this->redirect('/admin/users/login',null,true);
	}
	
	function submit() {
		$this->layout = 'default';
		if (!empty($this->data)) {
			$data = $this->data;
			if ($data['User']['email'] && $data['User']['headline'] && $data['User']['date'] && $data['User']['location']) {
                $this->Email->to = Configure::read('Calendar.admin_email');
                $this->Email->subject = '['.Configure::read('Calendar.name').'] Event Submission';
                $this->Email->from = $data['User']['email'];
                $this->Email->template = 'calendar';
                $this->set('user',$data['User']);
                if ($this->Email->send()) {
                	$this->Session->setFlash('Your calendar submission has been successfully received.');
                	$this->redirect('/',null,true);
                } else {
                	$this->Session->setFlash('Sorry, but there was an error receiving your submission. Please try again.');
                }
        	} else {
        		$this->Session->setFlash('You must fill out all the required fields to submit an event.');
        	}
		}
	}
	
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users',$this->paginate());
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('This User has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('This User could not be saved. Please try again.');
			}
		}
	}
	
	function admin_edit($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid User to edit.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		} 
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The User has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('Sorry, the User could not be saved.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null,$id);
		}
	}
	
	function admin_delete($id=null) {
		if (!$id) {
			$this->Session->setFlash('Invalid ID for User.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash('User id #'.$id.' deleted.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
	}

}
?>