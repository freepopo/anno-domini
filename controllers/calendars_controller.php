<?
/**
 * Controller functions for handling the Calendars table and elements
 *
 */
class CalendarsController extends AppController {

/**
 * Controller name for backwards compatibility in PHP 4
 *
 * @var string $name Name of table & controller
 */
	var $name = 'Calendars';
	
/**
 * Default layout for this controller
 *
 * @var string $layout The layout's filename without extension
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
		$this->Auth->allow(array('findNameByShortname','findCalendars'));
	}
	
/**
 * The index action, lists all calendars stored in the db
 *
 */
	function admin_index() {
		$this->Calendar->recursive = 0;
		$this->set('calendars',$this->paginate());
	}
	
/**
 * Adds calendars to the db
 *
 */
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
	
/**
 * Edits a calendar record
 *
 * @param int $id	The ID of the calendar record to edit
 */
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
	
/**
 * Deletes a calendar record
 *
 * @param int $id	The ID of the calendar record to delete
 */
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
	
/**
 * Returns the name field of a calendar record for a given shortname
 *
 * @param string $shortname	The shortname to lookup
 * @return string	The contents of the name field for the matching record
 */
	function findNameByShortname($shortname=null) {
		$calendar = $this->Calendar->find(array('shortname'=>$shortname),array('name'));
		return $calendar['Calendar']['name'];
	}
	
/**
 * Returns all calendar records
 *
 * @return array	All calendar records without associated table data
 */
	function findCalendars() {
		$this->Calendar->recursive = 1;
		return $this->Calendar->find('all');
	}
	
}
?>