<?
class TagsController extends AppController {
	var $name = 'Tags';
	var $layout = 'admin';
	
	function beforeFilter() {
		if ($this->action != 'findNameByShortname') {
			$this->checkAdmin();
		}
	}
	
	function admin_index() {
		$this->Tag->recursive = 0;
		$this->set('tags',$this->paginate());
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash('This Tag has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('This Tag could not be saved. Please try again.');
			}
		}
		$calendars = $this->Tag->Calendar->find('list');
		$this->set(compact('calendars'));
	}
	
	function admin_edit($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Tag to edit');
			$this->redirect(array('action'=>'admin_index'),null,true);
		} 
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash('The Tag has been saved.');
				$this->redirect(array('action'=>'admin_index'),null,true);
			} else {
				$this->Session->setFlash('Sorry, the Tag could not be saved.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null,$id);
		}
		$calendars = $this->Tag->Calendar->find('list');
		$this->set(compact('calendars'));
	}
	
	function admin_delete($id=null) {
		if (!$id) {
			$this->Session->setFlash('Invalid ID for Tag.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash('Tag id #'.$id.' deleted.');
			$this->redirect(array('action'=>'admin_index'),null,true);
		}
	}
	
	function findNameByShortname($shortname=null) {
		$tag = $this->Tag->find(array('shortname'=>$shortname),array('name'));
		return $tag['Tag']['name'];
	}
}
?>