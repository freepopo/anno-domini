<?
class CalendarsController extends AppController {
	var $name = 'Calendars';
	var $components = array('Domini');
	var $layout = 'admin';
	
	function beforeFilter() {
		if ($this->action != 'findNameByShortname' && $this->action != 'findCalendars') {
			$this->checkAdmin();
		}
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