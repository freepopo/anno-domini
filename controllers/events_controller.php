<?
class EventsController extends AppController {
	var $name = 'Events';
	var $components = array('Domini');
	
	function beforeFilter() {
		if ($this->action != 'view') {
			$this->layout = 'admin';
			$this->checkAdmin();
		}
	}
	
	function view($calendar=null,$tag=null,$date=null) {
		$data = $this->Domini->parseUrl($calendar,$tag,$date);
		$prev = $this->Domini->findPrev($this->params['pass']);
		$next = $this->Domini->findNext($this->params['pass']);
		$events = $this->Event->findEvents($data);
		$data['calendar_name'] = $this->requestAction('/calendars/findNameByShortname/'.$calendar);
		$data['tag_name'] = $this->requestAction('/tags/findNameByShortname/'.$tag);
		$this->set(compact('events','prev','next','data'));
	}
	
	function admin_index() {
		$this->Event->recursive = 0;
		$this->set('events',$this->paginate());
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Event->create();
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash('This Event has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('This Event could not be saved. Please try again.');
			}
		}
		$tags = $this->Event->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_edit($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Event to edit');
			$this->redirect(array('action'=>'admin_index'),null,true);
		} 
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash('The Event has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('Sorry, the Event could not be saved.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null,$id);
		}
		$tags = $this->Event->Tag->find('list');
		$this->set(compact('tags'));
	}
	
	function admin_delete($id=null) {
		if (!$id) {
			$this->Session->setFlash('Invalid ID for Event.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
		if ($this->Event->del($id)) {
			$this->Session->setFlash('Event id #'.$id.' deleted.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
	}
}
?>