<?
class CalendarsController extends AppController {
	var $name = 'Calendars';
	var $layout = 'admin';
	var $components = array('Auth');
	
	function beforeFilter() {
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login','prefix'=>'admin');
		$this->Auth->redirectLogin = array('action'=>'index','prefix'=>'admin');
		$this->Auth->allow(array('findNameByShortname','findCalendars'));
	}
	
	function admin_index() {
		$this->Calendar->recursive = 0;
		$this->set('calendars',$this->paginate());
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Calendar->create();
			if ($this->Calendar->save($this->data)) {
				$this->Session->setFlash('This Calendar has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('This Calendar could not be saved. Please try again.');
			}
		}
		$tags = $this->Calendar->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_edit($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Calendar to edit.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		} 
		if (!empty($this->data)) {
			if ($this->Calendar->save($this->data)) {
				$this->Session->setFlash('The Calendar has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('Sorry, the Calendar could not be saved.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calendar->read(null,$id);
		}
		$tags = $this->Calendar->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_delete($id=null) {
		if (!$id) {
			$this->Session->setFlash('Invalid ID for Calendar.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
		if ($this->Calendar->del($id)) {
			$this->Session->setFlash('Calendar id #'.$id.' deleted.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
	}
	
	function findNameByShortname($shortname=null) {
		$calendar = $this->Calendar->find(array('shortname'=>$shortname),array('name'));
		return $calendar['Calendar']['name'];
	}
	
	function findCalendars() {
		$this->Calendar->recursive = 1;
		return $this->Calendar->find('all');
	}
	
}
?>