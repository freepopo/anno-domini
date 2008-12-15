<?
/**
 * Controller functions for handling Tags
 *
 */
class TagsController extends AppController {
	
/**
 * Controller name for backwards compatibility in PHP 4
 *
 * @var string $name Name of table & controller
 */
	var $name = 'Tags';
	
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
	var $components = array('Auth');
	
/**
 * Any logic to be run before the controller function calls
 *
 */
	function beforeFilter() {
		$this->Auth->loginAction = array('controller'=>'users','action'=>'login','prefix'=>'admin');
		$this->Auth->redirectLogin = array('action'=>'index','prefix'=>'admin');
		$this->Auth->allow(array('findNameByShortname'));
	}
	
/**
 * Lists all Tags records
 *
 */
	function admin_index() {
		$this->Tag->recursive = 0;
		$this->set('tags',$this->paginate());
	}

/**
 * Adds a tag record to the database
 *
 */
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
	
/**
 * Edits a given tag record
 *
 * @param int $id	The ID of the tag record to edit
 */
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
	
/**
 * Deletes a given tag record
 *
 * @param int $id The ID of the tag record to delete
 */
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
	
/**
 * Returns the name of a tag record for a given shortname
 *
 * @param string $shortname	The shortname to look up
 * @return The matching tag's name
 */
	function findNameByShortname($shortname=null) {
		$tag = $this->Tag->find(array('shortname'=>$shortname),array('name'));
		return $tag['Tag']['name'];
	}
}
?>