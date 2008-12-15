<?
/**
 * Manages User records and access
 *
 */
class UsersController extends AppController {
	
/**
 * Controller name for backwards compatibility in PHP 4
 *
 * @var string $name Name of table & controller
 */
	var $name = 'Users';
	
/**
 * Default layout used by this controller
 *
 * @var $layout	The filename (without extension) of the views/layouts file
 */
	var $layout = 'admin';
	
/**
 * Components used by this controller
 *
 * @var array $components Components to be included
 */
	var $components = array('Auth','Email');
	
/**
 * Any logic to be run before the controller function calls
 *
 */
	function beforeFilter() {
		$this->Auth->allow(array('admin_login','admin_logout','submit'));
		$this->Auth->loginAction = array('action'=>'admin_login');
	}
	
/**
 * Handles user log in
 *
 */
	function admin_login(){
		
	}
	
/**
 * Logs out the user
 *
 */
	function admin_logout() {
		$this->Session->setFlash('User logged out.');
		$this->redirect($this->Auth->logout());
	}
	
/**
 * Returns the password hash for a given password; for admin purposes
 *
 * @param string $pass	The password to hash
 * @return Hashed equivalent of $pass
 */
	function password($pass=null) {
		$this->set('pass',$this->Auth->password($pass));
	}
	
/**
 * Sends email request to calendar's administrator to include an event
 *
 */
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
	
/**
 * Lists all users
 *
 */
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users',$this->paginate());
	}
	
/**
 * Adds a user to the db
 *
 */
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
	
/**
 * Edits a given user record
 *
 * @param int $id	The ID of the user record to edit
 */
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
	
/**
 * Deletes a given user record
 *
 * @param int $id	The ID of the user record to delete
 */
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